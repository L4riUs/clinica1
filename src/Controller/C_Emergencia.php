<?php

namespace Proyecto\Clinica\Controller;
use Proyecto\Clinica\Models\InsumoHospitalizacion;
use Exception;

class C_Emergencia
{
    public function desc()
    {
        try {
            $insumo = new InsumoHospitalizacion(null, $_POST['id_hospitalizacion'], $_POST['id_insumo'], $_POST['cantidad']);
            $insumo->insertar();
        } catch (Exception $e) {
            throw $e;
        }
    }
}