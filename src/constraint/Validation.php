<?php


namespace App\src\constraint;

use App\config\Parameter;

/**
 * Class Validation
 * @package App\src\constraint
 */
abstract class Validation
{

    protected $errors = [];
    protected $constraint;

    public function __construct()
    {
        $this->constraint = new Constraint();
    }

    /**
     * Vérification du champs donné, appel les contraintes de validation liées au type de la donnée
     * @param $name string Nom de la donnée
     * @param $value mixed  Valeur de la donnée
     */
    public abstract function checkField($name, $value);

    /**
     * Vérification des données contenues dans POST en fonction des contraites
     * de validation de Constraint
     * @param Parameter $post Données à vérifier
     * @return array Tableau associatif d'erreurs pour les champs non validés
     */
    public function check(Parameter $post)
    {
        foreach ($post->all() as $key => $value) {
            $this->checkField($key, $value);
        }
        return $this->errors;
    }

    /**
     * Ajoute une erreur dans le tableau associatif des erreurs si une erreur est donnée
     * @param $name string Nom du champ incorrect
     * @param $error null|string Contenu textuel de l'erreur
     */
    protected function addError($name, $error)
    {
        if ($error) {
            $this->errors += [
                $name => $error
            ];
        }
    }
}