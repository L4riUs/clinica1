<?php
    require_once("../../Models/Conexion.php");
    include_once("../../Models/Citas.php");
    $citas = new Cita();
    $citas->setId($_POST['id']);
    $citas->eliminar();
    echo json_encode(array("status"=>"ok"));
?>