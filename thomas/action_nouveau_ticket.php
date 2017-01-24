<?php
session_start();
require_once('connexiondb.php');

//echo '<br/> $_SESSION : '; print_r($_SESSION);
//echo '<br/> $_POST : '; print_r($_POST);


//mettre id createur dans $_SESSION

$idmat = $_POST['MatosFormIncident'];
//echo $idmat.'<br/>';
$salle = $_POST['SalleFormIncident'];
//echo $salle.'<br/>';
$obj = $_POST['ObjetFormIncident'];
//echo $obj.'<br/>';
$desc = $_POST['DescFormIncident'];
//echo $desc.'<br/><br/><br/>';


//====================================== méthode validateBlank =====================================================
/* dans le controlleur utilises $errors = $this->validateBlank(array('idmat', 'salle','objet', 'desc'))
 * a condition que tu aies suivi mon conseil sur les names à rallonge
 *
 * la méthode renvoie un tableau d'erreurs avec un élément par champ vide
 * après je fais le traitement if(empty($errors) { create etc }else { la j'utilise une méthode de merde display errors qui fait un echo aussi)
 * ce que je ferais quand j'aurais le temps, je laisse les erreurs dans une variable dans le render du formulaire
 * et un espace au dessus du formulaire dans lequel si la variable errors n'est pas vide j'affiche juste le formulaire avec l'erreur au dessus
 * j'attends d'intégrer le template de hait pour faire ça je t'en reparle plus tard
 */
if ( empty($idmat)OR empty($salle)OR empty($obj) OR empty($desc) )
	{
		echo 'Veuillez renseigner tous les champs !<br/>';
		echo '<a href="formulaire_nouveau_ticket.php"> Retour au formulaire</a><br/>';
		echo '<a href="index.php">Revenir à l\'accueil</a>';
		
	}

else
{
	//inserer donnees dans la bdd
	echo 'début <br/>';

//=========== méthodes de Database =====@@@create@@@==//=====update=======//========delete===========//==funky==la=présentation===non?==
/* dans la méthode new ou create ou quoi que ce soit :
 *  tu récupères la connexion à la base de données $db = Database::getInstance();
 *  $db->create($champs, 'nomdelatable')
 * la tu pourrais utiliser $_POST pour champs, moi je fais un $fields = $_POST
 * parce que tous mes names ne correspondent pas aux colonnes en base de données
 * or $champ est un tableau associatif dont les clés sont les colonnes de la table en bdd sinon ça plante
 * donc j'ai role dans mon formulaire je fais $fields['role_id'] = $fields['role']  et unset($fields['role']
 * je dois supprimer la clé 'role' de $champs sinon l'insert va essayer de remplir une colonne qui n'existe pas d'où la méthode unset
 * tu te souviens quand je t'ai dis de mettre des names qui correspondent aux colonnes dans la table de bdd tu comprends pourquoi la?
 * je t'invite à regarder la méthode create dans database pour voir comment cela fonctionne
 */
    $req = $bdd->prepare('	INSERT INTO incident(etat, materiel_id, date_signalement , salle_id, objet_incident, description_incident)
							VALUES(\'en attente\', :idmat, NOW(), :salle, :obj, :desc)');
	$req->execute(array(
		'idmat'=>$idmat,
		'salle'=>$salle,
		'obj'=>$obj,
		'desc'=>$desc
		));
	//==============================redirection==============================================================
    /* si ton controleur hérite de Core/Controller et une fois de plus je le recommande vivement
     * tu pourras utiliser la méthode redirect qui fais exactement ce que fais la méthode header
     * l'intérêt c'est que tu n'as plus qu'à entrer en paramètres la partie requete de l'url
     * exemple dans mon UserController $this->redirect('?page=user&action=index');
     * en fait quand j'aurai mergé le code &action=index sera inutile
     * pour toi ce serait donc $this->redirect('?page=ticket')
     * tu es libres d'utiliser le header mais index.php te rameneras à la homepage il faudra rajouter ?page=ticket
     * d'ailleurs avec redirect pour aller sur la homepage $this->redirect() au cas ou
     */
	header ("Location:index.php");
}//== Je t'invites à aller sur action_nouveau_tickets.php ==============================================
?>