<?php require('connexiondb.php');?>
<h1>Formulaire ticket de demande d'intervention</h1>

<div class='FormClient'>
	<form method="POST" action='action_nouveau_ticket.php'>
		
		<label>Matériel demandé :</label>
			<select name='MatosFormIncident' id='ObjetFormIncident'>
				<option></option>
				<?php include('model_form_incident_matos.php'); ?>
<?php // ===================== select options ===========================================================
/* bonne idée d'avoir séparé les queries c'est plus propre
 * bon sinon dans notre affaire :
 * tu dois créer un model materiel et un model salle,
 * les propriétés ( variables internes) correspondront aux colonnes des tables correspondantes
 * normalement on met les propriétés en privé et on créé des méthodes publique set et get pour y accéder
 * exemple class Salle { private nom; private id  public function getNom() { return $this->nom; } etc  }
 *  tu peux mettre les propriétés public pour aller plus vite en te disant que tu le modifieras peut être plus tard
 *  mais il faudra remodifier dans tous ton code je pense pas que ça prenne bcq de temps il ne doit pas y avoir des tonnes de propriétés
 * je pense que Cartailler pourrait te demander comme modif de les mettre en privé je sais pas
 * bon bref ce qui nous interesse :
 * dans les modeles respectifs tu créés une méthode options qui appelle la méthode all de Database comme tu n'as pas de jointures
 * si tu ne veux pas d'objet tu renvoies juste un tableau de tableaux qui contiennent deux valeurs l'id et la chaine type-marque-modele
 * tu donnes la variable à la fonction render $this->render('ticket.new.php, 'incidents', array('matos' => $matos, $salles => $salles)
 *
 * dans ta vue, ce fichier, au lien d'un include tu utilises un while ou un foreach <?php foreach $salles as $salle }?>
 *                                                                              <option value="<?= $salle[0] ?>><?= $salle[1] ?>
 *                                                                          <?php ] ?>
 * tu peux créer un tableau associatif à la place $salle['id']$salle['nom']
 *
 * tu peux aussi faire un objet salle ou materiel dans ce cas $salle->getId() $salle->getNom()
 * pour le materiel tu peux faire un get qui soit la concaténation des attributs $salle->getLibelle()
 * perso moi j'essaie d'aller vers le tout objet mais tu fais bien ce que tu veux. tu auras besoin de mettre de propriétés dans tes models
 *  si tu renvoie juste des tableaux mais je te conseille l'objet...
 */
//======================================================================================================?>
			</select><br/>
		
		
		<label>Salle :</label>
			<select name='SalleFormIncident' id='SalleFormIncident'>
<?php //============ name="salle' =======je ne connais pas ta bdd mais essaie d'avoir le name qui soit le nom de la propiété du model soit de la colonne==?>
				<option></option>
				<?php include('model_form_incident_salle.php'); ?>
			</select><br/>
			
			
		<label>Objet de la demande :</label>
		<input type='text' name='ObjetFormIncident'/><br/>
<?php//===========  name="objet" =========cele pourra t'éviter du code à rallonge dans le traitement ==================================================== ?>
		
		<label>Description :</label><br/>
		<textarea name='DescFormIncident' rows='4' cols='50' ></textarea><br/>
		
		
		<input type='submit'/>
		
	</form>
	
	<a href='index.php'>Revenir à l'accueil</a>
	
</div>
<?php //============= TicketController action : new, create ou add ==========================
/* méthode dans la controlleur qui fait un render de la vue ticket/new.php
 * Dans la vue tu met ce qu'il y a dans ce fichier.
 * Si tu mets une action vide action="" tu gère l'affichage du formulaire et le traitement du formulaire dans le même fichier
 * ou dans un controlleur dans la même "action" (méthode publique du controller)
 * moi je m'embete pas et vu le travail qu'il te reste à faire toi non plus tu ne devrais pas t'embeter à faire une action différente
 * si tu mets les deux fonctionnalités dans la même action tu dois entourer le traitement d'un " if(!empty($_POST) { traitenent }
 * le traitement doit être avant le code qui gère l'affichage de la vue ( render et peut être du code qui va avec)
 * tu peux avoir besoin de variables à la fois dans la partie traitement et affichage dans ce cas cette partie du code est avant lr if(!empty)
 * note : contrairement à ce qu'à cru Haitem le if(!empty) n'est pas une gestion d'erreurs si tu veux gérer les erreurs de formulaire c'est autres chose
 * moi j'ai créé validateBlank une méthode de Controlller, j'y rentre un tableau qui a une liste des noms des champs qui ne doivent pas être vide
 * tu peux l'utiliser mais il faut ajouter aussi l'attribut required à l'input qui doit obligatoirement être rempli, il faut les deux
 *  note: il peut y avoir d'autres gestions d'erreurs possibles
 *
 * rendez vous sur la page traitement du formulaire action_nouveau_ticket.php
 */
//=================================================================================================