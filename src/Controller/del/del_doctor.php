<?php
    require_once("../../Models/Conexion.php");
    include_once("../../Models/Doctores.php");
    $doctores = new Doctor();
    $doctores->setId($_POST['id']);
    $doctores->eliminar();
    echo json_encode(array("status"=>"ok"));
?>