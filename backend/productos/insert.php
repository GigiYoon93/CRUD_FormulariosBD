<?php
require_once '../../includes/database/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['claveProducto'], $_POST['nombreProducto'], $_POST['precioProducto'])) {
    $claveProducto      = trim($_POST['claveProducto']);
    $nombreProducto     = trim($_POST['nombreProducto']);
    $precioProducto     = (float) $_POST['precioProducto'];
    $descripcionProducto = trim($_POST['descripcion'] ?? '');

    if (empty($claveProducto) || empty($nombreProducto) || $precioProducto <= 0) {
        echo '<script>alert("Datos inválidos. Verifica los campos."); window.location.href = "../../index.php?error=1";</script>';
        exit();
    }

    $sql  = "INSERT INTO productos (claveProducto, nombreProducto, precioProducto, descripcion) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssds", $claveProducto, $nombreProducto, $precioProducto, $descripcionProducto);
        $resultado = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        $resultado = false;
    }

    if ($resultado) {
        echo '<script>alert("Producto agregado exitosamente"); window.location.href = "../../index.php";</script>';
        exit();
    }

    echo '<script>alert("Error al agregar el producto"); window.location.href = "../../index.php?error=1";</script>';
    exit();
}
?>
