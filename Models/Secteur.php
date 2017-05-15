<?php

require_once 'Core'.D_S.'Model.php';

class Secteur extends Model
{
    private $id;
    private $libelle;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    public function __toString()
    {
        return $this->nom;
    }

    public function setData($data)
    {
        if (is_array($data)) {
            foreach ($data as $field => $value) {
                if (!preg_match( '/_id$/', $field)) {
                    $this->$field = $value;
                }
            }
        }
    }

    public static function find($id)
    {
        $db = Database::getInstance();
        $data = $db->find($id, 'secteur');
        if (!$data) {
            return null;
        }
        $model = new self();

        $model->setData($data);

        return $model;
    }

    public static function findOneBy($filter)
    {
        $db = Database::getInstance();
        $data = $db->findOneBy($filter, 'secteur');
        if (!$data) {
            return null;
        }
        $model = new self();
        $model->setData($data);

        return $model;
    }

    public static function all()
    {
        $db = Database::getInstance();
        $data = $db->all('secteur', 'libelle');
        foreach($data as &$model) {
            $line = $model;
            $model = new self();
            $model->setData($line);
        }

        return $data;
    }
} 