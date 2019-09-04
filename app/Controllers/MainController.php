<?php

namespace Key4Events\Controllers;

use \Key4Events\Controllers\CoreController;
use \Key4Events\Models\UserModel;

class MainController extends CoreController {

    public function login() {
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['emailLogin'])) {
                $email = trim($_POST['emailLogin']);
            };
            if (!empty($_POST['passwordLogin'])) {
                $password = trim($_POST['passwordLogin']);
            };
            if (UserModel::findByEmail($email)) {
                $user = UserModel::findByEmail($email);
            } else {
                $infomessages[] = 'Utilisateur inconnu';
                $this->show('login', ['infomessages' => $infomessages]);
            };
            if (!empty($user)) {
                if (password_verify($password, $user->getPassword())) {
                    $_SESSION['user'] = $user->getLastname().' '.$user->getFirstname();
                    $_SESSION['userId'] = $user->getId();
                    $_SESSION['token'] = bin2hex(random_bytes(32));
                    header('Location: '.$_SERVER['BASE_URI'].'/home');
                } else {
                    $infomessages[] = 'Utilisateur inconnu';
                    $this->show('login', ['infomessages' => $infomessages]);
                };
            }
        } else {
            $this->show('login');
        };
    }

    public function logout() {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            unset($_SESSION['userId']);
            unset($_SESSION['token']);
        };
        session_destroy();
        $this->redirectToLogin();
    }

    public function home() {
        if (isset($_SESSION['user'])) {
            $users = UserModel::findAll();
            $this->show('home', ['users' => $users]);
        } else {
            $this->login();
        }
    }
}