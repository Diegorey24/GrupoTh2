-- Base de datos de la clase. Importar desde phpMyAdmin (pestaña "Importar")
-- o pegar en la pestaña SQL.
SET NAMES utf8mb4;
CREATE DATABASE IF NOT EXISTS tienda
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tienda;

DROP TABLE IF EXISTS productos;

CREATE TABLE productos (
    id     INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL
);

INSERT INTO productos (nombre, precio) VALUES
    ('Yerba', 285),
    ('Café', 420),
    ('Agua mineral', 95);

-- Usuarios (contraseñas de práctica: ana@demo.uy -> 1234, luis@demo.uy -> abcd)
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    nombre        VARCHAR(50)  NOT NULL,
    email         VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    rol           VARCHAR(20)  NOT NULL DEFAULT 'usuario'
);

INSERT INTO usuarios (nombre, email, password_hash, rol) VALUES
    ('Ana',  'ana@demo.uy',  '$2y$10$wJl2NvwoFSwPbLFOsemo/OUQzp9saSdQt0RyD7rROfLJIpbCnQgni', 'admin'),
    ('Luis', 'luis@demo.uy', '$2y$10$LWYxoka/z/.ylGGZqRul4eNCd4X9e.g0ABOeNAgdYr6.ZqXVlaXYS', 'usuario');
