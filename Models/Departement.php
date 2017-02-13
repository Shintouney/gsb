<?php

require_once 'Core'.D_S.'Model.php';
require_once 'Region.php';

class Departement extends Model
{
    protected $id;
    protected $nom;
    protected $regionCode;

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $regionCode
     */
    public function setRegionCode($regionCode)
    {
        $this->regionCode = $regionCode;
    }

    /**
     * @return string
     */
    public function getRegionCode()
    {
        return $this->regionCode;
    }

    //==================Active record methods===========================//

    public function getRegion()
    {
        return Region::findOneByCode($this->regionCode);
    }

    public static function findOneByCodePostal($code)
    {
        $db = Database::getInstance();
        $data = $db->find(substr($code, 0, 2), 'departement');
        if (!$data) {
            return null;
        }
        $model = new Departement();
        $model->setData($data);

        return $model;
    }
} 