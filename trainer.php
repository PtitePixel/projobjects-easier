<?php

// Autoload PSR-4
spl_autoload_register();

// Imports
use \Classes\Webforce3\Config\Config;


// Get the config object
$conf = Config::getInstance();

require $conf->getViewsDir().'header.php';
require $conf->getViewsDir().'trainer.php';
require $conf->getViewsDir().'footer.php';
