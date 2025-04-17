<?php
    include_once("../../Models/Conexion.php");
    include_once("../../Models/Diagnosticos.php");
    $id = $_GET["id"];
    $descripcion = $_POST["descripcion"];
    $tratamiento = $_POST["tratamiento"];
    $codigo_cita = $_POST["codigo_cita"];
    $fecha = $_POST["fecha"];

    $diagnostico = new Diagnostico();
    $diagnostico->setId($id);
    $diagnostico->setDescripcion($descripcion);
    $diagnostico->setTratamiento($tratamiento);
    $diagnostico->setidCita($codigo_cita);
    $diagnostico->setFecha($fecha);
    $diagnostico->actualizar();
    header("location:../../Diagnostico");
?>