<?php

namespace Proyecto\Clinica\Controller;
use Proyecto\Clinica\Models\Personal;

class C_Personal
{

    public function Index()
    {
        $titulo = "Doctores";
        $descripcion = "Esta es la pagina de doctores";
        include_once __DIR__ . '/../Views/V_Doctores.php';
    }

    public function BuscarDoctores()
    {
        $personal = new Personal();
        if (isset($_GET["id"])) {
            $personal->setId($_GET["id"]);
        }
        if (isset($_GET["cedula"])) {
            $personal->setCedula($_GET["cedula"]);
        }
        $personal = $personal->getPersonal();
        echo json_encode($personal);
    }
    public function GestionarDoctor()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id= $_POST["id"];
            $cedula = $_POST["cedula"];
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $telefono = $_POST["telefono"];
            $personal = new Personal();
            $personal->setId($id);
            $personal->setCedula($cedula);
            $personal->setNombre($nombre);
            $personal->setApellido($apellido);
            $personal->setTelefono($telefono);
            if ($id == "") {
                $personal->insertar();
            } else {
                $personal->actualizar();
            }
        } else {
            echo json_encode(array("error" => "No se ha enviado un POST"));
        }
    }
    public function EliminarDoctor()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST["id"];
            $personal = new Personal();
            $personal->setId($id);
            $personal->eliminar();
        } else {
            echo json_encode(array("error" => "No se ha enviado un POST"));
        }
    }
}
