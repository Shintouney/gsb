<?php 
$req = $bdd->query('SELECT * FROM materiel ORDER BY type');


while ($data_matos = $req -> fetch() )
{	
	echo '<option value =' . $data_matos['id'] . '>' . 
		$data_matos['type'] . ' - '.
		$data_matos['marque'] . ' - '.
		$data_matos['modele'] . '</option>';
}
?>