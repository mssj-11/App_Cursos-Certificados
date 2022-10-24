<?php

// Conexion a la Base de Dtaos
class DB{

    // Variable instancia para almacenar la conexion
    public static $instancia=null;

    // Funcion para la creacion de la Instancia de la conexion a la DB
    public static function crearInstancia(){

        // Si hay conexion
        if ( !isset( self::$instancia ) ) {

            // Parametros para el manejo de errores en la conexion
            $opciones[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;  // [EXEPCIONES] reflejara el error y la información del mismo
            // Creacion de la Instancia y se le agregara la (direccion, DB, usuario y contraseña)
            self::$instancia = new PDO('mysql:host=localhost;dbname=cursos_certificados', 'root', '', $opciones);
            //echo('<span>Conectado..</span>'); // Mostrar mensaje
        }
        return self::$instancia;    // Devolvera la Instancia vacia(NULL)
    }
}

?>