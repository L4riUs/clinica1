<?php
    namespace Proyecto\Clinica\Models;

class Entradas extends Conexion {
    private $id;
    private $id_proveedor;
    private $numero_de_lote;
    private $fecha_ingreso;
    private $precio_compra;

    public function __construct($id = null, $id_proveedor = null, $numero_de_lote = null, $fecha_ingreso = null, $precio_compra = null) {
        parent::__construct();
        $this->id = $id;
        $this->id_proveedor = $id_proveedor;
        $this->numero_de_lote = $numero_de_lote;
        $this->fecha_ingreso = $fecha_ingreso;
        $this->precio_compra = $precio_compra;
    }

    public function insertar() {
        $sql = "INSERT INTO entradas (id_proveedor, numero_de_lote, fecha_ingreso, precio_compra) 
                VALUES (:id_proveedor, :numero_de_lote, :fecha_ingreso, :precio_compra)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':id_proveedor'   => $this->id_proveedor,
            ':numero_de_lote' => $this->numero_de_lote,
            ':fecha_ingreso'  => $this->fecha_ingreso,
            ':precio_compra'  => $this->precio_compra
        ]);
        $this->id = $this->conexion->lastInsertId();
        return $this->id;
    }

    public function actualizar() {
        $sql = "UPDATE entradas SET id_proveedor = :id_proveedor, numero_de_lote = :numero_de_lote, 
                fecha_ingreso = :fecha_ingreso, precio_compra = :precio_compra WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':id_proveedor'   => $this->id_proveedor,
            ':numero_de_lote' => $this->numero_de_lote,
            ':fecha_ingreso'  => $this->fecha_ingreso,
            ':precio_compra'  => $this->precio_compra,
            ':id'             => $this->id
        ]);
    }

    public function eliminar() {
        $sql = "DELETE FROM entradas WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id' => $this->id]);
    }

    public function getEntradas($filtro = []) {
        $sql = "SELECT * FROM entradas WHERE 1";
        $params = [];
        if (!empty($filtro['id_proveedor'])) {
            $sql .= " AND id_proveedor = :id_proveedor";
            $params[':id_proveedor'] = $filtro['id_proveedor'];
        }
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}