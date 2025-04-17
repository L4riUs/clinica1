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
    public function paciente()
    {
        //aqui debe ir la logica para traer los pacientes en el card el inicio
    }

    public function doctores()
    {
        //aqui debe ir la logica para traer los doctores en el card el inicio
    }
}
