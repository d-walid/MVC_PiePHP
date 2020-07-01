<?php

namespace Controller;

session_start();

use Core\Controller;
use Core\Request;
use UserModel;

class UserController extends Controller
{

    public function __construct()
    {
        $req = new Request();
    }

    public function indexAction()
    {
        $this->render("register");
    }

    public function registerAction()
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $query = new UserModel($_POST['email'], $_POST['password']);
            if ($query->find()) {
                echo "This mail is already taken. Please change.";
            } else {
                $query->create($_POST['email'], $_POST['password']);
                $this->render("login");
            }
        }
    }

    public function loginAction()
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $query = new UserModel($_POST['email'], $_POST['password']);
            $query->login($_POST['email'], $_POST['password']);
            $this->render("show");
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
        }
        $this->render("login");
    }

    public function showAction()
    {
        if(!isset($_SESSION)){
            $account = new UserModel($_POST['email'], $_POST['password']);
            $account->displayAccount($_SESSION['email']);
        }
        $this->render("show");

    }

    public function errorAction()
    {
        echo "Error 404 not found. Sorry not sorry";
    }
}
