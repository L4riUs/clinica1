<?php
    include_once("../../Models/Conexion.php");
    include_once("../../Models/Doctores.php");
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cedula = $_POST['cedula'];
    $telefono = $_POST['telefono'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $especialidad = $_POST['especialidad'];

    $doctor = new Doctor();
    $doctor->setNombre($nombre);
    $doctor->setApellido($apellido);
    $doctor->setCedula($cedula);
    $doctor->setTelefono($telefono);
    $doctor->setFecha_nacimiento($fecha_nacimiento);
    $doctor->setEspecialidad($especialidad);
    $doctor->insertar();

    header("Location: ../../Doctores");
?>