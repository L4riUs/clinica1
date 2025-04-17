<?php
    require("../../Models/Conexion.php");
    require("../../Models/Usuarios.php");

    $contraseña = $_POST["contraseña"];
    $usuario = $_POST["usuario"];
    $clave = $_POST["llave"];
    
    $usuarios = new Usuario();
    $usuarios->setNombre($usuario);
    $usuarios->setPassword($contraseña);
    $usuarios->setLlave($clave);
    if ($usuarios->cambiar_contraseña()) {
        header("Location: ../../Login");
    } else {
        echo "Fallo el cambio e contraseña";
    }
    
