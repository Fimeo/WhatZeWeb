<?php


namespace App\src\constraint;

/**
 * Class Constraint, contient les contraintes de l'application pour la validation des données
 * @package App\src\constraint
 */
class Constraint
{
    /**
     * Contraintes à implémenter : email, tel, range
     */
    
    /**
     * Contrainte de validation valeur non nulle
     * @param $name Nom de la propriété
     * @param $value Valeur testée
     * @return string Erreur textuelle
     */
    public function notBlank($name, $value)
    {
        if (empty($value) || trim($value) === '') {
            return "<p>Le champ $name saisi ne doit pas être vide</p>";
        }
    }

    /**
     * Contrainte de validation, longueur de la chaine de données
     * @param $name Nom de la propriété
     * @param $value Valeur testée
     * @param $minSize Longueur minimale de la chaine de caractères
     * @return string Erreur textuelle
     */
    public function minLength($name, $value, $minSize)
    {
        if (strlen($value) < $minSize) {
            return "<p>Le champ $name doit contenir au moins $minSize caractères.</p>";
        }
    }

    /**
     * Contrainte de validation, longueur de la chaine de données
     * @param $name Nom de la propriété
     * @param $value Valeur testée
     * @param $maxSize Longueur maximale de la chaine de caractères
     * @return string Erreur textuelle
     */
    public function maxLength($name, $value, $maxSize)
    {
        if (strlen($value) > $maxSize) {
            return "<p>Le champs $name ne peut contenir plus de $maxSize caractères.</p>";
        }
    }

    public function onlyLetters($name, $value) {
        var_dump(preg_match('/^[A-Za-z]+$/', $value));
    }

    public function onlyLettersAndNumbers($name, $value) {
        var_dump(preg_match('/^[A-Za-z0-9]+$/', $value));
    }

    public function withoutSpecialChars($name, $value) {
        var_dump(preg_match('/^[A-Za-z0-9_-]+$/', $value));
    }
}