<?php

namespace Proyecto\Clinica\Controller;

use DateTime;
use Proyecto\Clinica\Models\Horario;
use Proyecto\Clinica\Models\HorarioPersonal;

class C_Horario
{
    public function estadoDoctor()
    {
        date_default_timezone_set('America/Caracas'); // configurar la zona horaria a venezuela
        $fechaActual = new DateTime(); // obtener la fecha y hora actual
        $fechaActual->format('Y-m-d H:i:s'); // formatear la fecha y hora en el formato deseado
        if ((new HorarioPersonal())->estaDisponible($_POST['id_personal'], $fechaActual)) {
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
            $detalles = new HorarioPersonal(null, $data['id_personal'], $id_h, $data['hora_entrada'], $data['hora_salida']);
            $detalles->insertar();
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
            echo json_encode($horarios);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function getPersonal()
    {
        try {
            $h = new HorarioPersonal();
            $horarios = $h->getPorPersonal($_POST['id_personal']);
            echo json_encode($horarios);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
