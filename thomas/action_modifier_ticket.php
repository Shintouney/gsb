<?php
session_start();
include ('connexiondb.php');
print_r ($_SESSION);
//(((((((((((((((((((=======méthodes de Database===//==create==//==@@update@@==//==delete//======)))))))))))))))))))))))
/* Comme create y a aussi une méthode update dans Database. tout ce que j'ai dit sur create s'applique
 *  notammant les éléments de $champs dont les clés doient être les noms de colonnes de la base de données
 * la seul différence c'est le nombre de parametres
 * $db->update($id, 'nomdelatable', $champs);
 * putain les parametres table et champs sont inversés par rapport à create je viens juste de m'en rendre compte
 * j'y touche pas sans en parler à haitem on verra ça plus tard
 */
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
