<?php 
// Load config file
require_once 'config/config.php';
// Load helpers
require_once 'helpers/helpers.php';
// require_once 'config/error_config.php';

// Auto Load Classes
spl_autoload_register(function($className) {
   require_once 'libraries/' . $className . '.php';
});