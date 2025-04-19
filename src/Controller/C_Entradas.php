<?php

namespace Proyecto\Clinica\Controller;

use Proyecto\Clinica\Models\Entradas;
use Proyecto\Clinica\Models\DetallesEntrada;
use Exception;

class C_Entradas
{

    public function procesarEntradaConDetalles()
    {
        try {
            $entrada = new Entradas(null, $_POST['id_proveedor'], $_POST['numero_de_lote'], $_POST['fecha_ingreso'], $_POST['precio_compra']);
            $id_entrada = $entrada->insertar();
            $detalle = new DetallesEntrada(null, $_POST['id_insumo'], $id_entrada, $_POST['fecha_vencimiento'], $_POST['precio'], $_POST['cantidad_entrante'], $_POST['cantidad_entrante'], $_POST['estado']);
            $detalle->insertar();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
