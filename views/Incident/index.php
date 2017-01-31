<?php

if ($this->getUser()->is('ROLE_VISITEUR') || $this->getUser()->is('ROLE_RESPONSABLE'))
		{
			?>
			<p><a href='formulaire_nouveau_ticket.php'> Nouveau ticket d'incident </a></p>
			<?php
		}
?>

<table class='incident'>
	<thead>
		<td> </td>
		<td>Id</td>
		<td>Etat</td>
		<td>Type du<br/>materiel</td>
		
		<td>Objet de<br/>l'incident</td>
		<td>Date de<br/>signalement /<br/>d'intervention</td>
		<td>Salle</td>

		<?php //champs supplémentaires pour responsables + techniciens
		if ($this->getUser()->is('ROLE_TECHNICIEN') || $this->getUser()->is('ROLE_RESPONSABLE') )
		{
		?>
			<td>Technicien</td>
			<td>Demandeur</td>
			<td>Niveau<br/>d'urgence/<br/>
				complexité</td>
			<td>Durée</td>
			<td>Nombre <br/>d'appels</td>
		<?php
		}
		?>
	</thead>
	
	<tbody>				
		<?php 
		foreach($tickets as $ligne_ticket)
		{
		?>
			<tr id='ticket <?php echo $ligne_ticket['id_incident']?>'>
				
			<td> <a href='affichage_ticket.php?idTicket=<?php echo $ligne_ticket['id_incident'];?>' >Voir plus</a></td>
			<td> <?php echo $ligne_ticket['id_incident'];?> </td>
			<td> <?php echo $ligne_ticket['etat'];?> </td>
			<td> <?php echo $ligne_ticket['type_materiel'] . ' - <br/>'
			 	. $ligne_ticket['marque_materiel'] . ' - <br/>'
			  	. $ligne_ticket['modele_materiel'];?> </td>
			<td> <?php echo $ligne_ticket['objet_incident'];?> </td>
			<td> <?php echo $ligne_ticket['date_signalement']. ' / ' 
				. $ligne_ticket['date_intervention'];?> </td>

			<td> <?php
				echo $ligne_ticket['salle_numero'] ;
				if (!empty($ligne_ticket['salle_nom']))
				{
					echo ' ('.$ligne_ticket['salle_nom'].')';
				}
				?>
				</td>
			
			<?php 
			if ($this->getUser()->is('ROLE_TECHNICIEN') || $this->getUser()->is('ROLE_RESPONSABLE'))
			{
				?>
				<td><?php echo $ligne_ticket['technicien'] . ' ' . $ligne_ticket['prenom'];?></td>
				<td><?php echo $ligne_ticket['demandeur'];?></td>
				<td><?php echo $ligne_ticket['niveau_urgence'] . ' / '
				 . $ligne_ticket['niveau_complexite'];?></td>
				<td><?php echo $ligne_ticket['duree'];?></td>
				<td><?php echo $ligne_ticket['nb_appels'];?></td>
				</tr>
				<?php
			}
		}
		?>
	</tbody>
</table>