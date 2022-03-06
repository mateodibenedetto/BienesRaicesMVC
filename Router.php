<?php

namespace MVC;

class Router {
    
    public array $rutasGET = [];
    public array $rutasPOST = [];

    /**  Metodo para obtener una url con una funcion */
    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }
    
    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }

    /** Comprobar si existen las rutas */
    public function comprobarRutas() {
        session_start();

        $auth = $_SESSION['login'] ?? null;

        // Arreglo de rutas protegidas
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar',
        '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];


        $urlActual = $_SERVER['PATH_INFO'] ?? '/'; // $_SERVER['PATH_INFO'] devuelve la ruta actual
        $metodo = $_SERVER['REQUEST_METHOD']; // devuelve POST o GET

        if($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null; // devuelve funcion asociada con la url
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        // Proteger las rutas
        if(in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /public/');
        }
        
        if($fn) { // Si existe la pagina entonces...
            call_user_func($fn, $this); // sirve para llamar a una funcion sin saber como se llama esa funcion
        } else { // Si no existe la pagina(url) entonces...
            echo "Pagina no encontrada o Ruta no valida";
        }
    }

    /** Muestra una vista */
    public function render($view, $datos = []) {

        foreach($datos as $key => $value) {
            $$key = $value; // $$ genera variables a partir de las llaves
        }

        ob_start(); // on_start() inicia un almacenamiento en memoria, en este caso la vista
       
        include_once __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); // ob_get_clean() limpia la memoria
        include_once __DIR__ . "/views/layout.php";
    }
}