<?php


namespace App\src\constraint;

use App\config\Parameter;

class ArticleValidation extends Validation
{
    private $errors = [];
    private $constraint;

    public function __construct()
    {
        $this->constraint = new Constraint();
    }

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
     * Vérification du champs donné, appel les contraintes de validation liées au type de la donnée
     * @param $name string Nom de la donnée
     * @param $value mixed  Valeur de la donnée
     */
    public function checkField($name, $value)
    {
        if ($name === 'title') {
            //Appel à la validation des titres
            $error = $this->checkTitle($name, $value);
            //Ajoute une erreur si rencontrée
            $this->addError($name, $error);
        } else if ($name === 'content') {
            $error = $this->checkContent($name, $value);
            $this->addError($name, $error);
        } else if ($name === 'author') {
            $error = $this->checkAuthor($name, $value);
            $this->addError($name, $error);
        }
    }

    /**
     * Validation d'un titre suivant : non nul, longueur mini de 2, longueur maxi de 100
     * @param $name string Nom de la propriété
     * @param $value mixed Valeur de la propriété
     * @return string Contenu textuel si erreur
     */
    private function checkTitle($name, $value)
    {
        //Si constraint renvoie qqchose, c'est le message d'erreur
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank($name, $value);
        }
        if ($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength($name, $value, 2);
        }
        if ($this->constraint->maxLength($name, $value, 100)) {
            return $this->constraint->maxLength($name, $value, 100);
        }
    }

    /**
     * Validation d'un contenu suivant : non nul, longueur mini de 2, longueur maxi 4000
     * @param $name string Nom de la propriété
     * @param $value mixed Valeur de la propriété
     * @return string Contenu textuel si erreur
     */
    private function checkContent($name, $value)
    {
        //Si constraint renvoie qqchose, c'est le message d'erreur
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank($name, $value);
        }
        if ($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength($name, $value, 2);
        }
        if ($this->constraint->maxLength($name, $value, 4000)) {
            return $this->constraint->minLength($name, $value, 4000);
        }
    }

    /**
     * Validation d'un autheur suivant : non nul, longueur mini de 2, longueur maxi de 255
     * @param $name string Nom de la propriété
     * @param $value mixed Valeur de la propriété
     * @return string Contenu textuel si erreur
     */
    private function checkAuthor($name, $value)
    {
        //Si constraint renvoie qqchose, c'est le message d'erreur
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank($name, $value);
        }
        if ($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength($name, $value, 2);
        }
        if ($this->constraint->maxLength($name, $value, 255)) {
            return $this->constraint->maxLength($name, $value, 255);
        }
    }

    /**
     * Ajoute une erreur dans le tableau associatif des erreurs si une erreur est donnée
     * @param $name string Nom du champ incorrect
     * @param $error null|string Contenu textuel de l'erreur
     */
    private function addError($name, $error)
    {
        if ($error) {
            $this->errors += [
                $name => $error
            ];
        }
    }
}