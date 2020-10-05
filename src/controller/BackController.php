<?php

namespace App\src\controller;

use App\config\Parameter;

/**
 * Class BackController gère les fonctionnalités de l'espace d'administration
 * @package App\src\controller
 */
class BackController extends Controller
{
    /**
     * Si un formulaire à été soumis, on ajoute un article avec ArticleDAO
     * Sinon aucune donnée sauvegardée.
     * @param $post Parameter Données POST du formulaire
     */
    public function addArticle(Parameter $post)
    {
        //Si le formulaire d'ajout à été soumis
        if ($post->get('submit')) {
            $this->articleDAO->addArticle($post);
            header('Location: ../public/index.php');
        }
        $this->view->render('add_article', [
            'post' => $post
        ]);
    }
}