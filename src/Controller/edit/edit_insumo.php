<?php
    require_once("../../Models/Conexion.php");
    require_once("../../Models/Insumos.php");
    $id = $_GET["id"];
    $nombre = $_POST["nombre"];
    $stock = $_POST["stock"];

    $insumos = new Insumo();
    $insumos->setId($id);
    $insumos->setNombre($nombre);
    $insumos->setStock($stock);
    $insumos->actualizar();
    header("location:../../Insumos");
?>