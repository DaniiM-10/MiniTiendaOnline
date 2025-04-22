<?php

use function PHPSTORM_META\type;

    require_once __DIR__ . '/../../Core/Logger.php';

    enum CategoriasEnum: string {
        case Ropa = 'Ropa';
        case Calzado = 'Calzado';
        case Accesorios = 'Accesorios';
    }

    class ProductoModel {
        private $conexion;

        public function __construct($conexion)
        {
            $this->conexion = $conexion;
        }

        public function obtenerTodosLosProductos() {
            try {
                $sql = "SELECT *, img_producto_url FROM producto INNER JOIN img_producto ON producto.producto_id = img_producto.producto_id;";
                $stmt = $this->conexion->prepare($sql); 
                $stmt->execute(); 

                if ($stmt->rowCount() == 0) return false;

                return $stmt->fetchAll();
            } catch (\Throwable $th) {
                LoggerManejador::getLogger()->error("Error al obtener todos los productos: " . $th->getMessage());
                return null;
            }
        }

        public function obtenerProductoId($productoId) {
            try {
                $sql = "SELECT *, img_producto_url FROM producto INNER JOIN img_producto ON producto.producto_id = img_producto.producto_id WHERE producto.producto_id = :id";
                $stmt = $this->conexion->prepare($sql);
                $stmt->execute(['id' => $productoId]);

                if ($stmt->rowCount() == 0) return false;

                return $stmt->fetch();
            } catch (\Throwable $th) {
                LoggerManejador::getLogger()->error("Error al obtener un producto por su ID: " . $th->getMessage());
                return null;
            }
        }

        public function agregarAlCarrito($producto) {
            if (isset($_COOKIE['carrito'])) :
                $carrito = json_decode($_COOKIE['carrito'], true);
                $encontrado = false;
            
                foreach ($carrito as $key => &$item) :
                    if ($item['id'] == $producto['id'] && $item['dimension'] == $producto['dimension']) :
                        $item['cantidad'] += $producto['cantidad'];
                        $encontrado = true;
                        break;
                    endif;
                endforeach;

                if (!$encontrado) :
                    $carrito[] = $producto;
                endif;
            
                setcookie('carrito', json_encode($carrito), time() + 3600 * 24 * 30, '/');
            else:
                $carrito[] = $producto;
                setcookie('carrito', json_encode($carrito), time() + 3600 * 24 * 30, '/'); // 30 días
            endif;
        }

        public function obtenerCarrito() {
            if (isset($_COOKIE['carrito'])) :
                $carrito = json_decode($_COOKIE['carrito'], true);
                return $carrito;
            else:
                return false;
            endif;
        }
    }
?>