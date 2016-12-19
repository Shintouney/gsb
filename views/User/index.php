<table id="users">


<tr>
    <th>Nom :</th>
    <th>Prénom :</th>
    <th>Actions :</th>
</tr>
<?php foreach ($users as $user): ?>
<tr>
    <td><?=$user->getNom()?></td>
    <td><?=$user->getPrenom(); ?> </td>
    <td><a href="?page=user&action=update&id=<?=$user->getId();?>">modifier</a></td>
    <td><a href="?page=user&action=delete&id=<?=$user->getId();?>">supprimer</a></td>
</tr>

<?php endforeach; ?>
</table>