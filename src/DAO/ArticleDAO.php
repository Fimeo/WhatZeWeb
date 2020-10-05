<?php

namespace App\src\DAO;

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
        $article->setAuthor($row['author']);
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
        $sql = 'SELECT id, title, content, author, createdAt FROM article WHERE id=:id';
        $parameters = [
            "id" => $articleId
        ];
        $result = $this->createQuery($sql, $parameters);
        $row = $result->fetch();
        return $this->buildObject($row);
    }

    /**
     * Ajout d'un article dans la base de données
     * @param $row array Données de l'article à insérer dans la base de données
     */
    public function addArticle($row)
    {
        //Exctraction des variables du tableau associatif post
        extract($row);
        $sql = 'INSERT INTO article (title, content, author, createdAt) VALUES (?,?,?,NOW())';
        $this->createQuery($sql, [$title, $content, $author]);
    }
}
