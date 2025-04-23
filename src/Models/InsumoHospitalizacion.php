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
        $usedLots = $this->ajustarInventario(-$this->cantidad);
        $this->insertarInventarioConsumo($usedLots);
        return $this->id;
    }

    private function ajustarInventario(int $delta): array
    {
        $sql = "
        SELECT de.id, de.existencia, de.fecha_vencimiento, e.numero_de_lote, de.precio
        FROM detalles_entrada de
        JOIN entradas e ON de.id_entrada = e.id
        WHERE de.id_insumo = :id_insumo
          AND de.existencia > 0
        ORDER BY de.fecha_vencimiento ASC
    ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id_insumo' => $this->id_insumo]);
        $lotes = $stmt->fetchAll();

        $remaining = abs($delta);
        $usedLots  = [];

        foreach ($lotes as $lote) {
            if ($remaining <= 0) break;
            $uso = min($lote['existencia'], $remaining);

            $upd = "UPDATE detalles_entrada SET existencia = existencia - :uso WHERE id = :id";
            $uStmt = $this->conexion->prepare($upd);
            $uStmt->execute([
                ':uso' => $uso,
                ':id'  => $lote['id']
            ]);
            $usedLots[] = [
                'cantidad'        => $uso,
                'fecha_vencimiento' => $lote['fecha_vencimiento'],
                'numero_lote'     => $lote['numero_de_lote'],
            ];
            $remaining -= $uso;
        }
        return $usedLots;
    }


    private function insertarInventarioConsumo(array $usedLots)
    {
        $invSql = "
            INSERT INTO inventario 
                (id_insumo, id_insumo_hospitalizacion, cantidad, fecha_vencimiento, numero_lote)
            VALUES 
                (:id_insumo, :id_ih, :cantidad, :fv, :nl)
        ";
        $invStmt = $this->conexion->prepare($invSql);
        foreach ($usedLots as $lot) {
            $invStmt->execute([
                ':id_insumo'  => $this->id_insumo,
                ':id_ih'      => $this->id,
                ':cantidad'   => $lot['cantidad'],
                ':fv'         => $lot['fecha_vencimiento'],
                ':nl'         => $lot['numero_lote'],
            ]);
        }
    }


    public function getPorHospitalizacion($id_hospitalizacion)
    {
        $sql = "
        SELECT
            ih.id,
            ih.id_insumo,
            ih.cantidad,
            i.nombre,
            i.precio     AS precio_unitario
        FROM insumo_hospitalizacion ih
        JOIN insumos i ON ih.id_insumo = i.id
        WHERE ih.id_hospitalizacion = :id_hospitalizacion
    ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id_hospitalizacion' => $id_hospitalizacion]);
        return $stmt->fetchAll();
    }
}
