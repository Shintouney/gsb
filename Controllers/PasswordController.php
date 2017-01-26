<?php

require_once 'Core'.D_S.'Database.php';
require_once 'Core'.D_S.'Mailer.php';
require_once 'Core'.D_S.'Controller.php';
require_once 'Models'.D_S.'Utilisateur.php';

class PasswordController extends Controller
{
    /* send password resetting email */
    private function sendResettingEmail(Utilisateur $user)
    {
        $to = array($user->getEmail() => $user->getNomComplet());
        $params =  array(
            'uti'  => $user->getNomComplet(),
            'link' => $this->url('?page=password&action=reset&id='.$user->getToken())
        );
        $subject = "Demande de réinitialisation de mot de passe";
        $body    = $this->renderView('views'.D_S.'emails'.D_S.'password_reset.php', $params);
        $mail    = new Mailer($to, $subject, $body);
        $mail->send();
    }

    // action recover password
    public function recover()
    {
        if (!empty($_POST)) {
            $db       = Database::getInstance();
            $username = htmlspecialchars($_POST['username'], ENT_QUOTES);
            $user     = Utilisateur::findOneByLoginOrEmail($username);

            if (null === $user) {
                $this->render('Password/request_reset.php', array(
                        'invalid_id' => $username
                    ));
            }
            $user->setToken();
            $this->sendResettingEmail($user);
            $db->update($user->getId(), 'utilisateur', array('token' => $user->getToken()));

            $this->render('Password/request_sent.php');
        }

        $this->render('Password/request_reset.php');
    }

    public function reset($token)
    {
        $db   = Database::getInstance();
        $user = Utilisateur::findBy(array('token' => $token));
        if (null === $user) {
            die( "erreur, le token n'est pas valide");
        }
        $auth = Auth::getInstance(); // on authentifie l'utilisateur si le token est valide
        $auth->authenticate($user);

        if (!empty($_POST)) {
            $fields = $_POST;
            $errors = $this->validateBlank(array('email', 'role'));
            if (!empty($fields['mdp']) && $fields['mdp'] === $fields['mdp_confirmation']) {
                $fields['mdp'] = Utilisateur::encrypt($fields['mdp']); // on crypte
                unset($fields['mdp_confirmation']);
            }else {
                unset($fields['mdp']); // mot de passe vide ne reset pas le mot de passe
                unset($fields['mdp_confirmation']);
            }
            if (empty($errors)) {
                $db->update($user->getId(), 'utilisateur', $fields);

                $this->redirect('?page=user&action=index');
            } else {
                $this->displayErrors($errors);
            }
        }
        $this->render('Password/reset.php');
    }

    // action encrypt
    //permet d'encrypter un mot de passe entré dans l'url et afficher une version cryptée sur la page pour l'entrer en db
    public function encrypt($password)
    {
        echo BR;
        echo '<pre>'. Utilisateur::encrypt($password) . '</pre>'.BR;
    }
} 