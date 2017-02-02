
<form method="POST" action='index.php?page=incident&action=action_nouveau'>
	
	<label>Matériel demandé :</label>
		<select name='new_matos' id='new_matos'>
			<option></option>
			<?php 
			foreach ($materiels as $materiel)
			{
				echo '<option>' . $materiel['type'] . ' - ' . $materiel['marque'] . ' - ' . $materiel['modele'] .'</option>';
			}
			?>
		</select><br/>
	
	
	<label>Salle :</label>
		<select name='SalleFormIncident' id='SalleFormIncident'>
			<option></option>
			<?php 
			foreach ($salles as $salle)
			{
				echo '<option>' . $salle['salle_nom'] . '</option>';
			}
			?>
		</select><br/>
		
		
	<label>Objet de la demande :</label>
	<input type='text' name='ObjetFormIncident'/><br/>
	
	
	<label>Description :</label><br/>
	<textarea name='DescFormIncident' rows='4' cols='50' ></textarea><br/>
	
	
	<input type='submit'/>
	
</form>

<a href='index.php'>Revenir à l'accueil</a>

