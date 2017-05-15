<?php
require_once 'Core'.D_S.'Auth.php';
require_once 'Core'.D_S.'Database.php';
require_once 'Core'.D_S.'Controller.php';
require_once 'Models'.D_S.'Incident.php';

//en tapant index.php?page=incident on arrive sur ce controller
class IncidentController extends Controller 
{
	public function index()
	{
		$auth = Auth::getInstance();

		//affichage des tickets selon l'utilisateur
		if($this->getUser()->is(array('ROLE_VISITEUR')))
		{
			$condition= 'WHERE demandeur_id = :id';
		}
		else 
		{
			if($this->getUser()->is(array('ROLE_TECHNICIEN')))
			{
				$condition= 'WHERE technicien_id = :id';
			}
			else //responsable admin ect 
			{
				$condition='';
				
			}
		}
		$id = $this->getUser()->getId();
		$tickets = Incident::all($id,$condition); //methode statique du model (incident.php), requete tous les tickets

		//render = pour afficher la view, avec dans l'array les paramètres a donner à la view
		$this->render('Incident/index.php', array('pageName' => "Gestion d'incidents", 'tickets'=> $tickets));
	}

	//?page=incident&action=afficher_ticket&id=3
	public function afficher_ticket($id)
	{
		$ticket = Incident::one($id);//requete d'un ticket selon l'id

		if (!$ticket)
		{
			$this->notFound();
		}
		
		$this->render('Incident/show.php', array('pageName' => "Afficher ticket d'incident", 'ticket'=> $ticket));
	}

	//?page=incident&action=nouveau_ticket
	public function nouveau_ticket()
	{
		$db = Database::getInstance();

		//une fois le formulaire rempli
		if (!empty($_POST))
		{
			//valeurs par défaut :
			$_POST['etat'] = 2;
			$_POST['date_signalement'] = date('d-m-y');
			$_POST['demandeur_id'] = $this->getUser()->getID() ;
			$_POST['technicien_id'] = 4;
			
			$db->create('incident', $_POST); //ecriture dans la bdd
			
			$this->redirect('?page=incident');
		}

		//1er passage : formulaire pas encore rempli
		$salles = Incident::select_salle();

		$materiels = Incident::select_materiel();

		$this->render('Incident/new.php', array('pageName' => "Créer un ticket d'incident", 'salles'=> $salles, 'materiels' => $materiels));
	}

	public function modifier_ticket($id)
	{
		$db = Database::getInstance();

		if (!empty($_POST))
		{
			$db->update($id, 'incident', $_POST); //modif dans la bdd
			
			$this->redirect('?page=incident');
		}
		
		$prechargement = Incident::one($id);
		$etats = Incident::select_etat();
		$salles = Incident::select_salle();
		$materiels = Incident::select_materiel();
		$utilisateurs = Incident::select_utilisateur();

		$this->render('Incident/update.php', array('pageName' => "Modifier le ticket d'incident", 
			'prechargement'=> $prechargement, 'etats'=> $etats, 'salles'=> $salles, 'materiels' => $materiels, 'utilisateurs' => $utilisateurs));
	}
	
	public function supprimer_ticket()
	{
		//on recoit l'id du ticket à supprimer via un form
		if (!empty($_POST))
		{
			$db = Database::getInstance();
			$db->delete($_POST['id'],'incident');
			$this->redirect('?page=incident');
		}
	}
	
}