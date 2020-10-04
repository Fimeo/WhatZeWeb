<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon blog</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <h1>Mon blog</h1>
    <p>En construction</p>
    <?php
    //Affichage des données reçues
    foreach ($articles as $article) {
        ?>
        <div>
            <h2><a href="../public/index.php?route=article&articleId=<?= htmlspecialchars($article->getId())?>"><?= htmlspecialchars($article->getTitle()); ?></a></h2>
            <p><?= htmlspecialchars($article->getContent()); ?></p>
            <p><?= htmlspecialchars($article->getAuthor()); ?></p>
            <p>Crée le : <?= htmlspecialchars($article->getCreatedAt()); ?></p>
        </div>
        <br>
        <?php
    }
    ?>
</body>
</html>