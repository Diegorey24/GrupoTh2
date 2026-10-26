<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Ingresar</title></head>
<body>
    <?php require 'vistas/partes/barra.php'; ?>
    <h1>Ingresar</h1>

    <?php if (!empty($error)): ?>
        <p style="color:#c0392b"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post" action="index.php?controlador=auth&accion=login">
        <p><label>Email: <input type="email" name="email" required
            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"></label></p>
        <p><label>Contraseña: <input type="password" name="clave" required></label></p>
        <button type="submit">Entrar</button>
    </form>

    <p>¿No tenés cuenta? <a href="index.php?controlador=auth&accion=registrar">Registrate</a></p>
    <p><a href="index.php?controlador=producto&accion=listar">Volver a la lista</a></p>
</body>
</html>
