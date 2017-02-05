<form method="POST" action=''>

	<label>Etat :</label>
	<select name='etat' id='etat'>
		<option></option><!--select options de la base de donnees-->
		<?php
		foreach ($etats as $etat)
		{
			echo '<option value='.$etat['id_etat'].' ' ;

			if ($etat['id_etat'] == $prechargement['etat'])
			{
				echo 'selected'; //donne l'attribut 'selected' à l'option préchargée
			}
			echo '>' . $etat['intitule_etat'] . '</option>';
		}
		?>
	</select><br/>
	
	
	<label>Matériel demandé :</label>
	<select name='materiel_id' id='materiel_id'>
		<option></option>
		<?php 
		foreach ($materiels as $materiel)
		{
			echo '<option value='.$materiel['id_materiel'].' ' ;

			if ($materiel['id_materiel'] == $prechargement['id_materiel'])
			{
				echo 'selected';
			}
			echo '>' . $materiel['type'].' - '.$materiel['marque'].' - '.$materiel['modele'] . '</option>';
		}
		?>
	</select><br/>
	
	
	<label>Date de signalement :</label><input type='text' name='date_signalement' value="<?php echo $prechargement['date_signalement'];?>" /><br/>
	<label>Date d'intervention :</label><input type='text' name='date_intervention' value="<?php echo $prechargement['date_intervention'];?>" /><br/>	
	<label>Objet de l'incident :</label><input type='text' name='objet_incident' value="<?php echo htmlspecialchars($prechargement['objet_incident']);?>" /><br/>
	<label>Description de l'incident :</label><br/>
		<textarea name='description_incident' rows="4" cols="50"><?php echo $prechargement['description_incident'];?></textarea><br/>
	<label>Solution à l'incident :</label><br/>
		<textarea name='solution_incident' rows="4" cols="50"><?php echo $prechargement['solution_incident'];?></textarea><br/>
	
	<label>Salle :</label>
	<select name='salle_id' id='salle_id'>
		<option></option>
		<?php 
		foreach ($salles as $salle)
		{
			echo '<option value='.$salle['salle_id'] . ' ';

			if ($salle['salle_id'] == $prechargement['salle_id'])
			{
				echo 'selected';
			}

			echo '>' . $salle['salle_nom'] . '</option>';
		}
		?>
	</select><br/>
	
	<label>Demandeur :</label>
	<select name='demandeur_id' id='demandeur_id'>
		<option></option>
		<?php 
		foreach ($utilisateurs as $demandeur)
		{
			echo '<option value=' . $demandeur['id'] . ' ';

			if ($demandeur['id'] == $prechargement['id_demand'])
			{
				echo 'selected';
			}
			echo '>' .$demandeur['prenom'].' '. strtoupper ($demandeur['nom']) . '</option>';
		}
		?>
	</select><br/>

	<label>Niveau d'urgence :</label>		<input type='text' name='niveau_urgence' value=<?php echo $prechargement['niveau_urgence'];?> /><br/>
	<label>Niveau de complexité :</label>	<input type='text' name='niveau_complexite' value=<?php echo $prechargement['niveau_complexite'];?> /><br/>
	<label>Durée (en minutes) :</label>		<input type='text' name='duree' value=<?php echo $prechargement['duree'];?> /><br/>
	<label>Nombre d'appels :</label>		<input type='text' name='nb_appels' value=<?php echo $prechargement['nb_appels'];?> /><br/>
	
	<?php
	//attribuer un ticket a un technicien
	if ($this->getUser()->is(array('ROLE_RESPONSABLE', 'ROLE_ADMIN')))
	{
	?>
		<p>
		<label>Technicien (OBLIGATOIRE) :</label>
		<select name='technicien_id' id='technicien_id'>
			<option></option>
			<?php
			foreach ($utilisateurs as $technicien)
			{
				if ($technicien['role_id']==4)
				{
					echo '<option value=' . $technicien['id'] . ' ';
					
					if ($technicien['id'] == $prechargement['id_tech'])
					{
						echo 'selected';
					}
					echo '>' .$technicien['prenom'].' '.strtoupper($technicien['nom']).'</option>';
				}
			}
			?>
		</select><br/>
		</p>
	<?php
	}
	?>
	<input type='submit'/>
</form>