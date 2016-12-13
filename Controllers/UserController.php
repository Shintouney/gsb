<?php 

require_once 'Core'.D_S.'Auth.php';
require_once 'Core'.D_S.'Controller.php';
require_once 'Models'.D_S.'Utilisateur.php';
require_once 'Models'.D_S.'Role.php';

class UserController extends Controller
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

                $this->redirect('');
            }else{
                $error = 'identifiants invalides';
            }
        }

        ob_start();
        $this->render('User/login.php', 'no_template');
    }
}