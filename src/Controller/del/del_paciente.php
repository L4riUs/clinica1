<?php
    require_once("../../Models/Conexion.php");
    include_once("../../Models/Pacientes.php");
    $pacientes = new Paciente();
    $pacientes->setId($_POST['id']);
    $pacientes->eliminar();
    echo json_encode(array("status"=>"ok"));
?>