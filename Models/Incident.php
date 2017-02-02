<?php

require_once 'Core'.D_S.'Database.php';

class Incident 
{
	public static function all()
	{
		$db = Database::getInstance();

		$sql = 'SELECT i.`id_incident`, i.`materiel_id`, i.`objet_incident`, i.`date_signalement`, 
		i.`date_intervention`,i.`salle_id`,i.`technicien_id`, i.`demandeur_id`, i.`niveau_urgence`, 
		i.`niveau_complexite`, i.`duree`, i.`nb_appels`,
		e.`id_etat`, e.`intitule_etat` AS `etat`,
		m.`id_materiel`, m.`type` AS `type_materiel`, m.`marque`AS `marque_materiel`, m.`modele`AS `modele_materiel`,
		s.`salle_id`, s.`salle_nom`,
		t.`id_technicien`, t.`nom` AS technicien, t.`prenom`,
		u.`id`, u.`nom` AS demandeur
		FROM `incident` i
		JOIN `etat_ticket` e
		ON i.`etat` = e.`id_etat` 
		JOIN `materiel` m
		ON i.`materiel_id` = m.`id_materiel`
		JOIN `salle` s
		ON i.`salle_id` = s.`salle_id`
		JOIN `technicien` t
		ON i.`technicien_id` = t.`id_technicien`
		JOIN `utilisateur` u
		ON i.`demandeur_id` = u.`id`
		ORDER BY  `id_incident` ASC';

		return($db->query($sql, true));
	}


	static public function one($id)
	{
		$db = Database::getInstance();

		$sql ='SELECT i.`id_incident`, /*i.`etat`, i.`materiel_id`,*/ i.`objet_incident`, 
		i.`description_incident`,i.`solution_incident`, i.`date_signalement`, 
		i.`date_intervention`, /*i.`salle_id`, i.`technicien_id`,*/ i.`demandeur_id`, i.`niveau_urgence`, 
		i.`niveau_complexite`, i.`duree`, i.`nb_appels`,
		e.`id_etat`, e.`intitule_etat` AS `etat`,
		m.`id_materiel`, m.`type` AS `type_materiel`, m.`modele`AS `modele_materiel`,m.`marque`AS `marque_materiel`,
		s.`salle_id`, s.`salle_nom` AS salle,
		t.`id_technicien`, t.`nom` AS nom_tech, t.`prenom`AS pnom_tech
		FROM `incident` i
		JOIN `etat_ticket` e
		ON i.`etat` = e.`id_etat` 
		JOIN `materiel` m
		ON i.`materiel_id` = m.`id_materiel`
		JOIN `salle` s
		ON i.`salle_id` = s.`salle_id`
		JOIN `technicien` t
		ON i.`technicien_id` = t.`id_technicien`
		WHERE id_incident = :id';//requete variable///////////////////////////////////////////////////////////////////////////////////////////////////////////

		$id = array('id' => $id);

		return($db->prepare($sql, $id));
	}

     public static function salle_options()
    {
        $db = Database::getInstance();

        return $db->all('salle');
    }

    public static function materiel_options()
    {
        $db = Database::getInstance();

        return $db->all('materiel');
    }
}