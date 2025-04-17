<?php
    include_once("../../Models/Conexion.php");
    include_once("../../Models/Pacientes.php");
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cedula = $_POST['cedula'];
    $telefono = $_POST['telefono'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    $paciente = new Paciente();
    $paciente->setNombre($nombre);
    $paciente->setApellido($apellido);
    $paciente->setCedula($cedula);
    $paciente->setTelefono($telefono);
    $paciente->setFecha_nacimiento($fecha_nacimiento);
    $paciente->insertar();

    header("Location: ../../Pacientes");
?>