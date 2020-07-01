<?php

namespace Controller;

use Core\Controller;
use Core\Request;

class AppController extends Controller
{
    public function __construct()
    {
        $req = new Request();
    }
}
