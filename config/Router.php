<?php

namespace App\config;

use Exception;

/**
 * Classe Router
 * Gère les routes pour accéder aux vues
 */
class Router
{
    /**
     * Inclusion de la vue demandée
     * Routes disponibles :
     * article => single.php
     * default => home.php
     */
    public function run()
    {
        try {
            if (isset($_GET['route'])) {
                if ($_GET['route'] === 'article') {
                    require '../templates/single.php';
                } else {
                    echo "Page inconnue";
                }
            } else {
                require '../templates/home.php';
            }
        } catch (Exception $e) {
            echo 'Erreur';
        }
    }
}
