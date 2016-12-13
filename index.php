<?php 
session_start();

define('D_S', DIRECTORY_SEPARATOR);
define('Corp', 'Corp'.D_S);
define('BR', '<br/>');

$path 	= 'Controllers'.D_S;
$page 	= isset($_GET['page']) ? $_GET['page'] : null;
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id 	= isset($_GET['id']) ? $_GET['id'] : null;

// conditions pour rediriger vers login sinon on lance les actions standards
if(/*!isset($_SESSION['logged'] || $_SESSION['logged'] == false || */$page = 'login') {
    $controller = 'UserController';
    $action 	= 'login';
} else {
    $controller = ucfirst($page).'Controller';
}

// inclusion du fichier avec require
require_once $path.$controller.'.php';
// instanciation du controller
$controller = new $controller();
// execution de la méthode
$id ? $controller->$action($id) : $controller->$action();