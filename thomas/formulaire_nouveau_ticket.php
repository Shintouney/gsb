<?php require('connexiondb.php');?>
<h1>Formulaire ticket de demande d'intervention</h1>

<div class='FormClient'>
	<form method="POST" action='action_nouveau_ticket.php'>
		
		<label>Matériel demandé :</label>
			<select name='MatosFormIncident' id='ObjetFormIncident'>
				<option></option>
				<?php include('model_form_incident_matos.php'); ?>
			</select><br/>
		
		
		<label>Salle :</label>
			<select name='SalleFormIncident' id='SalleFormIncident'>
				<option></option>
				<?php include('model_form_incident_salle.php'); ?>
			</select><br/>
			
			
		<label>Objet de la demande :</label>
		<input type='text' name='ObjetFormIncident'/><br/>
		
		
		<label>Description :</label><br/>
		<textarea name='DescFormIncident' rows='4' cols='50' ></textarea><br/>
		
		
		<input type='submit'/>
		
	</form>
	
	<a href='index.php'>Revenir à l'accueil</a>
	
</div>