<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-responsive" id="users">
                <tr>
                    <th>Login :</th>
                    <th>Prénom :</th>
                    <th>Nom :</th>
                    <th>Rôle :</th>
                    <th>Ville :</th>
                    <th>Actions :</th>
                </tr>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?=$user->getLogin()?></td>
                        <td><?=$user->getPrenom(); ?> </td>
                        <td><?=$user->getNom()?></td>
                        <td><?=$user->getRole()->getLibelle()?></td>
                        <td><?=$user->getCommune()->getNom()?> (<?=$user->getCommune()->getCodePostal()?>)</td>
                        <td><a href="?page=user&action=update&id=<?=$user->getId();?>">modifier</a></td>
                        <td><form action="?page=user&action=delete" method="post" class="inline-form" style="">
                                <input type="hidden" name="id" value="<?=$user->getId()?>">
                                <button class="delete" type="submit">Supprimer</button>
                            </form></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary btn-sm" href="?page=user&action=create">nouvel utilisateur</a>
            <a class="btn btn-warning btn-sm" href="?page=user&action=batchImport">importer liste utilisateurs</a>
        </div>
    </div>
</div>
