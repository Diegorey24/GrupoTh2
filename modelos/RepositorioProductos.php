<?php
require_once 'config/Conexion.php';
require_once 'modelos/Producto.php';

class RepositorioProductos {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::obtener();
    }

    public function agregar(Producto $p) {
        $stmt = $this->pdo->prepare("INSERT INTO productos (nombre, precio) VALUES (?, ?)");
        $stmt->execute([$p->getNombre(), $p->getPrecio()]);
        $p->setId($this->pdo->lastInsertId());   // el id lo genera MySQL
    }

    public function todos() {
        $filas = $this->pdo->query("SELECT id, nombre, precio FROM productos ORDER BY id")->fetchAll();
        $productos = [];
        foreach ($filas as $fila) {
            $productos[] = $this->aObjeto($fila);
        }
        return $productos;
    }

    public function buscar($id) {
        $stmt = $this->pdo->prepare("SELECT id, nombre, precio FROM productos WHERE id = ?");
        $stmt->execute([$id]);
        $fila = $stmt->fetch();
        return $fila ? $this->aObjeto($fila) : null;
    }

    // convierte una fila de la tabla en un objeto Producto
    private function aObjeto($fila) {
        $p = new Producto($fila['nombre'], (float) $fila['precio']);
        $p->setId((int) $fila['id']);
        return $p;
    }
}
