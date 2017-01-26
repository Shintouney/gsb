<?php 

require_once 'Auth.php';

class Controller
{
   protected function forbidden()
    {
        $this->redirect('?action=error&id=4');
    }

    protected function notFound()
    {
        $this->redirect('?action=error&id=2');
    }

    protected function redirect($url = '')
    {
        // on cree l'url avec  protocol //nom hote / index.php / requete http
        $url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'].$url;
        header('Location: ' . $url);
        die();
    }

    protected function render($view, $vars = array())
    {
        $vars = array_merge($vars, $this->userData());
        $view = str_replace('/', D_S, $view);
        ob_start();
        $template = isset($vars['template']) ? $vars['template'] : 'default';
        extract($vars);
        require 'views'.D_S.$view;
        $content = ob_get_clean();
        require 'views'.D_S.'Template'.D_S.'base.php';
    }

    protected function userData()
    {
        if (isset($_SESSION['user']))
        {
            $user = unserialize($_SESSION['user']);
            $role = $user->getRole()->getLibelle();
            return (array(
                'nom'    => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'login'  => $user->getLogin(),
                'activeRole'   => ucfirst($role)));
        }

        return (array('login' => 'undefined'));
    }

    public function getUser()
    {
        if (isset($_SESSION['user'])) {
            return unserialize($_SESSION['user']);
        }

        return false;
    }

    protected function partial($view, $vars)
    {
        $view = str_replace('/', D_S, $view);
        extract($vars);
        require 'views'.D_S.$view;
    }

    protected function filterAccess($role = 'ROLE_USER', $msg = 'Impossible d\'accéder à cette page!')
    {
        $auth = Auth::getInstance();

        if (false === $auth->isGranted($role, $msg)) {
            $this->forbidden($msg);
        }
    }

    /* rendu dans une variable */
    protected function renderView($view, $parameters)
    {
        ob_start();
        extract($parameters);
        require $view;

        return ob_get_clean();
    }

    // validation de formulaire retourne un message d'erreur pour chaque champ danss liste qui est vide
    protected function validateBlank($list)
    {
        $errors = array();
        $fields = $_POST;
        $emptyMsg = ' non renseigné';
        foreach ($fields as $field => $value) {
            if(empty($value) &&  in_array($field, $list)) {
                $errors[] = $field.$emptyMsg;
            }
        }

        return $errors;
    }

    // génere une url absolue
    protected function url($link)
    {
        return   $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'].$link;
    }
}