<table id="users">
	<tr>
		<th>Nom :</th>
		<td><?=$user->getNom()?> </td>
	</tr>
	<tr>
		<th>Prénom :</th>
		<td><?=$user->getPrenom(); ?> </td>
	</tr>
	<tr>
		<th>Login :</th>
		<td><?=$user->getLogin(); ?> </td>
	</tr>
	<tr>
		<th>Email :</th>
		<td><?=$user->getEmail(); ?> </td>
	</tr>
	<tr>
		<th>Rôle:</th>
		<td><?=$user->getRole()->getLibelle(); ?></td>
	</tr>
	<tr>
		<th>Téléphone :</th>
		<td>0477254678 </td>
	</tr>
	<tr>
		<th>Adresse :</th>
		<td> 14 rue du Chalot </td>
	</tr>
	<tr>
		<th>Commune :</th>
		<td>Pont-Salomon </td>
	</tr>
	<tr>
		<th>Date d'embauche :</th>
		<td><?=date('D. M Y'); ?> </td>
	</tr>
</table>