<?php
    namespace Proyecto\Clinica\Models;
    class Diagnosticos extends Conexion{

        private $id;
        private $descripcion;
        private $tratamiento;
        private $id_cita;
        private $fecha;
        
        function __construct($id=null,$descripcion=null,$tratamiento=null,$id_cita=null,$fecha=null){
            parent::__construct();

            $this->id = $id;
            $this->descripcion = $descripcion;
            $this->tratamiento = $tratamiento;
            $this->id_cita = $id_cita;
            $this->fecha = $fecha;
        }

        public function getId(){
            return $this->id;
        }

        public function getDescripcion(){
            return $this->descripcion;
        }

        public function getTratamiento(){
            return $this->tratamiento;
        }

        public function getidCita(){
            return $this->id_cita;
        }

        public function getFecha(){
            return $this->fecha;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }

        public function setTratamiento($tratamiento){
            $this->tratamiento = $tratamiento;
        }

        public function setidCita($id_cita){
            $this->id_cita = $id_cita;
        }

        public function setFecha($fecha){
            $this->fecha = $fecha;
        }
        
        public function insertar(){
            $sql = "INSERT INTO diagnostico (descripcion, tratamiento, id_cita, fecha) VALUES (:descripcion, :tratamiento, :id_cita, :fecha)";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':descripcion' => $this->descripcion,
                ':tratamiento' => $this->tratamiento,
                ':id_cita' => $this->id_cita,
                ':fecha' => $this->fecha
            ));
            $this->id = $this->conexion->lastInsertId();
            return $this->id;
        }

        public function actualizar(){
            $sql = "UPDATE diagnostico SET descripcion = :descripcion, tratamiento = :tratamiento, id_cita = :id_cita, fecha = :fecha WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':descripcion' => $this->descripcion,
                ':tratamiento' => $this->tratamiento,
                ':id_cita' => $this->id_cita,
                ':fecha' => $this->fecha,
                ':id' => $this->id
            ));
        }

        public function eliminar(){
            $sql = "DELETE FROM diagnostico WHERE id = :id";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(
                ':id' => $this->id
            ));
        }

        public function getDiagnosticos(){
            $sql = "SELECT 
            diagnostico.id,
            diagnostico.descripcion, 
            diagnostico.tratamiento, 
            diagnostico.id_cita, 
            diagnostico.fecha,
            (SELECT paciente.nombre FROM paciente WHERE citas.id_paciente = paciente.id) as paciente,
            (SELECT doctores.nombre FROM doctores WHERE citas.id_doctor = doctores.id) as doctor
            FROM diagnostico 
            INNER JOIN citas ON diagnostico.id_cita = citas.id
            where 1";
            if (isset($this->id)) {
                $sql .= " AND diagnostico.id = :id";
            }
            $query = $this->conexion->prepare($sql);
            $opciones = array();
            if (isset($this->id)) {
                $opciones[':id'] = $this->id;
            }
            $query->execute($opciones);
            $diagnosticos = $query->fetchAll();
            return $diagnosticos;
        }
    }