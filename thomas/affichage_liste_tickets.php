<?php require_once('connexiondb.php'); 
//l'affichage va toujours etre affiché dans l'index en include?>


<form method='POST' action='affichage_ticket.php'>  
<!--formulaire car on sélectionne un bouton radio pour afficher un ticket indépendant-->

	<table class='incident'>
		<thead>
			<td> </td>
			<td>Numéro</td>
			<td>etat</td>
			<td>type <br/>materiel</td>
			<td>modele <br/>materiel</td>
			<td>objet de <br/>l'incident</td>
			<td>date de <br/>signalement</td>
			<td>date <br/>d'intervention</td>
			<!--td>description de l'incident</td-->
			<!--td>solution à l'incident</td-->
			<td>salle</td>
			<td>Nom du <br/>technicien</td>
			
			<?php 
			//champs supplémentaires pour  techniciens + responsables
			if ($_SESSION['role'] == 3 OR $_SESSION['role'] == 2)
			{
				echo '
				<td>demandeur_id</td>
				<td>niveau<br/>urgence</td>
				<td>niveau<br/>complexite</td>
				<td>duree</td>
				<td>nombre <br/>d\'appels</td>';
			}
			?>
		</thead>
			
		<?php include ('model_affichage_liste.php');

		
		
		while ($ligne_ticket = $req -> fetch(PDO::FETCH_ASSOC) )
		{
		?>
			<tr id='ticket <?php echo $ligne_ticket['id']?>'>
				
				<!--un bouton radio par ligne, ce radio a pour id(=numero) le même id que l'id de l'incident de la ligne-->
				<!--il permet de sélectionner l'incident que l'on veut et de garder son id en variable de session-->
				<td><input type='radio' name='ticket_selectionne' value=<?php echo $ligne_ticket['id_incident'] ?> ></td>
				
				<td> <?php echo $ligne_ticket['id_incident'];?> </td>
				<td> <?php echo $ligne_ticket['etat'];?> </td>
				<td> <?php echo $ligne_ticket['type_materiel'];?> </td>
				<td> <?php echo $ligne_ticket['modele_materiel'];?> </td>
				<td> <?php echo $ligne_ticket['objet_incident'];?> </td>
				<td> <?php echo $ligne_ticket['date_signalement'];?> </td>
				<td> <?php echo $ligne_ticket['date_intervention'];?> </td>
				<!--td> <?php echo $ligne_ticket['description_incident'];?> </td-->
				<!--td> <?php echo $ligne_ticket['solution_incident'];?> </td-->
				<td> <?php echo $ligne_ticket['salle'];?> </td>
				<td> <?php echo $ligne_ticket['technicien'];?> </td>
				
				
				<?php 
				//champs supplémentaires pour les techniciens
				if ($_SESSION['role'] == 3 OR $_SESSION['role'] == 2)
				{
					echo '
					<td>'. $ligne_ticket['demandeur_id'].' </td>
					<td>'. $ligne_ticket['niveau_urgence']. '</td>
					<td>'. $ligne_ticket['niveau_complexite'].'</td>
					<td>'. $ligne_ticket['duree'] .'</td>
					<td>'. $ligne_ticket['nb_appels'].' </td>'
					;
				}
				?>
				
			<tr>
		<?php
		}
		/*
		$req = $bdd->query('SELECT * FROM incident');
		$incidents = $req -> fetchAll(PDO::FETCH_ASSOC);
		foreach($incidents as $incident)
		{
			echo '<tr><a href=\'#\'> ';
			
			foreach($incident as $champ => $valeur)
			{
				echo '<td>'. $valeur.'</td>';
			}
			echo '</a></tr>';
		}*/
		?>
	</table>
	
	<input type='submit'value='Afficher le ticket'/>
	
</form>