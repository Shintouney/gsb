

<h1>Liste du matériel</h1>

<table>
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
				<td> <a href='?page=materiel&action=afficher_materiel&id=<?=$un_materiel['id_materiel'];?>' >Voir plus</a></td>
				<td> <?php echo $un_materiel['id_materiel'];?> </td>
				<td> <?php echo $un_materiel['type'];?> </td>
				<td> <?php echo $un_materiel['marque'];?> </td>
				<td> <?php echo $un_materiel['modele'];?> </td>
				<td> <?php echo $un_materiel['logiciels_installes'];?> </td>
				<td> <?php echo $un_materiel['date_achat'];?> </td>
				<td> <?php echo $un_materiel['date_fin_garantie'];?> </td>
				<td> <?php echo $un_materiel['num_inventaire'];?> </td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>



