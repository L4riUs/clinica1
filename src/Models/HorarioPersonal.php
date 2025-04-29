<?php

namespace Proyecto\Clinica\Models;

use DateTime;

class HorarioPersonal extends Conexion
{
    private $id;
    private $id_personal;
    private $id_horario;
    private $hora_entrada;
    private $hora_salida;

    public function __construct($id = null, $id_personal = null, $id_horario = null, $hora_entrada = null, $hora_salida = null)
    {
        parent::__construct();
        $this->id           = $id;
        $this->id_personal  = $id_personal;
        $this->id_horario   = $id_horario;
        $this->hora_entrada = $hora_entrada;
        $this->hora_salida  = $hora_salida;
    }

    public function insertar()
    {
        $sql = "INSERT INTO horario_personal 
                  (id_personal, id_horario, hora_entrada, hora_salida)
                VALUES 
                  (:id_personal, :id_horario, :hora_entrada, :hora_salida)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':id_personal'  => $this->id_personal,
            ':id_horario'   => $this->id_horario,
            ':hora_entrada' => $this->hora_entrada,
            ':hora_salida'  => $this->hora_salida
        ]);
        return $this->conexion->lastInsertId();
    }

    public function actualizar()
    {
        $sql = "UPDATE horario_personal 
                SET hora_entrada = :he, hora_salida = :hs
                WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':he' => $this->hora_entrada,
            ':hs' => $this->hora_salida,
            ':id' => $this->id
        ]);
    }

    public function getPorPersonal(int $id_personal)
    {
        $sql = "
          SELECT hp.*, h.dias_laborables
          FROM horario_personal hp
          JOIN horario h ON hp.id_horario = h.id
          WHERE hp.id_personal = :id_personal
        ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id_personal' => $id_personal]);
        $rows = $stmt->fetchAll();
        foreach ($rows as &$r) {
            $r['dias_laborables'] = Horario::stringToDias($r['dias_laborables']);
        }
        return $rows;
    }

    public function estaDisponible(int $id_personal, DateTime $dt)
    {
        setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'Spanish_Spain', 'Spanish');
        $timestamp = $dt->getTimestamp();
        $rawDia = strftime('%A', $timestamp);
        $dia = ucfirst(mb_strtolower(utf8_encode($rawDia)));
        $hora      = $dt->format('H:i:s');
        $horarios  = $this->getPorPersonal($id_personal);
        foreach ($horarios as $h) {
            if (
                in_array($dia, $h['dias_laborables'], true)
                && $hora >= $h['hora_entrada']
                && $hora <= $h['hora_salida']
            ) {
                return true;
                echo "Se";
            }
        }
        return false;
        echo "Nose";
    }
}
