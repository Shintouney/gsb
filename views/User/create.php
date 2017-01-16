<form action="" method="post">
    <div><input type="text" name="nom" placeholder="Nom :"<?= isset($user)? ' value="'.$user->getNom().'"' :'';?>/></div>
    <div><input type="text" name="prenom" placeholder="Prenom :"<?= isset($user)? ' value="'.$user->getPrenom().'"' :'';?>/></div>
    <div><input type="text" name="login" placeholder="Login :"<?= isset($user)? ' value="'.$user->getLogin().'"' :'';?>/></div>
    <div><input type="password" name="mdp" placeholder="Mot de passe :"/></div>
    <div><input type="email" name="email" placeholder="Email :"<?= isset($user)? ' value="'.$user->getEmail().'"' :'';?>/></div>
    <div><select name="role" id="">
        <option value=""> </option>
        <?php foreach ($roles as $role): ?>
        <option value="<?=$role->getNom(); ?>" <?= $role->getNom()== 'ROLE_USER'? ' selected': '' ?>><?=$role->getLibelle(); ?></option>
        <?php endforeach; ?>
    </select></div>
    <input type="submit" value="Creer"/>
</form>