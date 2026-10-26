<?php
require_once 'config/Sesion.php';
require_once 'modelos/RepositorioUsuarios.php';

class AuthController {
    private $repo;

    public function __construct() {
        $this->repo = new RepositorioUsuarios();
    }

    // accion: login (muestra el formulario y procesa el envío)
    public function login() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $clave = $_POST['clave'] ?? '';
            $usuario = $this->repo->autenticar($email, $clave);

            if ($usuario !== null) {
                Sesion::login($usuario);
                header('Location: index.php?controlador=producto&accion=listar');
                exit;
            }
            // mismo mensaje para email inexistente y clave mala: no dar pistas
            $error = "Email o contraseña incorrectos.";
        }
        require 'vistas/auth/login.php';
    }

    // accion: registrar (muestra el formulario y crea la cuenta)
    public function registrar() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre  = trim($_POST['nombre'] ?? '');
            $email   = trim($_POST['email'] ?? '');
            $clave   = $_POST['clave'] ?? '';
            $clave2  = $_POST['clave2'] ?? '';

            if ($nombre === '' || $email === '' || $clave === '') {
                $error = "Completá todos los campos.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "El email no es válido.";
            } elseif (strlen($clave) < 4) {
                $error = "La contraseña debe tener al menos 4 caracteres.";
            } elseif ($clave !== $clave2) {
                $error = "Las contraseñas no coinciden.";
            } elseif ($this->repo->existeEmail($email)) {
                $error = "Ya existe una cuenta con ese email.";
            } else {
                $usuario = $this->repo->registrar($nombre, $email, $clave);
                Sesion::login($usuario);   // queda logueado al registrarse
                header('Location: index.php?controlador=producto&accion=listar');
                exit;
            }
        }
        require 'vistas/auth/registrar.php';
    }

    // accion: logout
    public function logout() {
        Sesion::logout();
        header('Location: index.php?controlador=auth&accion=login');
        exit;
    }
}
