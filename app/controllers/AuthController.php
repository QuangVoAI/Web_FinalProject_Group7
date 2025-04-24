<?php
require_once 'app/models/UserModel.php';

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new UserModel();
            $user = $model->login($_POST['email'], $_POST['password']);
            if ($user) {
                $_SESSION['user'] = $user;
                header("Location: ?controller=product&action=list");
                exit;
            } else {
                $error = "Đăng nhập thất bại!";
            }
        }
        require 'app/views/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new UserModel();
            $model->register($_POST['email'], $_POST['password']);
            header("Location: ?controller=auth&action=login");
            exit;
        }
        require 'app/views/register.php';
    }

    public function logout() {
        unset($_SESSION['user']);
        header("Location: ?controller=auth&action=login");
    }
}