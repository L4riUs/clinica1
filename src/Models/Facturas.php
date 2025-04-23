<?php
namespace Proyecto\Clinica\Models;
use DateTime;

class Facturas extends Conexion {
    private $id;
    private $id_paciente;
    private $fecha;
    private $total;
    private $estado;

    public function __construct($id = null, $id_paciente = null, $fecha = null, $total = null, $estado = null) {
        parent::__construct();
        $this->id = $id;
        $this->id_paciente = $id_paciente;
        $this->fecha = $fecha;
        $this->total = $total;
        $this->estado = $estado;
    }

    public function insertarDesdeCita($id_cita) {
        // 1) Obtiene datos de cita y servicio
        $citaSql = "SELECT c.id_paciente, c.emergencia, sm.precio AS precio_servicio
                    FROM citas c
                    JOIN servicio_medico sm ON c.id_servicio_medico = sm.id
                    WHERE c.id = :id_cita";
        $stmt = $this->conexion->prepare($citaSql);
        $stmt->execute([':id_cita' => $id_cita]);
        $cita = $stmt->fetch();

        // 2) Calcula total
        $total = $cita['precio_servicio'];
        $this->id_paciente = $cita['id_paciente'];
        $this->fecha = date('Y-m-d');
        $this->estado = 'PENDIENTE';

        // 3) Si emergencia, suma insumos de hospitalización
        if ($cita['emergencia']) {
            // a) Obtenemos control e ID de hospitalización
            $controlStmt = $this->conexion
                ->prepare("SELECT id FROM control WHERE id_cita = :id_cita");
            $controlStmt->execute([':id_cita' => $id_cita]);
            $control = $controlStmt->fetch();
    
            $hospStmt = $this->conexion
                ->prepare("SELECT id, fecha_hora_inicio, fecha_hora_final, precio_horas FROM hospitalizacion WHERE id_control = :id_control");
            $hospStmt->execute([':id_control' => $control['id']]);
            $h = $hospStmt->fetch();
    
            // b) Costo de hospitalización: diferencia en horas × tarifa por hora
            $inicio = new DateTime($h['fecha_hora_inicio']);
            $fin    = new DateTime($h['fecha_hora_final']);
            $intervalo = $fin->diff($inicio);
            $horas     = $intervalo->days * 24
                       + $intervalo->h
                       + $intervalo->i / 60;
            $costoHospital = $horas * $h['precio_horas'];
            $total += $costoHospital;
    
            // c) Ahora traemos insumos ligados a esa hospitalización
            $ih      = new InsumoHospitalizacion();
            $insumos = $ih->getPorHospitalizacion($h['id']);
            foreach ($insumos as $item) {
                $total += $item['precio_unitario'] * $item['cantidad'];
            }
        }

        $fSql = "INSERT INTO facturas (id_paciente, fecha, total, estado)
                 VALUES (:id_paciente, :fecha, :total, :estado)";
        $fStmt = $this->conexion->prepare($fSql);
        $fStmt->execute([
            ':id_paciente' => $this->id_paciente,
            ':fecha'       => $this->fecha,
            ':total'       => $total,
            ':estado'      => $this->estado,
        ]);
        $this->id = $this->conexion->lastInsertId();

        // 5) Detalles de inventario si emergencia
        if (!empty($insumos)) {
            $invSql = "SELECT id FROM inventario WHERE id_insumo_hospitalizacion = :id_ih";
            $invStmt = $this->conexion->prepare($invSql);
            foreach ($insumos as $item) {
                $invStmt->execute([':id_ih' => $item['id']]);
                $invs = $invStmt->fetchAll();
                foreach ($invs as $inv) {
                    $df = new DetallesFactura(null, $this->id, $inv['id']);
                    $df->insertar();
                }
            }
        }

        return $this->id;
    }

   
    public function pagar($id_factura, array $pagos) {
        $uSql = "UPDATE facturas SET estado = 'PAGADO' WHERE id = :id";
        $uStmt = $this->conexion->prepare($uSql);
        $uStmt->execute([':id' => $id_factura]);

        // 2) Inserta cada pago
        foreach ($pagos as $pago) {
            $p = new Pagos(null, $pago['id_metodo_pago'], $id_factura, $pago['referencia'], $pago['monto']);
            $p->insertar();
        }
    }
}

// public function insertarDesdeCita($id_cita) {
//     // … (todo lo anterior permanece igual: obtención de cita, cálculo de total, inserción de factura) …

//     // 5) Detalles de insumos en emergencia, ahora desde insumo_hospitalizacion
//     if (!empty($insumos)) {
//         // obtenemos directamente los registros vinculados a la hospitalización
//         $ihStmt = $this->conexion->prepare("
//             SELECT 
//                 ih.id            AS id_ih,
//                 ih.id_insumo     AS id_insumo,
//                 ih.cantidad      AS cantidad,
//                 i.precio         AS precio_unitario
//             FROM insumo_hospitalizacion ih
//             JOIN insumos i ON ih.id_insumo = i.id
//             WHERE ih.id_hospitalizacion = :id_hosp
//         ");
//         $ihStmt->execute([':id_hosp' => $h['id']]);
//         $consumos = $ihStmt->fetchAll();

//         // para cada consumo, calculamos subtotal y creamos el detalle de factura
//         foreach ($consumos as $c) {
//             // 1) Sumamos al total (si no lo hiciste antes)
//             $subtotal = $c['precio_unitario'] * $c['cantidad'];
//             // (opcional) — si quieres ajustar el campo total después de la inserción:
//             // $this->total += $subtotal;

//             // 2) Insertamos en detalles_factura usando id_insumo_hospitalizacion
//             //    Si la tabla detalles_factura sigue apuntando a inventario, deberías
//             //    adaptar su estructura para usar id_insumo_hospitalizacion en lugar de id_inventario.
//             $df = new DetallesFactura(null, $this->id, $c['id_ih']);
//             $df->insertar();
//         }
//     }

//     return $this->id;
// }