<?php
namespace Proyecto\Clinica\Models;

class InsumosUtilizados extends Conexion {
    private $id;
    private $id_insumos;
    private $id_diagnostico;
    private $cantidad;

    function __construct($id = null, $id_insumos = null, $id_diagnostico = null, $cantidad = null) {
        parent::__construct();

        $this->id = $id;
        $this->id_insumos = $id_insumos;
        $this->id_diagnostico = $id_diagnostico;
        $this->cantidad = $cantidad;
    }

    // getters
    public function getId() {
        return $this->id;
    }

    public function getIdInsumos() {
        return $this->id_insumos;
    }

    public function getIdDiagnostico() {
        return $this->id_diagnostico;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    // setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setIdInsumos($id_insumos) {
        $this->id_insumos = $id_insumos;
    }

    public function setIdDiagnostico($id_diagnostico) {
        $this->id_diagnostico = $id_diagnostico;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    // CRUD
    public function insertar() {
        $sql = "INSERT INTO insumos_utilizados (id_insumos, id_diagnostico, cantidad) VALUES (:id_insumos, :id_diagnostico, :cantidad)";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(
            ':id_insumos' => $this->id_insumos,
            ':id_diagnostico' => $this->id_diagnostico,
            ':cantidad' => $this->cantidad
        ));
        $this->id = $this->conexion->lastInsertId();
        return $this->id;
    }

    public function actualizar() {
        $sql = "UPDATE insumos_utilizados SET id_insumos = :id_insumos, id_diagnostico = :id_diagnostico, cantidad = :cantidad WHERE id = :id";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(
            ':id_insumos' => $this->id_insumos,
            ':id_diagnostico' => $this->id_diagnostico,
            ':cantidad' => $this->cantidad,
            ':id' => $this->id
        ));
    }

    public function eliminar() {
        $sql = "DELETE FROM insumos_utilizados WHERE id = :id";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(':id' => $this->id));
    }

    public function getInsumosUtilizados() {
        $sql = "SELECT * FROM insumos_utilizados WHERE 1";
        $opciones = array();

        if (isset($this->id)) {
            $sql .= " AND id = :id";
            $opciones[':id'] = $this->id;
        }

        if (isset($this->id_insumos)) {
            $sql .= " AND id_insumos = :id_insumos";
            $opciones[':id_insumos'] = $this->id_insumos;
        }

        if (isset($this->id_diagnostico)) {
            $sql .= " AND id_diagnostico = :id_diagnostico";
            $opciones[':id_diagnostico'] = $this->id_diagnostico;
        }

        $query = $this->conexion->prepare($sql);
        $query->execute($opciones);
        return $query->fetchAll();
    }
}