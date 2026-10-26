<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Registrarse</title></head>
<body>
    <?php require 'vistas/partes/barra.php'; ?>
    <h1>Crear cuenta</h1>

    <?php if (!empty($error)): ?>
        <p style="color:#c0392b"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post" action="index.php?controlador=auth&accion=registrar">
        <p><label>Nombre: <input type="text" name="nombre" required maxlength="50"
            value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>"></label></p>
        <p><label>Email: <input type="email" name="email" required maxlength="100"
            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"></label></p>
        <p><label>Contraseña: <input type="password" name="clave" required minlength="4"></label></p>
        <p><label>Repetir contraseña: <input type="password" name="clave2" required minlength="4"></label></p>
        <button type="submit">Registrarme</button>
    </form>

    <p>¿Ya tenés cuenta? <a href="index.php?controlador=auth&accion=login">Ingresar</a></p>
</body>
</html>
