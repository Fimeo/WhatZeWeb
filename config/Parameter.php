<?php


namespace App\config;

/**
 * Class Parameter, utilisation objet des supergloblaes GET, POST et SESSION
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
     * @param $name string Nom du paramètre
     * @param $value mixed Valeur du paramètre
     */
    public function set($name, $value)
    {
        $this->parameter[$name] = $value;
    }
}