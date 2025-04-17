<?php

namespace Proyecto\Clinica\Controller;
use Proyecto\Clinica\Models\Doctores;

class C_Doctores
{
    public function Index()
    {
        $titulo = "Doctores";
        $descripcion = "Esta es la pagina de doctores";
        include_once __DIR__ . '/../Views/V_Doctores.php';
    }

    public function searchDoctor()
    {
        $doctores = new Doctores();
        $doctores = $doctores->getDoctores();
        echo json_encode($doctores);
    }
}
