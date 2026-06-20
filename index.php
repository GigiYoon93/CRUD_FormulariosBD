<?php
require_once 'includes/database/conexion.php';
require_once 'backend/productos/select.php';
$productos = obtenerProductos($conexion);
?>

<?php include 'includes/templates/header.php'; ?>

<div class="container">

    <div class="list">
        <p><strong>Módulos</strong></p>
        <ul>
            <li>Insertar producto</li>
            <li>Ver productos</li>
            <li>Actualizar producto</li>
            <li>Eliminar producto</li>
        </ul>
    </div>

    <div class="article">

        <button type="button" class="btn btn-primary mb-3" id="myModal"
                data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="bi bi-plus-circle"></i> Insertar Producto
        </button>

        <?php if (count($productos) > 0): ?>
        <div class="tabla-wrapper"><table class="table table-hover table-bordered align-middle">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= htmlspecialchars($producto['claveProducto']) ?></td>
                    <td><?= htmlspecialchars($producto['nombreProducto']) ?></td>
                    <td>$<?= number_format($producto['precioProducto'], 2) ?></td>
                    <td><?= htmlspecialchars($producto['descripcion']) ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditar<?= htmlspecialchars($producto['claveProducto']) ?>">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </td>
                    <td>
                        <a href="backend/productos/delete.php?clave=<?= urlencode($producto['claveProducto']) ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Eliminar <?= htmlspecialchars(addslashes($producto['nombreProducto'])) ?>?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table></div>

        <?php foreach ($productos as $producto): ?>
            <?php include 'includes/modals/modal-actualizar.html'; ?>
        <?php endforeach; ?>

        <?php else: ?>
        <div class="alert alert-info">No hay productos disponibles.</div>
        <?php endif; ?>

    </div>
</div>

<?php include 'includes/modals/modal-producto.html'; ?>

<?php include 'includes/templates/footer.php'; ?>
