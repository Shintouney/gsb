<?php 
session_start();
require('connexiondb.php');?>

<?php 
//confirmer suppression


$request = $bdd->prepare('DELETE FROM incident WHERE id= :id_ticket');
$request -> execute(array(
	'id_ticket'=>$_SESSION['id_ticket_selectionne']
	));

header ("Location:index.php");
?>
