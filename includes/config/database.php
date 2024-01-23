<?php

function conectarDB(): mysqli{
    $db = new mysqli('localhost', 'root', '12345', 'kero_store');

    $db->set_charset('utf8');

    if(!$db){
        echo "Error no se pudo conectar";
        exit;
    }

    return $db;
}