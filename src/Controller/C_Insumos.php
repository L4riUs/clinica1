<?php
namespace Proyecto\Clinica\Controller;
use Proyecto\Clinica\Models\Insumos;
   
class C_Insumos
{
    public function Index()
    {
        $titulo = "Insumos";
        $descripcion = "Esta es la pagina de insumos";
        include_once __DIR__ . '/../Views/V_Insumos.php';
    }
    public function BuscarInsumos(){
        $clase = new Insumos();
        if (isset($_GET["id"])) {
            $insumos = $clase->setId($_GET["id"]);
        }
        $insumos = $clase->getInsumos();
        echo json_encode($insumos);
    }
}
?>