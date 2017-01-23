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
