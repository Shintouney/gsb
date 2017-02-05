<?php

require_once 'Core'.D_S.'Database.php';

class Model
{
    // hydrate un objet a partir d'une table de hachage
    protected function setData($data)
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
    protected function decamelize($string)
    {
        $string = strtolower(preg_replace('/(?<=[a-z])([A-Z])/', '_$1', $string));

        return $string;
    }

    // transforme snake_case et kebab-case en camelCase
    protected function camelize($string, $upper = false)
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

    // add SQL where clause
    protected static function addWhere($filters, $alias = '')
    {
        $where = array_keys($filters);
        $where = array_map(function ($filter) use ($alias) {return ($alias ? $alias.'.' : '').$filter.' = :'.$filter;}, $where);

        return ' WHERE '.implode( ' AND ', $where);
    }
} 