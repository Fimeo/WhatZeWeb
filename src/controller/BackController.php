<?php

namespace App\src\controller;

use App\src\DAO\ArticleDAO;
use App\src\model\View;

/**
 * Class BackController gère les fonctionnalités de l'espace d'administration
 * @package App\src\controller
 */
class BackController
{
    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * Si un formulaire à été soumis, on ajoute un article avec ArticleDAO
     * Sinon aucune donnée sauvegardée.
     * @param $post array Données POST du formulaire
     */
    public function addArticle($post)
    {
        if (isset($post['submit'])) {
            $articleDAO = new ArticleDAO();
            $articleDAO->addArticle($post);
            header('Location: ../public/index.php');
        }
        $this->view->render('add_article', [
            'post' => $post
        ]);
    }
}