<?php

namespace Proyecto\Clinica\Controller;
use Proyecto\Clinica\Models\Citas;

class C_Citas
{
    public function Index()
    {
        $titulo = "Citas";
        $descripcion = "Esta es la pagina de citas";
        include_once __DIR__ . '/../Views/V_Citas.php';
    }
    public function BuscarCitas(){
        $citas = new Citas();
        if (isset($_GET['id'])) {
            $citas->setId($_GET['id']);
        }
        echo json_encode($citas->getCitas());
    }
}
