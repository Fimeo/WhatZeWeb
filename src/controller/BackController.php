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
            //Création d'un message à afficher dans la session
            $this->session->set('add_article', 'Le nouvel article à bien été ajouté');
            header('Location: ../public/index.php');
        }
        $this->view->render('add_article', [
            'post' => $post
        ]);
    }

    /**
     * Modification d'un article dans la base de données
     * Si des données post sont transmises, on met à jour,
     * sinon on affiche la page de modification de l'article
     * @param Parameter $post Données mises à jour
     * @param $articleId Identifiant de l'article à modifier
     */
    public function editArticle(Parameter $post, $articleId)
    {
        $article = $this->articleDAO->getArticle($articleId);

        if ($post->get('submit')) {
            $this->articleDAO->editArticle($post, $articleId);
            $this->session->set('edit_article', 'L\'article à bien été mis à jour');
            header('Location: ../public/index.php');
        }
        //Si le formulaire n'a pas été soumis, on affiche l'article à modifier
        $this->view->render('edit_article', [
            'article' => $article
        ]);
    }
}