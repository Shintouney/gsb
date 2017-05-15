<?php
require_once 'Core'.D_S.'Auth.php';
require_once 'Core'.D_S.'Database.php';
require_once 'Core'.D_S.'Controller.php';
require_once 'Models'.D_S.'Materiel.php';
require_once 'Core'.D_S.'Mailer.php';

class MaterielController extends Controller 
{
	public function index()
	{

		$auth = Auth::getInstance();

		/*if (!$this->auth->isGranted("ROLE_RESPONSABLE") || !$this->auth->isGranted("ROLE_TECHNICIEN")) {
            $this->forbidden();
        }*/

		$id = $this->getUser()->getId();
		$tous_materiels = Materiel::all(); //methode statique du model (materiel.php), requete tous les materiel

		$to = $this->getUser()->getEmail();
		

		//render = pour afficher la view, avec dans l'array les paramètres a donner à la view
		$this->render('Materiel/index.php', array('pageName' => "Gestionnaire de matériel", 'tous_materiels'=> $tous_materiels, 'to'=> $to ));
	}
	
	//?page=materiel&action=afficher_materiel&id=3
	public function afficher_materiel($id)
	{
		$un_materiel = Materiel::one($id);//requete d'un materiel selon l'id

		if (!$un_materiel)
		{
			$this->notFound();
		}
		//$this->sendMailTicket();

		$this->render('Materiel/show.php', array('pageName' => "Afficher un matériel", 
			'un_materiel'=> $un_materiel));

	}


	public function nouveau_materiel()
	{
		$db = Database::getInstance();

		//2eme passage : une fois le formulaire rempli
		if (!empty($_POST))
		{
			//valeurs par défaut :
			if ($_POST['logiciels_installes'] == "") {
				$_POST['logiciels_installes'] = "Aucun";
			}

			$db->create('materiel', $_POST); //ecriture dans la bdd
			
			$this->redirect('?page=materiel');
		}

		//1er passage : formulaire pas encore rempli
		$this->render('Materiel/new.php', array('pageName' => "Ajouter un matériel"));
	}



	public function modifier_materiel($id)
	{
		$db = Database::getInstance();

		if (!empty($_POST))
		{
			if ($_POST['logiciels_installes'] == "") {
				$_POST['logiciels_installes'] = "Aucun";
			}
			$db->update($id, 'materiel', $_POST); //modif dans la bdd
			
			//si changement d'etat : envoi mail

			$this->redirect('?page=materiel');
		}

		$prechargement = Materiel::one($id);
		/*
		$etats = Incident::select_etat();
		$salles = Incident::select_salle();
		$materiels = Incident::select_materiel();
		$utilisateurs = Incident::select_utilisateur();
		*/

		$this->render('Materiel/update.php', array('pageName' => "Modifier le matériel", 
			'prechargement'=> $prechargement));
	}

	public function supprimer_materiel()
	{
		//on recoit l'id du ticket à supprimer via un form
		if (!empty($_POST))
		{
			$db = Database::getInstance();
			$db->delete($_POST['id'],'materiel');
			$this->redirect('?page=materiel');
		}
	}


	public function sendMailTicket()
    {
    	$to = $this->getUser()->getEmail();
    	//$param= //recupérer la valeur, if etat == 2 text =""

    	/*if etat == 1 {
    		
    	}*/

    	$params= array(
	            'message' 	=> 'test message',
	            'login'		=> 'test login',
	            'mdp'		=> 'test mdp',
        	);

        $subject = "Statut ticket d'incident";
        $body    = $this->renderView('views'.D_S.'emails'.D_S.'statut_ticket.php', $params);
        $mail    = new Mailer($to, $subject, $body);
        $mail->send();
        echo "mail envoyé";
    }
    
}