<?php

include_once("../../Models/Conexion.php");
include_once("../../Models/Insumos.php");

$nombre = $_POST['nombre'];
$stock = $_POST['stock'];

$insumo = new Insumo();
$insumo->setNombre($nombre);
$insumo->setStock($stock);
$insumo->insertar();

header("Location: ../../Insumos");

?>