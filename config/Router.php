<?php

namespace App\config;

use App\src\controller\FrontController;
use App\src\controller\BackController;
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
    private BackController  $backController;
    private Request $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->frontController = new FrontController();
        $this->errorController = new ErrorController();
        $this->backController = new BackController();
    }

    /**
     * Gestion des routes, redirection vers le module demandé
     * Routes disponibles :
     * article => vue sur un article en particulier
     * addArticle => création d'un nouvel article
     * editArticle => mise à jour d'un article
     * deleteArticle => suppression d'un article
     * default => page d'accueil du blog
     */
    public function run()
    {
        $route = $this->request->getGet()->get('route');
        $articleId = $this->request->getGet()->get('articleId');
        try {
            if (isset($route)) {
                if ($route === 'article') {
                    $this->frontController->article($articleId);
                } else if ($route === 'addArticle') {
                    $this->backController->addArticle($this->request->getPost());
                } else if ($route === 'editArticle') {
                    $this->backController->editArticle($this->request->getPost(), $articleId);
                } else if ($route === 'deleteArticle') {
                    $this->backController->deleteArticle($articleId);
                } else {
                    $this->errorController->errorNotFound();
                }
            } else {
                $this->frontController->home();
            }
        } catch (Exception $e) {
            $this->errorController->errorServer();
            echo $e->getMessage();
        }
    }
}
