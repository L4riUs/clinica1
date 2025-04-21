<?php
    namespace Proyecto\Clinica\Models;
    use Proyecto\Clinica\Models\conexion;
    class Metodos_Pagos extends Conexion{

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
            $sql = "INSERT INTO metodo_pago (nombre) VALUES (:nombre)";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':nombre' => $this->nombre
            ));
            $this->id = $this->conexion->lastInsertId();
            return $this->id;
        }

        public function actualizar(){
            $sql = "UPDATE metodo_pago SET nombre = :nombre WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':nombre' => $this->nombre,
                ':id' => $this->id
            ));
        }

        public function eliminar(){
            $sql = "UPDATE metodo_pago SET estado = 0 WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':id' => $this->id
            ));
        }

        public function getMetodosPago(){
            $sql = "SELECT 
            metodo_pago.id, 
            metodo_pago.nombre
            FROM metodo_pago 
            where 1";
            if (isset($this->id)) {
                $sql .= " AND metodo_pago.id = :id";
            }
            $query = $this->conexion->prepare($sql);
            $opciones = array();
            if (isset($this->id)) {
                $opciones[':id'] = $this->id;
            }
            $query->execute($opciones);
            $metodos_pago = $query->fetchAll();
            return $metodos_pago;
        }
    }