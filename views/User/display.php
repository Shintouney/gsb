<div class="box">
    <div class="row">
        <div class="8u -2u">
            <table id="users">
                <tr>
                    <th>Nom :</th>
                    <td><?= $user->getNom() ?> </td>
                </tr>
                <tr>
                    <th>Prénom :</th>
                    <td><?= $user->getPrenom(); ?> </td>
                </tr>
                <tr>
                    <th>Login :</th>
                    <td><?= $user->getLogin(); ?> </td>
                </tr>
                <tr>
                    <th>Email :</th>
                    <td><?= $user->getEmail(); ?> </td>
                </tr>
                <tr>
                    <th>Fonction :</th>
                    <td><?= $user->getRole()->getLibelle(); ?></td>
                </tr>
                <tr>
                    <th>Téléphone interne:</th>
                    <td><?= $user->getTelephoneInterne(); ?></td>
                </tr>
				<tr>
                    <th>Téléphone</th>
                    <td><?= $user->getTelephone(); ?></td>
                </tr>
                <tr>
                    <th>Adresse :</th>
                    <td><?= $user->getAdresse(); ?></td>
                </tr>
                <tr>
                    <th>Commune :</th>
                    <td><?= $user->getCommune()->getNom(); ?></td>
                </tr>
                <tr>
                    <th>Date d'embauche :</th>
                    <td><?= $user->getDateEmbauche('d M Y'); ?> </td>
                </tr>
            </table>
        </div>
		 <div class="2u">
			<?php if ($user->getImage()) { ?>
				<img class="profile" src="img/avatars/<?=$user->getImage();?>">
			<?php } ?>
		 </div>
    </div>
    <?php if ($pageName !== "Mes données" && $this->getUser()->isAdmin()) { ?>
        <hr/>
        <div class="row">
            <div class="9u -3u">
                <ul class="actions">
                    <li><a class="special" href="?app=user">retour à la liste</a></li>
                    <li><a class="special" href="?app=user&action=update&id=<?= $user->getId(); ?>">Modifier</a></li>
                    <li>
                        <form action="?app=user&action=delete" method="post" class="inline-form" style="">
                            <input type="hidden" name="id" value="<?=$user->getId()?>">
                            <button class="delete" type="submit">Supprimer</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    <?php } ?>
</div>