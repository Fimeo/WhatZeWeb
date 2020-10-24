<?php


namespace App\config;

/**
 * Class Session, gestion de la session utilisateur
 * @package App\config
 */
class Session
{
    private $session;

    public function __construct($session)
    {
        $this->session = $session;
    }

    /**
     * Création ou mise à jour d'une valeur de session
     * @param $name string Nom de la propriété
     * @param $value mixed Valeur de la propriété
     */
    public function set(string $name, $value)
    {
        $_SESSION[$name] = $value;
    }

    /**
     * Retourne la valeur associée à la clé et la supprime de la session
     * @param $name string Nom de la propriété
     * @return mixed Valeur de la propriété
     */
    public function show(string $name)
    {
        if (isset($_SESSION[$name])) {
            $key = $this->get($name);
            $this->remove($name);
            return $key;
        }
    }

    /**
     * Retourne la valeur associée à la clé
     * @param $name string Nom de la propriété
     * @return mixed Valeur de la propriété
     */
    public function get(string $name)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
    }

    /**
     * Retourne les données de l'utilisateur de la session
     * @param $name
     * @return mixed
     */
    public function getUserInfo($name)
    {
        if (isset($_SESSION['user'])) {
            if (isset($_SESSION['user'][$name])) {
                return $_SESSION['user'][$name];
            }
        }
    }

    /**
     * Suppression de la propriété dans les données de SESSION
     * @param $name string Nom de la propriété
     */
    public function remove(string $name)
    {
        if (isset($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
    }

    public function destroy()
    {
        session_destroy();
    }

    public function start()
    {
        session_start();
    }
}