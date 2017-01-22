<?php 

require_once 'Core'.D_S.'Auth.php';
require_once 'Core'.D_S.'Database.php';
require_once 'Core'.D_S.'Mailer.php';
require_once 'Core'.D_S.'Controller.php';
require_once 'Models'.D_S.'Utilisateur.php';
require_once 'Models'.D_S.'Role.php';

class UserController extends Controller
{

    // action index
    public function index()
    {
        $users = Utilisateur::all();

        $this->render('User/index.php', array('users' => $users));
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

        $this->render('User/create.php', array('roles' => $roles));
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
            if (empty($errors)) {
                $db->update($id, 'utilisateur', $fields);

                $this->redirect('?page=user&action=index');
            } else {
                $this->displayErrors($errors);
            }
        }

        $this->render('User/create.php', array('user' => $user, 'roles' => $roles));
    }

    public function handleRole($fields)
    {
        if (!empty($fields['role'])) {
            $role = Role::findBy(array('nom' => $fields['role']));
            unset($fields['role']);
            $fields['role_id'] = $role->getId();
        }

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

    // action batch import: importe des utilisateurs a partir de fichiers excel
    public function batchImport()
    {
        if (!empty($_FILES)) {
            $file = $_FILES['file']['tmp_name'];
            $file_handle = fopen($file, "r");
            $header = fgetcsv($file_handle, 1024, ';');
            $this->import($header);
            while (!feof($file_handle) ) {
                $row  = fgetcsv($file_handle, 1024, ';');
                var_dump(array_combine($header, $row));
                $data = array_combine($header, $row);
                $this->import($data);
            }

            die();
            fclose($file_handle);
        }
        $this->render('User/import.php');
    }

    // conversion des données du fichier excel et insertion en base
    private function import($fields)
    {
        $db = Database::getInstance();
        $fields['email'] = $fields['login'].'@gsb.fr';
        $fields['mdp'] = Utilisateur::encrypt($fields['mdp']);
    }
}