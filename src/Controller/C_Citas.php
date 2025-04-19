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
    public function BuscarCitas($id)
    {
        $citas = new Citas();
        $citas->setId($id);
        echo json_encode($citas->getCitas());
    }
    public function crearCita()
    {
        $id_paciente = $_POST["id_paciente"];
        $id_doctor = $_POST["id_doctor"];
        $motivo = $_POST["motivo"];
        $precio = $_POST["precio"];
        $fecha = $_POST["fecha"];
        $emergencia = $_POST["emergencia"] == "false" ? 1 : 0;

        $cita = new Citas();
        $cita->setIdPaciente($id_paciente);
        $cita->setIdDoctor($id_doctor);
        $cita->setMotivo($motivo);
        $cita->setPrecio($precio);
        $cita->setFecha($fecha);
        $cita->setEmergencia($emergencia);
        $cita->insertar();

        header("Location: ?c=Citas");
    }
}
