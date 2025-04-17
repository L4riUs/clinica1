<?php
namespace Proyecto\Clinica\Controller;
use Proyecto\Clinica\Models\Usuarios;

class C_Usuarios
{
    public function Index()
    {
        $titulo = "Usuarios";
        $descripcion = "Esta es la pagina de usuarios";
        include_once __DIR__ . '/../Views/V_Usuarios.php';
    }
    public function BuscarUsuarios(){
        $usuarios = new Usuarios();
        $usuarios->getUsuarios();
    
        header("Content-type: application/json");
        echo json_encode($usuarios->getUsuarios());
    }
}
