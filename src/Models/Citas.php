<?php
    namespace Proyecto\Clinica\Models;

    // class Citas extends conexion{

    //     private $id;
    //     private $id_paciente;
    //     private $id_doctor;
    //     private $motivo;
    //     private $precio;
    //     private $fecha;
    //     private $emergencia;
        
    //     function __construct($id=null,$id_paciente=null,$id_doctor=null,$motivo=null,$precio=null,$fecha=null,$emergencia=null){
    //         parent::__construct();

    //         $this->id = $id;
    //         $this->id_paciente = $id_paciente;
    //         $this->id_doctor = $id_doctor;
    //         $this->motivo = $motivo;
    //         $this->precio = $precio;
    //         $this->fecha = $fecha;
    //         $this->emergencia = $emergencia;
    //     }

    //     public function getId(){
    //         return $this->id;
    //     }

    //     public function getIdPaciente(){
    //         return $this->id_paciente;
    //     }

    //     public function getIdDoctor(){
    //         return $this->id_doctor;
    //     }

    //     public function getMotivo(){
    //         return $this->motivo;
    //     }

    //     public function getPrecio(){
    //         return $this->precio;
    //     }

    //     public function getFecha(){
    //         return $this->fecha;
    //     }

    //     public function setId($id){
    //         $this->id = $id;
    //     }

    //     public function setIdPaciente($id_paciente){
    //         $this->id_paciente = $id_paciente;
    //     }

    //     public function setIdDoctor($id_doctor){
    //         $this->id_doctor = $id_doctor;
    //     }

    //     public function setMotivo($motivo){
    //         $this->motivo = $motivo;
    //     }

    //     public function setPrecio($precio){
    //         $this->precio = $precio;
    //     }

    //     public function setFecha($fecha){
    //         $this->fecha = $fecha;
    //     }

    //     public function setEmergencia($emergencia){
    //         $this->emergencia = $emergencia;
    //     }
        
    //     public function insertar(){
    //         $sql = "INSERT INTO citas (id_paciente, id_doctor, motivo, precio, fecha, emergencia) VALUES (:id_paciente, :id_doctor, :motivo, :precio, :fecha, :emergencia)";
    //         $query = $this->conexion->prepare($sql);
    //         $query->execute(array(
    //             ':id_paciente' => $this->id_paciente,
    //             ':id_doctor' => $this->id_doctor,
    //             ':motivo' => $this->motivo,
    //             ':precio' => $this->precio,
    //             ':fecha' => $this->fecha,
    //             ':emergencia' => $this->emergencia,
    //         ));
    //         $this->id = $this->conexion->lastInsertId();
    //         return $this->id;
    //     }

    //     public function actualizar(){
    //         $sql = "UPDATE citas SET id_paciente = :id_paciente, id_doctor = :id_doctor, motivo = :motivo, precio = :precio, fecha = :fecha, emergencia = :emergencia WHERE id = :id";
    //         $query = $this->conexion->prepare($sql);
    //         $query->execute(array(
    //             ':id_paciente' => $this->id_paciente,
    //             ':id_doctor' => $this->id_doctor,
    //             ':motivo' => $this->motivo,
    //             ':precio' => $this->precio,
    //             ':fecha' => $this->fecha,
    //             ':emergencia' => $this->emergencia,
    //             ':id' => $this->id
    //         ));
    //     }

    //     public function eliminar(){
    //         $sql = "DELETE FROM citas WHERE id = :id";
    //         $query = $this->conexion->prepare($sql);
    //         $query->execute(array(
    //             ':id' => $this->id
    //         ));
    //     }

    //     public function getCitas(){
    //         $sql = "SELECT 
    //         citas.id, 
    //         citas.id_paciente, 
    //         citas.id_doctor, 
    //         citas.motivo, 
    //         citas.precio, 
    //         citas.fecha, 
    //         citas.emergencia,
    //         paciente.nombre as paciente,
    //         doctores.nombre as doctor
    //         FROM citas 
    //         INNER JOIN paciente ON citas.id_paciente = paciente.id 
    //         INNER JOIN doctores ON citas.id_doctor = doctores.id where 1";
    //         if (isset($this->id)) {
    //             $sql .= " AND citas.id = :id";
    //         }
    //         $query = $this->conexion->prepare($sql);
    //         $opciones = array();
    //         if (isset($this->id)) {
    //             $opciones[':id'] = $this->id;
    //         }
    //         $query->execute($opciones);
    //         $citas = $query->fetchAll();
    //         return $citas;
    //     }
    // }
    class Citas extends Conexion {
    
        private $id;
        private $id_servicio_medico;
        private $id_paciente;
        private $fecha;
        private $hora;
        private $estado;
    
        function __construct($id = null, $id_servicio_medico = null, $id_paciente = null, $fecha = null, $hora = null, $estado = null) {
            parent::__construct();
    
            $this->id = $id;
            $this->id_servicio_medico = $id_servicio_medico;
            $this->id_paciente = $id_paciente;
            $this->fecha = $fecha;
            $this->hora = $hora;
            $this->estado = $estado;
        }
    
        // getters
        public function getId() {
            return $this->id;
        }
    
        public function getIdServicioMedico() {
            return $this->id_servicio_medico;
        }
    
        public function getIdPaciente() {
            return $this->id_paciente;
        }
    
        public function getFecha() {
            return $this->fecha;
        }
    
        public function getHora() {
            return $this->hora;
        }
    
        public function getEstado() {
            return $this->estado;
        }
    
        // setters
        public function setId($id) {
            $this->id = $id;
        }
    
        public function setIdServicioMedico($id_servicio_medico) {
            $this->id_servicio_medico = $id_servicio_medico;
        }
    
        public function setIdPaciente($id_paciente) {
            $this->id_paciente = $id_paciente;
        }
    
        public function setFecha($fecha) {
            $this->fecha = $fecha;
        }
    
        public function setHora($hora) {
            $this->hora = $hora;
        }
    
        public function setEstado($estado) {
            $this->estado = $estado;
        }
    
        // CRUD
        public function insertar() {
            $sql = "INSERT INTO citas (id_servicio_medico, id_paciente, fecha, hora, estado) 
                    VALUES (:id_servicio_medico, :id_paciente, :fecha, :hora, :estado)";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':id_servicio_medico' => $this->id_servicio_medico,
                ':id_paciente' => $this->id_paciente,
                ':fecha' => $this->fecha,
                ':hora' => $this->hora,
                ':estado' => $this->estado
            ));
            // $this->id = $this->conexion->lastInsertId();
            // return $this->id;
        }
    
        public function actualizar() {
            $sql = "UPDATE citas 
                    SET id_servicio_medico = :id_servicio_medico, id_paciente = :id_paciente, fecha = :fecha, hora = :hora, estado = :estado 
                    WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':id_servicio_medico' => $this->id_servicio_medico,
                ':id_paciente' => $this->id_paciente,
                ':fecha' => $this->fecha,
                ':hora' => $this->hora,
                ':estado' => $this->estado,
                ':id' => $this->id
            ));
        }
    
        public function eliminar() {
            $sql = "DELETE FROM citas WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(':id' => $this->id));
        }
    
        public function getCitas() {
            $sql = "SELECT 
                        citas.*, 
                        paciente.nombre AS paciente,
                        servicios.nombre AS servicio
                    FROM citas 
                    INNER JOIN paciente ON citas.id_paciente = paciente.id 
                    INNER JOIN servicios ON citas.id_servicio_medico = servicios.id 
                    WHERE 1";
    
            if (isset($this->id)) {
                $sql .= " AND citas.id = :id";
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
    