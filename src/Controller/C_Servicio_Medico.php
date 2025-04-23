<?php

namespace Proyecto\Clinica\Controller;

use Proyecto\Clinica\Models\ServiciosMedicos;

class C_Servicio_Medico
{
    public function Index() {
        $titulo = "Servicios Médicos";
        $descripcion = "Esta es la página de servicios médicos";
        include_once __DIR__ . '/../Views/V_Servicio_Medico.php';
    }

    public function BuscarServiciosMedicos() {
        $servicios_medicos = new ServiciosMedicos();
        if (isset($_GET["id"])) {
            $servicios_medicos->setId($_GET["id"]);
        }
        $resultado = $servicios_medicos->getServiciosMedicos();
        echo json_encode($resultado);
    }

    public function GuardarServiciosMedicos() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_especialidad = $_POST["id_especialidad"];
            $id_doctor = $_POST["id_doctor"];
            $precio = $_POST["precio"];

            $servicios_medicos = new ServiciosMedicos();
            $servicios_medicos->setIdEspecialidad($id_especialidad);
            $servicios_medicos->setIdDoctor($id_doctor);
            $servicios_medicos->setPrecio($precio);
            $servicios_medicos->insertar();

            echo json_encode(["status" => "success", "message" => "Servicio médico guardado correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Método no permitido"]);
        }
    }
    public function ActualizarServiciosMedicos() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_especialidad = $_POST["id_especialidad"];
            $id_doctor = $_POST["id_doctor"];
            $precio = $_POST["precio"];

            $servicios_medicos = new ServiciosMedicos();
            $servicios_medicos->setIdEspecialidad($id_especialidad);
            $servicios_medicos->setIdDoctor($id_doctor);
            $servicios_medicos->setPrecio($precio);
            $servicios_medicos->actualizar();

            echo json_encode(["status" => "success", "message" => "Servicio médico actualizado correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Método no permitido"]);
        }
    }
    public function EliminarServiciosMedicos() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST["id"];

            $servicios_medicos = new ServiciosMedicos();
            $servicios_medicos->setId($id);
            $servicios_medicos->eliminar();

            echo json_encode(["status" => "success", "message" => "Servicio médico eliminado correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Método no permitido"]);
        }
    }    
}   