<?php
    require_once __DIR__.'/../Models/ErrorModel.php';

    class ErrorController {
        private $errorModel;

        public function __construct($errorCode = null) {
            $this->errorModel = new ErrorModel($errorCode);
        }

        public function index() {
            extract($this->errorModel->obtenerError()); 
            require_once __DIR__.'/../Views/ErrorViews/index.php';
        }
    }
?>