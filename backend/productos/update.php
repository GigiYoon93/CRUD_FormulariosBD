<?php
require_once '../../includes/database/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo '<script>alert("Acceso no permitido"); window.location.href="../../index.php";</script>';
    exit;
}

$clave       = trim($_POST['claveProducto']    ?? '');
$nombre      = trim($_POST['nombreProducto']   ?? '');
$precio      = (float)($_POST['precioProducto'] ?? 0);
$descripcion = trim($_POST['descripcion']      ?? '');

if (empty($clave) || empty($nombre) || $precio <= 0) {
    echo '<script>alert("Faltan datos o precio inválido"); window.location.href="../../index.php?error=1";</script>';
    exit;
}

$sql  = "UPDATE productos SET nombreProducto = ?, precioProducto = ?, descripcion = ? WHERE claveProducto = ?";
$stmt = mysqli_prepare($conexion, $sql);

if (!$stmt) {
    echo '<script>alert("Error interno"); window.location.href="../../index.php?error=1";</script>';
    exit;
}

mysqli_stmt_bind_param($stmt, "sdss", $nombre, $precio, $descripcion, $clave);

if (mysqli_stmt_execute($stmt)) {
    echo '<script>alert("Producto actualizado correctamente"); window.location.href = "../../index.php";</script>';
} else {
    echo '<script>alert("No se pudo actualizar el producto"); window.location.href = "../../index.php?error=1";</script>';
}

mysqli_stmt_close($stmt);
exit;
?>
