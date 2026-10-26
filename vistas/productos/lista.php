<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Productos</title></head>
<body>
    <?php require 'vistas/partes/barra.php'; ?>
    <h1>Productos</h1>

    <?php if (!empty($mensaje)): ?>
        <p><?= $mensaje ?></p>
    <?php endif; ?>

    <ul>
        <?php foreach ($productos as $p): ?>
            <li><?= $p ?></li>
        <?php endforeach; ?>
    </ul>

    <p><a href="index.php?controlador=producto&accion=crear">Nuevo producto</a></p>
</body>
</html>
