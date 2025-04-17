<?php
   namespace Proyecto\Clinica\Models;
    class Insumos extends Conexion{

        private $id;
        private $nombre;
        private $stock;

        function __construct($id=null, $nombre=null, $stock=null){
            parent::__construct();

            $this->id = $id;
            $this->nombre = $nombre;
            $this->stock = $stock;
        }

        public function getId(){
            return $this->id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getStock(){
            return $this->stock;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function setStock($stock){
            $this->stock = $stock;
        }
        
        public function insertar(){
            $sql = "INSERT INTO insumos (nombre, stock) VALUES (:nombre, :stock)";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':nombre' => $this->nombre,
                ':stock' => $this->stock
            ));
            $this->id = $this->conexion->lastInsertId();
            return $this->id;
        }

        public function actualizar(){
            $sql = "UPDATE insumos SET nombre = :nombre, stock = :stock WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':nombre' => $this->nombre,
                ':stock' => $this->stock,
                ':id' => $this->id
            ));
        }

        public function eliminar(){
            $sql = "DELETE FROM insumos WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':id' => $this->id
            ));
        }

        public function getInsumos(){
            $sql = "SELECT * FROM insumos where 1";
            if (isset($this->id)) {
                $sql .= " AND id = :id";
            }
            $query = $this->conexion->prepare($sql);
            $opciones = array();
            if (isset($this->id)) {
                $opciones[':id'] = $this->id;
            }
            $query->execute($opciones);
            $insumos = $query->fetchAll();
            return $insumos;
        }
    }