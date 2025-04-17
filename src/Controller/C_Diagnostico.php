<?php

namespace Proyecto\Clinica\Controller;
use Proyecto\Clinica\Models\Diagnosticos;

class C_Diagnostico
{
    public function Index()
    {
        $titulo = "Diagnostico";
        $descripcion = "Esta es la pagina de diagnostico";
        include_once __DIR__ . '/../Views/V_Diagnostico.php';
    }
    public function BuscarDiagnosticos(){
        $diagnosticos = new Diagnosticos();

        if (isset($_GET['id'])) {
            $diagnosticos->setId($_GET['id']);
        }
    
        echo json_encode($diagnosticos->getDiagnosticos());
    }
}
