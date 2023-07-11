<?php

// Autoload classes
spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    require_once __DIR__ . '/src/' . $class . '.php';
});


// Set error reporting level
error_reporting(E_ALL);
ini_set('display_errors', 'on');

