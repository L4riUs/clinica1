<?php
    namespace Proyecto\Clinica\Models;
    class Pagos extends Conexion {
        private $id;
        private $id_factura;
        private $id_metodo_pago;
        private $referencia;
        private $monto;

        function __construct($id = null, $id_factura = null, $id_metodo_pago = null, $referencia = null, $monto = null) {
            parent::__construct();
            $this->id = $id;
            $this->id_factura = $id_factura;
            $this->id_metodo_pago = $id_metodo_pago;
            $this->referencia = $referencia;
            $this->monto = $monto;
        }
        
        public function insertar() {
            $sql = "INSERT INTO pagos (id_factura, id_metodo_pago, referencia, monto)
                    VALUES (:id_factura, :id_metodo_pago, :referencia, :monto)";
            $query = $this->conexion->prepare($sql);
            $query->execute([
                ':id_factura' => $this->id_factura,
                ':id_metodo_pago' => $this->id_metodo_pago,
                ':referencia' => $this->referencia,
                ':monto' => $this->monto
            ]);
            $this->id = $this->conexion->lastInsertId();
            return $this->id;
        }
        // getters
        public function getId() { return 
            $this->id;
        }
        public function getIdFactura() { return 
            $this->id_factura;
        }
        public function getIdMetodoPago() { return 
            $this->id_metodo_pago;
        }
        public function getReferencia() { return 
            $this->referencia;
        }
        public function getMonto() { return 
            $this->monto;
        }

        // setters
        public function setId($id) { 
            $this->id = $id;
        }
        public function setIdFactura($id_factura) { 
            $this->id_factura = $id_factura;
        }
        public function setIdMetodoPago($id_metodo_pago) { 
            $this->id_metodo_pago = $id_metodo_pago;
        }
        public function setReferencia($referencia) { 
            $this->referencia = $referencia;
        }
        public function setMonto($monto) { 
            $this->monto = $monto;
        }

        // CRUD 
        public function actualizar() {
            $sql = "UPDATE pagos SET id_factura = :id_factura, id_metodo_pago = :id_metodo_pago,
                    referencia = :referencia, monto = :monto WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute([
                ':id_factura' => $this->id_factura,
                ':id_metodo_pago' => $this->id_metodo_pago,
                ':referencia' => $this->referencia,
                ':monto' => $this->monto,
                ':id' => $this->id
            ]);
        }

        public function eliminar() {
            $sql = "DELETE FROM pagos WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute([':id' => $this->id]);
        }

        public function getPagos() {
            $sql = "SELECT 
                        pagos.id,
                        pagos.id_factura,
                        pagos.id_metodo_pago,
                        pagos.referencia,
                        pagos.monto,
                        metodo_pago.nombre AS metodo_pago
                    FROM pagos
                    INNER JOIN metodo_pago ON pagos.id_metodo_pago = metodo_pago.id
                    WHERE 1";
            if (isset($this->id)) {
                $sql .= " AND pagos.id = :id";
            }

            $query = $this->conexion->prepare($sql);
            $params = [];
            if (isset($this->id)) {
                $params[':id'] = $this->id;
            }

            $query->execute($params);
            return $query->fetchAll();
        }
    }
?>
