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
	
	$req = $bdd->prepare('	INSERT INTO incident(etat, materiel_id, date_signalement , salle_id, objet_incident, description_incident) 
							VALUES(\'en attente\', :idmat, NOW(), :salle, :obj, :desc)');
	$req->execute(array(
		'idmat'=>$idmat,
		'salle'=>$salle,
		'obj'=>$obj,
		'desc'=>$desc
		));
	
	header ("Location:index.php");
}
?>