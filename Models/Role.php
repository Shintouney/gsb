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
} 