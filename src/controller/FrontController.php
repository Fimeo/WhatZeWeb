<?php

namespace App\src\controller;

use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\model\View;

/**
 * Class FrontController
 * Contrôleur qui gère ce qui est accessible à tout le monde
 * @package App\src\controller
 */
class FrontController
{
    private $articleDAO;
    private $commentDAO;
    private $view;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->view = new View();
    }

    /**
     * Gère l'affichage de la page d'accueil du site
     * i.e. tous les billets disponibles
     */
    public function home()
    {
        $articles = $this->articleDAO->getArticles();
        $this->view->render('home', [
            'articles' => $articles
        ]);
    }

    /**
     * Gère l'affichage d'un article et de ses commentaires
     * @param $articleId mixed Identifiant de l'article ciblé
     */
    public function article($articleId)
    {
        $article = $this->articleDAO->getArticle($articleId);
        $comments = $this->commentDAO->getCommentsFromArticle($articleId);
        $this->view->render('single', [
            'article' => $article,
            'comments' => $comments
        ]);
    }
}
