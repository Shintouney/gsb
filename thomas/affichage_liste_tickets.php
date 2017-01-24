<?php //=====Ceci est une vue============ views/ticket/index.php ========== (a titre indicatif) ================================?>
<?php require_once('connexiondb.php');
//===========================================plus besoin de connexiondb.php ====== jamais dans la vue de toutes façons ==========
//l'affichage va toujours etre affiché dans l'index en include?>
<?php //================ veux tu parler de la vue et du controleur? pas forcement index ========================================/?>
<?php //============Noooooooooooooo!!!! == un formulaire qui fait toute la page c'est mal!!! =====================================
/* tu vas te faire déglinguer si tu fais ça
 * l'affichage de données et les formulaires pour en créer de nouvelles sont des choses différentes à ne pas mélanger
 *  remember the crud? create read update delete, des actions très différentes
 * Je vais lire ton fichier et essayer de comprendre ce que tu as voulu faire
 */
//===================================================================?>
<form method='POST' action='affichage_ticket.php'>  
<!--formulaire car on sélectionne un bouton radio pour afficher un ticket indépendant-->

	<table class='incident'>
		<thead>
			<td> </td>
			<td>Numéro</td>
			<td>etat</td>
			<td>type <br/>materiel</td>
			<td>modele <br/>materiel</td>
			<td>objet de <br/>l'incident</td>
			<td>date de <br/>signalement</td>
			<td>date <br/>d'intervention</td>
			<!--td>description de l'incident</td-->
			<!--td>solution à l'incident</td-->
			<td>salle</td>
			<td>Nom du <br/>technicien</td>
			
			<?php
			//champs supplémentaires pour  techniciens + responsables
			if ($_SESSION['role'] == 3 OR $_SESSION['role'] == 2)
			{
				echo '
				<td>demandeur_id</td>
				<td>niveau<br/>urgence</td>
				<td>niveau<br/>complexite</td>
				<td>duree</td>
				<td>nombre <br/>d\'appels</td>';
			}
			?>
		</thead>

		<?php include ('model_affichage_liste.php');
// =========== ton nom de fichier n'indique pas qu'il s'agit d'une requete sql ni que ça concerne les incidents (boouuh!)
// ========    mais toutes façons tu ne feras pas comme ça =================
// ====== ta requete sera dans une méthode que tu mettras dans le model Ticket ou incident =====
// ========= tu pourrais la mettre dans database mais c'est un fichier commun j'y ai mis que des méthodes génériques ===========
// ========etu doit appeler $db =  Database::getInstance() dans la méthode en question si tu es dans le model ======
// ====== du coup tu vas créer $db dans le controlleur seulement pour un create, un update ou un delete pas pour les select
// apres tu appelles dans ton action index la méthode statique: $incidents = Ticket::all()
// ===== $incidents (ou le nom que tu veux) sera un tableau contenant tous les incidents ==========
// ======= ensuite si ton controleur hérite de Core/Controller ( je te le conseille vivement ) ==========
// ============= tu appelles la méthode render comme ceci : $this->render('Ticket/index.php', 'nomdetontemplate', array('tickets => $tickets))
// le premier parametre est le nom du fichier view ( ce fichier ci, si tu me suis) , le nom du template, ticket, incident, le nom que tu veux
// ==============================le nom de template permet de personnaliser les fichiers communs de nos pages web.
// ================par exemple si tu crée un fichier nomdemontemplate.js il sera automatiquement ajouter à la page si tu as donné un nom de template
// ============ je compte faire pareil pour les fichiers css ============================
// ===== on peut ajouter des if (template = ) dans les autres fichiers pour personnaliser un peu plus ( a voir ce qu'on peut faire avec les templates d'haitem)

//  =====/////////      ==========     je suis trop bavard je récapitule :       ===========          =/////////////=======
/* 1) requete dans une méthode de classe model (repertoire Models) "all" serait un très bon nom de méthode ===
 * 2) la méthode peut retourner $db->prepare($sql, $champs) sql est la chaine contenant ta requete, $champ un tableau de parametres
 * 3) all() n'a pas besoin de params, tu peux utiliser $db->query($sql, true) <= true veut dire renvoit un tableau
 * 4) prepare et query on un dernier parametre booleen qui détermine si la méthode renvoit un tableau ou un objet
 * 3) public static function all() ( n'oublie pas static)
 * 4) tu récupére ce tableau dans une variable
 * 5) tu passes cette variable à la méthode render, comme indiqué ci dessus)
 *
 * Oui mais? pourquoi un formulaire, je vais devoir maintenant éclaircir ce mystère...
 */
		
		while ($ligne_ticket = $req -> fetch(PDO::FETCH_ASSOC) )
		{
		?>
			<tr id='ticket <?php echo $ligne_ticket['id']?>'>
				<!--un bouton radio par ligne, ce radio a pour id(=numero) le même id que l'id de l'incident de la ligne-->
				<!--il permet de sélectionner l'incident que l'on veut et de garder son id en variable de session-->
				<td><input type='radio' name='ticket_selectionne' value=<?php echo $ligne_ticket['id_incident'] ?> ></td>
				
				<td> <?php echo $ligne_ticket['id_incident'];?> </td>
				<td> <?php echo $ligne_ticket['etat'];?> </td>
				<td> <?php echo $ligne_ticket['type_materiel'];?> </td>
				<td> <?php echo $ligne_ticket['modele_materiel'];?> </td>
				<td> <?php echo $ligne_ticket['objet_incident'];?> </td>
				<td> <?php echo $ligne_ticket['date_signalement'];?> </td>
				<td> <?php echo $ligne_ticket['date_intervention'];?> </td>
				<!--td> <?php echo $ligne_ticket['description_incident'];?> </td-->
				<!--td> <?php echo $ligne_ticket['solution_incident'];?> </td-->
				<td> <?php echo $ligne_ticket['salle'];?> </td>
				<td> <?php echo $ligne_ticket['technicien'];?> </td>
				
				
				<?php 
				//champs supplémentaires pour les techniciens
				if ($_SESSION['role'] == 3 OR $_SESSION['role'] == 2)
				{
					echo '
					<td>'. $ligne_ticket['demandeur_id'].' </td>
					<td>'. $ligne_ticket['niveau_urgence']. '</td>
					<td>'. $ligne_ticket['niveau_complexite'].'</td>
					<td>'. $ligne_ticket['duree'] .'</td>
					<td>'. $ligne_ticket['nb_appels'].' </td>'
					;
				}
				?>
				
			<tr>
		<?php
		}
		/*
		$req = $bdd->query('SELECT * FROM incident');
		$incidents = $req -> fetchAll(PDO::FETCH_ASSOC);
		foreach($incidents as $incident)
		{
			echo '<tr><a href=\'#\'> ';
			
			foreach($incident as $champ => $valeur)
			{
				echo '<td>'. $valeur.'</td>';
			}
			echo '</a></tr>';
		}*/
		?>
	</table>
	
	<input type='submit'value='Afficher le ticket'/>
	
</form>
<?php // ======== ok je vois tu selectionne une ligne et tu soumets pour changer de page ==========================
// si j'étais toi je renoncerai à cette idée foireuse
// en plus des raisons cités au dessus tu montres que tu ne sais pas à quoi sert un formulaire et le jury va ta dézinguer
//  tu ne soumets pas de données tu n'a pas besoin de formulaire et encore moins de post ( la méthode get suffit pour changer de page)
// fais toi une colonne qu'on pourrait appeler action ou pas lui donner de nom on s'en fout ( th )
// tu peux aussi utiliser la colonne id et la transformer en lien mais c'est pas tres explicite
// sur chaque ligne dans la colonne action tu vas faire un lien que tu appelera voir, visiter, ou ce que ton imagination t'inspire
// le href sera de type index.php?page=ticket&action=voir&id=5
// ticket pour le nom du controlleur  l'action sera une méthode que tu feras dans le controlleur
/* le plus importnt l'id  le href sera en dur sauf l'id tu auras href="?page=ticket&action=voir&id="<?php $incident->getId()?>"*/
// ou dans ton cas plutot qu'incident c'est ligne_ticket, moi perso j'utilise des foreach plutot que le while mais tu le sais déja :)
// c'est hors sujet par rapport à ma mission mais je te conseille ce refactoring
// évidemment le getId c'est une méthode publique de classe objet si tu créés un model Ticket ou Incident

// rendez vous dans affichage_ticket.php
?>