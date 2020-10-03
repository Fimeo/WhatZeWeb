<?php

namespace App\src\controller;

use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;

/**
 * Contrôleur qui gère ce qui est accessible à tout le monde
 */
class FrontController
{
    private $articleDAO;
    private $commentDAO;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
    }
    /**
     * Gère l'affichage de la page d'accueil du site
     * i.e. tous les billets disponibles
     */
    public function home()
    {
        $articles = $this->articleDAO->getArticles();
        require '../templates/home.php';
    }

    /**
     * Gère l'affichage d'un article et de ses commentaires
     */
    public function article($articleId)
    {
        $articles = $this->articleDAO->getArticle($articleId);
        $comments = $this->commentDAO->getCommentsFromArticle($articleId);
        require '../templates/single.php';
    }
}
