<?php

namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\Article;

/**
 * Class ArticleDAO gère les opérations effectuées sur les articles.
 * Hérite de la classe Database, effectue les requêtes directement.
 * @package App\src\DAO
 */
class ArticleDAO extends DAO
{
    /**
     * Renvoie le résultat de la requête de tous les articles
     * classés par ordre décroissant suivant l'id.
     * @return array Tableau d'Articles de la base de données
     */
    public function getArticles()
    {
        $sql = 'SELECT article.id, article.title, article.content, user.pseudo, article.createdAt FROM article INNER JOIN user ON article.user_id = user.id ORDER BY article.id DESC';
        $result = $this->createQuery($sql);

        //Création des objets Articles après récupération des données
        $articles = [];
        foreach ($result as $row) {
            $articleId = $row['id'];
            $articles[$articleId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $articles;
    }

    /**
     * Converti chaque champ de la table en propriété d'une instance d'Article
     * Factory methode de création d'Article
     * @param $row array Données brutes issues de la base de données
     * @return Article Instance d'Article crée depuis les données brutes
     */
    private function buildObject($row)
    {
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setContent($row['content']);
        $article->setAuthor($row['pseudo']);
        $article->setCreatedAt($row['createdAt']);
        return $article;
    }

    /**
     * Récupération d'un article suivant son id dans la base de données
     * @param $articleId int Identifiant de l'article concerné
     * @return Article Insntace d'Article récupéré depuis la base de données
     */
    public function getArticle($articleId)
    {
        $sql = 'SELECT article.id, article.title, article.content, user.pseudo, article.createdAt FROM article INNER JOIN user ON article.user_id = user.id WHERE article.id = ?';
        $result = $this->createQuery($sql, [$articleId]);
        $row = $result->fetch();
        return $this->buildObject($row);
    }

    /**
     * Ajout d'un article dans la base de données
     * @param $post Parameter Données de l'article à insérer dans la base de données
     * @param $userId
     */
    public function addArticle(Parameter $post, $userId)
    {
        $sql = 'INSERT INTO article (title, content, createdAt, user_id) VALUES (?, ?, NOW(), ?)';
        $this->createQuery($sql, [$post->get('title'), $post->get('content'), $userId]);
    }

    /**
     * Mise à jour d'un article dans la base de données avec les données reçes
     * @param Parameter $post Données mises à jour
     * @param $articleId int Identifiant de l'article à modifier
     */
    public function editArticle(Parameter $post, $articleId, $userId)
    {
        $sql = 'UPDATE article SET title=:title, content=:content, user_id=:user_id WHERE id=:articleId';
        $this->createQuery($sql, [
            'title' => $post->get('title'),
            'content' => $post->get('content'),
            'user_id' => $userId,
            'articleId' => $articleId
        ]);
    }

    /**
     * Suppresion d'un article dans la base de données
     * Attention, une fk associe les articles aux commentaires
     * Donc il faut supprimer les commentaires et l'article pour supprimer un article
     * @param $articleId int Identifiant de l'article
     */
    public function deleteArticle($articleId)
    {
        $sql = 'DELETE FROM comment WHERE article_id=:id';
        $this->createQuery($sql, [
           'id' => $articleId
        ]);
        $sql = 'DELETE FROM article WHERE id=:id';
        $this->createQuery($sql, [
            'id' => $articleId
        ]);
    }
}
