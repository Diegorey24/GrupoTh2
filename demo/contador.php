<?php
/* DEMO de la clase, sin MVC: ¿qué recuerda PHP entre un pedido y otro?
   Abrir en el navegador y recargar varias veces (F5). */
session_start();

$sinSesion = 0;          // variable común: nace y muere en cada pedido
$sinSesion++;

if (!isset($_SESSION['visitas'])) {
    $_SESSION['visitas'] = 0;
}
$_SESSION['visitas']++;  // esta sí se recuerda entre pedidos
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Contador</title></head>
<body>
    <h1>¿Qué recuerda PHP?</h1>
    <p>Variable común: <strong><?= $sinSesion ?></strong> (siempre 1)</p>
    <p>Variable de sesión: <strong><?= $_SESSION['visitas'] ?></strong> (cuenta tus visitas)</p>
    <p>Identificador de tu sesión: <code><?= htmlspecialchars(session_id()) ?></code></p>
    <p><small>Probá abrir esta página en otra ventana privada: arranca de nuevo en 1.</small></p>
</body>
</html>
