<?php
    require('../../Models/Conexion.php');
    include_once("../../Models/Metodos_Pagos.php");

    $metodosPago = new MetodoPago();

    if (isset($_GET['id'])) {
        $metodosPago->setId($_GET['id']);
    }

    echo json_encode($metodosPago->getMetodosPago());