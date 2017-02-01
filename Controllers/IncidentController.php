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

		$tickets = Incident::all();
		//requete model incident.php

		$this->render('Incident/index.php', array('pageName' => "Gestion d'incidents", 'tickets'=> $tickets));
		//render = pour afficher la vue
	}

	public function afficher_ticket($id)
	{
		$ticket = Incident::one($id);



		if (!$ticket)
		{
			$this->notFound();
		}
		
		$this->render('Incident/show.php', array('pageName' => "Affichage incident", 'ticket'=> $ticket));
	}

	public function nouveau_ticket()
	{
		$salles = Incident::salle_options();

		$materiels = Incident::materiel_options();


		$this->render('Incident/new.php', array('pageName' => "Créer un ticket d'incident", 'salles'=> $salles, 'materiels' => $materiels));
	}
}