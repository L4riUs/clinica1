<?php
    # Esta es la clase de Pacientes
    # Se conecta a la base de datos

    namespace Proyecto\Clinica\Models;

    class Pacientes extends Conexion{

        private $id;
        private $nombre;
        private $apellido;
        private $cedula;
        private $telefono;
        private $fecha_nacimiento;

        function __construct($id=null,$nombre=null,$apellido=null,$cedula=null,$telefono=null,$fecha_nacimiento=null){
            parent::__construct();

            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->cedula = $cedula;
            $this->telefono = $telefono;
            $this->fecha_nacimiento = $fecha_nacimiento;
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
        
        public function insertar(){
            $sql = "INSERT INTO paciente (nombre, apellido, cedula, telefono, fecha_nacimiento) VALUES (:nombre, :apellido, :cedula, :telefono, :fecha_nacimiento)";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':nombre' => $this->nombre,
                ':apellido' => $this->apellido,
                ':cedula' => $this->cedula,
                ':telefono' => $this->telefono,
                ':fecha_nacimiento' => $this->fecha_nacimiento
            ));
            $this->id = $this->conexion->lastInsertId();
            return $this->id;
        }

        public function actualizar(){
            $sql = "UPDATE paciente SET nombre = :nombre, apellido = :apellido, cedula = :cedula, telefono = :telefono, fecha_nacimiento = :fecha_nacimiento WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':nombre' => $this->nombre,
                ':apellido' => $this->apellido,
                ':cedula' => $this->cedula,
                ':telefono' => $this->telefono,
                ':fecha_nacimiento' => $this->fecha_nacimiento,
                ':id' => $this->id
            ));
        }

        public function eliminar(){
            $sql = "DELETE FROM paciente WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':id' => $this->id
            ));
        }

        public function getPacientes(){
            $sql = "SELECT * FROM paciente where 1 ";
            if (isset($this->id)) {
                $sql .= " AND id = :id";
            }
            $query = $this->conexion->prepare($sql);
            $opciones = array();
            if (isset($this->id)) {
                $opciones[':id'] = $this->id;
            }
            $query->execute($opciones);
            $pacientes = $query->fetchAll();
            return $pacientes;
        }
    }
?>