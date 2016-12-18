<?php

require_once 'Core'.D_S.'Database.php';
require_once 'Role.php';

class Utilisateur
{
    protected $id;
    protected $login;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $mdp;
    protected $role;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }


    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $mdp
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    /**
     * @param string $mdp
     */
    public function encrypt($mdp)
    {
        $mdp       = password_hash ($mdp, PASSWORD_BCRYPT);
        $this->mdp = $mdp;
    }

    /**
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }

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
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param Role $role
     */
    public function setRole(Role $role)
    {
        $this->role = $role;
    }

    /**
     * @return Role
     */
    public function getRole()
    {
        return $this->role;
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
        $data = $db->find($id, 'utilisateur');

        $model = new Utilisateur();
        $model->setData($data);
        $role = Role::find($data['role_id']);
        $model->setRole($role);

        return $model;
    }

    public static function findBy($filter)
    {
        $db = Database::getInstance();
        $data = $db->findBy($filter, 'utilisateur');

        $model = new Utilisateur();
        $model->setData($data);
        $role = Role::find($data['role_id']);
        $model->setRole($role);

        return $model;
    }

    public static function findByLogin($login)
    {
        $model = self::findBy(array('login' => $login), 'utilisateur');

        return $model;
    }
}