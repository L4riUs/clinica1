<?php

namespace Proyecto\Clinica\Models;
class Usuarios extends Conexion
{

    private $id;
    private $nombre;
    private $usuario;
    private $password;
    private $llave;

    function __construct($id = null, $nombre = null,$usuario = null,
     $password = null)
    {
        parent::__construct();

        $this->id = $id;
        $this->nombre = $nombre;
        $this->usuario = $usuario;
        $this->password = $password;
        $this->llave = null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setLlave($llave)
    {
        $this->llave = $llave;
    }

    public function getLlave()
    {
        return $this->llave;
    }

    public function cambiar_contraseña()
    {
        $sql = "SELECT id FROM usuario WHERE usuario=:usuario and llave=:llave";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(
            ':usuario' => $this->usuario,
            ':llave' => $this->llave
        ));
        $usuarios = $query->fetchAll();
        if (count($usuarios) == 0) {
            return false;
        }
        $this->id = $usuarios[0]['id'];
        // $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "UPDATE usuario SET password=:password WHERE id=:id";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(
            ':password' => $this->password,
            ':id' => $this->id
        ));
        return true;
    }

    public function insertar()
    {
        $sql = "INSERT INTO usuario (nombre, password, llave) VALUES (:nombre, :password, :llave)";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(
            ':nombre' => $this->nombre,
            ':password' => $this->password,
            ':llave' => $this->llave
        ));
        $this->id = $this->conexion->lastInsertId();
        return $this->id;
    }

    public function actualizar()
    {
        $sql = "UPDATE usuario SET nombre = :nombre, password = :password WHERE id = :id";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(
            ':nombre' => $this->nombre,
            ':password' => $this->password,
            ':id' => $this->id
        ));
    }

    public function eliminar()
    {
        $sql = "DELETE FROM usuario WHERE id = :id";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(
            ':id' => $this->id
        ));
    }

    public function getUsuarios()
    {
        $sql = "SELECT * FROM usuario";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        $usuarios = $query->fetchAll();
        return $usuarios;
    }

    public function check()
    {
        $sql = "SELECT * FROM usuarios WHERE usuario=:usuario AND password=:password";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(
            ':usuario' => $this->usuario,
            ':password' => $this->password
        ));
        $usuarios = $query->fetchAll();
        return $usuarios;
    }
}