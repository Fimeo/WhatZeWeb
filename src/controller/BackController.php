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
        if ($this->checkAdmin()){
            $post->trimAll();
            //Si le formulaire d'ajout à été soumis
            if ($post->get('submit')) {
                //Validation des données avant soumission à la BD
                $errors = $this->validation->validate($post, 'Article');
                if (!$errors) {
                    $this->articleDAO->addArticle($post, $this->session->getUserInfo('id'));
                    //Création d'un message à afficher dans la session
                    $this->session->set('add_article', 'Le nouvel article à bien été ajouté');
                    //TODO: Redirection vers l'article crée : nécessite de récupérer son id après création
                    header('Location: ../public/index.php?route=administration');
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
        if ($this->checkAdmin()){
            $post->trimAll();
            $article = $this->articleDAO->getArticle($articleId);

            if ($post->get('submit')) {
                $errors = $this->validation->validate($post, 'Article');
                if (!$errors) {
                    var_dump($this->session);
                    $this->articleDAO->editArticle($post, $articleId, $this->session->getUserInfo('id'));
                    $this->session->set('edit_article', 'L\'article à bien été mis à jour');
                    header('Location: ../public/index.php?route=administration');
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
    }

    /**
     * Suppresion d'un article dans la base de données suivant son identifiant
     * @param $articleId mixed Identifiant de l'article à supprimer
     */
    public function deleteArticle($articleId)
    {
        if ($this->checkAdmin()) {
            $this->articleDAO->deleteArticle($articleId);
            //TODO : vérifier si suppression effective pour enregistrer le message dans la session
            $this->session->set('delete_article', 'Article supprimé avec succès');
            header('Location: ../public/index.php?route=administration');
        }
    }

    /**
     * Suppression d'un commentaire dans la base de données
     * @param $commentId mixed Identifiant du commentaire à supprimer
     */
    public function deleteComment($commentId)
    {
        if ($this->checkAdmin()) {
            $this->commentDAO->deleteComment($commentId);
            $this->session->set('delete_comment', 'Suppression du commentaire effectuée');
            header('Location: ../public/index.php?route=administration');
        }
    }

    /**
     * Profil de l'utilisateur connecté
     */
    public function profile()
    {
        if ($this->checkLoggedIn()) {
            $this->view->render('profile');
        }
    }

    /*
     * Mise à jour du mot de passe de l'utilisateur
     * @param Parameter $post Nouveau mot de passe
     */
    public function updatePassword(Parameter $post)
    {
        if ($this->checkLoggedIn()) {
            if ($post->get('submit')) {
                $errors = $this->validation->validate($post, 'User');
                if (!$errors) {
                    $this->userDAO->updatePassword($post, $this->session->get('user'));
                    $this->session->set('update_password', 'Le mot de passe à bien été mis à jour');
                    header('Location: ../public/index.php?route=profile');
                } else {
                    $this->view->render('updatePassword', [
                        'errors' => $errors
                    ]);
                }
            } else {
                $this->view->render('updatePassword');
            }
        }
    }

    /**
     * Déconnexion de l'utilisateur courant
     */
    public function logout()
    {
        if ($this->checkLoggedIn()) {
            $this->session->destroy();
            $this->session->start();
            $this->session->set('logout', 'Déconnexion réussie');
            header('Location: ../public/index.php');
        }
    }

    /**
     * Suppresion du compte utilisateur
     */
    public function deleteAccount()
    {
        if ($this->checkLoggedIn()) {
            $this->userDAO->deleteAccount($this->session->get('user'));
            $this->session->destroy();
            $this->session->start();
            $this->session->set('delete_account', 'Votre compte à bien été supprimé');
            header('Location: ../public/index.php');
        }
    }

    /**
     * Espace administration
     */
    public function administration()
    {
        if ($this->checkAdmin()) {
            $articles = $this->articleDAO->getArticles();
            $flagComments = $this->commentDAO->getFlagComments();
            $users = $this->userDAO->getUsers();
            $this->view->render('administration', [
                'articles' => $articles,
                'comments' => $flagComments,
                'users' => $users
            ]);
        }
    }

    public function unflagComment($commentId)
    {
        if ($this->checkAdmin()) {
            $this->commentDAO->unflagComment($commentId);
            $this->session->set('unflag_comment', 'Le commentaire a bien été désignalé');
            header('Location: ../public/index.php?route=administration');
        }
    }

    public function deleteUser($userId)
    {
        if ($this->checkAdmin()) {
            $this->userDAO->deleteUser($userId);
            $this->session->set('delete_user', 'L\'utilisateur a bien été supprimé');
            header('Location: ../public/index.php?route=administration');
        }
    }

    private function checkLoggedIn()
    {
        if(!$this->session->getUserInfo('pseudo')) {
            $this->session->set('need_login', 'Vous devez vous connecter pour accéder à cette page');
            header('Location: ../public/index.php?route=login');
        } else {
            return true;
        }
    }

    private function checkAdmin()
    {
        $this->checkLoggedIn();
        if(!($this->session->getUserInfo('role') === 'admin')) {
            $this->session->set('not_admin', 'Vous n\'avez pas le droit d\'accéder à cette page');
            header('Location: ../public/index.php?route=profile');
        } else {
            return true;
        }
    }


}