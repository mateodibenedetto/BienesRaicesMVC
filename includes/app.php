<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

// Conectamos a la base de datos
$db = conectarDB();

// Importamos el namespace
use Model\ActiveRecord;

// Seteamos la base de datos
ActiveRecord::setDB($db);
