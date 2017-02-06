<form method="POST" action=""><!--on retourne sur la même page, mais l'action est dans le controller-->
	
	<label>Matériel demandé :</label>
	<select name='materiel_id' id='materiel_id'>
		<option></option>
		<?php 
		foreach ($materiels as $materiel)
		{
			echo '<option value='.$materiel['id_materiel'].'>' . 
			$materiel['type'] . ' - ' . $materiel['marque'] . ' - ' . $materiel['modele'] .
			'</option>';
		}
		?>
	</select><br/>
	
	
	<label>Salle :</label>
	<select name='salle_id' id='salle_id'>
		<option></option>
		<?php 
		foreach ($salles as $salle)
		{
			echo '<option value='.$salle['salle_id'].'>' . 
			$salle['salle_nom'] . 
			'</option>';
		}
		?>
	</select><br/>
		
		
	<label>Objet de la demande :</label>
	<input type='text' name='objet_incident'/><br/>
	
	
	<label>Description :</label><br/>
	<textarea name='description_incident' rows='4' cols='50' ></textarea><br/>
	
	
	<input type='submit'/>
</form>