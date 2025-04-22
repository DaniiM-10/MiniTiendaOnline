<?php
    require_once '../app/Controllers/ProductoController.php';
    require_once '../app/Controllers/ErrorController.php';
    
    class Router {
        public function redireccion($uri) {
            $url_sanitizada = filter_var($uri, FILTER_SANITIZE_URL); // sanitizar la URL para evitar inyecciones
            $url_sanitizada = explode('?', $url_sanitizada)[0]; // quitar parametros de la URL, dejando solo la ruta
            
            if(preg_match('#/producto/(\d+)$#', $url_sanitizada, $matches)) :
                $controller = new ProductoController();
                $controller->productoId((int)$matches[1]);
                return;
            endif;

            if(preg_match('#/Error/(\d+)$#', $url_sanitizada, $matches)) :
                $controller = new ErrorController((int)$matches[1]);
                $controller->index();
                return;
            endif;

            switch($url_sanitizada) :
                case "/":
                    $controller = new ProductoController();
                    $controller->index();
                    break;
                case '/aggCarrito':
                    $controller = new ProductoController();
                    $controller->aggCarrito();
                    break;
                case '/carrito':
                    $controller = new ProductoController();
                    $controller->mostrarCarrito();
                    break;
                default:
                    $controller = new ErrorController();
                    $controller->index();
                    break;
            endswitch;
        }
    }
?>