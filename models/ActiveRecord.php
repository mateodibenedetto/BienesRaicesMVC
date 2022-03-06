<?php

namespace Model;

class ActiveRecord {
    // Base de Datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    // Errores
    protected static $errores = [];

    // *** Definir la conexion a la Base de Datos *** //
    public static function setDB($database) {
        // self:: por que es statico
        self::$db = $database;
    }

    // *** Guardar Propiedad en la base de datos *** //
    public function guardar() {
        if(!is_null($this->id)) { 
            // Actualizar
            $this->actualizar();
        } else {
            // Creando nuevo registro
            $this->crear();
        }
    }

    // *** Crear Propiedad *** //
    public function crear() {
        // Sanitizar entradad de datos
        $atributos = $this->sanitizarAtributos();
        
        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
        
        // Le damos el query a la variable estatica $db
        $resultado = self::$db->query($query);
        
        // Mensaje de exito
        if ($resultado) {
            // Redireccionar al usuraio cuando le da al boton de enviar
            header('Location: /public/admin?resultado=1');
        }
    }

    // *** Actualizar Propiedad *** //
    public function actualizar() {
        // Sanitizar entradad de datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        $query = " UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores); // El metodo join convierte el array en un string para que se puede enviar a la DB sin que tire errores
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";
        
        $resultado = self::$db->query($query);

        if ($resultado) {
            // Redireccionar al usuraio
            header('Location: /public/admin?resultado=2');
        }
    }

    // *** Eliminar una propiedad *** //
    public function eliminar() {
        // Eliminar registro
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1"; // limit para que solo elimine uno
        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->borrarImagen();
            // Redireccionar al usuraio
            header('Location: /public/admin?resultado=3');
        }
    }
    
    // *** Identificar y unir los atributos de la BD *** //
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    } 

    // *** Sanitizar Atributos *** //
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    // *** Subida de archivos *** //
    public function setImagen($imagen) {
        // Elimina la imagen previa
        if( !is_null($this->id) ) { // isset verifica que exista y que tenga un valor
            $this->borrarImagen();
        }

        // Asignar al atributo imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    // *** Elimina el archivo *** //
    public function borrarImagen() {
         // Comprobar si existe el archivo
         $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
         if($existeArchivo) {
             unlink(CARPETA_IMAGENES . $this->imagen);
         } else if(file_exists(CARPETA_IMAGENES_VENDEDORES . $this->imagen)) {
            unlink(CARPETA_IMAGENES_VENDEDORES . $this->imagen);
         }
    }

    // *** Validacion *** //
    public static function getErrores()
    {
        return static::$errores;
    }

    public function validar() {
        static::$errores = [];
        return static::$errores;
    }

    // *** Lista todas las registros *** //
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla; // static va a buscar ese atributo en la clase en la que se esté heredando

        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    // *** Obtiene un determinado numero de registros *** //
    public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    // *** Busca un registro por su id *** //
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";
        
        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    // *** Consultar base de datos *** //
    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // // Liberar la memoria
        // $resultado->free();
        
        // Retornar los resultados ya fomateados
        return $array;
    }

    /** Va a ir mapeando los atributos que estan como arreglo a objeto (por que active record solo trabaja con objetos)*/
    protected static function crearObjeto($registro) {
        // crear nuevas propiedades (self hace referencia a la clase padre)
        $objeto = new static;

        foreach($registro as $key => $value) {
            if( property_exists( $objeto, $key ) ) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    /** Sincriniza el objeto en memoria con los cambios realizados por el usuario */
    public function sincronizar($args = []) {
        foreach($args as $key => $value) {
            if( property_exists( $this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}