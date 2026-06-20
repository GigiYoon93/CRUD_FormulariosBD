<?php
function obtenerProductos($conexion) {
    $query     = "SELECT claveProducto, nombreProducto, precioProducto, descripcion FROM productos ORDER BY claveProducto ASC";
    $resultado = mysqli_query($conexion, $query);
    $productos = [];

    while ($fila = mysqli_fetch_assoc($resultado)) {
        $productos[] = $fila;
    }

    return $productos;
}
?>
