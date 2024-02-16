<?php 

namespace App;

class Usuario extends ActiveRecord{

    //Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'telefono', 'password', 'token', 'confirmado', 'creado', 'idRol'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;
    public $password;
    public $token;
    public $confirmado;
    public $creado;
    public $idRol;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->creado = date('Y-m-d');
        $this->idRol = $args['idRol'] ?? '2';
    }

    public function validarNuevaCuenta(){

        if(!$this->nombre){
            self::$errores[] = 'El nombre es obligatorio';
        }

        if(!$this->apellido){
            self::$errores[] = 'El apellido es obligatorio';
        }

        if(!$this->email){
            self::$errores[] = 'El email es obligatorio';
        }

        if(!$this->telefono){
            self::$errores[] = 'El telefono es obligatorio';
        }

        if(!$this->password){
            self::$errores[] = 'El password es obligatorio';
        }

        if(strlen($this->password) < 6){
            self::$errores[] = 'El password debe contener al menos 6 caracteres';
        }

        return self::$errores;
    }

    public function validarLogin(){
        
        if(!$this->email){
            self::$errores[] = 'El email es Obligatorio';
        }

        if(!$this->password){
            self::$errores[] = 'El password es Obligatorio';
        }

        return self::$errores;
    }

    public function validarEmail(){
        if(!$this->email){
            self::$errores[] = 'El email es Obligatorio';
        }

        return self::$errores;
    }

    public function validarPassword(){
        if(!$this->password){
            self::$errores[] = 'El password es obligatorio';
        }

        if(strlen($this->password) < 6){
            self::$errores[] = 'El password debe tener al menos 6 caracteres';
        }

        return self::$errores;
    }

    //Revisa si el usuario ya existe
    public function existeUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado->num_rows){
            self::$errores[] = 'El usuario ya esta registrado';
        }

        return $resultado;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken(){
        $this->token = uniqid();
    }

    public function comprobarPasswordAndVerificado($password){
        $resultado = password_verify($password, $this->password);

        if(!$resultado || !$this->confirmado){
            self::$errores[] = 'Password Incorrecto o tu cuenta no ha sido confirmada';
        }else{
            return true;
        }
    }
}