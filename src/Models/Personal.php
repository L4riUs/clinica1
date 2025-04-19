<?php
    namespace Proyecto\Clinica\Models;

    class Personal extends Conexion {

        private $id;
        private $id_especialidad;
        private $cedula;
        private $nombre;
        private $apellido;
        private $telefono;

        function __construct($id = null, $id_especialidad = null, $cedula = null, $nombre = null, $apellido = null, $telefono = null) {
            parent::__construct();

            $this->id = $id;
            $this->id_especialidad = $id_especialidad;
            $this->cedula = $cedula;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->telefono = $telefono;
        }

        // getters
        public function getId() {
            return $this->id;
        }

        public function getIdEspecialidad() {
            return $this->id_especialidad;
        }

        public function getCedula() {
            return $this->cedula;
        }

        public function getNombre() {
            return $this->nombre;
        }

        public function getApellido() {
            return $this->apellido;
        }

        public function getTelefono() {
            return $this->telefono;
        }

        // setters
        public function setId($id) {
            $this->id = $id;
        }

        public function setIdEspecialidad($id_especialidad) {
            $this->id_especialidad = $id_especialidad;
        }

        public function setCedula($cedula) {
            $this->cedula = $cedula;
        }

        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }

        public function setApellido($apellido) {
            $this->apellido = $apellido;
        }

        public function setTelefono($telefono) {
            $this->telefono = $telefono;
        }

        // CRUD
        public function insertar() {
            $sql = "INSERT INTO personal (id_especialidad, cedula, nombre, apellido, telefono) 
                    VALUES (:id_especialidad, :cedula, :nombre, :apellido, :telefono)";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':id_especialidad' => $this->id_especialidad,
                ':cedula' => $this->cedula,
                ':nombre' => $this->nombre,
                ':apellido' => $this->apellido,
                ':telefono' => $this->telefono
            ));
            $this->id = $this->conexion->lastInsertId();
            return $this->id;
        }

        public function actualizar() {
            $sql = "UPDATE personal 
                    SET id_especialidad = :id_especialidad, cedula = :cedula, nombre = :nombre, apellido = :apellido, telefono = :telefono 
                    WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':id_especialidad' => $this->id_especialidad,
                ':cedula' => $this->cedula,
                ':nombre' => $this->nombre,
                ':apellido' => $this->apellido,
                ':telefono' => $this->telefono,
                ':id' => $this->id
            ));
        }

        public function eliminar() {
            $sql = "DELETE FROM personal WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(':id' => $this->id));
        }

        public function getPersonal() {
            $sql = "SELECT 
                        personal.id, 
                        personal.nombre, 
                        personal.apellido, 
                        personal.cedula, 
                        personal.telefono, 
                        (SELECT nombre FROM especialidades WHERE especialidades.id = personal.id_especialidad) as especialidad 
                    FROM personal 
                    WHERE 1";

            if (isset($this->id)) {
                $sql .= " AND personal.id = :id";
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
