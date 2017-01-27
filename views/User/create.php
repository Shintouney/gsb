<div class="box">
    <form action="" method="post">
        <div class="row">
                <div class="6u">
                    <fieldset class="align-fieldset fieldset-auto-width">
                        <legend> <span class='icon fa-pencil-square-o'>identifiants</span> </legend>
                        <div>
                            <label for="login">Login :</label>
                            <input class="form-control" type="text" id="login"
                                   name="login" <?= isset($user) ? ' value="' . $user->getLogin() . '"' : ''; ?>/></div>
                        <div class="form-group">
                            <label for="mdp">Mot de passe :</label>
                            <input class="form-control" type="password" id="mdp" name="mdp"/></div>
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input class="form-control" type="email" id="email"
                                   name="email" <?= isset($user) ? ' value="' . $user->getEmail() . '"' : ''; ?>/></div>
                        <div class="form-group">
                            <label for="role">Fonction :</label>
                            <select input class="form-control" name="role" id="role">
                                <?php foreach ($roles as $role): ?>
                                    <option value="<?= $role->getNom(); ?>" <?= $role->getNom(
                                    ) == 'ROLE_VISITEUR' ? ' selected' : '' ?>><?= $role->getLibelle(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </fieldset>
                </div>

                <div class="6u">
                    <fieldset class='align-fieldset fieldset-auto-width'>
                        <legend><span class='icon fa-pencil-square-o'>données personnelles</span></legend>
                        <div>
                            <label for="nom">Nom :</label>
                            <input class="form-control" type="text" id="nom"
                                   name="nom" <?= isset($user) ? ' value="' . $user->getNom() . '"' : ''; ?>/></div>
                        <div>
                            <label for="prenom">Prénom :</label>
                            <input class="form-control" type="text" id="prenom"
                                   name="prenom" <?= isset($user) ? ' value="' . $user->getPrenom() . '"' : ''; ?>/></div>
                        <div class="form-group">
                            <label for="telephone">Tel :</label>
                            <input class="form-control" type="text" id="telephone"
                                   name="telephone" <?= isset($user) ? ' value="' . $user->getTelephone() . '"' : ''; ?>/></div>
                        <div>
                            <label for="date_embauche">Date d'embauche :</label>

                            <input class="form-control span2 datepicker" id="date_embauche" name="date_embauche" size="16"
                                   type="text" <?= isset($user) ? ' value="' . $user->getDateEmbauche() . '"' : ''; ?>/>
                        </div>
                        <div class="form-group">
                            <label for="codepostal">Code postal :</label>
                            <input class="form-control" type="text" id="code_postal"
                                   name="code_postal" <?= isset($user) ? ' value="' . $user->getCommune()->getCodePostal(
                                ) . '"' : ''; ?>/></div>
                        <div class="form-group">
                            <label for="commune">Commune :</label>
                            <?= isset($communes) ? "" : "<span>choisir un code postal...</span>"; ?>
                            <select class="form-control" <?= isset($communes) ? '' : ' style="visibility:hidden"' ?>
                                    id="commune" name="commune">
                                <?php if (isset($communes)):
                                    foreach ($communes as $commune): ?>
                                        <option <?php echo $user->getCommune()->getId(
                                        ) == $commune['value'] ? ' selected' : ''; ?>
                                            value="<?= $commune['value']; ?>"><?= $commune{'label'}; ?></option>
                                    <?php endforeach; endif; ?>
                            </select>
                        </div>
                    </fieldset>
                </div>
        </div>
        <div class="row">
            <div class="6u">
                <input type="submit" value="<?= isset($user) ? "Modifier" : "Créer"; ?>"/>
            </div>
        </div>
    </form>
</div>
