<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-responsive" id="users">
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
                        <td><form action="?page=user&action=delete" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?=$user->getId()?>">
                                <button type="submit">Supprimer</button>
                            </form></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary btn-sm" href="?page=user&action=create">nouvel utilisateur</a>
        </div>
    </div>
</div>
