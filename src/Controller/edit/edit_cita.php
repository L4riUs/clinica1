<?php
    include_once("../../Models/Conexion.php");
    include_once("../../Models/Citas.php");
    $id = $_GET["id"];
    $id_paciente = $_POST["id_paciente"];
    $id_doctor = $_POST["id_doctor"];
    $motivo = $_POST["motivo"];
    $precio = $_POST["precio"];
    $fecha = $_POST["fecha"];
    $emergencia = $_POST["emergencia"];

    $cita = new Cita();
    $cita->setId($id);
    $cita->setIdPaciente($id_paciente);
    $cita->setIdDoctor($id_doctor);
    $cita->setMotivo($motivo);
    $cita->setPrecio($precio);
    $cita->setFecha($fecha);
    $cita->setEmergencia($emergencia);
    $cita->actualizar();
    header("location:../../Citas");
?>