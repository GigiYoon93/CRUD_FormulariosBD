<?php
require_once '../../includes/database/conexion.php';

if (!isset($_GET['clave']) || empty($_GET['clave'])) {
    echo '<script>alert("No se recibió identificador"); window.location.href="../../index.php";</script>';
    exit;
}

$clave = trim($_GET['clave']);
$sql   = "DELETE FROM productos WHERE claveProducto = ?";
$stmt  = mysqli_prepare($conexion, $sql);

if (!$stmt) {
    echo '<script>alert("Error al preparar eliminación"); window.location.href="../../index.php?error=1";</script>';
    exit;
}

mysqli_stmt_bind_param($stmt, "s", $clave);

if (mysqli_stmt_execute($stmt)) {
    echo '<script>alert("Producto eliminado correctamente"); window.location.href = "../../index.php";</script>';
} else {
    echo '<script>alert("No se pudo eliminar el producto"); window.location.href = "../../index.php?error=1";</script>';
}

mysqli_stmt_close($stmt);
exit;
?>
