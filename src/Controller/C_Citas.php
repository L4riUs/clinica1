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
            $id_paciente = $_POST["id_paciente"];
            $id_personal = $_POST["id_personal"];
            $fecha = $_POST["fecha"];
            $emergencia = $_POST["emergencia"] == "false" ? 1 : 0;

            $cita = new Citas();
            $cita->setIdPaciente($id_paciente);
            $cita->setIdPersonal($id_personal);
            $cita->setFecha($fecha);
            $cita->setEmergencia($emergencia);
            $cita->insertar();

            echo json_encode(["status" => "success", "message" => "Cita guardada correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Método no permitido"]);
        }
    }
}
