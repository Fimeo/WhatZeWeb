<?php

/**
 * Classe qui gère les commentaires sur le site.
 */
class Comment extends Database
{
    /**
     * Récupération des commentaires associés à un article (son identifiant)
     */
    public function getCommentsFromArticle($articleId)
    {
        $sql = 'SELECT id, pseudo, content, createdAt FROM comment WHERE article_id = ? ORDER BY createdAt DESC';
        return $this->createQuery($sql, [$articleId]);
    }
}