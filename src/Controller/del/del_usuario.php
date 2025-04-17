<?php
    require_once("../../Models/Conexion.php");
    require_once("../../Models/Usuarios.php");
    $id = $_POST["id"];
    $usuario = new Usuario();
    $usuario->setId($id);
    $usuario->eliminar();
    echo json_encode(array("status"=>"ok"));
?>