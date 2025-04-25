<?php

namespace Proyecto\Clinica\Models;

use PDO;

class Conexion
{
    public $conexion;

    function __construct()
    {
        $this->conexion = new PDO("mysql:host=localhost;dbname=sanrafael", "root", "");
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function __destruct()
    {
        $this->conexion = null;
    }
}
