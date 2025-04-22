<?php
    require_once __DIR__.'/../../config.php';
    require_once __DIR__.'/../Models/ProductoModel.php';

    class ProductoController {
        private $productoModel;

        public function __construct() {
            $db = DBConexion::obtenerConexion();
            $this->productoModel = new ProductoModel($db);
        }

        public function index() {
            $productos = $this->productoModel->obtenerTodosLosProductos();

            if ($productos === []) : $productos = 'No hay productos disponibles.'; endif;
            if ($productos === null) : header('Location: /Error/500'); endif;

            require_once __DIR__.'/../Views/ProductoViews/index.php';
        }

        public function productoId($id) {
            $producto = $this->productoModel->obtenerProductoId($id);

            if (!$producto) : header('Location: /Error/404'); endif;
            if ($producto === null) : header('Location: /Error/500'); endif;

            require_once __DIR__.'/../Views/ProductoViews/producto.php';
        }

        public function aggCarrito() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Sanitizar y validar los datos del formulario
                $productoId = filter_var($_POST['producto_id'], FILTER_SANITIZE_NUMBER_INT);
                $productoNombre = htmlspecialchars($_POST['producto_nombre'], ENT_QUOTES, 'UTF-8');
                $productoPrecio = filter_var($_POST['producto_precio'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $productoDimension = htmlspecialchars($_POST['dimension'], ENT_QUOTES, 'UTF-8');
                $productoCantidad = filter_var($_POST['cantidad'], FILTER_SANITIZE_NUMBER_INT);

                if (!isset($productoId) || !isset($productoDimension) || !isset($productoCantidad) || !isset($productoNombre) || !isset($productoPrecio)) :
                    header('Location: /Error');
                    exit;
                endif;

                if (!is_numeric($productoId) || !is_numeric($productoCantidad) || !is_numeric($productoPrecio)) :
                    header('Location: /Error');
                    exit;
                endif;
                if ($productoDimension === '' || $productoNombre === '') :
                    header('Location: /Error'); 
                    exit;
                endif;

                if ($productoId <= 0 || $productoPrecio <= 0) :  
                    header('Location: /Error');
                    exit;
                endif;
                if($productoCantidad < 0) : $productoCantidad = 1; endif;

                $producto = [
                    'id' => (int)$productoId,
                    'dimension' => $productoDimension,
                    'cantidad' => (int)$productoCantidad,
                    'nombre' => $productoNombre,
                    'precio' => (float)((int)$productoCantidad * (float)$productoPrecio),
                ];
                
                $this->productoModel->agregarAlCarrito($producto);
                header('Location: /');
                exit;
            } else {
                header('Location: /Error');
                exit;
            }
        }

        public function mostrarCarrito() {
            $carrito = $this->productoModel->obtenerCarrito();
            if ($carrito === [] || $carrito == false) : $carrito = 'No hay productos en el carrito.'; endif;

            require_once __DIR__.'/../Views/CarritoViews/index.php';
        }
    }
?>