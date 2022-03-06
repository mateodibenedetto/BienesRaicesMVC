<?php

namespace Model;

class Vendedor extends ActiveRecord {

    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre','apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validar() {
        
        if (!$this->nombre) {
            self::$errores[] = "El nombre es obligatotio";
        }
    
        if (!$this->apellido) {
            self::$errores[] = "El apellido es obligatotio";
        }
    
        if (!$this->telefono) {
            self::$errores[] = "El teléfono es obligatotio";
        }

        // Expresion regular para aceptar solo numeros del 1 al 10 en el telefono
        if(!preg_match('/[0-9]{10}/', $this->telefono)) {
            self::$errores[] = "El telefono debe ser de 10 digitos";
        }

        return self::$errores;
    
    }

    
}