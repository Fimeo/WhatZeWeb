<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/style.css">
    <title>Mon blog</title>
</head>
<body>
    <h1>Mon blog</h1>
    <p>En construction</p>
    <?php $article = $articles->fetch(); ?>
    <div>
        <h2><?= htmlspecialchars($article->title);?></h2>
        <p><?= htmlspecialchars($article->content); ?></p>
        <p><?= htmlspecialchars($article->author); ?></p>
        <p>Crée le : <?= htmlspecialchars($article->createdAt); ?></p>
    </div>
    <br>
    <?php $articles->closeCursor(); ?>
    <a href="../public/index.php">Retour à l'accueil</a>
    <div id="id" class="text-left">
        <h3>Commentaires</h3>
        <?php
        while ($comment = $comments->fetch()) {
            ?>
            <h4><?= htmlspecialchars($comment->pseudo); ?></h4>
            <p><?= htmlspecialchars($comment->content)?></p>
            <p>Posté le : <?= htmlspecialchars($comment->createdAt)?></p>
            <?php
        }
        $comments->closeCursor();
        ?>
    </div>
</body>
</html>