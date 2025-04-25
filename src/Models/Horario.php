<?php
namespace Proyecto\Clinica\Models;
class Horario extends Conexion {
    private $id;
    private $dias;
    

    public function __construct($id = null, $dias = [], $hora_entrada = null, $hora_salida = null) {
        parent::__construct();
        $this->id = $id;
        $this->dias = $dias;
    }

    private function diasToString() {
        return implode(',', $this->dias);
    }
    public static function stringToDias(string $raw): array {
        return array_map('trim', explode(',', $raw));
    }

    public function insertar(){
        $sql = "INSERT INTO horario (dias_laborables) VALUES (:dias)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':dias' => $this->diasToString()]);
        return $this->conexion->lastInsertId();
    }

    public function actualizar() {
        $sql = "UPDATE horario SET dias_laborables = :dias WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':dias' => $this->diasToString(),
            ':id'   => $this->id
        ]);
    }

    public function getTodos() {
        $rows = $this->conexion->query("SELECT * FROM horario")->fetchAll();
        foreach ($rows as &$r) {
            $r['dias_laborables'] = self::stringToDias($r['dias_laborables']);
        }
        return $rows;
    }
}