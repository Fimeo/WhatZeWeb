<?php

namespace App\src\DAO;

//Création des articles sur la base du modèle
use App\src\model\Article;

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
     * Récupération des données d'un article en fonction de son id
     */
    public function getArticle($articleId)
    {
        $sql = 'SELECT id, title, content, author, createdAt FROM article WHERE id=:id';
        $parameters = [
            "id" => $articleId
        ];
        $result = $this->createQuery($sql, $parameters);
        $row = $result->fetch();
        return $this->buildObject($row);
    }

    /**
     * Converti chaque champ de la table en propriété d'une instance d'Article
     * Factory methode de création d'Article
     */
    private function buildObject($row)
    {
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setContent($row['content']);
        $article->setAuthor($row['author']);
        $article->setCreatedAt($row['createdAt']);
        return $article;
    }
}
