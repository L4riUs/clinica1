<?php
namespace Proyecto\Clinica\Models;

class Patologias extends Conexion {
    private $id;
    private $nombre;
    private $estado;

    function __construct($id = null,$nombre = null, $estado = null) { 
        parent::__construct();

        $this->id = $id;
        $this->nombre = $nombre;
        $this->estado = $estado;
    }

    // getters
    public function getId() {
        return $this->id;
    }

    public function getIdEstado() {
        return $this->estado;
    }

    public function getNombre() {
        return $this->nombre;
    }

    // setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setIdEstado($estado) {
        $this->estado = $estado;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // CRUD
    public function insertar() {
        $sql = "INSERT INTO patologias (id, nombre,estado) VALUES (:id, :nombre, :estado)";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(
            ':nombre' => $this->nombre,
            ':estado' => $this->estado
        ));
        $this->id = $this->conexion->lastInsertId();
        return $this->id;
    }

    public function actualizar() {
        $sql = "UPDATE patologias SET estado = :estado, nombre = :nombre WHERE id = :id";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(
            ':estado' => $this->estado,
            ':nombre' => $this->nombre,
            ':id' => $this->id
        ));
    }

    public function eliminar() {
        $sql = "UPDATE patologias SET estado = 0 WHERE id = :id";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(':id' => $this->id));
    }

    public function getPatologias() {
        $sql = "SELECT * FROM patologias WHERE 1=1";
        $opciones = array();

        if (isset($this->id)) {
            $sql .= " AND id = :id";
            $opciones[':id'] = $this->id;
        }

        if (isset($this->estado)) {
            $sql .= " AND estado = :estado";
            $opciones[':estado'] = $this->estado;
        }

        $query = $this->conexion->prepare($sql);
        $query->execute($opciones);
        return $query->fetchAll();
    }
}