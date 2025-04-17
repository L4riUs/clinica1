<?php
    include_once("../../Models/Conexion.php");
    include_once("../../Models/Citas.php");
    $id_paciente = $_POST["id_paciente"];
    $id_doctor = $_POST["id_doctor"];
    $motivo = $_POST["motivo"];
    $precio = $_POST["precio"];
    $fecha = $_POST["fecha"];
    $emergencia = $_POST["emergencia"] == "false" ? 1 : 0;

    $cita = new Cita();
    $cita->setIdPaciente($id_paciente);
    $cita->setIdDoctor($id_doctor);
    $cita->setMotivo($motivo);
    $cita->setPrecio($precio);
    $cita->setFecha($fecha);
    $cita->setEmergencia($emergencia);
    $cita->insertar();

    header("Location: ../../Citas");
?>