<?php
    require_once("../../Models/Conexion.php");
    include_once("../../Models/Usuarios.php");
    $usuario = new Usuario();
    if(isset($_POST['nombre']) && isset($_POST['clave'])){
        $usuario->setNombre($_POST['nombre']);
        $usuario->setPassword($_POST['clave']);
        $usuario->setLlave(substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 15));
        $usuario->insertar();
        header("location:../../Usuarios");
    }
    
?>