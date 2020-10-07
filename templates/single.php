<?php $this->title = 'Article'; ?>
<h1>Mon blog</h1>
<p>En construction</p>
<?= $this->session->show('add_article'); ?>
<?= $this->session->show('edit_article'); ?>
<?= $this->session->show('delete_article'); ?>
<?= $this->session->show('add_comment'); ?>
<?= $this->session->show('flag_comment'); ?>
<?= $this->session->show('delete_comment'); ?>
<div>
    <h2><?= htmlspecialchars($article->getTitle()); ?></h2>
    <p><?= nl2br(htmlspecialchars($article->getContent())); ?></p>
    <p><?= htmlspecialchars($article->getAuthor()); ?></p>
    <p>Crée le : <?= htmlspecialchars($article->getCreatedAt()); ?></p>
</div>
<div class="actions">
    <p><a href="../public/index.php?route=editArticle&articleId=<?= $article->getId(); ?>">Modifier</a></p>
    <p><a href="../public/index.php?route=deleteArticle&articleId=<?= $article->getId(); ?>">Supprimer</a></p>
</div>
<br>
<a href="../public/index.php">Retour à l'accueil</a>
<div id="comments" class="text-left">
    <h3>Ajouter un commentaire</h3>
    <?php include 'form_comment.php'; ?>
    <h3>Commentaires</h3>
    <?php
    foreach ($comments as $comment) {
        ?><h4><?= htmlspecialchars($comment->getPseudo()); ?></h4>
        <p><?= nl2br(htmlspecialchars($comment->getContent())) ?></p>
        <p>Posté le : <?= htmlspecialchars($comment->getCreatedAt()) ?></p>
        <?php
        if ($comment->isFlag()) {
            ?><p class="flag">Ce commentaire à été signalé</p>
            <?php
        } else {
            ?><p><a href="../public/index.php?route=flagComment&commentId=<?= $comment->getId() ?>">Signaler le commentaire</a></p>
        <?php }
        ?><p><a href="../public/index.php?route=deleteComment&commentId=<?= $comment->getId(); ?>">Supprimer le commentaire</a></p><?php
    }
    ?>
</div>