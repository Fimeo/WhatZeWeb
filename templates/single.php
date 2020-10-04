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
    <div>
        <h2><?= htmlspecialchars($article->getTitle());?></h2>
        <p><?= htmlspecialchars($article->getContent()); ?></p>
        <p><?= htmlspecialchars($article->getAuthor()); ?></p>
        <p>Crée le : <?= htmlspecialchars($article->getCreatedAt()); ?></p>
    </div>
    <br>
    <a href="../public/index.php">Retour à l'accueil</a>
    <div id="comments" class="text-left">
        <h3>Commentaires</h3>
        <?php
        foreach($comments as $comment) {
            ?>
            <h4><?= htmlspecialchars($comment->getPseudo()); ?></h4>
            <p><?= htmlspecialchars($comment->getContent())?></p>
            <p>Posté le : <?= htmlspecialchars($comment->getCreatedAt())?></p>
            <?php
        }
        ?>
    </div>
</body>
</html>