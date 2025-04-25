<?php
    namespace Proyecto\Clinica\Controller;
    use Proyecto\Clinica\Models\Usuarios;
    class C_Recuperar_Contraseña
    {
        public function Index()
        {
            $titulo = "Recuperar Contraseña";
            $descripcion = "Esta es la página de recuperar contraseña";
            include_once __DIR__ . '/../Views/V_RecuperarContraseña.php';
        }
        public function RecuperarContraseña()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $usuario = new Usuarios();
                $usuario->setUsuario($_POST["usuario"]);
                $usuario->setPassword($_POST["password"]);
                $result = $usuario->check();
    
                if (count($result) < 1) {
                include_once __DIR__ . '/../Views/V_RecuperarContraseña?err=1';
                    exit();
                }
    
                $result = $result[0];
    
                $usuarios = new Usuarios();
                $usuarios->setUsuario($result['usuario']);
                $usuarios->setPassword($_POST["contraseña"]);
                $usuarios->setLlave($_POST["llave"]);
                $usuarios->cambiar_contraseña();
    
                include_once __DIR__ . '/../Views/V_Login?msg=1';
            } else {
                include_once __DIR__ . '/../Views/V_RecuperarContraseña?err=2';
            }
        }
    }