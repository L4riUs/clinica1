<?php
namespace Proyecto\Clinica\Models;
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
            $controlSql = "SELECT id FROM control WHERE id_cita = :id_cita";
            $cStmt = $this->conexion->prepare($controlSql);
            $cStmt->execute([':id_cita' => $id_cita]);
            $control = $cStmt->fetch();

            $hSql = "SELECT id FROM hospitalizacion WHERE id_control = :id_control";
            $hStmt = $this->conexion->prepare($hSql);
            $hStmt->execute([':id_control' => $control['id']]);
            $h = $hStmt->fetch();

            $ih = new InsumoHospitalizacion();
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