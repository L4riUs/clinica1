<?php

namespace Proyecto\Clinica\Controller;
use Proyecto\Clinica\Models\Pagos;

class C_Pagos
{
    public function Index()
    {
        $titulo = "Facturacion";
        $descripcion = "Esta es la pagina de facturacion";
        include_once __DIR__ . '/../Views/V_Pagos.php';
    }
    public function BuscarPagos(){
        $pagos = new Pagos();
        if (isset($_GET['id'])) {
            $pagos->setId($_GET['id']);
        }
        echo json_encode($pagos->getPagos());
    }
}
