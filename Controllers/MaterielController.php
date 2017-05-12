<?php
require_once 'Core'.D_S.'Auth.php';
require_once 'Core'.D_S.'Database.php';
require_once 'Core'.D_S.'Controller.php';
require_once 'Models'.D_S.'Materiel.php';


class MaterielController extends Controller 
{
	public function index()
	{

		$auth = Auth::getInstance();

		if (!$this->auth->isGranted("ROLE_RESPONSABLE") || !$this->auth->isGranted("ROLE_TECHNICIEN")) {
            $this->forbidden();
        }

		$id = $this->getUser()->getId();
		$materiel_tout = Materiel::all($id); //methode statique du model (materiel.php), requete tous les materiel

		//render = pour afficher la view, avec dans l'array les paramètres a donner à la view
		$this->render('Materiel/index.php', array('pageName' => "Gestionnaire de matériel", 'materiel'=> $materiel_tout));

	}
	
}