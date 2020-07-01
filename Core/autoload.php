<?php

spl_autoload_register(function ($class) {
    if (file_exists($class . '.php'))
        require_once $class . '.php';
    else if (file_exists('Core/' . $class . '.php'))
        require_once 'Core/' . $class . '.php';
    else if (file_exists('src/Controller/' . $class . '.php'))
        require_once 'src/Controller/' . $class . '.php';
    else if (file_exists('src/Model/' . $class . '.php'))
        require_once 'src/Model/' . $class . '.php';
    else if (file_exists('src/' . $class . '.php'))
        require_once 'src/' . $class . '.php';
    var_dump($class);
});
