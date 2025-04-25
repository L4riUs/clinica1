<?php

namespace Proyecto\Clinica\Controller;

class C_Inicio
{
    public function Index()
    {
        $titulo = "Inicio";
        $descripcion = "Esta es la pagina de inicio";
        include_once __DIR__ . '/../Views/V_Inicio.php';
    }
}
