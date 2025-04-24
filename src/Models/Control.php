<?php

namespace Proyecto\Clinica\Models;

class Control extends Conexion
{

    private $id;
    private $id_cita;
    private $id_paciente;
    private $diagnostico;
    private $medicamentos_recetados;
    private $fecha_control;
    private $fecha_regreso;
    private $nota;
    private $estado;

    function __construct($id = null, $id_cita = null, $id_paciente = null, $diagnostico = null, $medicamentos_recetados = null, $fecha_control = null, $fecha_regreso = null, $nota = null, $estado = null)
    {
        parent::__construct();

        $this->id = $id;
        $this->id_cita = $id_cita;
        $this->id_paciente = $id_paciente;
        $this->diagnostico = $diagnostico;
        $this->medicamentos_recetados = $medicamentos_recetados;
        $this->fecha_control = $fecha_control;
        $this->fecha_regreso = $fecha_regreso;
        $this->nota = $nota;
        $this->estado = $estado;
    }

    // getters
    public function getId()
    {
        return $this->id;
    }

    public function getIdCita()
    {
        return $this->id_cita;
    }
    public function getIdPaciente()
    {
        return $this->id_paciente;
    }

    public function getDiagnostico()
    {
        return $this->diagnostico;
    }
    public function getmedicamentos_recetados()
    {
        return $this->medicamentos_recetados;
    }
    public function getFechaControl()
    {
        return $this->fecha_control;
    }

    public function getFechaRegreso()
    {
        return $this->fecha_regreso;
    }

    public function getNota()
    {
        return $this->nota;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    // setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIdCita($id_cita)
    {
        $this->id_cita = $id_cita;
    }
    public function setIdPaciente($id_paciente)
    {
        $this->id_paciente = $id_paciente;
    }

    public function setDiagnostico($diagnostico)
    {
        $this->diagnostico = $diagnostico;
    }
    public function setmedicamentos_recetados($medicamentos_recetados)
    {
        $this->medicamentos_recetados = $medicamentos_recetados;
    }

    public function setFechaControl($fecha_control)
    {
        $this->fecha_control = $fecha_control;
    }

    public function setFechaRegreso($fecha_regreso)
    {
        $this->fecha_regreso = $fecha_regreso;
    }

    public function setNota($nota)
    {
        $this->nota = $nota;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    // CRUD
    public function insertar($id, $diagnostico, $medicamentos_recetados, $fecha_control, $fecha_regreso, $nota, $estado, $id_cita)
    {
        $sql = "INSERT INTO control (id, id_cita, diagnostico, medicamentos_recetados, fecha_control, fecha_regreso, nota, estado) VALUES (:id, :id_cita, :diagnostico, :medicamentos_recetados, :fecha_control, :fecha_regreso, :nota, :estado)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_cita', $id_cita);
        $stmt->bindParam(':diagnostico', $diagnostico);
        $stmt->bindParam(':medicamentos_recetados', $medicamentos_recetados);
        $stmt->bindParam(':fecha_control', $fecha_control);
        $stmt->bindParam(':fecha_regreso', $fecha_regreso);
        $stmt->bindParam(':nota', $nota);
        $stmt->bindParam(':estado', $estado);

        return $stmt->execute();
    }
    public function actualizar($id, $diagnostico, $medicamentos_recetados, $fecha_regreso, $nota, $estado)
    {
        $sql = "UPDATE control SET diagnostico = :diagnostico, medicamentos_recetados = :medicamentos_recetados, fecha_regreso = :fecha_regreso, nota = :nota, estado = :estado WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':diagnostico', $diagnostico);
        $stmt->bindParam(':medicamentos_recetados', $medicamentos_recetados);
        $stmt->bindParam(':fecha_regreso', $fecha_regreso);
        $stmt->bindParam(':nota', $nota);
        $stmt->bindParam(':estado', $estado);
        return $stmt->execute();
    }

    public function toggleEstado($id)
    {
        $sql = "UPDATE control SET estado = 2 WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getPacientsControl()
    {
        $sql = "SELECT 
                    p.id, p.cedula, CONCAT(p.nombre, ' ', p.apellido) AS nombre
                FROM 
                    pacientes p
                JOIN 
                    citas c ON c.id_paciente = p.id
                JOIN 
                    control ctr ON ctr.id_cita = c.id;";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPacientControl($id_paciente)
    {
        $sql = "SELECT 
                    ctr.id,
                    ctr.fecha_control,
                    esp.nombre AS Servicio_Medico,
                    CONCAT(per.nombre, ' ', per.apellido) AS Doctor
                FROM 
                    control ctr
                JOIN
                    citas c ON ctr.id_cita = c.id
                JOIN
                    pacientes p ON c.id_paciente = p.id
                JOIN
                    servicio_medico sm ON c.id_servicio_medico = sm.id
                JOIN
                    especialidades esp ON sm.id_especialidad = esp.id
                JOIN
                    personal per ON sm.id_doctor = per.id
                WHERE 
                    p.id = :id_paciente;";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id_paciente', $id_paciente);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getControl($id)
    {
        $sql = "SELECT 
                    ctr.id,
                    ctr.id_cita,
                    CONCAT(p.nombre, ' ', p.apellido) AS nombre_paciente,
                    ctr.fecha_control,
                    ctr.diagnostico,
                    ctr.medicamentos_recetados,
                    ctr.nota,
                    ctr.fecha_regreso,
                    ctr.estado,
                FROM 
                    control ctr
                JOIN 
                    citas c ON ctr.id_cita = c.id
                JOIN 
                    pacientes p ON c.id_paciente = p.id
                WHERE 
                    ctr.id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
