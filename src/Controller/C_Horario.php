<?php

namespace Proyecto\Clinica\Controller;
use Proyecto\Clinica\Models\Horario;
use Proyecto\Clinica\Models\HorarioPersonal;
use Exception;

class C_Horario
{
    public function desc()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $h = new Horario(null, $data['dias']);
            $id_h = $h->insertar();
            $hp = new HorarioPersonal(null, $data['id_personal'], $id_h, $data['hora_entrada'], $data['hora_salida']);
            $hp->insertar();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
