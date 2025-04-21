<?php
namespace Proyecto\Clinica\Models;

class Patologias extends Conexion {
    private $id;
    private $id_paciente;
    private $nombre;

    function __construct($id = null, $id_paciente = null, $nombre = null) {
        parent::__construct();

        $this->id = $id;
        $this->id_paciente = $id_paciente;
        $this->nombre = $nombre;
    }

    // getters
    public function getId() {
        return $this->id;
    }

    public function getIdPaciente() {
        return $this->id_paciente;
    }

    public function getNombre() {
        return $this->nombre;
    }

    // setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setIdPaciente($id_paciente) {
        $this->id_paciente = $id_paciente;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // CRUD
    public function insertar() {
        $sql = "INSERT INTO patologias (id_paciente, nombre) VALUES (:id_paciente, :nombre)";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(
            ':id_paciente' => $this->id_paciente,
            ':nombre' => $this->nombre
        ));
        $this->id = $this->conexion->lastInsertId();
        return $this->id;
    }

    public function actualizar() {
        $sql = "UPDATE patologias SET id_paciente = :id_paciente, nombre = :nombre WHERE id = :id";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(
            ':id_paciente' => $this->id_paciente,
            ':nombre' => $this->nombre,
            ':id' => $this->id
        ));
    }

    public function eliminar() {
        $sql = "DELETE FROM patologias WHERE id = :id";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(':id' => $this->id));
    }

    public function getPatologias() {
        $sql = "SELECT * FROM patologias WHERE 1";
        $opciones = array();

        if (isset($this->id)) {
            $sql .= " AND id = :id";
            $opciones[':id'] = $this->id;
        }

        if (isset($this->id_paciente)) {
            $sql .= " AND id_paciente = :id_paciente";
            $opciones[':id_paciente'] = $this->id_paciente;
        }

        $query = $this->conexion->prepare($sql);
        $query->execute($opciones);
        return $query->fetchAll();
    }
}