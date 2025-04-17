<?php

namespace Proyecto\Clinica\Controller;
use Proyecto\Clinica\Models\Pacientes;

class C_Pacientes
{
    public function Index()
    {
        $titulo = "Pacientes";
        $descripcion = "Esta es la pagina de pacientes";
        include_once __DIR__ . '/../Views/V_Pacientes.php';
    }
    public function BuscarPacientes(){
        $pacientes = new Pacientes();
        if (isset($_GET['id'])) {
            $pacientes->setId($_GET['id']);
        }
        echo json_encode($pacientes->getPacientes());
    }
}
