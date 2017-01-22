<?php 

require_once 'Core'.D_S.'Auth.php';
require_once 'Core'.D_S.'Controller.php';
require_once 'Models'.D_S.'Utilisateur.php';

class LoginController extends Controller
{
    // action login
    public function index()
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


    public function displayErrors($errors)
    {
        echo '<pre>';
        foreach ($errors as $error) {
            echo $error.BR;
        }
        echo '</pre>';
    }

    // action logout
    public function logout()
    {
        $auth = Auth::getInstance();
        $auth->logout();
    }
}