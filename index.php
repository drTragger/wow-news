<?php
include_once 'config.php';

spl_autoload_register(function ($class) {
    $classPath = 'classes' . DIRECTORY_SEPARATOR . $class . '.php';
    if (file_exists($classPath)) {
        require_once $classPath;
        return true;
    }
    return false;
});

Router::init();