<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . '/funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '../../imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false, bool $abajo = false, bool $masAbajo = false){
    include TEMPLATES_URL . "/$nombre.php";
}

function estaAutenticado(){
    session_start();
    
    if(!$_SESSION['login']){
        header('Location: /KeroStore/index.php');
    }
}

function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo '</pre>';

    exit;
}

function mostrarNotificacion($codigo){
    $mensaje = '';

    switch($codigo){
        case 1: $mensaje = 'Creado Correctamente';
            break;
        case 2: $mensaje = 'Actualizado Correctamente';
            break;
        case 3: $mensaje = 'Eliminado Correctamente';
            break;
        default: $mensaje = false;
            break;
    }

    return $mensaje;
}

//Escapa (Sanitizar) el HTML
function s($html) : string{
    $s = htmlspecialchars($html);

    return $s;
}

//Validar tipo de contenido
function validarTipoContenido($tipo){
    $tipos = ['categoria', 'producto', 'usuario'];

    return in_array($tipo, $tipos);
}

function iniciarSession() {
    if(!isset($_SESSION)){
        session_start();
    }  
}

function isAdmin() : void{
    if(!isset($_SESSION['idRol'])){
        header('Location: /kerostore/index.php');
    }
}