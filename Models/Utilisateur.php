<?php

require_once 'Core'.D_S.'Model.php';
require_once 'Core'.D_S.'Date.php';
require_once 'Role.php';
require_once 'Commune.php';
require_once 'Secteur.php';

class Utilisateur extends Model
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
	protected $telephoneInterne;
    protected $adresse;
    protected $commune;
    protected $dateEmbauche;
	protected $image;
	protected $twitter;
	protected $secteur;

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
        /*$salt = "$2a$10$" . bin2hex( openssl_random_pseudo_bytes( 22, $strongCheck ) );
        return crypt ($mdp, $salt);*/
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
    public function setToken($token)
    {
        $this->token = $token;
    }

    public static function generateToken()
    {
        $token = hash('sha256', uniqid(mt_rand(), true), true);

        return rtrim(strtr(base64_encode($token), '+/', '-_'), '=');
    }

    public function removeToken()
    {
        $this->token = null;
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
    public function getDateEmbauche($format = 'd/m/Y')
    {
        $date = new Date($this->dateEmbauche);
        return $date->format($format);
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
	
	/**
     * @param string $telephone
     */
    public function setTelephoneInterne($telephone)
    {
        $this->telephoneInterne = $telephone;
    }

    /**
     * @return string
     */
    public function getTelephoneInterne()
    {
        return $this->telephoneInterne;
    }
	
	/**
     * @param string $twitter
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }
	
	/**
     * @param string $secteur
     */
    public function setSecteur(Secteur $secteur)
    {
        $this->secteur = $secteur;
    }

    /**
     * @return string
     */
    public function getSecteur()
    {
        return $this->secteur;
    }
	
	public function getImage()
	{
		return $this->image;
	}
	
	public function setImage($image)
	{
		$this->image = $image;
	}

    public function isAdmin()
    {
        return $this->getRole()->getNom() === 'ROLE_ADMIN';
    }

    public function isVisiteur()
    {
        return $this->is('ROLE_VISITEUR');
    }

    public function is($role)
    {
        if (is_array($role)) {
            foreach ($role as $currentRole) {
                if ($this->getRole()->getNom() === $currentRole) {
                    return true;
                }
            }
            return false;
        }

        return $this->getRole()->getNom() === $role;
    }

    /*--------------------------Active record methods-----------------------------------*/

    private function initRole($data)
    {
        $fields = array('id' => $data['role_id'], 'nom' => $data['role_nom'], 'libelle' => $data['role_libelle']);
        unset($data['role_nom']);
        unset($data['role_libelle']);
        $role = new Role();
        $role->setData($fields);
        $this->role = $role;

        return $data;
    }
	
	private function initSecteur($data)
    {
        $fields = array('id' => $data['secteur_id'],  'secteur' => $data['secteur_libelle']);
       
        unset($data['secteur_libelle']);
        $secteur = new Secteur();
        $secteur->setData($fields);
        $this->secteur = $secteur;

        return $data;
    }

    private function initCommune($data)
    {
        $fields = array('id' => $data['commune_id'], 'nom' => $data['commune_nom'], 'code_postal' => $data['code_postal']);
        unset($data['commune_nom']);
        unset($data['code_postal']);
        $commune = new Commune();
        $commune->setData($fields);
        $this->commune = $commune;

        return $data;
    }

    private static function selectUnsafeFields()
    {
        return 'u.mdp, u.token';
    }

    private static function selectSafeFields()
    {
        return 'u.id, u.login, u.email, u.role_id, u.nom, u.prenom, u.telephone, u.adresse, 
		u.commune_id, u.date_embauche, u.telephone_interne, u.image, u.twitter, u.secteur_id';
    }

    private static function selectRoleFields()
    {
        return 'r.nom AS role_nom, r.libelle AS role_libelle';
    }

    private static function selectCommuneFields()
    {
        return 'c.nom AS commune_nom, c.code_postal AS code_postal';
    }

    private static function addJoins()
    {
        return  ' JOIN role r ON u.role_id = r.id
         JOIN commune c ON u.commune_id = c.id';
    }

    private static function manageFields($unsafe = false)
    {
        $fields = $unsafe? implode(', ', array(static::selectSafeFields(), static::selectUnsafeFields())): static::selectSafeFields();
        $fields = implode(', ', array($fields, static::selectRoleFields(), static::selectCommuneFields()));

        return $fields;
    }

    // recupere ligne sql et retourne un objet a partir de l'id;
    public static function find($id, $unsafe = false)
    {
        $db = Database::getInstance();

        $id = array('id' => $id);
        $sql = 'SELECT '.static::manageFields($unsafe).' FROM utilisateur u'.static::addJoins().
		
        self::addWhere($id, 'u');
		
        $data = $db->prepare($sql, $id);

        //$data = $db->find($id, 'utilisateur');
        if (!$data) {
            return null;
        }
        $model = new Utilisateur();
        $data = $model->initRole($data);
        $data = $model->initCommune($data);
		$data = $model->initSecteur($data);
        $model->setData($data);

    return $model;
    }

    // recupere ligne sql et genere/ retourne un objet champs de recherche a specifier
    public static function findOneBy($filter, $unsafe = false)
    {
        $db = Database::getInstance();

        $sql = 'SELECT '.static::manageFields($unsafe).' FROM utilisateur u'.static::addJoins().
            self::addWhere($filter, 'u');

        $data = $db->prepare($sql, $filter);
        if (!$data) {
            return null;
        }
        $model = new Utilisateur();
        $data = $model->initRole($data);
        $data = $model->initCommune($data);
        $model->setData($data);

        return $model;
    }

    public static function findBy($filter)
    {
        $db = Database::getInstance();
        $sql = 'SELECT '.static::manageFields().' FROM utilisateur u'.static::addJoins().
            self::addWhere($filter, 'u');

        $list = $db->prepare($sql, $filter, true);

        foreach ($list as &$model) {
            $data = $model;
            $model = new Utilisateur();
            $data = $model->initRole($data);
            $data = $model->initCommune($data);
            $model->setData($data);
        }

        return $list;
    }

    // genere tous les utilisateurs a partir de la db
    public static function all()
    {
        $db = Database::getInstance();
        $sql = 'SELECT '.static::manageFields().' FROM utilisateur u'.static::addJoins();

        $list = $db->query($sql, true);

        foreach ($list as &$model) {
            $data = $model;
            $model = new Utilisateur();
            $data = $model->initRole($data);
            $data = $model->initCommune($data);
            $model->setData($data);
        }

        return $list;
    }

    public static function paginate($page = 1, $filter = array())
    {
        $db = Database::getInstance();
        $sql = 'SELECT DISTINCT '.static::manageFields().' FROM utilisateur u'.static::addJoins();
        if (empty($filter)) {
            $pagination = $db->paginate('utilisateur', $sql, $page);
        } else {
            $sql .= self::addWhere($filter, 'u');
            $pagination = $db->paginate('utilisateur', $sql, $page, $filter);
        }

        foreach ($pagination['list'] as &$model) {
            $data = $model;
            $model = new Utilisateur();
            $data = $model->initRole($data);
            $data = $model->initCommune($data);
            $model->setData($data);
        }

        return $pagination;
    }

    // wrapper pour findBy 'login'
    public static function findOneByLogin($login, $unsafe = false)
    {
        return self::findOneBy(array('login' => $login), $unsafe);
    }

    // wrapper pour findBy 'email'
    public static function findOneByEmail($email, $unsafe = false)
    {
        return self::findOneBy(array('email' => $email), $unsafe);
    }

    public static function findOneByLoginOrEmail($username)
    {
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return static::findOneByEmail($username);
        }

        return static::findOneByLogin($username);
    }

    public static function findByRole($role)
    {
        $role = Role::findOneBy(array('nom' => $role));
        $filter = array('role_id' => $role->getId());

        return static::findBy($filter);
    }
}