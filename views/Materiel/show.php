<table>
	<tr><td>id_materiel</td>			<td><?php echo $un_materiel['id_materiel'];?> 		</td></tr>
	<tr><td>type</td>					<td><?php echo $un_materiel['type'];?> 			</td></tr>
	<tr><td>marque</td>					<td><?php echo $un_materiel['marque'];?> 			</td></tr>
 	<tr><td>modele</td>					<td><?php echo $un_materiel['modele'];?> 		</td></tr>
  	<tr><td>logiciels_installes</td>	<td><?php echo $un_materiel['logiciels_installes'];?> 	</td></tr>
	<tr><td>date_achat</td>				<td><?php echo $un_materiel['date_achat'];?> 		</td></tr>
	<tr><td>date_fin_garantie</td>		<td><?php echo $un_materiel['date_fin_garantie'];?> 	</td></tr>
	<tr><td>num_inventaire</td>			<td><?php echo $un_materiel['num_inventaire'];?> 		</td></tr>
	
		<p><!--modifier et supprimer-->
			<a href='?page=incident&action=modifier_ticket&id=<?php echo $ticket['id'];?>'>Modifier le ticket</a>

			<!--suppression : utilisation d'un form pour envoyer à supprimer_ticket l'id du ticket a supprimer-->
			<form method="POST" action='?page=incident&action=supprimer_ticket'>
				<input type='hidden' name='id' value=<?php echo $ticket['id'];?>>
				<input type='submit' value='Supprimer le ticket'>
			</form>
		</p>
	
</table>