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

                $this->redirect();
            }else{
                $error = 'identifiants invalides';
            }
        }

        $this->render('User/login.php', null, 'no_template');
    }
<<<<<<< Updated upstream
=======

    public function index()
    {
        $auth  = Auth::getInstance();
        $db = Database::getInstance();

        $users = $db->all('utilisateur');
        var_dump($users);

        $this->render('User/index.php');
    }

    public function create()
    {
        $db = Database::getInstance();
        $user = new Utilisateur();

        if (!empty($_POST)) {

        }

        $this->render('User/create.php');
    }
>>>>>>> Stashed changes
}