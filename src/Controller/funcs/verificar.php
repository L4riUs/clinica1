<?php
    session_start();
    if (!isset($_SESSION['usuario']) or !isset($_SESSION['clave'])) {
        header("Location: ?pagina=Login");
        exit();
    }
?>