<?php 

require_once 'Auth.php';

class Controller
{
    protected function forbidden($msg = 'Accès interdit')
    {
        header('HTTP/1.0 403 Forbidden');
        die($msg);
    }

    protected function notFound()
    {
        header('HTTP/1.0 404 Not Found');
        die('Page introuvable');
    }

    protected function redirect($url = '')
    {
        // on cree l'url avecv  nom hote / fichier / requete http
        $url = $_SERVER['HTTP_ORIGIN'].$_SERVER['SCRIPT_NAME'].$url;
        header('Location: ' . $url);
    }

    protected function render($view, $template = 'default')
    {
        $view = str_replace('/', D_S, $view);
        ob_start();
        require 'views'.D_S.$view;
        $content = ob_get_clean();
        require 'views'.D_S.'Template'.D_S.$template.'.php';
    }
}