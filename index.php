<?php 
session_start();

define('D_S', DIRECTORY_SEPARATOR);
define('Corp', 'Corp'.D_S);
define('BR', '<br/>');
define('ROOT', dirname(__DIR__));

require_once 'vendor/autoload.php'; // for plugins (mailer etc.)


$path 	= 'Controllers'.D_S;
$page 	= isset($_GET['page']) 	 ? $_GET['page']     : 'home';
$action = isset($_GET['action']) ? $_GET['action'] 	 : 'index';
$id 	= isset($_GET['id'])	 ? $_GET['id']       : null;

// conditions pour rediriger vers login sinon on lance les actions standards sinon homepage
if ($page != 'password' && $page != 'login' && notLogged()) {
    $controller = 'HomeController';
    $action     = 'toLogin';
} else {
    $controller = ucfirst($page).'Controller';
}

// inclusion du fichier avec require
require_once $path.$controller.'.php';
// instanciation du controller
$controller = new $controller();
// execution de la méthode
$id ? $controller->$action($id) : $controller->$action();

function notLogged()
{
    return !isset($_SESSION['logged']) || $_SESSION['logged'] == false;
}