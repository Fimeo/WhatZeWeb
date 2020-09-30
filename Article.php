<?php

/**
 * Classe Article, gère les opérations effectuées sur les articles.
 */
class Article
{
    /**
     * Renvoie le résultat de la requête de tous les articles
     * classés par ordre décroissant suivant l'id.
     */
    public function getArticles()
    {
        $db = new Database();
        $connection = $db->getConnection();
        $result = $connection->query('SELECT id, title, content, author, createdAt FROM article ORDER BY id DESC');
        return $result;
    }

    /**
     * Récupération des données d'un article en fonction de son id
     */
    public function getArticle($articleId)
    {
        $db = new Database();
        $connection = $db->getConnection();
        $result = $connection->prepare('SELECT id, title, content, author, createdAt FROM article WHERE id=:id');
        $result->execute(['id' => $articleId]);
        return $result;
    }
}