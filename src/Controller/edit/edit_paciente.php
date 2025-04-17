<?php
    require_once("../../Models/Conexion.php");
    include_once("../../Models/Pacientes.php");
    $id = $_GET["id"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $cedula = $_POST["cedula"];
    $telefono = $_POST["telefono"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];

    $pacientes = new Paciente();
    $pacientes->setId($id);
    $pacientes->setNombre($nombre);
    $pacientes->setApellido($apellido);
    $pacientes->setCedula($cedula);
    $pacientes->setTelefono($telefono);
    $pacientes->setFecha_nacimiento($fecha_nacimiento);
    $pacientes->actualizar();
    header("location:../../Pacientes");
?>