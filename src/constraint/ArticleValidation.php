<?php


namespace App\src\constraint;

use App\config\Parameter;

class ArticleValidation extends Validation
{
    public function checkField($name, $value)
    {
        if ($name === 'title') {
            //Appel à la validation des titres
            $error = $this->checkTitle($name, $value);
            //Ajoute une erreur si rencontrée
            $this->addError($name, $error);
        } elseif ($name === 'content') {
            $error = $this->checkContent($name, $value);
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
}