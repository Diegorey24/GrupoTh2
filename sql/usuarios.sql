-- Agrega la tabla de usuarios a la base "tienda" de la clase anterior.
-- Contraseñas de práctica:  ana@demo.uy -> 1234   |   luis@demo.uy -> abcd
SET NAMES utf8mb4;
USE tienda;

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
