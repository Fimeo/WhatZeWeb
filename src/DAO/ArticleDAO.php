<?php

namespace App\src\DAO;

/**
 * Classe Article, gère les opérations effectuées sur les articles.
 * Hérite de la classe Database, effectue les requêtes directement.
 */
class ArticleDAO extends DAO
{
    /**
     * Renvoie le résultat de la requête de tous les articles
     * classés par ordre décroissant suivant l'id.
     */
    public function getArticles()
    {
        $sql = 'SELECT id, title, content, author, createdAt FROM article ORDER BY id DESC';
        return $this->createQuery($sql);
    }

    /**
     * Récupération des données d'un article en fonction de son id
     */
    public function getArticle($articleId)
    {
        $sql = 'SELECT id, title, content, author, createdAt FROM article WHERE id=:id';
        $parameters = [
            "id" => $articleId
        ];
        return $this->createQuery($sql, $parameters);
    }
}
