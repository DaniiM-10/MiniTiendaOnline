<?php
    require_once 'vendor/autoload.php';
    use Dotenv\Dotenv;


    class DBConexion {
        private static $instancia = null;
        private $conexion;

        private function __construct() {
            // Cargo las variables del .env
            $dotenv = Dotenv::createImmutable(__DIR__ );
            $dotenv->load();

            try {
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Manejo de errores mediante excepciones
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Modo de obtención de resultados
                    PDO::ATTR_EMULATE_PREPARES   => false,                  // Desactivar la emulación de sentencias preparadas
                ];

                $dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'] . ";charset=" . $_ENV['DB_CHARSET'] . ";port=" . $_ENV['DB_PORT']; // (data sourse name: datos para conectarse a la base de datos)
                $this->conexion = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $options); // conexion a la base de datos
            } catch (PDOException $exc) {
                echo "Error de conexión: " . $exc->getMessage();
            }
        }

        public static function obtenerConexion() { // metodo estatico para obtener la conexión
            if (self::$instancia === null) { // si no existe una instancia de la clase, la creo
                self::$instancia = new DBConexion();
            }
            return self::$instancia->conexion; // devuelvo la conexión a la base de datos
        }
    }
?>