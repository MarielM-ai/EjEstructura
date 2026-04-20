<?php
namespace App\Models;


use PDO;
use PDOException;


class AccesoDB {
    private static $instance = null;


    public static function getConectar() {
        if (!self::$instance) {
            $host = $_ENV['SRV_HOST'];
            $nombrebase = $_ENV['SRV_BASE'];
            $usuario = $_ENV['SRV_USR'];
            $pwd = $_ENV['SRV_PWD'];


            try {
                self::$instance = new PDO("mysql:host=$host;dbname=$nombrebase;charset=utf8", $usuario, $pwd);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,
                                              PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC,
                                              PDO::ATTR_EMULATE_PREPARES, false);
            } catch (PDOException $e) {
                die("Error conexión: " . $e->getMessage());
            }
        }


        return self::$instance;
    }
}
?>
