<?php
    # Esta es la clase de doctores
    # Se conecta a la base de datos

    namespace Proyecto\Clinica\Models;
    class Doctores extends Conexion{

        private $id;
        private $nombre;
        private $apellido;
        private $cedula;
        private $telefono;
        private $fecha_nacimiento;
        private $especialidad;

        function __construct($id=null,$nombre=null,$apellido=null,$cedula=null,$telefono=null,$fecha_nacimiento=null,$especialidad=null){
            parent::__construct();

            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->cedula = $cedula;
            $this->telefono = $telefono;
            $this->fecha_nacimiento = $fecha_nacimiento;
            $this->especialidad = $especialidad;
        }

        public function getId(){
            return $this->id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getApellido(){
            return $this->apellido;
        }

        public function getCedula(){
            return $this->cedula;
        }

        public function getTelefono(){
            return $this->telefono;
        }

        public function getFecha_nacimiento(){
            return $this->fecha_nacimiento;
        }

        public function getEspecialidad(){
            return $this->especialidad;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function setApellido($apellido){
            $this->apellido = $apellido;
        }

        public function setCedula($cedula){
            $this->cedula = $cedula;
        }

        public function setTelefono($telefono){
            $this->telefono = $telefono;
        }

        public function setFecha_nacimiento($fecha_nacimiento){
            $this->fecha_nacimiento = $fecha_nacimiento;
        }

        public function setEspecialidad($especialidad){
            $this->especialidad = $especialidad;
        }
        
        public function insertar(){
            $sql = "INSERT INTO doctores (nombre, apellido, cedula, telefono, fecha_nacimiento, especialidad) VALUES (:nombre, :apellido, :cedula, :telefono, :fecha_nacimiento, :especialidad)";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':nombre' => $this->nombre,
                ':apellido' => $this->apellido,
                ':cedula' => $this->cedula,
                ':telefono' => $this->telefono,
                ':fecha_nacimiento' => $this->fecha_nacimiento,
                ':especialidad' => $this->especialidad
            ));
            $this->id = $this->conexion->lastInsertId();
            return $this->id;
        }

        public function actualizar(){
            $sql = "UPDATE doctores SET nombre = :nombre, apellido = :apellido, cedula = :cedula, telefono = :telefono, fecha_nacimiento = :fecha_nacimiento, especialidad = :especialidad WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':nombre' => $this->nombre,
                ':apellido' => $this->apellido,
                ':cedula' => $this->cedula,
                ':telefono' => $this->telefono,
                ':fecha_nacimiento' => $this->fecha_nacimiento,
                ':especialidad' => $this->especialidad,
                ':id' => $this->id
            ));
        }

        public function eliminar(){
            $sql = "DELETE FROM doctores WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':id' => $this->id
            ));
        }

        public function getDoctores(){
            $sql = "SELECT id, nombre, apellido, cedula, telefono, fecha_nacimiento, (SELECT nombre FROM especialidades WHERE especialidades.id = doctores.especialidad) as especialidad FROM doctores where 1";
            if (isset($this->id)) {
                $sql .= " AND id = :id";
            }
            $query = $this->conexion->prepare($sql);
            $opciones = array();
            if (isset($this->id)) {
                $opciones[':id'] = $this->id;
            }
            $query->execute($opciones);
            $doctores = $query->fetchAll();
            return $doctores;
        }
    }