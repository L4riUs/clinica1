<?php

namespace Proyecto\Clinica\Models;

class Inventario extends Conexion
{
    public function resumenInventario()
    {
        $sql = "SELECT de.id_insumo, ins.nombre, SUM(de.existencia) AS total_existencia
                FROM detalles_entrada de
                JOIN insumos ins ON de.id_insumo = ins.id
                GROUP BY de.id_insumo";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function detallePorInsumo($id_insumo)
    {
        $sql = "SELECT de.*, e.numero_de_lote
                FROM detalles_entrada de
                JOIN entradas e ON de.id_entrada = e.id
                WHERE de.id_insumo = :id_insumo";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id_insumo' => $id_insumo]);
        return $stmt->fetchAll();
    }
}
