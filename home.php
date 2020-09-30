<?php
//Include de la connexion à la base de données.
require 'Database.php';

require 'Article.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon blog</title>
</head>
<body>
    <h1>Mon blog</h1>
    <p>En construction</p>
    <?php
    
    //Création d'un article
    $article = new Article();
    //Récupération des données des articles
    $articles = $article->getArticles();
    //Affichage des données reçues
    while ($article = $articles->fetch()) {
        ?>
        <div>
            <h2><a href="single.php?articleId=<?= htmlspecialchars($article['id'])?>"><?= htmlspecialchars($article['title']); ?></a></h2>
            <p><?= htmlspecialchars($article['content']); ?></p>
            <p><?= htmlspecialchars($article['author']); ?></p>
            <p>Crée le : <?= htmlspecialchars($article['createdAt']); ?></p>
        </div>
        <br>
        <?php
    }
    $articles->closeCursor();
    ?>
</body>
</html>