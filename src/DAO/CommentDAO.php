<?php

namespace App\src\DAO;

use App\src\model\Comment;
use App\config\Parameter;

/**
 * Classe qui gère les commentaires sur le site.
 */
class CommentDAO extends DAO
{
    /**
     * Récupération des commentaires associés à un article (son identifiant)
     */
    public function getCommentsFromArticle($articleId)
    {
        $sql = 'SELECT id, pseudo, content, createdAt FROM comment WHERE article_id = ? ORDER BY createdAt DESC';
        $result = $this->createQuery($sql, [$articleId]);
        $comments = [];
        foreach($result as $row) {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }

    /**
     * Converti chaque champ de la table en propriété d'une instance Comment
     * Factory méthod création de Commentaires
     */
    private function buildObject($row)
    {
        $comment = new Comment();
        $comment->setId($row['id']);
        $comment->setPseudo($row['pseudo']);
        $comment->setContent($row['content']);
        $comment->setCreatedAt($row['createdAt']);
        return $comment;
    }

    public function addComment(Parameter $post, $articleId)
    {
        $sql = 'INSERT INTO comment (pseudo, content, createdAt, article_id) VALUES (?, ?, NOW(), ?)';
        $this->createQuery($sql, [
            $post->get('pseudo'),
            $post->get('content'),
            $articleId
        ]);
    }
}
