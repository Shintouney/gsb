
<form method="POST" action=''>
	
	<label>Matériel demandé :</label>
		<select name='MatosFormIncident' id='ObjetFormIncident'>
			<option></option>
			<?php 

			foreach ($salles as $salle)
			{
				echo '<option>' . $salle['salle_numero'] . '</option>';
			}

			?>
		</select><br/>
	
	
	<label>Salle :</label>
		<select name='SalleFormIncident' id='SalleFormIncident'>
			<option></option>
			<?php include('select_salle.php'); ?>
		</select><br/>
		
		
	<label>Objet de la demande :</label>
	<input type='text' name='ObjetFormIncident'/><br/>
	
	
	<label>Description :</label><br/>
	<textarea name='DescFormIncident' rows='4' cols='50' ></textarea><br/>
	
	
	<input type='submit'/>
	
</form>

<a href='index.php'>Revenir à l'accueil</a>

