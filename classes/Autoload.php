<?php
namespace App;
/**
 * Class Autoloader
 * @package App
 */
class Autoloader{

    //register autoloader
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }  

    /**
     * Inclut le fichier correspondant à notre classe
     * @param $class string Le nom de la classe à charger
     */
    static function autoload($class){
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);
        $class = str_replace('\\', '/', $class);
        require 'classes/' . $class . '.php';
    }
}
?>