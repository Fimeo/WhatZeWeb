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
     * flagComment => signaler un commentaire d'article
     * deleteComment => suppresion d'un commentaire uniquement
     * login => Connexion utilisateur
     * register => inscription sur le site
     * default => page d'accueil du blog
     */
    public function run()
    {
        $route = $this->request->getGet()->get('route');
        $articleId = $this->request->getGet()->get('articleId');
        $post = $this->request->getPost();
        try {
            if (isset($route)) {
                if ($route === 'article') {
                    $this->frontController->article($articleId);
                } elseif ($route === 'addArticle') {
                    $this->backController->addArticle($post);
                } elseif ($route === 'editArticle') {
                    $this->backController->editArticle($post, $articleId);
                } elseif ($route === 'deleteArticle') {
                    $this->backController->deleteArticle($articleId);
                } elseif ($route === 'addComment') {
                    $this->frontController->addComment($post, $articleId);
                } elseif ($route === 'flagComment') {
                    $this->frontController->flagComment($this->request->getGet()->get('commentId'));
                } elseif ($route === 'deleteComment') {
                    $this->backController->deleteComment($this->request->getGet()->get('commentId'));
                } elseif ($route === 'register') {
                    $this->frontController->register($post);
                } elseif ($route === 'login') {
                    $this->backController->deleteComment($this->request->getGet()->get('commentId'));
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
