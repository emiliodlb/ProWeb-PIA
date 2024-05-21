<?php
include_once 'app/conexion.inc.php';


$idproducto = $_POST['idproducto'];
$cantidad = $_POST['cantidad'];


try {

    conexion::abrir_conexion();

    $sql = "INSERT INTO carrito (idusuario, idproducto, cantidad) VALUES (:idusuario, :idproducto, :cantidad)";

    $consulta = conexion::obtener_conexion()->prepare($sql);
    $consulta->bindParam(':idusuario', $idusuario); 
    $consulta->bindParam(':idproducto', $idproducto);
    $consulta->bindParam(':cantidad', $cantidad);
    $consulta->execute();


    header("Location: menu_productos.php");
    exit();
} catch (PDOException $ex) {
    echo "Error al agregar al carrito: " . $ex->getMessage();
}
?>
