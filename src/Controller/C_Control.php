<?php

namespace Proyecto\Clinica\Controller;

use Proyecto\Clinica\Models\Control;

class C_Control
{
    public function Index()
    {
        $titulo = "Control";
        $descripcion = "Esta es la página de control";
        include_once __DIR__ . '/../Views/V_Control.php';
    }

    public function BuscarControl()
    {
        if (!isset($_GET["id"])) {
            echo json_encode(["status" => "error", "message" => "ID no especificado"]);
            return;
        }

        $control = new Control();
        $control->setId($_GET["id"]);
        $resultado = $control->getControl($control->getId());
        echo json_encode($resultado);
    }

    public function BuscarControlPaciente()
    {
        if (!isset($_GET["id"])) {
            echo json_encode(["status" => "error", "message" => "ID de control no especificado"]);
            return;
        }

        $control = new Control();
        $control->setId($_GET["id"]);
        $resultado = $control->getPacientControl($control->getId()); // Se asume que ya tiene seteado el id
        echo json_encode($resultado);
    }

    public function BuscarControlPacientes()
    {
        if (!isset($_GET["id_paciente"])) {
            echo json_encode(["status" => "error", "message" => "ID de paciente no especificado"]);
            return;
        }

        $control = new Control();
        $control->setIdPaciente($_GET["id_paciente"]);
        $resultado = $control->getPacientsControl(); // Este método debería usar el ID seteado
        echo json_encode($resultado);
    }

    public function GuardarControl()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(["status" => "error", "message" => "Método no permitido"]);
            return;
        }

        $control = new Control();
        $control->setIdCita($_POST["id_cita"]);
        $control->setDiagnostico($_POST["diagnostico"]);
        $control->setMedicamentos_recetados($_POST["medicamentosRecetados"]);
        $control->setFechaControl($_POST["fecha_control"]);
        $control->setFechaRegreso($_POST["fecha_regreso"]);
        $control->setNota($_POST["nota"]);
        $control->setEstado($_POST["estado"] == "false" ? 0 : 1);

        $control->insertar(
            $control->getIdCita(),
            $control->getDiagnostico(),
            $control->getMedicamentos_recetados(),
            $control->getFechaControl(),
            $control->getFechaRegreso(),
            $control->getNota(),
            $control->getEstado(),
            $control->getId()
        );

        echo json_encode(["status" => "success", "message" => "Control guardado correctamente"]);
    }

    public function ActualizarControl()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(["status" => "error", "message" => "Método no permitido"]);
            return;
        }

        $control = new Control();
        $control->setId($_POST["id"]);
        $control->setDiagnostico($_POST["diagnostico"]);
        $control->setMedicamentos_recetados($_POST["medicamentosRecetados"]);
        $control->setFechaRegreso($_POST["fecha_regreso"]);
        $control->setNota($_POST["nota"]);
        $control->setEstado($_POST["estado"]);

        $control->actualizar(
            $control->getId(),
            $control->getDiagnostico(),
            $control->getMedicamentos_recetados(),
            $control->getFechaRegreso(),
            $control->getNota(),
            $control->getEstado()
        );

        echo json_encode(["status" => "success", "message" => "Control actualizado correctamente"]);
    }

    public function ToggleEstado()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(["status" => "error", "message" => "Método no permitido"]);
            return;
        }

        $control = new Control();
        $control->setId($_POST["id"]);
        $control->toggleEstado($control->getId());

        echo json_encode(["status" => "success", "message" => "Estado de control actualizado correctamente"]);
    }
}
