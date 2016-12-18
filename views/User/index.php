<table id="users">


<tr>
    <th>Nom :</th>
    <th>Prénom :</th>
</tr>
<?php foreach ($users as $user): ?>
<tr>
    <td><?=$user->getNom()?></td>
    <td><?=$user->getPrenom(); ?> </td>
</tr>

<?php endforeach; ?>
</table>