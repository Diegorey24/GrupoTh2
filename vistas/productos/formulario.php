<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Nuevo producto</title></head>
<body>
    <?php require 'vistas/partes/barra.php'; ?>
    <h1>Nuevo producto</h1>

    <?php if (!empty($mensaje)): ?>
        <p><?= $mensaje ?></p>
    <?php endif; ?>

    <form method="post" action="index.php?controlador=producto&accion=crear">
        <label>Nombre: <input type="text" name="nombre"></label>
        <label>Precio: <input type="number" step="0.01" name="precio"></label>
        <button type="submit">Guardar</button>
    </form>

    <p><a href="index.php?controlador=producto&accion=listar">Volver a la lista</a></p>
</body>
</html>
