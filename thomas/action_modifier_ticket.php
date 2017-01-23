<?php
session_start();
include ('connexiondb.php');
print_r ($_SESSION);

$req = $bdd -> prepare('UPDATE incident SET etat = :ModifEtat, materiel_id = :ModifMatos, date_signalement = :ModifDateSignalement, 
						date_intervention = :ModifDateIntervention, objet_incident = :ModifObjet,
						description_incident = :ModifDescription, solution_incident = :ModifSolution, salle_id = :ModifSalle,
						technicien_id= :ModifTechId,demandeur_id = :ModifDemandId, niveau_urgence = :ModifUrgence, 
						niveau_complexite = :ModifComplexite, duree = :ModifDuree, nb_appels = :ModifNbAppels
						WHERE id = :id ');
						
$req->execute(array(
	'ModifEtat'=>$_POST['ModifEtat'],
	'ModifMatos'=>$_POST['ModifMatos'],
	'ModifDateSignalement'=>$_POST['ModifDateSignalement'],
	'ModifDateIntervention'=>$_POST['ModifDateIntervention'],
	'ModifObjet'=>$_POST['ModifObjet'],
	'ModifDescription'=>$_POST['ModifDescription'],
	'ModifSolution' => $_POST['ModifSolution'],
	'id'=>$_SESSION['id_ticket_selectionne'],
	'ModifSalle'=>$_POST['ModifSalle'],
	'ModifTechId'=>$_POST['ModifTechId'],
	'ModifDemandId'=>$_POST['ModifDemandId'],
	'ModifUrgence'=>$_POST['ModifUrgence'],
	'ModifComplexite'=>$_POST['ModifComplexite'],
	'ModifDuree'=>$_POST['ModifDuree'],
	'ModifNbAppels'=>$_POST['ModifNbAppels']
	));

	header ("Location:index.php");
?>
