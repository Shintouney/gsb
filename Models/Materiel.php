<?php

require_once 'Core'.D_S.'Database.php';

class Materiel 
{
	public static function all($id)
	{
		$db = Database::getInstance();

		$select= 'SELECT * FROM `materiel` ';
	}


	static public function one($id)
	{
		$db = Database::getInstance();

		$sql= 'SELECT * FROM `materiel` ';

		$id = array('id' => $id);
		return($db->prepare($sql, $id));
	}

     public static function select_salle()
    {
        $db = Database::getInstance();
        return $db->all('salle');
    }

    public static function select_materiel()
    {
        $db = Database::getInstance();
        return $db->all('materiel');
    }

    public static function select_etat()
    {
    	$db = Database::getInstance();
    	return $db->all('etat_ticket') ;
    }
    
    public static function select_utilisateur()
    {
    	$db = Database::getInstance();
    	return $db->all('utilisateur') ;
    }
    
}