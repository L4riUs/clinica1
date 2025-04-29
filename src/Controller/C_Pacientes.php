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
    public function GuardarPacientes() {
        $pacientes = new Pacientes();
        $pacientes->setNombre($_POST['nombre']);
        $pacientes->setCedula($_POST['cedula']);
        $pacientes->setApellido($_POST['apellido']);
        $pacientes->setTelefono($_POST['telefono']);
        $pacientes->setDireccion($_POST['direccion']);
        $pacientes->setFechaNacimiento($_POST['fecha_nacimiento']);
        $pacientes->setEstado(1);
    
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $pacientes->setId($_POST['id']);
            echo json_encode($pacientes->actualizar());
        } else {
            echo json_encode($pacientes->insertar());
        }
    }
    public function EliminarPacientes(){
        $pacientes = new Pacientes();
        $pacientes->setId($_POST['id']);
        echo json_encode($pacientes->eliminar());
    }
    public function ActualizarPacientes(){
        $pacientes = new Pacientes();
            $pacientes->setId($_POST['id']);
            $pacientes->setNombre($_POST['nombre']);
            $pacientes->setApellido($_POST['apellido']);
            $pacientes->setTelefono($_POST['telefono']);
            $pacientes->setDireccion($_POST['direccion']);
            $pacientes->setFechaNacimiento($_POST['fecha_nacimiento']);
        echo json_encode($pacientes->actualizar());
    }
}
