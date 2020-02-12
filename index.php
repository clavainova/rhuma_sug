<?php

namespace App;

use App\Kernel;

//chargement du fichier de configuration
require_once 'config/config.php';

//chargement automatique des classes du kernel
require_once 'classes/Autoload.php';
$autoloader = new Autoloader();
$autoloader->register();

//instanciation du kernel (lance l'application)
$kernel = new Kernel();
?>