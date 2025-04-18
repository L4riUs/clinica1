<?php
namespace Proyecto\Clinica\Models;

class Insumos extends Conexion {

    private $id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $estado;

    function __construct($id = null, $nombre = null, $descripcion = null, $precio = null, $estado = null) {
        parent::__construct();

        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->estado = $estado;
    }

    // getters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getEstado() {
        return $this->estado;
    }

    // setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    // CRUD
    public function insertar() {
        $sql = "INSERT INTO insumos (nombre, descripcion, precio, estado) 
                VALUES (:nombre, :descripcion, :precio, :estado)";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(
            ':nombre' => $this->nombre,
            ':descripcion' => $this->descripcion,
            ':precio' => $this->precio,
            ':estado' => $this->estado
        ));
        $this->id = $this->conexion->lastInsertId();
        return $this->id;
    }

    public function actualizar() {
        $sql = "UPDATE insumos 
                SET nombre = :nombre, descripcion = :descripcion, precio = :precio, estado = :estado 
                WHERE id = :id";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(
            ':nombre' => $this->nombre,
            ':descripcion' => $this->descripcion,
            ':precio' => $this->precio,
            ':estado' => $this->estado,
            ':id' => $this->id
        ));
    }

    public function eliminar() {
        $sql = "DELETE FROM insumos WHERE id = :id";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(':id' => $this->id));
    }

    public function getInsumos() {
        $sql = "SELECT * FROM insumos WHERE 1";
        if (isset($this->id)) {
            $sql .= " AND id = :id";
        }
        $query = $this->conexion->prepare($sql);
        $opciones = array();
        if (isset($this->id)) {
            $opciones[':id'] = $this->id;
        }
        $query->execute($opciones);
        $insumos = $query->fetchAll();
        return $insumos;
    }
}
?>
