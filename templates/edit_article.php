<?php $this->title = 'Editer l\'article'; ?>
<?php
/**
 * On affiche le contenu de l'article dans les champs associés.
 * L'article récupéré est contenu dans la variable $article
 */
?>
<h1>Mon blog</h1>
<p>En construction</p>
<div>
    <form action="../public/index.php?route=editArticle&articleId=<?= htmlspecialchars($article->getId()); ?>" method="post">
        <label for="title">Titre</label><br>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($article->getTitle()); ?>"><br>
        <label for="content">Contenu</label><br>
        <textarea id="content" name="content"><?= htmlspecialchars($article->getContent()); ?></textarea><br>
        <label for="author">Auteur</label><br>
        <input type="text" id="author" name="author" value="<?= htmlspecialchars($article->getAuthor()); ?>"><br>
        <input type="submit" value="Mettre à jour" id="submit" name="submit">
    </form>
    <a href="../public/index.php">Retour à l'accueil</a>
</div>
