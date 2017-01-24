<?php
session_start();
include ('connexiondb.php');
?>

<html>
<head>
    <meta charset="utf-8"/>
	<link rel='stylesheet' href='thomas.css'/>
    <title>Afffichage d'un ticket</title>
</head>

<body>
	<?php
	if (isset($_POST['ticket_selectionne']))
	{
		?>
		
		<div class='affichage_ticket'>
			
			<table> 
<?php // ================= ok je me répéte mais n'oublie que les requetes sont dans des méthodes du model ticket ============== ?>
				<?php
				//$_POST['ticket_selectionne']
				//on récupère l'id du radio=l'id de l'incident pour le mettre en session
//==================== avec ma méthode (lien) l'id sera dans l'url ===============================================
				$_SESSION['id_ticket_selectionne'] = $_POST['ticket_selectionne'];
				
				$req = $bdd->prepare('SELECT * FROM incident WHERE id = :ticket_selectionne');
				$req -> execute(array('ticket_selectionne' =>$_SESSION['id_ticket_selectionne']));

				$ticket = $req->fetch(PDO::FETCH_ASSOC);

				foreach ($ticket as $champ=>$valeur)
				{
					echo '<tr> <td>'.$champ.'</td><td>'.$valeur.'</td> </tr>';
				}

				?>
<?php //============== dans la méthode en question tu mets une requete sql dans une variable ($sql) et à la fin tu renvois $this->prepare($sql, array('id'=> $id) ?>
			</table>
		
		
			<?php
// ========= remarque avant j'utilisais l'id des roles mais comme les sessions sont faciles à pirater j'utilise les noms des roles de type 'ROLE_VISITEUR'
			if ($_SESSION['role'] == 2 OR $_SESSION['role'] == 3)
			{
				$_POST['ticket_selectionne']
			?>
			
				<a href='modifier_ticket.php ' > Modifier le ticket </a><br/>
				<a href='supprimer_ticket_conf.php ' > Supprimer le ticket </a><br/>
<?php // si tu sais faire un peu de javascript il y a une méthode confirm() qui est pas mal :) =======la tu te compliques la vie ============
 // un lien pour supprimer. grosse faille de sécurité en perspective... les sessions sont faciles à pirater, coucou je viens supprimer vos tickets les amis
// non la en fait il vaut mieux mettre un mini formulaire avec comme action supprimer ticket et la méthode post pour le coup c'est plus safe
// l'action delete est dans le controlleur of course n'hésite pas à regarder ce que j'ai fait pour les utilisateurs c'est plus rapide
// moi je fais comme ça systématiquement.  mais c'est toujours mieux que si tu avais une url pour supprimer les tickets  :)
// ============ j'aimerais te dire rendez vous dans modifier ticket mais c'est bientot une heure du mat je continuerais plus tard =========
// tu as déja a faire point de vue lecture ;) ==============================
                ?>
				
			<?php
			}
			?>
			
		</div>
	<?php
	}	
	
	else
	{echo 'veuillez sélectionner un ticket';}
	?>
	
		<a href='index.php'>Revenir à l'accueil</a>
</body>
</html>