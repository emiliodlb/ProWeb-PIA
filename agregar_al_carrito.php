<?php
// Verificar si el usuario está autenticado y tiene una sesión activa

// Incluir el archivo de conexión a la base de datos
include_once 'app/conexion.inc.php';

// Recuperar el ID del producto y la cantidad desde el formulario
$idproducto = $_POST['idproducto'];
$cantidad = $_POST['cantidad'];

// Lógica para agregar el producto al carrito del usuario
// Debes insertar los datos en la tabla 'carrito' en la base de datos
try {
    // Abrir la conexión a la base de datos
    conexion::abrir_conexion();

    // Consulta SQL para insertar el producto en el carrito
    $sql = "INSERT INTO carrito (idusuario, idproducto, cantidad) VALUES (:idusuario, :idproducto, :cantidad)";

    // Preparar la consulta
    $consulta = conexion::obtener_conexion()->prepare($sql);

    // Enlazar parámetros
    $consulta->bindParam(':idusuario', $idusuario); // Debes obtener el ID del usuario actual
    $consulta->bindParam(':idproducto', $idproducto);
    $consulta->bindParam(':cantidad', $cantidad);

    // Ejecutar la consulta
    $consulta->execute();

    // Redireccionar de nuevo a la página de productos después de agregar al carrito
    header("Location: menu_productos.php");
    exit();
} catch (PDOException $ex) {
    // Manejar errores de base de datos
    // Por ejemplo, puedes mostrar un mensaje de error o registrar el error en un archivo de registro
    echo "Error al agregar al carrito: " . $ex->getMessage();
}
?>
