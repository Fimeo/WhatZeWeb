<?php

namespace App\config;

use App\src\controller\FrontController;
use App\src\controller\ErrorController;
use Exception;

/**
 * Classe Router
 * Gère les routes pour accéder aux vues
 */
class Router
{
    private FrontController $frontController;
    private ErrorController $errorController;

    public function __construct()
    {
        $this->frontController = new FrontController();
        $this->errorController = new ErrorController();
    }

    /**
     * Gestion des routes, redirection vers le module demandé
     * Routes disponibles :
     * article => single.php
     * default => home.php
     */
    public function run()
    {
        try {
            if (isset($_GET['route'])) {
                if ($_GET['route'] === 'article') {
                    $this->frontController->article($_GET['articleId']);
                } else {
                    $this->errorController->errorNotFound();
                }
            } else {
                $this->frontController->home();
            }
        } catch (Exception $e) {
            $this->errorController->errorServer();
        }
    }
}
