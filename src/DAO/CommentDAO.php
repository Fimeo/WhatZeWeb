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
        $sql = 'SELECT id, pseudo, content, createdAt, flag FROM comment WHERE article_id = ? ORDER BY createdAt DESC';
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
        $comment->setFlag($row['flag']);
        return $comment;
    }

    public function addComment(Parameter $post, $articleId)
    {
        $sql = 'INSERT INTO comment (pseudo, content, createdAt, article_id, flag) VALUES (?, ?, NOW(), ?, 0)';
        $this->createQuery($sql, [
            $post->get('pseudo'),
            $post->get('content'),
            $articleId
        ]);
    }

    /**
     * Signalement d'un commentaire, reviens à mettre le flag à true
     * @param $commentId mixed Identifiant du commentaire
     */
    public function flagComment($commentId)
    {
        $sql = 'UPDATE comment SET flag=:flag WHERE id=:id';
        $this->createQuery($sql, [
            'flag' => 1,
            'id' => $commentId
        ]);
    }

    /**
     * Suppression du commentaire avec identifiant commentId dans la base de données
     * @param $commentId mixed Identifiant du commentaire concerné
     */
    public function deleteComment($commentId)
    {
        $sql = 'DELETE FROM comment WHERE id=:id';
        $this->createQuery($sql, [
            'id' => $commentId
        ]);
    }

    public function getFlagComments()
    {
        $sql = 'SELECT id, pseudo, content, createdAt, flag FROM comment WHERE flag = ? ORDER BY createdAt DESC';
        $result = $this->createQuery($sql, [1]);
        $comments = [];
        foreach ($result as $row) {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }

    public function unflagComment($commentId)
    {
        $sql = 'UPDATE comment SET flag=? WHERE id=?';
        $this->createQuery($sql, [0, $commentId]);
    }
}
