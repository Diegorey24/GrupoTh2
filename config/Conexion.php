<?php
/* Una sola conexión a la base para toda la aplicación.
   Los datos son los de XAMPP por defecto: usuario root, sin contraseña. */
class Conexion {
    private static $pdo = null;

    public static function obtener() {
        if (self::$pdo === null) {
            $dsn = 'mysql:host=localhost;dbname=tienda;charset=utf8mb4';
            self::$pdo = new PDO($dsn, 'root', 'Utu2026', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        }
        return self::$pdo;
    }
}
