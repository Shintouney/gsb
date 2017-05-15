<h1>Liste du matériel</h1>

<table>
	<thead>
		<td> </td>
		<td>Numéro d'inventaire</td>
		<td>Type de matériel</td>
		<td>Marque</td>
		<td>Modèle</td>
		<td>Date fin de garantie</td>
	</thead>
	
	<tbody>				
		<?php
		foreach($tous_materiels as $materiel)
		{
		?>
			<tr >
				<td> <a href='?page=materiel&action=afficher_materiel&id=<?=$materiel['id'];?>' >
						<!--c'est id en GET et pas id_materiel sinon ca fait planter -->
						Voir plus</a></td> 
				<td> <?php echo $materiel['num_inventaire'];?> </td>
				<td> <?php echo $materiel['type'];?> </td>
				<td> <?php echo $materiel['marque'];?> </td>
				<td> <?php echo $materiel['modele'];?> </td>
				<td> <?php echo $materiel['date_fin_garantie'];?> </td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>