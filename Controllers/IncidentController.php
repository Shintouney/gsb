<?php

require_once 'Core'.D_S.'Auth.php';
require_once 'Core'.D_S.'Database.php';
require_once 'Core'.D_S.'Controller.php';
require_once 'Models'.D_S.'Incident.php';

class IncidentController extends Controller 
{
	public function index()
	{
		$auth = Auth::getInstance();

		$data = Incident::all();
		//requete model incident.php

		$this->render('Incident/index.php', array('pageName' => "Gestion d'incidents", 'tickets'=> $data));
		//render = pour afficher la vue
	}


}