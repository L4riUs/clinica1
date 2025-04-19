<?php

namespace Proyecto\Clinica\Models;

class InsumoHospitalizacion extends Conexion
{
    private $id;
    private $id_hospitalizacion;
    private $id_insumo;
    private $cantidad;

    public function __construct($id = null, $id_hospitalizacion = null, $id_insumo = null, $cantidad = null)
    {
        parent::__construct();
        $this->id = $id;
        $this->id_hospitalizacion = $id_hospitalizacion;
        $this->id_insumo = $id_insumo;
        $this->cantidad = $cantidad;
    }

    public function insertar()
    {
        // registrar insumo en hospitalizacion
        $sql = "INSERT INTO insumo_hospitalizacion (id_hospitalizacion, id_insumo, cantidad)
                VALUES (:id_hospitalizacion, :id_insumo, :cantidad)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':id_hospitalizacion' => $this->id_hospitalizacion,
            ':id_insumo'          => $this->id_insumo,
            ':cantidad'           => $this->cantidad
        ]);
        $this->id = $this->conexion->lastInsertId();

        // descontar del inventario
        $this->ajustarInventario(-$this->cantidad);
        return $this->id;
    }

    private function ajustarInventario($delta)
    {
        // busca inventario disponible más antiguo
        $sql = "SELECT id, existencia FROM detalles_entrada 
                WHERE id_insumo = :id_insumo AND existencia > 0
                ORDER BY fecha_vencimiento ASC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id_insumo' => $this->id_insumo]);
        $lotes = $stmt->fetchAll();

        $remaining = abs($delta);
        foreach ($lotes as $lote) {
            if ($remaining <= 0) break;
            $uso = min($lote['existencia'], $remaining);
            $upd = "UPDATE detalles_entrada SET existencia = existencia + :delta WHERE id = :id";
            $uStmt = $this->conexion->prepare($upd);
            $uStmt->execute([
                ':delta' => ($delta < 0 ? -$uso : $uso),
                ':id'    => $lote['id']
            ]);
            $remaining -= $uso;
        }
    }

    public function getPorHospitalizacion($id_hospitalizacion)
    {
        $sql = "SELECT ih.*, i.nombre FROM insumo_hospitalizacion ih
                JOIN insumos i ON ih.id_insumo = i.id
                WHERE ih.id_hospitalizacion = :id_hospitalizacion";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id_hospitalizacion' => $id_hospitalizacion]);
        return $stmt->fetchAll();
    }
}
