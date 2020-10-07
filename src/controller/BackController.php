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
        $post->trimAll();
        //Si le formulaire d'ajout à été soumis
        if ($post->get('submit')) {
            //Validation des données avant soumission à la BD
            $errors = $this->validation->validate($post, 'Article');
            if (!$errors) {
                $this->articleDAO->addArticle($post);
                //Création d'un message à afficher dans la session
                $this->session->set('add_article', 'Le nouvel article à bien été ajouté');
                //TODO: Redirection vers l'article crée : nécessite de récupérer son id après création
                header('Location: ../public/index.php');
            } else {
                //Si il y a des erreurs, tjrs en modification avec données et errors en plus
                $this->view->render('add_article', [
                    'post' => $post,
                    'errors' => $errors
                ]);
            }
        } else {
            //Si aucune données POST, création d'un article
            $this->view->render('add_article');
        }
    }

    /**
     * Modification d'un article dans la base de données
     * Si des données post sont transmises, on met à jour,
     * sinon on affiche la page de modification de l'article
     * @param Parameter $post Données mises à jour
     * @param $articleId mixed Identifiant de l'article à modifier
     */
    public function editArticle(Parameter $post, $articleId)
    {
        $post->trimAll();
        $article = $this->articleDAO->getArticle($articleId);

        if ($post->get('submit')) {
            $errors = $this->validation->validate($post, 'Article');
            if (!$errors) {
                $this->session->set('edit_article', 'L\'article à bien été mis à jour');
                $this->articleDAO->editArticle($post, $articleId);
                header('Location: ../public/index.php?route=article&articleId=' . $articleId);
            } else {
                //Si il y a des erreurs, affichage avec les données soumises et erreurs
                $this->view->render('edit_article', [
                    'post' => $post,
                    'errors' => $errors
                ]);
            }
        } else {
            //Edition d'un article, données brutes de la base
            $post->set('id', $article->getId());
            $post->set('title', $article->getTitle());
            $post->set('content', $article->getContent());
            $post->set('author', $article->getAuthor());
            //Si le formulaire n'a pas été soumis, on affiche l'article à modifier
            $this->view->render('edit_article', [
                'post' => $post
            ]);
        }
    }

    /**
     * Suppresion d'un article dans la base de données suivant son identifiant
     * @param $articleId Identifiant de l'article à supprimer
     */
    public function deleteArticle($articleId)
    {
        $this->articleDAO->deleteArticle($articleId);
        //TODO : vérifier si suppression effective pour enregistrer le message dans la session
        $this->session->set('delete_article', 'Article supprimé avec succès');
        header('Location: ../public/index.php');
    }

    /**
     * Suppression d'un commentaire dans la base de données
     * @param $commentId mixed Identifiant du commentaire à supprimer
     */
    public function deleteComment($commentId)
    {
        $this->commentDAO->deleteComment($commentId);
        $this->session->set('delete_comment', 'Suppression du commentaire effectuée');
        header('Location: ../public/index.php');
    }
}