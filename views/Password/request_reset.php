<h2>Demander un nouveau mot de passe</h2>
<?php if (isset($invalid_id)) { ?><h3><?=$invalid_id ;?> n'est pas un identifiant connu</h3><?php }; ?>
<form action="" method="post" >
   <div>
       <label for="username">Identifiant</label>
       <input type="text" id="username" name="username" required="required"/>
   </div>
    <div>
        <input type="submit" value="envoyer" />
    </div>
</form>