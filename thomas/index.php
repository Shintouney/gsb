<?php
session_start();

if (!isset($_SESSION['role']))//en cas de 1ère arrivée sur la page
	{$_SESSION['role']=1;}
	
$_SESSION['id_incident']='126';
//print_r ($_SESSION);
?>


<html>
<head>
    <meta charset="utf-8"/>
	<link rel='stylesheet' href='thomas.css'/>
    <title>Gestionnaire de tickets</title>
</head>

<body>
	<h1>Page d'accueil Gestionnaire de tickets </h1>

	<?php 
	require_once('connexiondb.php');
	
	//changement de role en changeant la valeur dans $_SESSION['role']
	include('role.php'); 
	
	//création de tickets pour les visiteurs ou admins
	if (($_SESSION['role'] == 1) OR ($_SESSION['role'] == 3))
	{
		echo "<p><a href='formulaire_nouveau_ticket.php'> Nouveau ticket d'incident </a></p>";
	}
	
	//pour les responsables : attribuer un ticket à un technicien
	/*if ($_SESSION['role'] == 3)
	{
		echo "<p><a href='attribuer_ticket.php'> Attribuer un ticket à un technicien </a></p>";
	}*/

	include('affichage_liste_tickets.php'); ?>
	
</body>
</html>
<?php
//==================================================================/
/*  1) le html doit se trouver dans les views
*   2) la structure de la page <html> est actuellement dans Template/default.php
*      - dans ma nouvelle version (pas encore mergée) ce sera base.php
*      - dans ce fichier il y a des includes pour toutes les parties des pages qui ne
*        varient jamais :  partie <head>, barre de navigation, footer etc.
    *   3) le  <title> sera modifié par une variable ( pour l'instant pas en place)
        *
        *   4) L'important pour toi c'est de séparer la partie de la page qui varie de la partie commune aux autres pages ( voir plus haut)
        *
        *   5) Le changemenet de role dans une page gestionnaire de ticket c'est pas une bonne idée je vais rajouter tes roles dans ma db
        -  j'ai converti tous les utilisateurs fournis avec gsb on poourra leur donner le role qu'on veut
        -  demain je mergerai mes trucs et je t'enverrai les fichiers sql tu pourras de créer des techniciens

        ==========   fini le blabla les choses sérieuses commencent ici ==================================

        *   6) sur ta page de base, cette page, tu veux afficher une liste de tickets et un lien ( ou bouton "créer un nouveau ticket d'incident )
        *
        *  7) tu vas créer un fichier TicketController.php ( ou n'importe quel nom de type IncidentController.php, ton choix) dans le répertoire Controller
        *  -  dans le fichier  une classe TicketController si c'est le nom que tu choisis
        *  - l'url pour aller sur ta page dépendra du nom de ton controller.  exemple :  index.php?page=ticket&action=index si tu prends TicketController
        *  - si tu veux utiliser les méthodes qu'on a créé dans la classe Controller tu peux faire hériter ta classe de Controller, donc ajouter extends Controller
        *  - dans ce cas ajouter en haut de page include 'Core'.D_S.Controller.php, tu peux t'inspirer de mes controllers existants pour les tiens
        *  - tu devras inclure toutes les classes que tu veux utiliser dans ton controller
        * -
        *  8) Dans ton controller tu fera des méthodes ( fonctions) publiques pour les "actions" du controlleur ( dans l'url)
        * - Les méthodes privées pour les méthodes utilisées à l'intérieur des actions. (tu peux tout laisser public au début)
        *
        * 9)  exemples d'action :
        * - index pour afficher une liste (de tickets, d'incidents, d'utilisateurs),
        * - create/new/add pour créer un nouveau
        * - update/edit pour modifier
        * - delete/remove pour supprimer
        * -  show/view/display pour afficher les détails d'une ligne de base de données
        * - les noms donnés en exemple sont des conventions mais tu peux donner n'importe quel nom mais le plus court et le mieux (leurs noms seront dans l'url)
        * - dans ma nouvelle version nom mergée index est l'action par défaut et on n'aura ps besoin de le mettre : donc l'url sera index.php?page=ticket pour index
        * - je t'expliquerai plus en détail comment faire des méthodes dans le fichier correspondant que tu as inclus
        *
        * 10) Sur cette page :
        * - tu affiches un h1, un lien pour créer un nouveau ticket une liste de tickets et, pour les responsables, un lien pour attribuer un ticket à un tech
        * - C'est donc une page "index". Pour la générer une méthode index dans le controller qui générera les données et affichera la vue en y apportant les données
        * - je te retrouve sur la page affichage_liste_tickets.php et formulaire_nouveau_ticket.php pour plus des détails
        *
        * 11) Database (tres important!!!!!!) ( Il y aura bcq de !!!!!!!!!!!!!!!!!!!!! )
        * - il faudra inclure Database.php dans ton/tes controlleur(s) !!!!!! tres important !!! (Core/Database.php)
        * - tu n'auras plus besoin de connexionDb.php de ta vie!!!!!!
        * - Tu peux également le mettre dans tes modeles si tu veux inclure ds méthodes d'acces aux bases de données
        * - Moi je le fais, pourquoi? les méthodes dans Database sont génériques et peuvent s'utiliser avec n'importe quelle table / classe
        * - par exemple $this->find($id, $table) marche avec tout mais renvoie juste un tableau associatif de données
        * -  un find dans un modèle fera plus :
        * - Utilisateur::find($id) appelle la méthode find de database, instancie un nouvel Utilisateur (new) et initialise ces propriétés avec les données de la base
        * - le find de Database renvoie un tableau de données le find du model renvoie un objet/model avec toutes les variables( son nom, son prénom etc)
        * - les méthodes :
        * - find (renvoie une table/un objet en fonction de l'id en parametre
        * - all (renvoie toutes les lignes de la table sous forme de tableau
        * - findBy (renvoie plusieurs lignes de la table/ plusieurs objets en fonction de un ou plusieurs critères ( ville = saint etienne, role = administrateur)
        * - findOneBy( renvoie un objet unique en fonction d'un critère unique comme l'email ou le login)
        * - ces deux méthodes utilisent un tableau associatif en parametre pour les filtres ( array('nom' => Avinint, 'commune' => 'ST Ferreol')

        * 11) Mon avis sur la fonctionnalité "attribuer un ticket à un technicien"
        * - plutot qu'un seul lien "attribuer" un lien/bouton pour chaque élément de la liste
        * - ce lien mène vers un lien pour modifier le ticket, dans le formulaire une liste déroulante avec les techniciens
        * - cela veut dire une requete pour afficher les utilisateurs qui ont le role technicien  ( where ou findBy si tu utilises mes méthodes)
        * - question: le technicien de base peut il consulter tous les tickets? il serait peut être mieux qu'ils ne voient que les tickets qui leur sont attribués?
        * - suggestion : plutot qu'une page qui affiche des choses différentes en fonction du role une page pour le responsable et une page pour le tech
        * - évidemment j'ai pas lu ton dossier mes suggestions sont peut être fausses
        *
        *
        */
        //==================================================================/?>