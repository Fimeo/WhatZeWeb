<?php

namespace App\src\controller;

/**
 * Class BackController gère les fonctionnalités de l'espace d'administration
 * @package App\src\controller
 */
class BackController extends Controller
{
    /**
     * Si un formulaire à été soumis, on ajoute un article avec ArticleDAO
     * Sinon aucune donnée sauvegardée.
     * @param $post array Données POST du formulaire
     */
    public function addArticle($post)
    {
        if (isset($post['submit'])) {
            $this->articleDAO->addArticle($post);
            header('Location: ../public/index.php');
        }
        $this->view->render('add_article', [
            'post' => $post
        ]);
    }
}