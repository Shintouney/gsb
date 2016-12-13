<?php 

require_once 'Core'.D_S.'Auth.php';
require_once 'Models'.D_S.'Utilisateur.php';
require_once 'Models'.D_S.'Role.php';

class UserController
{
    public function login()
    {
        $auth = new Auth();

        $bruno = new Utilisateur();
        $bruno->setLogin('bruno');
        $bruno->encrypt('1234');
        $role = new Role();
        $role->setNom('ROLE_ADMIN');
        $bruno->setRole($role);

        if (!empty($_POST)) {
            if ($auth->login($bruno, $_POST['mdp'])) {
                if(isset($_SESSION['redirect'])) {
                    // on recupere l'url de destination pour rediriger apres login et on l'efface
                    $redirect = $_SESSION['redirect'];
                    unset($_SESSION['redirect']);
                } else {
                    // sinon on redirige vers la page de profil de l'utilisateur
                   $redirect = 'index.php?page=utilisateur&action=profil';
                }
                $this->redirect($redirect);

            }else{
                $error = 'identifiants invalides';
            }
        }

        ob_start();
        require 'views'.D_S.'Utilisateur'.D_S.'login.php';
        $content = ob_get_clean();
        require 'views'.D_S.'Template'.D_S.'no_template.php';
    }

    private function redirect()
    {

    }

}