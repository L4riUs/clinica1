<?php

namespace Proyecto\Clinica\Controller;
$titulo = "Login";
$descripcion = "Esta es la pagina de Login";
include_once __DIR__ . '/../Views/V_Login.php';

class C_Login{
    public function printLogin(){
        print_r("Login");
    }
}
?>