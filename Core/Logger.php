<?php
    use Monolog\Level;
    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;

    class LoggerManejador
    {
        private static $logger;

        public static function getLogger(): Logger
        {
            if (!self::$logger) :
                self::$logger = new Logger('minitiendaonline');
                self::$logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/app.log', Level::Debug));
            endif;
            
            return self::$logger;
        }
    }
?>