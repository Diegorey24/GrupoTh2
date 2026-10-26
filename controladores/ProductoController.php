<?php
require_once 'config/Sesion.php';
require_once 'modelos/RepositorioProductos.php';

class ProductoController {
    private $repo;

    public function __construct() {
        $this->repo = new RepositorioProductos();
    }

    // accion: listar
    public function listar($mensaje = '') {
        
        $productos = $this->repo->todos();
        require 'vistas/productos/lista.php';
    }

    // accion: crear
    public function crear() {
        Sesion::requerirLogin();   // solo usuarios con sesión iniciada
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $producto = new Producto(
                    $_POST['nombre'] ?? '',
                    (float) ($_POST['precio'] ?? 0)
                );
                $this->repo->agregar($producto);
                // tras crear, mostramos la lista con un mensaje
                $this->listar("Producto creado: " . $producto);
                return;
            } catch (Exception $e) {
                $mensaje = "Error: " . $e->getMessage();
            }
        }
        require 'vistas/productos/formulario.php';
    }
}
