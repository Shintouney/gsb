<!--on retourne sur la même page, mais l'action est dans le controller-->
<form method="POST" action="" id="obligatoire">

	<label>Matériel demandé :</label>
	<br/>
	<div class="9u$ align-center uniform">
	<div class="select-wrapper">
	<select name='materiel_id' id='materiel_id' >
		<option></option>
		<?php 
		foreach ($materiels as $materiel)
		{
			echo '<option value='.$materiel['id'].'>' . 
				 $materiel['num_inventaire']. ' - ' . $materiel['type'] . ' - ' .$materiel['marque'] .
				'</option>';
		}
		?>
	</select>
	</div>
	</div>
	</br>
	
	
	<label>Salle :</label>
	<div class="9u$ align-center uniform">
	<div class="select-wrapper">
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
	</select>
	</div>
	</div>
	<br/>
		
		
	<label>Objet de la demande :</label>
	<input type='text' name='objet_incident'/><br/>
	
	
	<label>Description :</label><br/>
	<textarea name='description_incident' rows='4' cols='50' ></textarea><br/>
	
	
	<input type='submit'/>
</form>