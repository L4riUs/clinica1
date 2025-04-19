<?php
    namespace Proyecto\Clinica\Models;

    class Hospitalizacion extends Conexion {

        private $id;
        private $id_control;
        private $fecha_hora_inicio;
        private $precio_horas;
        private $total;
        private $fecha_hora_final;
        private $estado;

        function __construct($id = null, $id_control = null, $fecha_hora_inicio = null, $precio_horas = null, $total = null, $fecha_hora_final = null, $estado = null) {
            parent::__construct();

            $this->id = $id;
            $this->id_control = $id_control;
            $this->fecha_hora_inicio = $fecha_hora_inicio;
            $this->precio_horas = $precio_horas;
            $this->total = $total;
            $this->fecha_hora_final = $fecha_hora_final;
            $this->estado = $estado;
        }

        // getters
        public function getId() {
            return $this->id;
        }

        public function getIdControl() {
            return $this->id_control;
        }

        public function getFechaHoraInicio() {
            return $this->fecha_hora_inicio;
        }

        public function getPrecioHoras() {
            return $this->precio_horas;
        }

        public function getTotal() {
            return $this->total;
        }

        public function getFechaHoraFinal() {
            return $this->fecha_hora_final;
        }

        public function getEstado() {
            return $this->estado;
        }

        // setters
        public function setId($id) {
            $this->id = $id;
        }

        public function setIdControl($id_control) {
            $this->id_control = $id_control;
        }

        public function setFechaHoraInicio($fecha_hora_inicio) {
            $this->fecha_hora_inicio = $fecha_hora_inicio;
        }

        public function setPrecioHoras($precio_horas) {
            $this->precio_horas = $precio_horas;
        }

        public function setTotal($total) {
            $this->total = $total;
        }

        public function setFechaHoraFinal($fecha_hora_final) {
            $this->fecha_hora_final = $fecha_hora_final;
        }

        public function setEstado($estado) {
            $this->estado = $estado;
        }

        // CRUD
        public function insertar() {
            $sql = "INSERT INTO hospitalizacion (id_control, fecha_hora_inicio, precio_horas, total, fecha_hora_final, estado) 
                    VALUES (:id_control, :fecha_hora_inicio, :precio_horas, :total, :fecha_hora_final, :estado)";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':id_control' => $this->id_control,
                ':fecha_hora_inicio' => $this->fecha_hora_inicio,
                ':precio_horas' => $this->precio_horas,
                ':total' => $this->total,
                ':fecha_hora_final' => $this->fecha_hora_final,
                ':estado' => $this->estado
            ));
            $this->id = $this->conexion->lastInsertId();
            return $this->id;
        }

        public function actualizar() {
            $sql = "UPDATE hospitalizacion 
                    SET id_control = :id_control, fecha_hora_inicio = :fecha_hora_inicio, precio_horas = :precio_horas, 
                        total = :total, fecha_hora_final = :fecha_hora_final, estado = :estado 
                    WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':id_control' => $this->id_control,
                ':fecha_hora_inicio' => $this->fecha_hora_inicio,
                ':precio_horas' => $this->precio_horas,
                ':total' => $this->total,
                ':fecha_hora_final' => $this->fecha_hora_final,
                ':estado' => $this->estado,
                ':id' => $this->id
            ));
        }

        public function eliminar() {
            $sql = "DELETE FROM hospitalizacion WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(':id' => $this->id));
        }

        public function getHospitalizaciones() {
            $sql = "SELECT 
                        hospitalizacion.*, 
                        controles.nombre AS control 
                    FROM hospitalizacion 
                    INNER JOIN controles ON hospitalizacion.id_control = controles.id 
                    WHERE 1";

            if (isset($this->id)) {
                $sql .= " AND hospitalizacion.id = :id";
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
?>
