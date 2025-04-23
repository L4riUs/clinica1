<?php
    namespace Proyecto\Clinica\Models;
    class Pagos extends Conexion {
        private $id;
        private $id_metodo_pago;
        private $id_factura;
        private $referencia;
        private $monto;
    
        public function __construct($id = null, $id_metodo_pago = null, $id_factura = null, $referencia = null, $monto = null) {
            parent::__construct();
            $this->id_metodo_pago = $id_metodo_pago;
            $this->id_factura = $id_factura;
            $this->referencia = $referencia;
            $this->monto = $monto;
        }
    
        public function insertar() {
            $sql = "INSERT INTO pagos (id_metodo_pago, id_factura, referencia, monto)
                    VALUES (:id_metodo_pago, :id_factura, :referencia, :monto)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([
                ':id_metodo_pago' => $this->id_metodo_pago,
                ':id_factura'     => $this->id_factura,
                ':referencia'     => $this->referencia,
                ':monto'          => $this->monto,
            ]);
            $this->id = $this->conexion->lastInsertId();
            return $this->id;
        }
    }
?>
