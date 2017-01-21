<?php

require_once 'Core'.D_S.'Database.php';
require_once 'Role.php';
require_once 'Commune.php';
class Utilisateur
{
    protected $id;
    protected $login;
    protected $email;
    protected $mdp;
    protected $role;
    protected $token;
    protected $nom;
    protected $prenom;
    protected $telephone;
    protected $adresse;
    protected $commune;
    protected $dateEmbauche;

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
    public static function encrypt($mdp)
    {
        return password_hash ($mdp, PASSWORD_BCRYPT);
    }

    /**
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }


    /**
    * @return string
    */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken()
    {
        $token = hash('sha256', uniqid(mt_rand(), true), true);
        $this->token =rtrim(strtr(base64_encode($token), '+/', '-_'), '=');
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
     * @return string
     */
    public function getNomComplet()
    {
        return implode(' ', array_filter(array($this->prenom, $this->nom)));
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $commune
     */
    public function setCommune(Commune $commune)
    {
        $this->commune = $commune;
    }

    /**
     * @return Commune
     */
    public function getCommune()
    {
        return $this->commune;
    }

    /**
     * @param date $dateEmbauche
     */
    public function setDateEmbauche($dateEmbauche)
    {
        $this->dateEmbauche = $dateEmbauche;
    }

    /**
     * @return date
     */
    public function getDateEmbauche()
    {
        $date = new DateTime($this->dateEmbauche);
        return $date->format('d/m/Y');
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    // ----------------------------------------------------------------------------------------------

    // hydrate un objet a partir d'une table de hachage
    public function setData($data)
    {
        if (is_array($data)) {
            foreach ($data as $field => $value) {
                if (!preg_match( '/_id$/', $field)) {
                    $field = $this->camelize($field);
                    $this->$field = $value;
                }
            }
        }
    }

    // transforme camelCase en snake_case
    public function decamelize($string)
    {
        $string = strtolower(preg_replace('/(?<=[a-z])([A-Z])/', '_$1', $string));

        return $string;
    }

    // transforme snake_case et kebab-case en camelCase
    public function camelize($string, $upper = false)
    {
        $delimiter = strpos($string, '_')? '_' : (strpos($string, '-')? '-' : null);
        if($delimiter) {
            $string = explode('_', $string);
            $string = array_map('ucfirst', $string);
            $string[0] = $upper === false ? lcfirst($string[0]) : $string[0];
            $string = implode($string);
        }

        return $string;
    }

    /*--------------------------Active record methods-----------------------------------*/


    private function initRole($data)
    {
        $roleId = isset($data['role_id']) && $data['role_id'] ? $data['role_id'] : 1;
        $role = Role::find($roleId);
        $this->role = $role;
    }

    private function initCommune($data)
    {
        if (isset($data['commune_id']) && $data['commune_id']) {
            $communeId = $data['commune_id'] ;
            $commune = Commune::find($communeId);
            $this->setCommune($commune);
        }
    }

    // recupere ligne sql et genere/ retourne un objet a partir de l'id
    public static function find($id)
    {
        $db = Database::getInstance();
        $data = $db->find($id, 'utilisateur');
        if (!$data) {
            return null;
        }
        $model = new Utilisateur();
        $model->setData($data);
        $model->initRole($data);
        $model->initCommune($data);

    return $model;
    }

    // recupere ligne sql et genere/ retourne un objet champs de recherche a specifier
    public static function findOneBy($filter)
    {
        $db = Database::getInstance();
        $data = $db->findOneBy($filter, 'utilisateur');
        if (!$data) {
            return null;
        }
        $model = new Utilisateur();
        $model->setData($data);
        $model->initRole($data);
        $model->initCommune($data);

        return $model;
    }

    // genere tous les utilisateurs a partir de la db
    public static function all()
    {
        $db = Database::getInstance();
        $list = $db->all('utilisateur');

        foreach ($list as &$model) {
            $data = $model;
            $model = new Utilisateur();
            $model->setData($data);
            $model->initRole($data);
            $model->initCommune($data);
        }

        return $list;
    }

    // wrapper pour findBy 'login'
    public static function findOneByLogin($login)
    {
        return self::findOneBy(array('login' => $login), 'utilisateur');
    }

    // wrapper pour findBy 'email'
    public static function findOneByEmail($email)
    {
        return self::findOneBy(array('email' => $email), 'utilisateur');
    }

    public static function findOneByLoginOrEmail($username)
    {
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return static::findOneByEmail($username);
        }

        return static::findOneByLogin($username);
    }
}