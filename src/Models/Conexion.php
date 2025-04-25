<?php

namespace Proyecto\Clinica\Models;

use PDO;

class Conexion
{
    public $conexion;

    function __construct()
    {
        $this->conexion = new PDO("mysql:host=localhost;dbname=clinica1", "root", "12345");
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function __destruct()
    {
        $this->conexion = null;
    }
}
