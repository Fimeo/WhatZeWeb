<?php

namespace App\src\controller;

/**
 * Contrôleur qui gère les erreurs de manière centralisée
 */
class ErrorController
{
    /** Gestion des vues lors d'une page non trouvée 404 */
    public function errorNotFound()
    {
        require '../templates/error_404.php';
    }

    /** Gestion des vues lors d'une erreur serveur */
    public function errorServer()
    {
        require '../templates/error_500.php';
    }
}