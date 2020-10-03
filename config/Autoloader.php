<?php

namespace App\config;

/**
 * Création d'un autoloader maison pour éviter de multiplier les
 * appels de require (au risque d'en oublier).
 */
class Autoloader
{
    /**
     * Enregistrement des classes nécessaires dans la pile
     */
    public static function register()
    {
        /**
         * La fonction spl_autoload_register() enregistre un nombre quelconque de chargeurs automatiques,
         * ce qui permet aux classes et aux interfaces d'être automatiquement chargées si elles
         * ne sont pas définies actuellement.
         */
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    /**
     * Méthode de rappel de spl_autoload_register
     * Le namespace de la classe est donné en paramètre
     * Le filtrage supprime App et remplace les \ par /
     * Inclusion du fichier de la classe concernée
     */
    public static function autoload($class)
    {
        $class = str_replace('App', '', $class);
        $class = str_replace('\\', '/', $class);
        require '../' . $class . '.php';
    }
}
