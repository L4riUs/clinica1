<?php
namespace Proyecto\Clinica\Models;

class ServiciosMedicos extends Conexion {
    private $id;
    private $id_especialidad;
    private $id_doctor;
    private $precio;
    private $estado;

    function __construct($id = null,$id_especialidad = null, $id_doctor = null, $precio = null, $estado = null) { 
        parent::__construct();

        $this->id = $id;
        $this->id_especialidad = $id_especialidad;
        $this->id_doctor = $id_doctor;
        $this->precio = $precio;
        $this->estado = $estado;
    }

    // getters
    public function getId() {
        return $this->id;
    }

    public function getIdEspecialidad() {
        return $this->id_especialidad;
    }

    public function getIdDoctor() {
        return $this->id_doctor;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getIdEstado() {
        return $this->estado;
    }

    // setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setIdEspecialidad($id_especialidad) {
        $this->id_especialidad = $id_especialidad;
    }

    public function setIdDoctor($id_doctor) {
        $this->id_doctor = $id_doctor;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setIdEstado($estado) {
        $this->estado = $estado;
    }

    // CRUD
    public function insertar() {
        $sql = "INSERT INTO servicios_medicos (id, id_especialidad, id_doctor, precio,estado) VALUES (:id, :id_especialidad, :id_doctor, :precio, :estado)";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(
            ':id' => $this->id,
            ':id_especialidad' => $this->id_especialidad,
            ':id_doctor' => $this->id_doctor,
            ':precio' => $this->precio,
            ':estado' => $this->estado
        ));
        $this->id = $this->conexion->lastInsertId();
        return $this->id;
    }

    public function actualizar() {
        $sql = "UPDATE servicios_medicos SET id_especialidad = :id_especialidad, id_doctor = :id_doctor, precio = :precio, estado = :estado WHERE id = :id";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(
            ':id' => $this->id,
            ':id_especialidad' => $this->id_especialidad,
            ':id_doctor' => $this->id_doctor,
            ':precio' => $this->precio,
            ':estado' => $this->estado
        ));
    }

    public function eliminar() {
        $sql = "UPDATE servicios_medicos SET estado = 0 WHERE id = :id";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(':id' => $this->id));
    }

    public function getServiciosMedicos() {
        $sql = "SELECT
                    sm.id,
                    e.nombre AS especialidad,
                    CONCAT(p.nombre, ' ', p.apellido) AS nombre,
                    precio,
                    sm.estado
                FROM
                    servicio_medico sm
                JOIN especialidades e ON
                    e.id = sm.id_especialidad
                JOIN personal p ON
                    p.id = sm.id_doctor where 1=1";
        $opciones = array();

        if (isset($this->id)) {
            $sql .= " AND id = :id";
            $opciones[':id'] = $this->id;
        }

        if (isset($this->id_especialidad)) {
            $sql .= " AND id_especialidad = :id_especialidad";
            $opciones[':id_especialidad'] = $this->id_especialidad;
        }

        if (isset($this->id_doctor)) {
            $sql .= " AND id_doctor = :id_doctor";
            $opciones[':id_doctor'] = $this->id_doctor;
        }
    }
}