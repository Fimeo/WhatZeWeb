<?php
/**
 * Si existance d'un article, alors on affiche ses données pré-remplies => modification
 * Sinon champs vide => insertion
 */

$route = isset($article) && $article->getId() ? 'editArticle&articleId=' . $article->getId() : 'addArticle';
$title = isset($article) && $article->getTitle() ? htmlspecialchars($article->getTitle()) : '';
$content = isset($article) && $article->getContent() ? htmlspecialchars($article->getContent()) : '';
$author = isset($article) && $article->getAuthor() ? htmlspecialchars($article->getAuthor()) : '';
$submit = $route === 'addArticle' ? 'Envoyer' : 'Mettre à jour';
?>
<form action="../public/index.php?route=<?= $route; ?>" method="post">
    <label for="title">Titre</label><br>
    <input type="text" id="title" name="title" value="<?= $title; ?>"><br>
    <label for="content">Contenu</label><br>
    <textarea name="content" id="contenu" cols="30" rows="10"><?= $content; ?></textarea><br>
    <label for="author">Auteur</label><br>
    <input type="text" id="author" name="author" value="<?= $author; ?>"><br>
    <input type="submit" value="<?= $submit; ?>" id="submit" name="submit">
</form>