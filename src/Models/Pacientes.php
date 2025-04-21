<?php
    namespace Proyecto\Clinica\Models;
    class Pacientes extends Conexion {
        private $id;
        private $cedula;
        private $nombre;
        private $apellido;
        private $telefono;
        private $direccion;
        private $fecha_nacimiento;
        private $estado;

        function __construct($id = null, $cedula = null, $nombre = null, $apellido = null, $telefono = null, $direccion = null, $fecha_nacimiento = null, $estado = null) {
            parent::__construct();

            $this->id = $id;
            $this->cedula = $cedula;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->telefono = $telefono;
            $this->direccion = $direccion;
            $this->fecha_nacimiento = $fecha_nacimiento;
            $this->estado = $estado;
        }

        // getters
        public function getId() {
            return $this->id;
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

        public function getDireccion() {
            return $this->direccion;
        }

        public function getFechaNacimiento() {
            return $this->fecha_nacimiento;
        }

        public function getEstado() {
            return $this->estado;
        }

        // setters
        public function setId($id) {
            $this->id = $id;
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

        public function setDireccion($direccion) {
            $this->direccion = $direccion;
        }

        public function setFechaNacimiento($fecha_nacimiento) {
            $this->fecha_nacimiento = $fecha_nacimiento;
        }

        public function setEstado($estado) {
            $this->estado = $estado;
        }

        // CRUD
        public function insertar() {
            $sql = "INSERT INTO pacientes (cedula, nombre, apellido, telefono, direccion, f_n, estado)
                    VALUES (:cedula, :nombre, :apellido, :telefono, :direccion, :fecha_nacimiento, :estado)";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':cedula' => $this->cedula,
                ':nombre' => $this->nombre,
                ':apellido' => $this->apellido,
                ':telefono' => $this->telefono,
                ':direccion' => $this->direccion,
                ':fecha_nacimiento' => $this->fecha_nacimiento,
                ':estado' => $this->estado
            ));
            $this->id = $this->conexion->lastInsertId();
            return $this->id;
        }

        public function actualizar() {
            $sql = "UPDATE pacientes SET cedula = :cedula, nombre = :nombre, apellido = :apellido, telefono = :telefono,
                    direccion = :direccion, f_n = :fecha_nacimiento, estado = :estado WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':cedula' => $this->cedula,
                ':nombre' => $this->nombre,
                ':apellido' => $this->apellido,
                ':telefono' => $this->telefono,
                ':direccion' => $this->direccion,
                ':fecha_nacimiento' => $this->fecha_nacimiento,
                ':estado' => $this->estado,
                ':id' => $this->id
            ));
        }

        public function eliminar() {
            $sql = "UPDATE pacientes SET estado = 0 WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(':id' => $this->id));
        }

        public function getPacientes() {
            $sql = "SELECT * FROM pacientes WHERE 1";
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
