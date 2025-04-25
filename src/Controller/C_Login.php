<?php
    namespace Proyecto\Clinica\Controller;
    use Proyecto\Clinica\Models\Usuarios;
    class C_Login
    {
        public function Index()
        {
            $titulo = "Login";
            $descripcion = "Esta es la página de login";
            include_once __DIR__ . '/../Views/V_Login.php';
        }
        public function Login()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $usuario = new Usuarios();
                $usuario->setUsuario($_POST["usuario"]);
                $usuario->setPassword($_POST["password"]);
                $result = $usuario->check();
    
                if (count($result) < 1) {
                    include_once __DIR__ . '/../Views/V_Login.php';
                    exit();
                }
    
                $result = $result[0];
    
                $_SESSION['usuario'] = $result['usuario'];
                $_SESSION['clave'] = $result['password'];
    
                header("Location:?c=Inicio&a=Index");
            } else {
                include_once __DIR__ . '/../Views/V_Login.php';
            }
        }
        public function Logout()
        {
            session_destroy();
            include_once __DIR__ . '/../Views/V_Login.php';
        }
    }