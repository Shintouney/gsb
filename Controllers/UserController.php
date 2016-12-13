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
		var_dump(empty($_POST));
		var_dump($_POST);
		
		
        if (!empty($_POST)) {
			die();
            if ($auth->login($bruno, $_POST['mdp'])) {
                $this->redirect('index.php?page=home');
            }else{
                $error = 'identifiants invalides';
            }
        }

        ob_start();
        require 'views'.D_S.'User'.D_S.'login.php';
        $content = ob_get_clean();
        require 'views'.D_S.'Template'.D_S.'no_template.php';
    }

    private function redirect()
    {

    }

}