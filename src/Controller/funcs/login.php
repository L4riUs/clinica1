<?php

    require('../../Models/Conexion.php');
    require('../../Models/Usuarios.php');

    $usuario = new Usuario();
    $usuario->setNombre($_POST['nombre']);
    $usuario->setPassword($_POST['password']);
    $result = $usuario->check();

    if (count($result) < 1) {
        header("Location: ../Login?err=1");
        exit();
    }

    $result = $result[0];

    session_start();
    $_SESSION['usuario'] = $result['nombre'];
    $_SESSION['clave'] = $result['password'];

    // print_r($result);

    header("Location: ../Inicio");