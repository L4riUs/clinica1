<?php

namespace Proyecto\Clinica\Controller;

use Proyecto\Clinica\Models\Citas;

class C_Citas
{
    public function Index()
    {
        $titulo = "Citas";
        $descripcion = "Esta es la página de citas";
        include_once __DIR__ . '/../Views/V_Citas.php';
    }

    public function BuscarCitas()
    {
        $citas = new Citas();
        if (isset($_GET["id"])) {
            $citas->setId($_GET["id"]);
        }
        $resultado = $citas->getCitas();
        echo json_encode($resultado);
    }

    public function GuardarCitas()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            print_r($_POST);
            $id_paciente = $_POST["id_paciente"];
            $id_servicio = $_POST["id_servicio_medico"];
            $id_personal = $_POST["id_personal"];
            $fecha = $_POST["fecha"];
            $emergencia = $_POST["emergencia"] == "si" ? 1 : 0;
            $estado = 1;

            $cita = new Citas();
            $cita->setIdPaciente($id_paciente);
            $cita->setIdPersonal($id_personal);
            $cita->setIdServicioMedico($id_servicio);
            $cita->setFecha($fecha);
            $cita->setEmergencia($emergencia);
            $cita->setEstado($estado);
            $cita->insertar();

            echo json_encode(["status" => "success", "message" => "Cita guardada correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Método no permitido"]);
        }
    }
    public function toggleEstado()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(["status" => "error", "message" => "Método no permitido"]);
            return;
        }

        $cita = new Citas();
        $cita->setId($_POST["id"]);
        $cita->toggleEstado();

        echo json_encode(["status" => "success", "message" => "Cita actualizada correctamente"]);
    }
}
