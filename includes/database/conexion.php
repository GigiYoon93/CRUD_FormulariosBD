<?php
$servidor = "localhost";
$usuario       = "u219080452_michelle";
$clave         = "WebHostMichelle2=?";
$base_de_datos = "u219080452_CRUD_michelle";

$conexion = new mysqli($servidor, $usuario, $clave, $base_de_datos);

if ($conexion->connect_error) {
    die("ERROR: No se puede conectar al servidor: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");
?>
