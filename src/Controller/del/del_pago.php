<?php
    require_once("../../Models/Conexion.php");
    require_once("../../Models/Pago.php");

    $pago = new Pago();
    $pago->setId($_POST['id']);
    $pago->eliminar();
    echo json_encode(array("status"=>"ok"));
?>