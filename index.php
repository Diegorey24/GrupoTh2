<?php
/* ENRUTADOR (front controller)
   Lee ?controlador=...&accion=... y despacha al controlador correcto.
   Para agregar una entidad nueva: creás su controlador y lo registrás acá. */

require_once 'config/Sesion.php';
Sesion::iniciar();   // arranca (o retoma) la sesión antes de mostrar nada

// controladores disponibles:  nombre en la URL  =>  archivo y clase
$controladores = [
    'producto' => 'ProductoController',
    'auth'     => 'AuthController',
];

$nombre = $_GET['controlador'] ?? 'producto';   // por defecto
$accion = $_GET['accion'] ?? 'listar';

// ¿existe ese controlador?
if (!isset($controladores[$nombre])) {
    http_response_code(404);
    exit("Controlador no encontrado: " . htmlspecialchars($nombre));
}

$clase = $controladores[$nombre];
require_once 'controladores/' . $clase . '.php';

try {
    $controlador = new $clase();   // el constructor ya abre la conexión a la base

    // ¿el controlador tiene esa acción?
    if (!method_exists($controlador, $accion)) {
        http_response_code(404);
        exit("Acción no encontrada: " . htmlspecialchars($accion));
    }

    $controlador->$accion();   // despacha, p. ej. $controlador->listar()
} catch (PDOException $e) {
    // Si MySQL no está encendido o la base no existe, no mostramos el detalle técnico.
    http_response_code(500);
    exit("No se pudo acceder a la base de datos. ¿Está MySQL encendido y la base 'tienda' importada?");
}
