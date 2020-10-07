<?php


namespace App\config;

/**
 * Class Parameter, utilisation objet des supergloblaes GET, POST
 * @package App\config
 */
class Parameter
{
    /**
     * @var array Associative array contenant des paramètres sous forme clé = valeur
     */
    private $parameter;

    public function __construct($parameter)
    {
        $this->parameter = $parameter;
    }

    /**
     * Retourne la valeur d'un paramètre s'il existe
     * @param $name string Nom du paramètre cherché
     * @return mixed Valeur du paramètre cherché || void
     */
    public function get($name)
    {
        if (isset($this->parameter[$name])) {
            return $this->parameter[$name];
        }
    }

    /**
     * Ajoute ou met à jour un paramètre
     * Espaces avant et après supprimés
     * @param $name string Nom du paramètre
     * @param $value mixed Valeur du paramètre
     */
    public function set($name, $value)
    {
        $this->parameter[$name] = trim($value);
    }

    /**
     * Renvoie toutes les données de la classe
     * @return array Données de la classe
     */
    public function all()
    {
        return $this->parameter;
    }

    /**
     * Applique la fonction trim sur chaque entrée de parameter
     * Permet de supprimer les espaces avant et après une chaine de caractères
     */
    public function trimAll()
    {
        foreach ($this->parameter as $name => $value) {
            $this->trim($name, $value);
        }
    }

    /**
     * Applique la fonction trim sur une entree de parameter
     * @param $name string Nom du paramètre de parameter
     * @param $value mixed Valeur à trim
     */
    public function trim($name, $value)
    {
        $this->parameter[$name] = trim($value);
    }
}