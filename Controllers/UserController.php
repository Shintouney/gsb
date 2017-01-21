<?php 

require_once 'Core'.D_S.'Auth.php';
require_once 'Core'.D_S.'Database.php';
require_once 'Core'.D_S.'Mailer.php';
require_once 'Core'.D_S.'Controller.php';
require_once 'Core'.D_S.'Date.php';
require_once 'Models'.D_S.'Utilisateur.php';
require_once 'Models'.D_S.'Role.php';
require_once 'Models'.D_S.'Commune.php';

class UserController extends Controller
{
    // action login
    public function login()
    {
        if (!empty($_POST)) {
            $auth  = Auth::getInstance();
            $user = Utilisateur::findOneByLogin($_POST['login']);
            if ($user && $auth->login($user, $_POST['mdp'])) {
                $this->redirect();
            }else{
                $error = 'identifiants invalides';
            }
        }

        $this->render('User/login.php', 'no_template', null);
    }

    // action index
    public function index()
    {
        $users = Utilisateur::all();

        $this->render('User/index.php', 'admin', array('users' => $users));
    }

    // action display
    public function display($id)
    {
        if($_SESSION['auth'] == $id || $_SESSION['role'] === 'ROLE_ADMIN') {
            $user = Utilisateur::find($id);
            $this->render('User/display.php', 'dashboard', array('user' => $user));
        } else {
            $this->forbidden();
        }
    }

    // action create
    public function create()
    {
        $db = Database::getInstance();
        $mdp  = '';
        $roles = Role::all();
        if (!empty($_POST)) {
            $fields = $_POST;
            $errors = $this->validateBlank(array('mdp', 'login', 'email', 'role'));
            if (!empty($fields['mdp'])) {
                $mdp = $fields['mdp'];
                $fields['mdp'] = Utilisateur::encrypt($fields['mdp']);
            }
            $fields = $this->handleRole($fields);
            $fields = $this->handleCommune($fields);
            $fields = $this->handleDate($fields);;
            if (empty($errors)) {
                $db->create($fields, 'utilisateur');
                $nom_complet = $fields['prenom'].' '.$fields['nom'];
                $to          = array($fields['email'] => $nom_complet);
                $params      = array(
                    'nom_complet' => $nom_complet,
                    'login'       => $fields['login'],
                    'mdp'         => $mdp,
                );
                $this->sendAccountCreationMail($to, $params);
                $this->redirect('?page=user&action=index');
            } else {
               $this->displayErrors($errors);
            }
        }

        $this->render('User/create.php', 'admin', array('roles' => $roles));
    }

    // action update
    public function update($id)
    {
        $db = Database::getInstance();
        $user = Utilisateur::find($id);
        $roles = Role::all();

        if (!empty($_POST)) {
            $fields = $_POST;
            $errors = $this->validateBlank(array('email', 'role'));
            if (!empty($fields['mdp'])) {
                $fields['mdp'] = Utilisateur::encrypt($fields['mdp']); // on crypte
            }else {
                unset($fields['mdp']); // mot de passe vide ne reset pas le mot de passe
            }
            $fields = $this->handleRole($fields);
            $fields = $this->handleCommune($fields);
            $fields = $this->handleDate($fields);

            if (empty($errors)) {
                $db->update($id, 'utilisateur', $fields);

                $this->redirect('?page=user&action=index');
            } else {
                $this->displayErrors($errors);
            }
        }
        $communes = $user->getCommune() ? Commune::options($user->getCommune()->getCodePostal()) : null;

        $this->render('User/create.php', 'admin', array('user' => $user, 'roles' => $roles, 'communes' => $communes));
    }

    public function handleDate($fields)
    {
        $date = DateTime::createFromFormat('d/m/Y', $fields['date_embauche']);
        $fields['date_embauche'] = $date->format('Y-m-d');

        return $fields;
    }

    public function handleRole($fields)
    {
        if (!empty($fields['role'])) {
            $role = Role::findOneBy(array('nom' => $fields['role']));
            var_dump($role);
            unset($fields['role']);
            $fields['role_id'] = $role->getId();
            var_dump($role->getId());
        }

        return $fields;
    }

    public function handleCommune($fields)
    {
        if (!empty($fields['commune'])) {
            $fields['commune_id'] = $fields['commune'];
            unset($fields['commune']);

        }
        unset($fields['code_postal']);

        return $fields;
    }

    public function displayErrors($errors)
    {
        echo '<pre>';
        foreach ($errors as $error) {
            echo $error.BR;
        }
        echo '</pre>';
    }

    /* send email function */
    public function sendAccountCreationMail($to, $params)
    {
        $subject = "Votre compte a été créé";
        $body    = $this->renderView('views'.D_S.'emails'.D_S.'create_user.php', $params);
        $mail    = new Mailer($to, $subject, $body);
        $mail->send();
    }

    // action delete
    public function delete()
    {
        if (!empty($_POST)) {
            $db = Database::getInstance();
            $db->delete($_POST['id'], 'utilisateur');
            $this->redirect('?page=user&action=index');
        }
    }

    // action logout
    public function logout()
    {
        $auth = Auth::getInstance();
        $auth->logout();
    }

    public function batchImport()
    {
        if (!empty($_POST)) {

        }
        $this->render('User/import.php');
    }

    public function displayCommuneByCodePostal($code)
    {
        $communes = Commune::options($code);

        $this->partial('Template/options.php',  array('choices' => $communes));
    }
}