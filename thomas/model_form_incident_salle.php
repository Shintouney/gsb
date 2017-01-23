<?php 
$req = $bdd->query('SELECT * FROM salle');

while ($data_salle = $req -> fetch() )
{	
	echo '<option value =' . $data_salle['salle_id']. ' ' ;
	
	if (isset($prechargement['salle_id']) )
	{
		
		if ($data_salle['salle_id']== $prechargement['salle_id'])
		{
			echo 'selected';
		}
		
	}
	
	echo '>' . $data_salle['salle_numero'] . '</option>';
}
?>