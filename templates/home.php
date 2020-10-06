<?php

use App\src\model\Article;

$this->title = "Accueil";
?>
    <h1>Mon blog</h1>
    <p>En construction</p>
<?= $this->session->show('add_article'); ?>
<?= $this->session->show('edit_article'); ?>
    <a href="../public/index.php?route=addArticle">Nouvel Article</a>
<?php
/** @var Article $articles */
foreach ($articles as $article) {
    ?>
    <div>
        <h2>
            <a href="../public/index.php?route=article&articleId=<?= htmlspecialchars($article->getId()) ?>"><?= htmlspecialchars($article->getTitle()); ?></a>
        </h2>
        <p><?= htmlspecialchars($article->getContent()); ?></p>
        <p><?= htmlspecialchars($article->getAuthor()); ?></p>
        <p>Crée le : <?= htmlspecialchars($article->getCreatedAt()); ?></p>
    </div>
    <br>
    <?php
}
?>