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
		<th>Adresse :</th>
		<td><?=$user->getEmail(); ?> </td>
	</tr>
	<tr>
		<th>Commune :</th>
		<td><?=$user->getEmail(); ?> </td>
	</tr>
	<tr>
		<th>Téléphone :</th>
		<td><?=$user->getEmail(); ?> </td>
	</tr>
	<tr>
		<th>Date d'embauche :</th>
		<td><?=date('now'); ?> </td>
	</tr>
</table>