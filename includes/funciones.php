<?php

define('TEMPLATES_URL', __DIR__ . '/templates'); // __DIR__ toma la ruta actual del archivo templates
define('FUNCIONES_URL', __DIR__ . 'funciones.php'); // __DIR__ toma la ruta actual del archivo templates funciones.php
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/public/imagenes/');
define('CARPETA_IMAGENES_VENDEDORES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes_vendedores/');



function incluirTemplate( string $nombre, bool $inicio = false ) {
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado() {
    session_start();

    if(!$_SESSION['login']) {
        header('Location: /admin');
    } 
}

function debuguear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";

    exit;
}

/** Escapa / Sanitizar el HTML */
function sanitizar($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//** Validar tipo de Contenido
function validarTipoContenido($tipo) {
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos); // busca un valor en un arreglo
}

//** Muestra los mesajes
function mostrarNotificacion($codigo) {
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        default:
        $mensaje =  false;
            break;
    }

    return $mensaje;
}

function validarORedireccionar(string $url) {
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header("Location: ${url}");
    }

    return $id;
}