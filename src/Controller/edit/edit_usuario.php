<?php
    require_once("../../Models/Conexion.php");
    require_once("../../Models/Usuarios.php");
    $id = $_GET["id"];
    $nombre = $_POST["nombre"];
    $clave = $_POST["clave"];

    $usuario = new Usuario();
    $usuario->setId($id);
    $usuario->setNombre($nombre);
    $usuario->setPassword($clave);
    $usuario->actualizar();
    header("location:../../Usuarios");
?>