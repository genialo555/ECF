<?php
require_once '../models/User.php';

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = User::findByEmail($email);

            if ($user && password_verify($password, $user->getPassword())) {
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['user_role'] = $user->getRole();
                header('Location: index.php');
                exit();
            } else {
                $error = "Email ou mot de passe incorrect.";
                include '../views/auth/login.php';
            }
        } else {
            include '../views/auth/login.php';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php');
        exit();
    }
}