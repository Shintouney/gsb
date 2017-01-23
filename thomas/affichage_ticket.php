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
			
				<?php
				//$_POST['ticket_selectionne']
				//on récupère l'id du radio=l'id de l'incident pour le mettre en session
				$_SESSION['id_ticket_selectionne'] = $_POST['ticket_selectionne'];
				
				$req = $bdd->prepare('SELECT * FROM incident WHERE id = :ticket_selectionne');
				$req -> execute(array('ticket_selectionne' =>$_SESSION['id_ticket_selectionne']));

				$ticket = $req->fetch(PDO::FETCH_ASSOC);

				foreach ($ticket as $champ=>$valeur)
				{
					echo '<tr> <td>'.$champ.'</td><td>'.$valeur.'</td> </tr>';
				}

				?>
				
			</table>
		
		
			<?php
			if ($_SESSION['role'] == 2 OR $_SESSION['role'] == 3)
			{
				$_POST['ticket_selectionne']
			?>
			
				<a href='modifier_ticket.php ' > Modifier le ticket </a><br/>
				<a href='supprimer_ticket_conf.php ' > Supprimer le ticket </a><br/>
				
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