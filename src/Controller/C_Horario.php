<?php

namespace Proyecto\Clinica\Controller;

use DateTime;
use Proyecto\Clinica\Models\Horario;
use Proyecto\Clinica\Models\HorarioPersonal;

class C_Horario
{
    public function estadoDoctor()
    {
        $dt = new DateTime('2025-04-24 09:30:00');
        if ((new HorarioPersonal())->estaDisponible($_POST['id_personal'], $dt)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'El doctor no está disponible']);
        }
    }

    public function insertar()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $h = new Horario(null, $data['dias']);
            $id_h = $h->insertar();
            echo json_encode(['success' => true, 'id' => $id_h]);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function actualizar()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $h = new Horario($data['id'], $data['dias']);
            $h->actualizar();
            echo json_encode(['success' => true]);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function getTodos()
    {
        try {
            $h = new Horario();
            $horarios = $h->getTodos();
            echo json_encode(['success' => true, 'data' => $horarios]);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
