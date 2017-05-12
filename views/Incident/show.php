<table>
	<tr><td>Id</td>							<td><?php echo $ticket['id'];?> 					</td></tr>
	<tr><td>Etat</td>						<td><?php echo $ticket['intitule_etat'];?> 			</td></tr>
	<tr><td>Type du materiel</td>			<td><?php echo $ticket['type_materiel'];?> 			</td></tr>
 	<tr><td>Marque du materiel</td>			<td><?php echo $ticket['marque_materiel'];?> 		</td></tr>
  	<tr><td>Modèle du materiel</td>			<td><?php echo $ticket['modele_materiel'];?> 		</td></tr>
	<tr><td>Objet de l'incident</td>		<td><?php echo $ticket['objet_incident'];?> 		</td></tr>
	<tr><td>Description de l'incident</td>	<td><?php echo $ticket['description_incident'];?> 	</td></tr>
	<tr><td>Solution de l'incident</td>		<td><?php echo $ticket['solution_incident'];?> 		</td></tr>
	<tr><td>Date de signalement </td>		<td><?php echo $ticket['date_signalement'];?> 		</td></tr>
	<tr><td>Date d'intervention</td>		<td><?php echo $ticket['date_intervention'];?> 		</td></tr>
	<tr><td>Salle</td>						<td><?php echo $ticket['salle_nom'] ;?>				</td></tr>
	
	<?php
	if ($this->getUser()->is(array('ROLE_TECHNICIEN', 'ROLE_RESPONSABLE', 'ROLE_ADMIN')))
	{
	?>
		<tr><td>Technicien </td><td><?php echo $ticket['pnom_tech'] . ' ' . $ticket['nom_tech'];?></td></tr>
		<tr><td>Demandeur</td>				<td><?php echo $ticket['pnom_demand'] . ' ' . $ticket['nom_demand'];?></td></tr>
		<tr><td>Niveau d'urgence</td>		<td><?php echo $ticket['niveau_urgence'];?>			</td></tr>
		<tr><td>Niveau de complexité</td>	<td><?php echo $ticket['niveau_complexite'];?>		</td></tr>
		<tr><td>Durée</td>					<td><?php echo $ticket['duree'];?>					</td></tr>
		<tr><td>Nombre d'appels</td>		<td><?php echo $ticket['nb_appels'];?>				</td></tr>

		<p><!--modifier et supprimer-->
			<a href='?page=incident&action=modifier_ticket&id=<?php echo $ticket['id'];?>'>Modifier le ticket</a>

			<!--suppression : utilisation d'un form pour envoyer à supprimer_ticket l'id du ticket a supprimer-->
			<form method="POST" action='?page=incident&action=supprimer_ticket'>
				<input type='hidden' name='id' value=<?php echo $ticket['id'];?>>
				<input type='submit' value='Supprimer le ticket'>
			</form>
		</p>
	<?php
	}
	?>
</table>