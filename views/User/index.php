<div class="box">
    <div class="row">
        <div class="12u">
            <table class="table table-responsive" id="users">
                <tr>
					<th></th>
                    <th>Login :</th>
                    <th>Prénom :</th>
                    <th>Nom :</th>
                    <th>Rôle :</th>
                    <th>Ville :</th>
                    <th colspan="2">Actions :</th>
                </tr>
                <?php foreach ($users as $user): ?>
                    <tr>
						<td class= "center"><img class="small" src="img/avatars/<?= $user->getImage() ? : 'user.png' ?>"/></td>
						<td><?=$user->getLogin()?></td>
                        <td><?=$user->getLogin()?></td>
                        <td><?=$user->getPrenom(); ?> </td>
                        <td><?=$user->getNom()?></td>
                        <td><?=$user->getRole()->getLibelle()?></td>
                        <td><?php
                            $commune = strlen($user->getCommune()->getNom()) > 18 ? substr($user->getCommune()->getNom(), 0, 18).'...':
                                $user->getCommune()->getNom();
                            $commune = $commune. ' ('.$user->getCommune()->getCodePostal().')';
                            echo $commune;
                            ?></td>
                        <td><a class="special" href="?app=user&action=display&id=<?=$user->getId();?>">voir</a></td>
                        <td><a class="special" href="?app=user&action=update&id=<?=$user->getId();?>">modifier</a></td>

                    </tr>
                <?php endforeach; ?>
            </table>
            <?php include 'views'.D_S.'Template'.D_S.'_pagination.php'; ?>
        </div>
    </div>
    <div class="row">
        <div class="12u">
            <ul class="actions">
                <li><a class="special" href="?app=user&action=create">nouvel utilisateur</a></li>
                <li><a class="special" href="?app=user&action=import">importer liste utilisateurs</a></li>
            </ul>
        </div>
    </div>
</div>
