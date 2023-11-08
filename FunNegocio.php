<?php
class DescuentoProducto {
    private $producto;
    private $tasaDescuento;

    public function __construct($producto, $tasaDescuento) {
        $this->producto = $producto;
        $this->tasaDescuento = $tasaDescuento;
    }

    public function aplicarDescuento() {
        try {
            if ($this->tasaDescuento <= 0 || $this->tasaDescuento >= 1) {
                throw new Exception("La tasa de descuento debe estar entre 0 y 1.");
            }

            // Aplicar el descuento al precio del producto
            $precioConDescuento = $this->producto->obtenerPrecio() * (1 - $this->tasaDescuento);
            $this->producto->establecerPrecio($precioConDescuento);

            // Imprimir el resultado en la consola
            echo "Descuento aplicado al producto '{$this->producto->obtenerNombre()}'. Nuevo precio: {$precioConDescuento}\n";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }
}

class Producto {
    private $nombre;
    private $precio;

    public function __construct($nombre, $precio) {
        $this->nombre = $nombre;
        $this->precio = $precio;
    }

    public function obtenerNombre() {
        return $this->nombre;
    }

    public function obtenerPrecio() {
        return $this->precio;
    }

    public function establecerPrecio($precio) {
        $this->precio = $precio;
    }
}

// Ejemplo de uso
$producto = new Producto("Producto de ejemplo", 100.0);
$tasaDescuento = 0.2; // 20% de descuento

$descuento = new DescuentoProducto($producto, $tasaDescuento);
$descuento->aplicarDescuento();
?>
