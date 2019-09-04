<?php

namespace Key4Events\Controllers;

use \Key4Events\Controllers\CoreController;
use \Key4Events\Models\UserModel;

class UserController extends CoreController {

    /**
     * Get a specified user by id
     */
    public function profile($id) {

        if (isset($_SESSION['user'])) {
            $user = UserModel::findById($id);
            if (empty($user)) {
                $this->show('404');
            } else {
                $this->show('profile', ['user' => $user]);
            };
        } else {
            $this->redirectToLogin();
        };
    }

    /**
     * Create an user
     */
    public function create() {

        if (isset($_SESSION['user'])) {

            if (!empty($_POST['lastname'])) {
                $lastname = trim($_POST['lastname']);
            } else {
                $infomessages[] = 'Veuillez entrer un nom';
            };
            if (!empty($_POST['firstname'])) {
                $firstname = trim($_POST['firstname']);
            } else {
                $infomessages[] = 'Veuillez entrer un prénom';
            };
            if (!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                if (!empty(UserModel::findByEmail($_POST['email']))) {
                    $infomessages[] = 'Un compte utilisateur possède déjà cette adresse email';
                } else {
                    $email = trim($_POST['email']);
                }
            } else {
                $infomessages[] = 'Veuillez entrer une adresse email valide';
            };
            if (!empty($_POST['password']) && !empty($_POST['checkpassword'])) {
                if (trim($_POST['password']) == trim($_POST['checkpassword'])) {
                    if (strlen(trim($_POST['password'])) < 8) {
                        $infomessages[] = 'Le mot de passe doit contenir 8 caractères minimum';
                    } else {
                        $password = password_hash(trim($_POST['password']), PASSWORD_ARGON2I) ;
                    }
                } else {
                    $infomessages[] = 'Les mots de passes fournis ne sont pas identiques';
                };
            };
            if ($_POST['role'] != 'role_user') {
                if (UserModel::findById($_SESSION())->getRoles() === 'role_admin') {
                    $role = 'role_admin';
                } else {
                    $infomessages[] = 'Seul un administrateur peut modifier les privilèges';
                };
            } else {
                $role = 'role_user';
            };

            
            if (!empty($infomessages)) {
                $users = UserModel::findAll();
                $this->show('home', [
                    'users' => $users,
                    'infomessages' => $infomessages]);
            }
            else {
                UserModel::create($lastname, $firstname, $email, $password, $role);
                $users = UserModel::findAll();
                $this->show('home', ['users' => $users,]);
            }
        } else {
            $this->redirectToLogin();
        };
    }

    /**
     * Update a specified user informations
     */
    public function update($id) {

        if (isset($_SESSION['user'])) {

            $currentUser =  UserModel::findById($id);

            if (!empty($_POST['lastname'])) {
                $lastname = trim($_POST['lastname']);
            } else {
                $infomessages[] = 'Veuillez entrer un nom';
            };
            if (!empty($_POST['firstname'])) {
                $firstname = trim($_POST['firstname']);
            } else {
                $infomessages[] = 'Veuillez entrer un prénom';
            };
            if (!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                if (UserModel::findByEmail($_POST['email']) != $currentUser) {
                    $infomessages[] = 'Un compte utilisateur possède déjà cette adresse email';
                } else {
                    $email = trim($_POST['email']);
                };
            } else {
                $infomessages[] = 'Veuillez entrer une adresse email valide';
            };
            if (!empty($_POST['password']) && !empty($_POST['checkpassword'])) {
                if (trim($_POST['password']) === trim($_POST['checkpassword'])) {
                    if (strlen(trim($_POST['password'])) < 8) {
                        $infomessages[] = 'Le mot de passe doit contenir 8 caractères minimum';
                    } else {
                        $password = password_hash(trim($_POST['password']), PASSWORD_ARGON2I);
                    };
                };
            } else {
                $password = $currentUser->getPassword();
            };
            if ($_POST['role'] == 'role_admin') {
                if (UserModel::findById($_SESSION['userId'])->getRole() == 'role_admin') {
                    $role = 'role_admin';
                } else {
                    $infomessages[] = 'Seul un administrateur peut modifier les privilèges';
                };
            } else {
                $role = 'role_user';
            };

            if (!empty($infomessages)) {
                $this->show('profile', [
                    'user' => $currentUser,
                    'infomessages' => $infomessages]);
            } else {
                UserModel::update($id, $lastname, $firstname, $email, $password, $role);
                $updatedUser = UserModel::findById($id);
                $this->show('profile', ['user' => $updatedUser]);
            };
        } else {
            $this->redirectToLogin();
        };
    }

    /**
     * Delete a specified user
     */
    public function delete($id) {

        if (isset($_SESSION['user'])) {
            if ($_POST['token'] === $_SESSION['token']) {
                $deletedUser = UserModel::findById($id);
                UserModel::delete($id);
                $users = UserModel::findAll();
                $infomessages[] = "L'utilisateur ".$deletedUser->getLastname()." ".$deletedUser->getFirstname()." a été supprimé"; 
            } else {
                $infomessages[] = 'La vérification des tokens à échoué; reconnexion nécessaire.';
            };
            $users = UserModel::findAll();
            $this->show('home', [
                'users' => $users,
                'infomessages' => $infomessages]);
        } else {
            $this->redirectToLogin();
        };
    }
}