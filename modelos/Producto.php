<?php
class Producto {
    private $id;
    private $nombre;
    private $precio;

    public function __construct($nombre, $precio) {
        if (trim($nombre) === '') {
            throw new Exception("El nombre no puede estar vacío.");
        }
        if ($precio <= 0) {
            throw new Exception("El precio debe ser mayor a 0.");
        }
        $this->nombre = $nombre;
        $this->precio = $precio;
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    public function getNombre() { return $this->nombre; }
    public function getPrecio() { return $this->precio; }

    public function __toString() {
        return htmlspecialchars($this->nombre) . " - $"
             . number_format($this->precio, 2, ',', '.');
    }
}
