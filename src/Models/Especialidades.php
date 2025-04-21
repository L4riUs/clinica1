<?php
    namespace Proyecto\Clinica\Models;
    class Especialidades extends Conexion {
        private $id;
        private $nombre;
        private $estado;

        function __construct($id = null, $nombre = null, $estado = null) {
            parent::__construct();

            $this->id = $id;
            $this->nombre = $nombre;
            $this->estado = $estado;
        }

        // getters
        public function getId() {
            return $this->id;
        }

        public function getNombre() {
            return $this->nombre;
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

        public function setEstado($estado) {
            $this->estado = $estado;
        }

        // CRUD
        public function insertar() {
            $sql = "INSERT INTO especialidades (nombre, estado) VALUES (:nombre, :estado)";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':nombre' => $this->nombre,
                ':estado' => $this->estado
            ));
            $this->id = $this->conexion->lastInsertId();
            return $this->id;
        }

        public function actualizar() {
            $sql = "UPDATE especialidades SET nombre = :nombre, estado = :estado WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':nombre' => $this->nombre,
                ':estado' => $this->estado,
                ':id' => $this->id
            ));
        }

        public function eliminar() {
            $sql = "UPDATE especialidades SET estado = 0 WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(':id' => $this->id));
        }

        public function getEspecialidades() {
            $sql = "SELECT * FROM especialidades WHERE 1";
            if (isset($this->id)) {
                $sql .= " AND id = :id";
            }

            $query = $this->conexion->prepare($sql);
            $opciones = array();

            if (isset($this->id)) {
                $opciones[':id'] = $this->id;
            }

            $query->execute($opciones);
            return $query->fetchAll();
        }
    }
