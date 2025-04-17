<?php
    require('../../Models/Conexion.php');
    require('../../Models/Especialidades.php');

    $especialidades = new Especialidad();
    $especialidades = $especialidades->getEspecialidades();
    echo json_encode($especialidades);
?>