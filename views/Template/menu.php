<?php
$menu_frais = array(
	array('text' => 'Accueil',               'url' => 'index.php'),
	array('text' => 'Saisie fiche de frais', 'url' => 'index.php?page=frais'),
	array('text' => 'Mes fiches de frais',   'url' => 'index.php?page=frais&action=mesfiches', 'page' => 'Mes fiches frais'),
);
$menu_incidents = array(
	array('text' => 'Tous mes tickets', 'url' => '?page=incident'),
    array('text' => 'créer ticket', 'url' => '.?page=incident&action=nouveau_ticket'),
);
$menu_admin = array(
    array('text' => 'Index des utilisateurs', 'url' => 'index.php?page=user', 'icon' => 'group', 'page' => 'Liste utilisateurs'),
    array('text' => 'Créer utilisateur',      'url' => '?page=user&action=create', 'icon' => 'user'),
    array('text' => 'Importer utilisateurs',  'url' => '?page=user&action=import', 'icon' => 'file-text', 'page' => 'Import utilisateurs'));

$menu_dashboard = array(
    array('text' => 'Accueil',                 'url' => 'index.php', 'icon' => 'home'),
    array('text' => 'Consulter mes données',   'url' => "?page=user&action=profile", 'icon' => 'user', 'page' => 'Mes données'),
    array('text' => 'Changer de mot de passe', 'url' => "?page=password&action=change", 'icon' => 'key'),
)?>

<!-- Sidebar -->
<div id="sidebar">
    <div class="inner">
        <!-- Menu -->
        <nav id="menu">
            <?php if($this->getUser()->is('ROLE_ADMIN')): ?>
                <?php
                $header = "Administration"; $items = $menu_admin;
                include "_list_menu.php" ;
                $header = "Rapports incidents"; $opener = 'Gérer incidents'; $items = $menu_incidents;
                include "_drop_down_menu.php" ?>
                <?php
                 if ($menu_frais[0]['text'] === 'Accueil') array_shift($menu_frais);
                $header = "Applifrais"; $opener = 'Gérer frais';  $items = $menu_frais;
                include "_drop_down_menu.php" ?>
                <?php
                $header = "Tableau de bord"; $items = $menu_dashboard;
                include "_list_menu.php" ?>
            <?php else: ?>
                <?php
                $header = "Applifrais"; $items = $menu_frais;
                include "_list_menu.php" ?>
                <?php
                $header = "Rapports incidents"; $items = $menu_incidents;
                include "_list_menu.php" ?>
                <?php
                $header = "Tableau de bord"; $items = $menu_dashboard;
                include "_list_menu.php" ?>
            <?php endif; ?>
        </nav>
        <!-- Footer -->
        <footer id="footer">
            <img class="menu-logo" src="img/app/logo-tr.png" alt=""/>
            <p class="copyright"> GSB &copy; <?= date('Y')?></a></p>
        </footer>
    </div>
</div>

