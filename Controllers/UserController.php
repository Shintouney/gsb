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
            $user = Utilisateur::findByLogin($_POST['login']);

            if ($auth->login($user, $_POST['mdp'])) {

                $this->redirect();
            }else{
                $error = 'identifiants invalides';
            }
        }

        $this->render('User/login.php', null, 'no_template');
    }

    public function index()
    {
        $auth  = Auth::getInstance();
        $db = Database::getInstance();
        $users = Utilisateur::all();

        $this->render('User/index.php', array('users' => $users));
    }

    public function create()
    {
        $db = Database::getInstance();
        $user = new Utilisateur();
        $roles = Role::all();
        if (!empty($_POST)) {
            $errors = array();
            $fields = $_POST;
            $emptyMsg = ' non renseigne';

            foreach ($fields as $field => $value) {
                if(empty($value) &&  in_array($field, array('mdp', 'login', 'email', 'role'))) {
                    $errors[] = $field.$emptyMsg;
                }
            }

            if (!empty($fields['mdp'])) {
                $fields['mdp'] = Utilisateur::encrypt($fields['mdp']);
            }
            if (!empty($fields['role'])) {
                $role = Role::findBy(array('nom' => $fields['role']));
                unset($fields['role']);
                $fields['role_id'] = $role->getId();
            }
            if (empty($errors)) {
                $db->create($fields, 'utilisateur');
                $this->redirect('?page=user&action=index');
            } else {
                echo '<pre>';
                foreach ($errors as $error) {
                    echo $error.BR;
                }
                echo '</pre>';
            }
        }

        $this->render('User/create.php', array('roles' => $roles));
    }
}