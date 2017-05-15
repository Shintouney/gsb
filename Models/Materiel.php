<?php

require_once 'Core'.D_S.'Database.php';

class Materiel 
{
	public static function all()
	{
		$db = Database::getInstance();

		$select= 'SELECT * FROM `materiel` ORDER BY num_inventaire';

		return($db->query($select, true));
	}

	public static function one($id)
	{
		$db = Database::getInstance();

		$sql= 'SELECT * FROM `materiel` WHERE id = :id ORDER BY num_inventaire';

		$id = array('id' => $id);
		return($db->prepare($sql, $id));
	}
}