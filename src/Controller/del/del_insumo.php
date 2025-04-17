<?php
    require_once("../../Models/Conexion.php");
    include_once("../../Models/Insumos.php");
    $insumos = new Insumo();
    $insumos->setId($_POST['id']);
    $insumos->eliminar();
    echo json_encode(array("status"=>"ok"));
?>