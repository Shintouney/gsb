<?php 

require_once 'Core'.D_S.'Auth.php';
require_once 'Core'.D_S.'Database.php';
require_once 'Core'.D_S.'Controller.php';
require_once 'Models'.D_S.'Utilisateur.php';
require_once 'Models'.D_S.'Role.php';

class UserController extends Controller
{
    public function login()
    {
        if (!empty($_POST)) {
            $auth  = Auth::getInstance();
            $db = Database::getInstance();
            $data = $db->findByLogin($_POST['login']);
            $user = new Utilisateur();

            $user->setData($data);
            $user->encrypt('1234');

            $role = new Role();
            $roleData = $db->find($data['role_id'], 'role');
            $role->setData($roleData);
            $user->setRole($role);
            var_dump($user);

            if ($auth->login($user, $_POST['mdp'])) {

                $this->redirect();
            }else{
                $error = 'identifiants invalides';
            }
        }

        ob_start();
        $this->render('User/login.php', 'no_template');
    }

    public function index()
    {
        $auth  = Auth::getInstance();
        $db = Database::getInstance();

        $users = $db->all('utilisateur');
        var_dump($users);
    }
}