<?php

namespace Proyecto\Clinica\Controller;
use Proyecto\Clinica\Models\Facturas;
use Exception;

class C_Facturas
{
    public function desc()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            // 1) Crear factura (incluye insumos si emergencia)
            $factura = new Facturas();
            $id_factura = $factura->insertarDesdeCita($data['id_cita']);
            // 2) Registrar pagos
            $factura->pagar($id_factura, $data['pagos']);
            return $id_factura;
        } catch (Exception $e) {
            throw $e;
        }
    }
}