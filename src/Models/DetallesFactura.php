<?php
namespace Proyecto\Clinica\Models;
class DetallesFactura extends Conexion {
    private $id;
    private $id_factura;
    private $id_inventario;

    public function __construct($id = null, $id_factura = null, $id_inventario = null) {
        parent::__construct();
        $this->id_factura = $id_factura;
        $this->id_inventario = $id_inventario;
    }

    public function insertar() {
        $sql = "INSERT INTO detalles_factura (id_factura, id_inventario)
                VALUES (:idf, :idi)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':idf' => $this->id_factura,
            ':idi' => $this->id_inventario
        ]);
        $this->id = $this->conexion->lastInsertId();
        return $this->id;
    }
}
