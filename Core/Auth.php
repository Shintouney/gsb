<?php

class Auth
{
    private static $_instance;

    private function __construct()
    {
        // private for singleton pattern
    }

    public static function getInstance()
    {
        if (is_null(self::$_instance))
            self::$_instance = new Auth();

        return self::$_instance;
    }

    public function login($user, $password)
    {
        return password_verify($password, $user->getMdp()) ? $this->authenticate($user) :  false;
    }

    public function authenticate($user, $id = null)
    {
        $_SESSION['auth'] = $id ? : $user->getId();
        $_SESSION['role'] = false === $user->getRole() ? 'ROLE_USER' : $user->getRole();

        return $_SESSION['logged'] = true;
    }

    public function isLogged()
    {
        return isset($_SESSION['logged']);
    }

    public function logged()
    {
        return $_SESSION['logged'];
    }

    public function logout()
    {
        unset($_SESSION['auth']);
        unset($_SESSION['role']);
    }

    public function isGranted($role = 'ROLE_USER')
    {
        return ($this->logged() && $_SESSION['role'] === $role);
    }


}