<?php

namespace Core;

class Request
{
    private $request;

    public function __construct()
    {
        foreach ($_REQUEST as $key => $element) {
            $_REQUEST = stripslashes(trim(htmlspecialchars($element)));
            $this->request = $_REQUEST;
        }
    }

    public function getQueryParams()
    {
        return $this->request = $_REQUEST;
    }
}