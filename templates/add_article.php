<?php $this->title = 'Nouvel Article' ?>
<h1>Mon blog</h1>
<p>En construction</p>
<div>
    <form action="../public/index.php?route=addArticle" method="post">
        <label for="title">Titre</label><br>
        <input type="text" id="title" name="title"><br>
        <label for="content">Contenu</label><br>
        <textarea name="content" id="contenu" cols="30" rows="10"></textarea><br>
        <label for="author">Auteur</label><br>
        <input type="text" id="author" name="author"><br>
        <input type="submit" value="Envoyer" id="submit" name="submit">
    </form>
    <a href="../public/index.php">Retour à l'accueil</a>
</div>
