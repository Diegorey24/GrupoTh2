<?php
/* Todo lo relacionado con la sesión en un solo lugar. */
class Sesion {

    public static function iniciar() {
        if (session_status() === PHP_SESSION_NONE) {
            // HttpOnly: JavaScript no puede leer la cookie de sesión
            session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax']);
            session_start();
        }
    }

    // Guarda en la sesión quién es el usuario (solo datos simples, nunca la contraseña).
    public static function login(Usuario $u) {
        session_regenerate_id(true);   // id nuevo al loguearse: evita robo de sesión
        $_SESSION['usuario'] = [
            'id'     => $u->getId(),
            'nombre' => $u->getNombre(),
            'rol'    => $u->getRol(),
        ];
    }

    public static function usuario() {
        return $_SESSION['usuario'] ?? null;
    }

    public static function estaLogueado() {
        return isset($_SESSION['usuario']);
    }

    public static function logout() {
        $_SESSION = [];       // vacía los datos
        session_destroy();    // destruye la sesión en el servidor
    }

    // Para las acciones que exigen haber iniciado sesión.
    public static function requerirLogin() {
        if (!self::estaLogueado()) {
            header('Location: index.php?controlador=auth&accion=login');
            exit;
        }
    }
}
