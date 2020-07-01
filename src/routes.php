<?php

use Core\Router;

Router::connect('/', ['controller' => 'user', 'action' => 'index']);
Router::connect('/register', ['controller' => 'user', 'action' => 'register']);
Router::connect('/login', ['controller' => 'user', 'action' => 'login']);
Router::connect('/error', ['controller' => 'user', 'action' => 'error']);
Router::connect('/home', ['controller' => 'user', 'action' => 'show']);
