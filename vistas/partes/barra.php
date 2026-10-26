<p>
<?php if (Sesion::estaLogueado()): ?>
    Hola, <strong><?= htmlspecialchars(Sesion::usuario()['nombre']) ?></strong>
    (<?= htmlspecialchars(Sesion::usuario()['rol']) ?>) ·
    <a href="index.php?controlador=auth&accion=logout">Cerrar sesión</a>
<?php else: ?>
    <a href="index.php?controlador=auth&accion=login">Ingresar</a> ·
    <a href="index.php?controlador=auth&accion=registrar">Registrarse</a>
<?php endif; ?>
</p>
<hr>
