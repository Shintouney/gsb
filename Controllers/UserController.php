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
    // action index
    public function index()
    {
        $users = Utilisateur::all();

        $this->render('User/index.php', array('pageName' => 'Liste utilisateurs','template' => 'admin', 'users' => $users));
    }

    // action display utilisateur affichage version admin
    public function display($id)
    {
        $auth = Auth::getInstance();
        if ($auth->isGranted('ROLE_ADMIN')) {
            $user = Utilisateur::find($id);
            $this->render('User/display.php', array('pageName' => 'Page utilisateur', 'template' => 'admin', 'user' => $user));
        } else {
            $this->forbidden();
        }
    }

    // action
    public function profile()
    {
        $user = $this->getUser();
        $this->render('User/display.php', array('pageName' => 'Mon profil', 'template' => 'dashboard', 'user' => $user));
    }

    // action create utilisateur
    public function create()
    {
        $db = Database::getInstance();
        $mdp  = '';
        $roles = Role::all();
        $errors = array();
        if (!empty($_POST)) {
            $fields = $_POST;
            $errors = array_merge_recursive($errors, $this->validateBlank(array('mdp', 'mdp_conf','login', 'email', 'role')));
            $errors = array_merge_recursive($errors, $this->validatePasswordConfirmation());
            $errors = array_merge_recursive($errors, $this->validateUniques(array('login', 'email')));
            unset($fields['mdp_conf']);
            if (!empty($fields['mdp'])) {
                $mdp = $fields['mdp'];
                $fields['mdp'] = Utilisateur::encrypt($fields['mdp']);
            }
            $fields = $this->handleRole($fields);
            $fields = $this->handleCommune($fields);
            $fields = $this->convertDate($fields);

            if (empty($errors)) {
                if(isset($_SESSION['post']))  unset($_SESSION['form']) ;
                $db->create('utilisateur', $fields);
                $nom_complet = $fields['prenom'].' '.$fields['nom'];
                $to          = array($fields['email'] => $nom_complet);
                $params      = array(
                    'nom_complet' => $nom_complet,
                    'login'       => $fields['login'],
                    'mdp'         => $mdp,
                );
                $this->sendAccountCreationMail($to, $params);
                $this->redirect('?page=user&action=index');
            }
            $_SESSION['form'] = $_POST;
            $_SESSION['form_errors'] = $errors;
            $this->redirect('?page=user&action=create');

        }
        $this->render('User/create.php', array(
                'template' => 'admin',
                'pageName' => 'Créer utilisateur',
                'roles' => $roles,

            ));
    }

    // action update utilisateur
    public function update($id)
    {
        $db = Database::getInstance();
        $user = Utilisateur::find($id);
        $roles = Role::all();
        $errors = array();
        if (!empty($_POST)) {
            $fields = $_POST;
            $errors = array_merge_recursive($errors,$this->validateBlank(array('email', 'role')));
            $errors = array_merge_recursive($errors, $this->validatePasswordConfirmation());
            $errors = array_merge_recursive($errors, $this->validateUniques(array('login', 'email'), $user));
            unset($fields['mdp_conf']);
            if (!empty($fields['mdp'])) {
                $fields['mdp'] = Utilisateur::encrypt($fields['mdp']); // on crypte
            }else {
                unset($fields['mdp']); // mot de passe vide ne reset pas le mot de passe
            }
            $fields = $this->handleRole($fields);
            $fields = $this->handleCommune($fields);
            $fields = $this->convertDate($fields);

            if (empty($errors)) {
                if(isset($_SESSION['post']))  unset($_SESSION['form']) ;
                $db->update($id, 'utilisateur', $fields);

                $this->redirect('?page=user&action=index');
            }
            $_SESSION['form'] = $_POST;
            $_SESSION['form_errors'] = $errors;
            $this->redirect('?page=user&action=update&id='.$id);
        }


        $communes = $user->getCommune() ? Commune::options($user->getCommune()->getCodePostal()) : null;

        $this->render('User/create.php', array(
                'template' => 'admin',
                'pageName' => 'Modifier utilisateur',
                'user' => $user,
                'roles' => $roles,
                'communes' => $communes,
            ));
    }

    // conversion date au format yyyy-mm-dd pour db
    public function convertDate($fields)
    {
        if(!empty($fields['date_embauche'])) {
            $date = DateTime::createFromFormat('d/m/Y', $fields['date_embauche']);
            $fields['date_embauche'] = $date->format('Y-m-d');
        }

        return $fields;
    }

    // récupération de l'id du role à partir de nom & clean-up // possibilité à partir du libelle
    public function handleRole($fields, $col = 'nom')
    {
        if (!empty($fields['role'])) {
            $role = Role::findOneBy(array($col => $fields['role']));
            unset($fields['role']);
            $fields['role_id'] = $role->getId();

        }

        return $fields;
    }

    // récupération de l'id & clean up code postal et commune
    public function handleCommune($fields)
    {
        if (!empty($fields['commune'])) {
            $fields['commune_id'] = $fields['commune'];
            unset($fields['commune']);

        }
        unset($fields['code_postal']);

        return $fields;
    }

    // validation de formulaire retourne un message d'erreur pour chaque champ danss liste qui est vide
    private function validatePasswordConfirmation()
    {
        $errors = array();
        $fields = $_POST;
        if (isset($fields['mdp']) && isset($fields['mdp_conf'])) {

            if ($fields['mdp'] !== $fields['mdp_conf']) {
                $errors = array('mdp' => array());
                $errors['mdp'][] = 'Le mot de passe doit être identique dans le champ de confirmation';
            }
        }

        return $errors;
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

    // action delete utilisateur
    public function delete()
    {
        if (!empty($_POST)) {
            $db = Database::getInstance();
            $db->delete($_POST['id'], 'utilisateur');
            $this->redirect('?page=user&action=index');
        }
    }

    // affiche les communes correspondant au code postal (AJAX)
    public function displayCommuneByCodePostal($code)
    {
        $communes = Commune::options($code);
        $this->partial('Template/options.php',  array('choices' => $communes));
    }

    // action import: importe des utilisateurs a partir de fichiers excel
    public function import()
    {
        if (!empty($_FILES)) {
            $file = $_FILES['file']['tmp_name'];
            $file_handle = fopen($file, "r");
            $header = fgetcsv($file_handle, 1024, ';');
            while (!feof($file_handle) ) {
                $row  = fgetcsv($file_handle, 1024, ';');
                $data = array_combine($header, $row); // creation tableau associatif
                $this->saveImport($data);
            }
            fclose($file_handle);

            $this->redirect('?page=user&action=index');
        }
        $this->render('User/import.php', array('template' => 'admin'));
    }

    // conversion des données du fichier excel et insertion en base
    private function saveImport($fields)
    {
        $db = Database::getInstance();
        $fields['email'] = $fields['email'] ? : $fields['login'].'@gsb.fr';
        $fields['role'] = $fields['role'] ? : 'visiteur';
        $fields['mdp'] = Utilisateur::encrypt($fields['mdp']);
        $fields['commune_id'] = Commune::findIdFromData($fields['cp'], strtoupper($fields['commune']));
        unset($fields['cp']);
        unset($fields['commune']);
        $fields = $this->handleRole($fields, 'libelle');
        $fields = $this->convertDate($fields);
        $db->create($fields, 'utilisateur');

    }
}