<?php
    require_once("../../Models/Conexion.php");
    include_once("../../Models/Diagnosticos.php");
    $diagnosticos = new Diagnostico();
    $diagnosticos->setId($_POST['id']);
    $diagnosticos->eliminar();
    echo json_encode(array("status"=>"ok"));
?>