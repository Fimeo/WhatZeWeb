<?php

namespace App\src\controller;

use App\src\model\View;

/**
 * Contrôleur qui gère les erreurs de manière centralisée
 */
class ErrorController
{

    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    /** Gestion des vues lors d'une page non trouvée 404 */
    public function errorNotFound()
    {
        $this->view->render('error_404');
    }

    /** Gestion des vues lors d'une erreur serveur */
    public function errorServer()
    {
        $this->view->render('error_500');
    }
}