<!-- Banner -->
<section id="banner">
    <div class="content">
		<header>
            <h1>Bienvenue sur gsb</h1>
            <p>Vous êtes connecté avec l'utilisateur: <strong><?=$login;?></strong></p>
        </header>
		<div>
		<?php if ($this->getUser()->getImage()) { ?>
		<img src="img/avatars/<?=$this->getUser()->getImage()?>":>
		<?php } ?>
		</div>
        <ul class="actions">
            <li><a href="?page=frais" class="button big">Saisir fiche de frais</a></li>
			<li><a href="?page=incident" class="button big">Mes tickets</a></li>
        </ul>
    </div>
	<span class="image object">
		<img src="img/app/pic12.jpg" alt="" />
	</span>
</section>