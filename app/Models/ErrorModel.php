<?php
    class ErrorModel {
        private $errorCode;
        private $error;

        public function __construct($errorCode) {
            $this->errorCode = $errorCode ?? '404';
            $this->error = $this->obtenerInfoError($this->errorCode);
        }

        public function obtenerError() {
            return $this->error;
        }

        private function obtenerInfoError($errorCode) {
            $info = match ($errorCode) {
                500 => [
                    'Code' => 500,
                    'Title' => 'Error interno del servidor.',
                    'Message' => 'Ocurrió un error en el servidor.'
                ],
                404 => [
                    'Code' => 404,
                    'Title' => 'Página no encontrada.',
                    'Message' => 'La página solicitada no existe.'
                ],
                default => [
                    'Code' => $errorCode,
                    'Title' => 'Error inesperado.',
                    'Message' => 'Algo salió mal.'
                ]
            };
            return $info;
        }
    }
?>