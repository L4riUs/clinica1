<?php
   namespace Proyecto\Clinica\Models;
    class Pagos extends conexion{

        private $id;
        private $id_diagnostico;
        private $monto;
        private $id_metodo_pago;
        private $fecha;
        
        function __construct($id=null,$id_diagnostico=null,$monto=null,$id_metodo_pago=null,$fecha=null){
            parent::__construct();

            $this->id = $id;
            $this->id_diagnostico = $id_diagnostico;
            $this->monto = $monto;
            $this->id_metodo_pago = $id_metodo_pago;
            $this->fecha = $fecha;
        }

        
        public function insertar(){
            $sql = "INSERT INTO pagos ( id_diagnostico, monto, id_metodo_pago, fecha) VALUES ( :id_diagnostico, :monto, :id_metodo_pago, :fecha)";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':id_diagnostico' => $this->id_diagnostico,
                ':monto' => $this->monto,
                ':id_metodo_pago' => $this->id_metodo_pago,
                ':fecha' => $this->fecha
            ));
            $this->id = $this->conexion->lastInsertId();
            return $this->id;
        }

        public function actualizar(){
            $sql = "UPDATE pagos SET  id_diagnostico = :id_diagnostico, monto = :monto, id_metodo_pago = :id_metodo_pago, fecha = :fecha WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':id_diagnostico' => $this->id_diagnostico,
                ':monto' => $this->monto,
                ':id_metodo_pago' => $this->id_metodo_pago,
                ':fecha' => $this->fecha,
                ':id' => $this->id
            ));
        }

        public function eliminar(){
            $sql = "DELETE FROM pagos WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':id' => $this->id
            ));
        }

        public function getPagos(){
            $sql = "SELECT 
            pagos.id, 
            pagos.id_diagnostico,
            pagos.monto,
            pagos.id_metodo_pago,
            pagos.fecha,
            metodo_pago.nombre as metodo_pago
            FROM pagos 
            INNER JOIN metodo_pago ON pagos.id_metodo_pago = metodo_pago.id
             where 1";
            if (isset($this->id)) {
                $sql .= " AND pagos.id = :id";
            }
            $query = $this->conexion->prepare($sql);
            $opciones = array();
            if (isset($this->id)) {
                $opciones[':id'] = $this->id;
            }
            $query->execute($opciones);
            $pagos = $query->fetchAll();
            return $pagos;
        }

        public function getId(){
            return $this->id;
        }

        public function getIdDiagnostico(){
            return $this->id_diagnostico;
        }

        public function getMonto(){
            return $this->monto;
        }

        public function getMetodoPago(){
            return $this->id_metodo_pago;
        }

        public function getFecha(){
            return $this->fecha;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setIdDiagnostico($id_diagnostico){
            $this->id_diagnostico = $id_diagnostico;
        }

        public function setMonto($monto){
            $this->monto = $monto;
        }

        public function setMetodoPago($id_metodo_pago){
            $this->id_metodo_pago = $id_metodo_pago;
        }

        public function setFecha($fecha){
            $this->fecha = $fecha;
        }
    }