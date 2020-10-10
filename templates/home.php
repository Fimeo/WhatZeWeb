<?php $this->title = "Accueil"; ?>
    <h1>Mon blog</h1>
    <p>En construction</p>
<?= $this->session->show('add_article'); ?>
<?= $this->session->show('edit_article'); ?>
<?= $this->session->show('delete_article'); ?>
<?= $this->session->show('add_comment'); ?>
<?= $this->session->show('flag_comment'); ?>
<?= $this->session->show('delete_comment'); ?>
<?= $this->session->show('register'); ?>
    <a href="../public/index.php?route=addArticle">Nouvel Article</a>
    <a href="../public/index.php?route=login">Connexion</a>
    <a href="../public/index.php?route=register">Inscription</a>
<?php
foreach ($articles as $article) {
    ?>
    <div>
        <h2>
            <a href="../public/index.php?route=article&articleId=<?= htmlspecialchars($article->getId()) ?>"><?= htmlspecialchars($article->getTitle()); ?></a>
        </h2>
        <p><?= nl2br(htmlspecialchars($article->getContent())); ?></p>
        <p><?= htmlspecialchars($article->getAuthor()); ?></p>
        <p>Crée le : <?= htmlspecialchars($article->getCreatedAt()); ?></p>
    </div>
    <br>
    <?php
}
?>