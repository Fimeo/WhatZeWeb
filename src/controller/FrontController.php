<?php

namespace App\src\controller;

use App\config\Parameter;

/**
 * Class FrontController
 * Contrôleur qui gère ce qui est accessible à tout le monde
 * @package App\src\controller
 */
class FrontController extends Controller
{
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

    /**
     * Si données d'ajout de commentaire reçues et données validées, insertion dans BD
     * Sinon
     * @param Parameter $post
     * @param $articleId
     */
    public function addComment(Parameter $post, $articleId)
    {
        $post->trimAll();
        $article = $this->articleDAO->getArticle($articleId);
        $comments = $this->commentDAO->getCommentsFromArticle($articleId);

        //Si formulaire POST soumis, on insère le commentaire si les données sont valides
        if ($post->get('submit')) {
            $errors = $this->validation->validate($post, 'Comment');
            if (!$errors) {
                $this->commentDAO->addComment($post, $articleId);
                $this->session->set('add_comment', 'Le commentaire à bien été ajouté');
                header('Location: ../public/index.php?route=article&articleId=' . $articleId);
            } else {
                $this->view->render('single', [
                    'article' => $article,
                    'comments' => $comments,
                    'errors' => $errors,
                    'post' => $post
                ]);
            }
        } else {
            //Si aucun formulaire soumis, redirection vers home
            header('Location: ../public/index.php');
        }
    }

    /**
     * Signalement d'un commentaire par un utilisateur
     * @param $commentId mixed Identifiant du commentaire
     */
    public function flagComment($commentId)
    {
        $this->commentDAO->flagComment($commentId);
        $this->session->set('flag_comment', 'Le commentaire à bien été signalé, merci');
        header('Location: ../public/index.php');
    }

    /**
     * Inscription sur le site
     * @param $post Parameter Données utilisateur d'incription
     */
    public function register(Parameter $post)
    {
        //Si formulaire soumis
        if ($post->get('submit')) {
            $errors = $this->validation->validate($post, 'User');
            $checkUser = $this->userDAO->checkUser($post);
            if ($checkUser) {
                //Ajoute une erreur avec un message renvoyé par checkUser
                $errors['pseudo'] = $checkUser;
            }
            if (!$errors) {
                $this->userDAO->register($post);
                $this->session->set('register', 'Votre inscription à bien été effectuée');
                header('Location: ../public/index.php');
            } else {
                $this->view->render('register', [
                    'errors' => $errors,
                    'post' => $post
                ]);
            }
        } else {
            $this->view->render('register');
        }
    }

    /**
     * Page de connexion
     * @param Parameter $post Données de connexion
     */
    public function login(Parameter $post)
    {
        //Si formulaire soumis, vérification de l'identité
        //Stockage des infos de l'utilisateur dans la session
        if ($post->get('submit')) {
            $result = $this->userDAO->login($post);
            if ($result && $result['isPasswordValid']) {
                $this->session->set('login_message', 'Content de vous revoir');
                $this->session->set('user', $result['result']);
                header('Location: ../public/index.php');
            } else {
                //Si mot de passe invalide, remet la page de connexion avec infos
                $this->session->set('error_login', 'Le pseudo ou le mot de passe sont incorrects');
                $this->view->render('login', [
                    'post' => $post
                ]);
            }
        } else {
            //Si aucun formulaire soumis, retour page connexion
            $this->view->render('login');
        }
    }
}
