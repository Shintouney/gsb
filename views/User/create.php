<form action="" method="post">
    <label for="nom">Nom :</label>
    <div><input type="text" name="nom" <?= isset($user)? ' value="'.$user->getNom().'"' :'';?>/></div>
    <label for="nom">Prénom :</label>
    <div><input type="text" name="prenom" <?= isset($user)? ' value="'.$user->getPrenom().'"' :'';?>/></div>
    <label for="nom">Login :</label>
    <div><input type="text" name="login" <?= isset($user)? ' value="'.$user->getLogin().'"' :'';?>/></div>
    <label for="nom">Mot de passe :</label>
    <div><input type="password" name="mdp" /></div>
    <label for="nom">Email :</label>
    <div><input type="email" name="email" p<?= isset($user)? ' value="'.$user->getEmail().'"' :'';?>/></div>
    <label for="nom">Rôle :</label>
    <div><select name="role" id="">
        <option value=""> </option>
        <?php foreach ($roles as $role): ?>
        <option value="<?=$role->getNom(); ?>" <?= $role->getNom()== 'ROLE_USER'? ' selected': '' ?>><?=$role->getLibelle(); ?></option>
        <?php endforeach; ?>
    </select></div>
    <input type="submit" value="<?= isset($user) ? "Modifier" : "Créer"; ?>"/>
</form>