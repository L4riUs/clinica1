<?php
    namespace Proyecto\Clinica\Models;

class DetallesEntrada extends Conexion {
    private $id;
    private $id_insumo;
    private $id_entrada;
    private $fecha_vencimiento;
    private $precio;
    private $cantidad_entrante;
    private $existencia;
    private $estado;

    public function __construct($id = null, $id_insumo = null, $id_entrada = null, $fecha_vencimiento = null, $precio = null, $cantidad_entrante = null, $existencia = null, $estado = null) {
        parent::__construct();
        $this->id = $id;
        $this->id_insumo = $id_insumo;
        $this->id_entrada = $id_entrada;
        $this->fecha_vencimiento = $fecha_vencimiento;
        $this->precio = $precio;
        $this->cantidad_entrante = $cantidad_entrante;
        $this->existencia = $existencia;
        $this->estado = $estado;
    }

    public function insertar() {
        $sql = "INSERT INTO detalles_entrada (id_insumo, id_entrada, fecha_vencimiento, precio, cantidad_entrante, existencia, estado)
                VALUES (:id_insumo, :id_entrada, :fecha_vencimiento, :precio, :cantidad_entrante, :existencia, :estado)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':id_insumo'         => $this->id_insumo,
            ':id_entrada'        => $this->id_entrada,
            ':fecha_vencimiento' => $this->fecha_vencimiento,
            ':precio'            => $this->precio,
            ':cantidad_entrante' => $this->cantidad_entrante,
            ':existencia'        => $this->existencia,
            ':estado'            => $this->estado
        ]);
        $this->id = $this->conexion->lastInsertId();
        return $this->id;
    }

    public function actualizar() {
        $sql = "UPDATE detalles_entrada 
                SET id_insumo = :id_insumo, fecha_vencimiento = :fecha_vencimiento, precio = :precio, 
                    cantidad_entrante = :cantidad_entrante, existencia = :existencia, estado = :estado
                WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':id_insumo'         => $this->id_insumo,
            ':fecha_vencimiento' => $this->fecha_vencimiento,
            ':precio'            => $this->precio,
            ':cantidad_entrante' => $this->cantidad_entrante,
            ':existencia'        => $this->existencia,
            ':estado'            => $this->estado,
            ':id'                => $this->id
        ]);
    }

    public function eliminar() {
        $sql = "DELETE FROM detalles_entrada WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id' => $this->id]);
    }

    public function getDetalles($filtro = []) {
        $sql = "SELECT de.*, i.nombre AS insumo, e.numero_de_lote 
                FROM detalles_entrada de
                JOIN insumos i ON de.id_insumo = i.id
                JOIN entradas e ON de.id_entrada = e.id
                WHERE 1";
        $params = [];
        if (!empty($filtro['id_entrada'])) {
            $sql .= " AND de.id_entrada = :id_entrada";
            $params[':id_entrada'] = $filtro['id_entrada'];
        }
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}