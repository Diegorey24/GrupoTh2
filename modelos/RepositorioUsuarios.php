<?php
require_once 'config/Conexion.php';
require_once 'modelos/Usuario.php';

class RepositorioUsuarios {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::obtener();
    }

    // Devuelve el Usuario si el email y la contraseña son correctos; si no, null.
    public function autenticar($email, $clave) {
        $stmt = $this->pdo->prepare(
            "SELECT id, nombre, email, password_hash, rol FROM usuarios WHERE email = ?"
        );
        $stmt->execute([$email]);
        $fila = $stmt->fetch();

        // password_verify compara la clave escrita con el hash guardado
        if ($fila && password_verify($clave, $fila['password_hash'])) {
            return new Usuario((int) $fila['id'], $fila['nombre'], $fila['email'], $fila['rol']);
        }
        return null;
    }

    public function existeEmail($email) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }

    // Crea el usuario con rol 'usuario' y lo devuelve. La clave se guarda como hash, nunca en texto.
    public function registrar($nombre, $email, $clave) {
        $hash = password_hash($clave, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare(
            "INSERT INTO usuarios (nombre, email, password_hash) VALUES (?, ?, ?)"
        );
        $stmt->execute([$nombre, $email, $hash]);
        return new Usuario((int) $this->pdo->lastInsertId(), $nombre, $email, 'usuario');
    }
}
