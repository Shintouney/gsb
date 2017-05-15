<?php ?>
<table>
	<tr><td>Numéro d'inventaire</td>	<td><?php echo $un_materiel['num_inventaire'];?> 		</td></tr>
	<tr><td>Type de matériel</td>		<td><?php echo $un_materiel['type'];?> 					</td></tr>
	<tr><td>Marque</td>					<td><?php echo $un_materiel['marque'];?> 				</td></tr>
 	<tr><td>Modèle</td>					<td><?php echo $un_materiel['modele'];?> 				</td></tr>
	<tr><td>Date d'achat</td>			<td><?php echo $un_materiel['date_achat'];?> 			</td></tr>
	<tr><td>Date fin de garantie</td>	<td><?php echo $un_materiel['date_fin_garantie'];?> 	</td></tr>
	<tr><td>Logiciels installés</td>	<td><?php echo $un_materiel['logiciels_installes'];?>	</td></tr>
	<tr><td>Processeur</td>				<td><?php echo $un_materiel['processeur'];?> 			</td></tr>
	<tr><td>RAM</td>					<td><?php echo $un_materiel['RAM'];?> 					</td></tr>
	<tr><td>Disque dur</td>				<td><?php echo $un_materiel['disque_dur'];?> 			</td></tr>
	<tr><td>Carte mère</td>				<td><?php echo $un_materiel['carte_mere'];?> 			</td></tr>
	<tr><td>Autre</td>					<td><?php echo $un_materiel['autre'];?> 				</td></tr>
	
		<p><!--modifier et supprimer-->
			<a href='?page=materiel&action=modifier_materiel&id=<?php echo $un_materiel['id'];?>'>Modifier le matériel</a>

			<!--suppression : utilisation d'un form pour envoyer à supprimer_ticket l'id du ticket a supprimer-->
			<form method="POST" action='?page=materiel&action=supprimer_materiel'>
				<input type='hidden' name='id' value=<?php echo $un_materiel['id'];?> />
				<input type='submit' value='Supprimer le materiel'/>
			</form>
		</p>
</table>