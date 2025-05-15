<?php

namespace Proyecto\Clinica\Controller;

use Proyecto\Clinica\Models\Citas;
use Proyecto\Clinica\Models\HorarioPersonal;
use DateTime;

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
        if (isset($_GET["id_personal"])) {
            $citas->setIdPersonal($_GET["id_personal"]);
        }
        if (isset($_GET["fecha"])) {
            $citas->setFecha($_GET["fecha"]);
        }
        $resultado = $citas->getCitas();
        echo json_encode($resultado);
    }
    public function BuscarCitasPast()
    {
        $citas = new Citas();
        if (isset($_GET["id"])) {
            $citas->setId($_GET["id"]);
        }
        if (isset($_GET["id_personal"])) {
            $citas->setIdPersonal($_GET["id_personal"]);
        }
        if (isset($_GET["fecha"])) {
            $citas->setFecha($_GET["fecha"]);
        }
        $resultado = $citas->getCitasPast();
        echo json_encode($resultado);
    }

    public function GuardarCitas()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_paciente = $_POST["id_paciente"];
            $id_servicio = $_POST["id_servicio_medico"];
            $id_personal = $_POST["id_personal"];
            $fecha = $_POST["fecha"];
            $emergencia = $_POST["emergencia"] == "si" ? 1 : 0;
            $estado = $_POST["emergencia"] == "si" ? 1 : 0;;

            $cita = new Citas();
            $cita->setIdPaciente($id_paciente);
            $cita->setIdPersonal($id_personal);
            $cita->setIdServicioMedico($id_servicio);
            $cita->setFecha($fecha);
            $cita->setEmergencia($emergencia);
            $cita->setEstado($estado);
            date_default_timezone_set('America/Caracas'); // configurar la zona horaria a venezuela
            $fechaActual = new DateTime(); // obtener la fecha y hora actual
            $fechaActual->format('Y-m-d H:i:s'); // formatear la fecha y hora en el formato deseado

            if ((new HorarioPersonal())->estaDisponible($_POST['id_personal'], $fechaActual)) {
                $cita->insertar();
                echo json_encode(["status" => "success", "message" => "Cita guardada correctamente"]);
            } else {
                echo json_encode(["status" => "error", "message" => "registro no permitido por conflicto de horario"]);
            }
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
