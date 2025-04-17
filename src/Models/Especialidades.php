<?php
    # Esta es la clase de especialidades
    # Se conecta a la base de datos

    class Especialidad extends Conexion{

        private $id;
        private $nombre;

        function __construct($id=null,$nombre=null){
            parent::__construct();

            $this->id = $id;
            $this->nombre = $nombre;
        }

        public function getId(){
            return $this->id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        
        public function insertar(){
            $sql = "INSERT INTO especialidades (nombre) VALUES (:nombre)";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':nombre' => $this->nombre
            ));
            $this->id = $this->conexion->lastInsertId();
            return $this->id;
        }

        public function actualizar(){
            $sql = "UPDATE especialidades SET nombre = :nombre WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':nombre' => $this->nombre,
                ':id' => $this->id
            ));
        }

        public function eliminar(){
            $sql = "DELETE FROM especialidades WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':id' => $this->id
            ));
        }

        public function getEspecialidades(){
            $sql = "SELECT * FROM especialidades where 1";
            if (isset($this->id)) {
                $sql .= " AND id = :id";
            }
            $query = $this->conexion->prepare($sql);
            $opciones = array();
            if (isset($this->id)) {
                $opciones[':id'] = $this->id;
            }
            $query->execute($opciones);
            $especialidades = $query->fetchAll();
            return $especialidades;
        }
    }