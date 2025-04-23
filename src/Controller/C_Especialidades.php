<?php
    namespace Proyecto\Clinica\Controller;

    use Proyecto\Clinica\Models\Especialidades;

    class C_Especialidades
    {
        public function Index()
        {
            $titulo = "Especialidades";
            $descripcion = "Esta es la página de especialidades";
            include_once __DIR__ . '/../Views/V_Especialidades.php';
        }

        public function BuscarEspecialidades()
        {
            $especialidades = new Especialidades();
            if (isset($_GET["id"])) {
                $especialidades->setId($_GET["id"]);
            }
            $resultado = $especialidades->getEspecialidades();
            echo json_encode($resultado);
        }

        public function GuardarEspecialidades()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombre = $_POST["nombre"];
                $estado = $_POST["estado"] == "false" ? 0 : 1;

                $especialidades = new Especialidades();
                $especialidades->setNombre($nombre);
                $especialidades->setEstado($estado);
                $especialidades->insertar();

                echo json_encode(["status" => "success", "message" => "Especialidad guardada correctamente"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Método no permitido"]);
            }
        }

        public function ActualizarEspecialidades()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST["id"];
                $nombre = $_POST["nombre"];
                $estado = $_POST["estado"] == "false" ? 0 : 1;

                $especialidades = new Especialidades();
                $especialidades->setId($id);
                $especialidades->setNombre($nombre);
                $especialidades->setEstado($estado);
                $especialidades->actualizar();

                echo json_encode(["status" => "success", "message" => "Especialidad actualizada correctamente"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Método no permitido"]);
            }
        }
        public function EliminarEspecialidades() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST["id"];

                $especialidades = new Especialidades();
                $especialidades->setId($id);
                $especialidades->eliminar();

                echo json_encode(["status" => "success", "message" => "Especialidad eliminada correctamente"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Método no permitido"]);
            }
        }    
    }