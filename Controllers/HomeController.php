<?php 

require_once 'Core'.D_S.'Auth.php';
require_once 'Core'.D_S.'Controller.php';
require_once 'Models'.D_S.'Utilisateur.php';
require_once 'Models'.D_S.'Role.php';

class HomeController extends Controller
{
    public function index()
    {
        $this->render('Home/index.php');
    }

    public function toLogin()
    {
        $this->redirect('?page=login');
    }
}