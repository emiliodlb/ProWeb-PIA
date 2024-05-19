<?php
include_once 'app/conexion.inc.php';

class funciones_carrito {
    public static function obtener_productos_carrito($idUsuario) {
        try {
            conexion::abrir_conexion();
            $conexion = conexion::obtener_conexion();

            $sql = "SELECT p.IdProducto, p.NombreProducto, p.PrecioProducto, c.Cantidad, (p.PrecioProducto * c.Cantidad) AS Total
                    FROM carrito c
                    INNER JOIN producto p ON c.idproducto = p.IdProducto
                    WHERE c.idusuario = :idUsuario";

            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
            $sentencia->execute();

            $productos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            conexion::cerrar_conexion();

            return $productos;
        } catch (PDOException $ex) {
            print "ERROR: " . $ex->getMessage() . "<br>";
            die();
        }
    }
}
