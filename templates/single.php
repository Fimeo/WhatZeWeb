<?php $this->title = 'Article'; ?>
<h1>Mon blog</h1>
<p>En construction</p>
<div>
    <h2><?= /** @var Article $article */
        htmlspecialchars($article->getTitle()); ?></h2>
    <p><?= htmlspecialchars($article->getContent()); ?></p>
    <p><?= htmlspecialchars($article->getAuthor()); ?></p>
    <p>Crée le : <?= htmlspecialchars($article->getCreatedAt()); ?></p>
</div>
<div class="actions">
    <a href="../public/index.php?route=editArticle&articleId=<?= $article->getId();?>">Modifier</a>
    <a href="../public/index.php?route=deleteArticle&articleId=<?= $article->getId(); ?>">Supprimer</a>
</div>
<br>
<a href="../public/index.php">Retour à l'accueil</a>
<div id="comments" class="text-left">
    <h3>Commentaires</h3>
    <?php
    /** @var Comment $comments */
    foreach ($comments as $comment) {
        ?>
        <h4><?= htmlspecialchars($comment->getPseudo()); ?></h4>
        <p><?= nl2br(htmlspecialchars($comment->getContent())) ?></p>
        <p>Posté le : <?= htmlspecialchars($comment->getCreatedAt()) ?></p>
        <?php
    }
    ?>
</div>