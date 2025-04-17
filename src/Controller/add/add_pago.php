<?php
    include_once("../../Models/Conexion.php");
    include_once("../../Models/Pagos.php");
    $id_diagnostico = $_POST["id_diagnostico"];
    $monto = $_POST["monto"];
    $metodo_pago = $_POST["id_metodo_pago"];
    $fecha = $_POST["fecha"];

    $pago = new Pago();
    $pago->setIdDiagnostico($id_diagnostico);
    $pago->setMonto($monto);
    $pago->setMetodoPago($metodo_pago);
    $pago->setFecha($fecha);
    $pago->insertar();

    header("Location: ../../Pagos");
?>