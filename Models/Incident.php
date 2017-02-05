<?php

require_once 'Core'.D_S.'Database.php';

class Incident 
{
	public static function all()
	{
		$db = Database::getInstance();

		$select='SELECT 
			i.`id`, i.`objet_incident`, i.`date_signalement`, i.`date_intervention`, i.`niveau_urgence`, i.`niveau_complexite`,
			e.`intitule_etat`,
			m.`type` AS `type_materiel`, m.`marque`AS `marque_materiel`, m.`modele`AS `modele_materiel`,
			s.`salle_nom`,
			t.`id` AS id_tech, t.`prenom`AS pnom_tech, UPPER (t.`nom`) AS nom_tech, 
			d.`id` AS id_demand, d.`prenom` AS pnom_demand, UPPER (d.`nom`) AS nom_demand
			FROM `incident` i
			JOIN `etat_ticket` e
			ON i.`etat` = e.`id_etat` 
			JOIN `materiel` m
			ON i.`materiel_id` = m.`id_materiel`
			JOIN `salle` s
			ON i.`salle_id` = s.`salle_id`
			JOIN `utilisateur` t
			ON i.`technicien_id` = t.`id`
			JOIN `utilisateur` d
			ON i.`demandeur_id`= d.`id`
			';
			$sql = $select;//construction de la requete
			return($db->query($sql, true));
			/*
		if ($condition!='')
		{
			$sql = $select.$condition; //construction de la requete
			
			$id = array('id' => $id);
			return($db->prepare($sql, $id));
		}

		else
		{
			$sql = $select;//construction de la requete
			return($db->query($sql, true));
		}
		*/
	}


	static public function one($id)
	{
		$db = Database::getInstance();

		$sql ='SELECT 
		i.`id`, i.`objet_incident`, i.`etat`, i.`description_incident`,i.`solution_incident`, i.`date_signalement`, 
		i.`date_intervention`, i.`niveau_urgence`, i.`niveau_complexite`, i.`duree`, i.`nb_appels`,
		e.`intitule_etat`,
		m.`id_materiel`, m.`type` AS `type_materiel`, m.`modele`AS `modele_materiel`,m.`marque`AS `marque_materiel`,
		s.`salle_id`, s.`salle_nom`,
		t.`id` AS id_tech, t.`prenom`AS pnom_tech, UPPER (t.`nom`) AS nom_tech, 
		d.`id` AS id_demand, d.`prenom` AS pnom_demand, UPPER (d.`nom`) AS nom_demand
		FROM `incident` i
		JOIN `etat_ticket` e
		ON i.`etat` = e.`id_etat` 
		JOIN `materiel` m
		ON i.`materiel_id` = m.`id_materiel`
		JOIN `salle` s
		ON i.`salle_id` = s.`salle_id`
		JOIN `utilisateur` t
		ON i.`technicien_id` = t.`id`
		JOIN `utilisateur` d
		ON i.`demandeur_id`= d.`id`
		WHERE i.`id` = :id';

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