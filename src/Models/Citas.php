<?php
    namespace Proyecto\Clinica\Models;
    class Citas extends Conexion {
    
        private $id;
        private $id_servicio_medico;
        private $cedula_paciente;
        private $id_personal;
        private $id_paciente;
        private $fecha;
        private $emergencia;
        private $estado;
    
        function __construct($id = null, $id_servicio_medico = null, $cedula_paciente = null, $id_personal = null, $id_paciente = null, $fecha = null,$emergencia = null, $estado = null) {
            parent::__construct();
    
            $this->id = $id;
            $this->id_servicio_medico = $id_servicio_medico;
            $this->cedula_paciente = $cedula_paciente;
            $this->id_personal = $id_personal;
            $this->id_paciente = $id_paciente;
            $this->fecha = $fecha;
            $this->emergencia = $emergencia;
            $this->estado = $estado;
        }
    
        // getters
        public function getId() {
            return $this->id;
        }
    
        public function getIdServicioMedico() {
            return $this->id_servicio_medico;
        }

        public function getCedulaPaciente() {
            return $this->cedula_paciente;
        }   
        public function getIdPersonal() {
            return $this->id_personal;
        }
    
        public function getIdPaciente() {
            return $this->id_paciente;
        }
    
        public function getFecha() {
            return $this->fecha;
        }
    
        public function getEmergencia() {
            return $this->emergencia;
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

        public function setCedulaPaciente($cedula_paciente) {
            $this->cedula_paciente = $cedula_paciente;
        }

        public function setIdPersonal($id_personal) {
            $this->id_personal = $id_personal;
        }
    
        public function setIdPaciente($id_paciente) {
            $this->id_paciente = $id_paciente;
        }
    
        public function setFecha($fecha) {
            $this->fecha = $fecha;
        }
    
        public function setEmergencia($emergencia) {
            $this->emergencia = $emergencia;
        }
    
        public function setEstado($estado) {
            $this->estado = $estado;
        }
    
        // CRUD
        public function insertar() {
            $sql = "INSERT INTO citas (id_servicio_medico, id_paciente, fecha, emergencia, estado) 
                    VALUES (:id_servicio_medico, :id_paciente, :fecha, :emergencia, :estado)";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':id_servicio_medico' => $this->id_servicio_medico,
                ':id_paciente' => $this->id_paciente,
                ':fecha' => $this->fecha,
                ':emergencia' => $this->emergencia,
                ':estado' => $this->estado
            ));
        }
    
        public function actualizar() {
            $sql = "UPDATE citas 
                    SET id_servicio_medico = :id_servicio_medico, id_paciente = :id_paciente, fecha = :fecha, hora = :hora, emergencia = :emergencia, estado = :estado 
                    WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':id_servicio_medico' => $this->id_servicio_medico,
                ':id_paciente' => $this->id_paciente,
                ':fecha' => $this->fecha,
                ':hora' => $this->hora,
                ':emergencia' => $this->emergencia,
                ':estado' => $this->estado,
                ':id' => $this->id
            ));
        }
        public function toggleEstado() {
            $sql = "UPDATE citas 
                    SET estado = 1 
                    WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(':id' => $this->id));
        }
        public function eliminar() {
            $sql = "UPDATE citas SET estado = 0 WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(':id' => $this->id));
        }
        
        public function getCitas() {
            $sql = "SELECT 
                p.cedula AS Cedula,
                CONCAT(p.nombre, ' ', p.apellido) AS Nombre,
                p.telefono AS Telefono,
                CONCAT(per.nombre, ' ', per.apellido) AS Doctor,
                esp.nombre AS Especialidad,
                c.fecha,
                c.hora,
                c.emergencia,
                c.estado
                FROM 
                citas c
                JOIN 
                pacientes p ON p.id = c.id_paciente
                JOIN 
                servicio_medico sm ON sm.id = c.id_servicio_medico
                JOIN 
                personal per ON per.id = sm.id_doctor
                JOIN 
                especialidades esp ON esp.id = sm.id_especialidad
                WHERE c.estado = 1";
            $opciones = array();
        
            if (isset($this->id)) {
            $sql .= " AND c.id = :id";
            $opciones[':id'] = $this->id;
            }
        
            if (isset($this->fecha)) {
            $sql .= " AND c.fecha = :fecha";
            $opciones[':fecha'] = $this->fecha;
            }
            
            if (isset($this->id_personal)) {
                $sql .= " AND per.id = :id_personal";
                $opciones[':id_personal'] = $this->id_personal;
            }

            $query = $this->conexion->prepare($sql);
            $query->execute($opciones);
            return $query->fetchAll();
        }
        public function getCitasPast() {
            $sql = "SELECT 
                p.cedula AS Cedula,
                CONCAT(p.nombre, ' ', p.apellido) AS Nombre,
                p.telefono AS Telefono,
                CONCAT(per.nombre, ' ', per.apellido) AS Doctor,
                esp.nombre AS Especialidad,
                c.fecha,
                c.hora,
                c.emergencia,
                c.estado
                FROM 
                citas c
                JOIN 
                pacientes p ON p.id = c.id_paciente
                JOIN 
                servicio_medico sm ON sm.id = c.id_servicio_medico
                JOIN 
                personal per ON per.id = sm.id_doctor
                JOIN 
                especialidades esp ON esp.id = sm.id_especialidad
                WHERE c.estado = 0";
        
            $opciones = array();
        
            if (isset($this->id)) {
            $sql .= " AND c.id = :id";
            $opciones[':id'] = $this->id;
            }
        
            if (isset($this->fecha)) {
            $sql .= " AND c.fecha = :fecha";
            $opciones[':fecha'] = $this->fecha;
            }

            if (isset($this->id_personal)) {
                $sql .= " AND per.id = :id_personal";
                $opciones[':id_personal'] = $this->id_personal;
            }
        
            $query = $this->conexion->prepare($sql);
            $query->execute($opciones);
            return $query->fetchAll();
        }
    }
