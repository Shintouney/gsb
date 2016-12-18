<form action="" method="post">
    <div><input type="text" name="nom" placeholder="Nom :"/></div>
    <div><input type="text" name="prenom" placeholder="Prenom :"/></div>
    <div><input type="text" name="login" placeholder="Login :"/></div>
    <div><input type="password" name="mdp" placeholder="Mot de passe :"/></div>
    <div><input type="email" name="email" placeholder="Email :"/></div>
    <div><select name="role" id="">
        <option value=""> </option>
        <?php foreach ($roles as $role): ?>
        <option value="<?=$role->getNom(); ?>" <?= $role->getNom()== 'ROLE_USER'? ' selected': '' ?>><?=$role->getLibelle(); ?></option>
        <?php endforeach; ?>
    </select></div>
    <input type="submit" value="Creer"/>
</form>