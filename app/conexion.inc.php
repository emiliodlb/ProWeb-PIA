<?php

class conexion {

    private static $conexion;
    
    public static function abrir_conexion() {
        if (!isset(self::$conexion)) {
            try {
                include_once 'config.inc.php';

              self::$conexion = new PDO("mysql:host=$nombre_servidor; dbname=restaurante", $nombre_usuario, $password);
                self::$conexion ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexion -> exec("SET CHARACTER SET utf8");

                print'Conexion ABIERTA'.'<br>';
            } catch (PODExeption $ex){
                print "ERROR: " . $ex -> getMessage() . "<br>";
                die();

            }
        }
    }
    public static function cerrar_conexion(){
        if (isset(self::$conexion)){
            self::$conexion = null;
            print'Conexion CERRADA';
        }
    }
    public static function obtener_conexion() {
        return self::$conexion;
    }
}