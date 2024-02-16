<?php

use App\Producto;

require 'includes/app.php';

$productos = Producto::all();

echo json_encode($productos);