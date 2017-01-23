<?php
session_start();
include ('connexiondb.php');

//faire un formulaire avec préchargé les données depuis la bdd
//update
?>

<html>
<head>
    <meta charset="utf-8"/>
	<link rel='stylesheet' href='thomas.css'/>
    <title></title>
</head>

<body>
	<h1>Modifier un ticket (technicien et admin seulement)</h1>

	<?php
	$requete = $bdd -> prepare ('SELECT * FROM incident WHERE id= ?');
	$requete -> execute (array( $_SESSION['id_ticket_selectionne'] ));
	$prechargement = $requete ->fetch() ;
	print_r($prechargement);
	?>
	
	<div class='FormAdmin'>
	
		<form method="POST" action='action_modifier_ticket.php'>
		
			<label>Etat :</label>					<input type='text' name='ModifEtat' value=<?php echo htmlspecialchars($prechargement['etat']);?> /><br/>
			
			
			<label>Matériel demandé :</label>
				<select name='ModifMatos' id='ModifMatos'>
					<option></option>
					<?php include('model_form_incident_matos.php') ?>
						
				</select><br/>
			
			<label>Date de signalement :</label>	<input type='text' name='ModifDateSignalement' value=<?php echo $prechargement['date_signalement'];?> /><br/>
			<label>Date d'intervention :</label>	<input type='text' name='ModifDateIntervention' value=<?php echo $prechargement['date_intervention'];?> /><br/>
			
			
			
			<label>Objet de l'incident :</label> 	<input type='text' name='ModifObjet' value=<?php echo $prechargement['objet_incident'];?> /><br/>
			
			<label>Description de l'incident :</label><br/>
			<textarea name='ModifDescription' rows="4" cols="50"><?php echo $prechargement['description_incident'];?></textarea><br/>
			
			<label>Solution à l'incident :</label><br/>
			<textarea name='ModifSolution' rows="4" cols="50"><?php echo $prechargement['solution_incident'];?></textarea><br/>
			
			
			<label>Salle :</label>
				<select name='ModifSalle' id='ModifSalle'>
					<option></option>
					<?php include('model_form_incident_salle.php') ?>
				</select><br/>
				
			<?php 
			if ($_SESSION['role'] == 3)
			{	
			?>
			<!label>Technicien id :</label>			<input type='text' name='ModifTechId' value=<?php //echo $prechargement['technicien_id'];?> /><br/-->
			<?php }?>
			
			<label>demandeur id :</label>			<input type='text' name='ModifDemandId' value=<?php echo $prechargement['demandeur_id'];?> /><br/>
			
			<label>Niveau d'urgence :</label>		<input type='text' name='ModifUrgence' value=<?php echo $prechargement['niveau_urgence'];?> /><br/>
			
			<label>Niveau de complexité :</label>	<input type='text' name='ModifComplexite' value=<?php echo $prechargement['niveau_complexite'];?> /><br/>
			
			<label>Durée (en minutes) :</label>		<input type='text' name='ModifDuree' value=<?php echo $prechargement['duree'];?> /><br/>
			
			<label>Nombre d'appels :</label>	<input type='text' name='ModifNbAppels' value=<?php echo $prechargement['nb_appels'];?> /><br/>
			
			
			<input type='submit'/>
		</form>
	</div>

	<a href='index.php'>Revenir à l'accueil</a>
	
</body>
</html>