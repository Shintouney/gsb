<form method="POST" action="" id="incident"><!--on retourne sur la même page, mais l'action est dans le controller-->
	
	<label>Numéro d'inventaire :</label>
	<input type='text' name='num_inventaire' required value="<?php echo $prechargement['num_inventaire'];?>"/><br/>

	<label>Type :</label>
	<input type='text' name='type' required value="<?php echo $prechargement['type'];?>"/><br/>
	
	<label>Marque :</label>
	<input type='text' name='marque' required value="<?php echo $prechargement['marque'];?>"/><br/>

	<label>Modele :</label>
	<input type='text' name='modele' required value="<?php echo $prechargement['modele'];?>"/><br/>
	
	<label>Date d'achat :</label>
	<input type='text' name='date_achat' value="<?php echo $prechargement['date_achat'];?>"/><br/>

	<label>Date de fin de garantie :</label>
	<input type='text' name='date_fin_garantie' value="<?php echo $prechargement['date_fin_garantie'];?>"/><br/>

	<label>Logiciels installés :</label>
	<input type='text' name='logiciels_installes' value="<?php echo $prechargement['logiciels_installes'];?>"/><br/>

	<label>Processeur :</label>
	<input type='text' name='processeur' value="<?php echo $prechargement['processeur'];?>"/><br/>

	<label>RAM :</label>
	<input type='text' name='RAM' value="<?php echo $prechargement['RAM'];?>"/><br/>

	<label>Disque dur :</label>
	<input type='text' name='disque_dur' value="<?php echo $prechargement['disque_dur'];?>"/><br/>

	<label>Carte mère :</label>
	<input type='text' name='carte_mere' value="<?php echo $prechargement['carte_mere'];?>"/><br/>

	<label>Autre :</label>
	<textarea name='autre' rows="4" cols="50"><?php echo $prechargement['autre'];?></textarea><br/>

	<input type='submit'/>
</form>
