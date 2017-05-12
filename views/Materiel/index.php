<h1>Le matériel</h1>

<table class='incident'>
	<thead>
		<td> </td>
		<td>Id materiel</td>
		<td>type</td>
		<td>marque</td>
		<td>modele</td>
		<td>logiciels installes</td>
		<td>date achat</td>
		<td>date fin garantie</td>
		<td>num inventaire</td>
	</thead>
	

	<tbody>				
		<?php //seulement les tickets du demandeur if id=getid
		foreach($materiel as $un_materiel)
		{
		?>
			<tr >
				<td> <a href='?page=incident&action=afficher_ticket&id=<?=$un_materiel['id'];?>' >Voir plus</a></td>
				<td> <?php echo $un_materiel['id_materiel'];?> </td>
				<!--
				<td> <?php echo $un_materiel['intitule_etat'];?> </td>
				<td> <?php echo $un_materiel['num_inventaire'] . ' - <br/>'
						. $un_materiel['type_materiel'] . ' - <br/>'
				 		. $un_materiel['marque_materiel'] . ' - <br/>'
				  		. $un_materiel['modele_materiel'];?> </td>
				<td> <?php echo $un_materiel['objet_incident'];?> </td>
				<td> <?php echo $un_materiel['date_signalement']. ' / <br/>' 
						. $un_materiel['date_intervention'];?> </td>
				<td> <?php echo $un_materiel['salle_nom'] ;?></td>

				
				<td><?php echo $un_materiel['pnom_tech'] . ' ' . $un_materiel['nom_tech'];?></td>
				<td><?php echo $un_materiel['pnom_demand'] . ' ' . $un_materiel['nom_demand'];?></td>
				<td><?php echo $un_materiel['niveau_urgence'] . ' / '
				 . $un_materiel['niveau_complexite'];?></td>
	-->
					
			</tr>
		<?php
		}
		?>
	</tbody>
</table>



