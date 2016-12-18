<?php
# -
# Classe d'accès aux données.
# Utilise les services de la classe PDO
# MobyDick Project
# ~ L'appetit viens en mangeant
class Database
{
    // object pdo
    private $_gpdo;

    # Instance de Database
    private static $_instance = null;

    private function __construct()
    {
        # Constructeur db - Pattern singleton
        try
        {
            $options =
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    PDO::ATTR_ERRMODE 			 => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];
            $params = require 'Core'.D_S.'config.php';
            $this->_gpdo = new PDO('mysql:host='.$params['host'].';dbname='.$params['db_name'], $params['user'], $params['password']);

        }
        catch (PDOException $e)
        {
            exit('Erreur : ' . $e->getMessage());
        }
    }

    # Retourne une instance de Database (existante ou nouvelle)
    public static function getInstance()
    {
        if (is_null(self::$_instance))
            self::$_instance = new Database();

        return self::$_instance;
    }

    public function query($sql, $multiple = false)
    {
        return $this->prepare($sql, false, $multiple);
    }

    public function prepare($sql, $fields = false, $multiple = false)
    {
        try
        {
            $statement = $this->_gpdo->prepare($sql);
            if ($fields)
            {
                foreach ($fields as $key => $value)
                {
                    if (is_int($value))
                        $dataType = PDO::PARAM_INT;
                    elseif (is_bool($value))
                        $dataType = PDO::PARAM_BOOL;
                    elseif (is_null($value))
                        $dataType = PDO::PARAM_NULL;
                    else
                        $dataType = PDO::PARAM_STR;

					$statement->bindValue(':'.$key, $value, $dataType);
				}
			}

			$statement->execute();

			# On traite des objets ici c'est mieux
			if($multiple)
				$result = $statement->fetchAll(PDO::FETCH_NAMED);
			else
				$result = $statement->fetch(PDO::FETCH_NAMED);

			$statement->closeCursor();
			return $result;
		}
		catch (Exception $e)
		{
			exit($e->getMessage());
		}

	}

    public function find($id, $table)
    {
        $id = array('id' => $id);
        $sql = 'SELECT * FROM '.$table.' WHERE id = :id';

        return $this->prepare($sql, $id);
    }

    public function findBy(array $fields, $table)
    {
        $sql = 'SELECT * FROM '.$table.' WHERE ';
        $where = array_keys($fields);
        $where = array_map(function ($field) {return $field.' = :'.$field;}, $where);
        $where = implode( ', ', $where);
        $sql .= $where;

        return $this->prepare($sql, $fields);
    }

    public function create($fields, $table)
    {
        $sql = 'INSERT INTO '.$table.' SET ';

        $keys = array_keys($fields);
        $keys = array_map(function ($field) {return $field.' = :'.$field;}, $keys);
        $keys = implode( ', ', $keys);
        $sql = $sql.$keys;
        $fields = array_values($fields);

        return $this->prepare($sql, $fields);
    }


    /*public function findByLogin($login)
    {
        $login = array('login' => $login);
        $sql = 'SELECT * FROM `utilisateur` WHERE login = :login';

        return $this->prepare($sql, $login);
    }*/

    public function all($table, $order = null)
    {
        $order = $order ? ' ORDER BY '.$order : '';
        $sql = 'SELECT * FROM '.$table.$order;

        return $this->query($sql, true);
    }
}
