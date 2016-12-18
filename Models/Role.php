<?php

class Role
{
    protected $id;
    protected $nom;
    protected $libelle;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $nom
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
        if (!is_array($data)) {
            die("données invalides");
        }

        foreach ($data as $field => $value) {
            if (!preg_match( '/_id$/', $field)) {
                $this->$field = $value;
            }
        }
    }

    public static function find($id)
    {
        $db = Database::getInstance();
        $model = new self();
        $data = $db->find($id, 'role');
        $model->setData($data);

        return $model;
    }

    public static function findBy($filter)
    {
        $db = Database::getInstance();
        $data = $db->findBy($filter, 'role');
        $model = new Role();
        $model->setData($data);

        return $model;
    }

    public static function all()
    {
        $db = Database::getInstance();
        $data = $db->all('role', 'libelle');
        foreach($data as &$model) {
            $line = $model;
            $model = new self();
            $model->setData($line);
        }

        return $data;
    }
} 