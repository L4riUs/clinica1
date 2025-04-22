<?php
namespace Proyecto\Clinica\Models;

class Control extends Conexion {

    private $id;
    private $id_cita;
    private $fecha_control;
    private $hora_control;
    private $estado;

    function __construct($id = null,$id_cita = null, $fecha_control = null, $hora_control = null, $estado = null) {
        parent::__construct();

        $this->id = $id;
        $this->cedula_paciente = $cedula_paciente;
        $this->id_cita = $id_cita;
        $this->fecha_control = $fecha_control;
        $this->hora_control = $hora_control;
        $this->estado = $estado;
    }

    // getters
    public function getId() {
        return $this->id;
    }

    public function getCedulaPaciente() {
        return $this->cedula_paciente;
    }   
    public function getIdCita() {
        return $this->id_cita;
    }

    public function getFechaControl() {
        return $this->fecha_control;
    }

    public function getHoraControl() {
        return $this->hora_control;
    }

    public function getEstado() {
        return $this->estado;
    }

    // setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setCedulaPaciente($cedula_paciente) {
        $this->cedula_paciente = $cedula_paciente;
    }

    public function setIdCita($id_cita) {
        $this->id_cita = $id_cita;
    }

    public function setFechaControl($fecha_control) {
        $this->fecha_control = $fecha_control;
    }

    public function setHoraControl($hora_control) {
        $this->hora_control = $hora_control;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    // CRUD
    public function insertar() {
        $sql = "INSERT INTO control (id, cedula_paciente, id_cita, fecha_control, hora_control, estado) 
                    VALUES (:id, :cedula_paciente, :id_cita, :fecha_control, :hora_control, :estado)";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(
            ':id' => $this->id,
            ':cedula_paciente' => $this->cedula_paciente,
            ':id_cita' => $this->id_cita,
            ':fecha_control' => $this->fecha_control,
            ':hora_control' => $this->hora_control,
            ':estado' => $this->estado
        ));
        // $this->id = $this->conexion->lastInsertId();
        // return $this->id;
    }

    public function actualizar() {
        $sql = "UPDATE control 
                    SET cedula_paciente = :cedula_paciente, id_cita = :id_cita, fecha_control = :fecha_control, hora_control = :hora_control, estado = :estado 
                    WHERE id = :id";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(
            ':id' => $this->id,
            ':cedula_paciente' => $this->cedula_paciente,
            ':id_cita' => $this->id_cita,
            ':fecha_control' => $this->fecha_control,
            ':hora_control' => $this->hora_control,
            ':estado' => $this->estado
        ));
    }
    public function eliminar() {
        $sql = "UPDATE control SET estado = 0 WHERE id = :id";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(':id' => $this->id));
    }

    public function getControl() {
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
                WHERE estado = 1";
        
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

            if (isset($this->cedula_paciente)) {
                $sql .= " AND p.cedula = :cedula_paciente";
                $opciones[':cedula_paciente'] = $this->cedula_paciente;
            }

            $query = $this->conexion->prepare($sql);
            $query->execute($opciones);
            return $query->fetchAll();
        }