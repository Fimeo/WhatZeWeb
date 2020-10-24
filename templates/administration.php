<?php $this->title = 'Administration'; ?>
    <h1>Mon blog</h1>
    <p>En construction</p>
<?= $this->session->show('delete_article'); ?>
<?= $this->session->show('add_article'); ?>
<?= $this->session->show('edit_article'); ?>
    <h2>Articles</h2>
    <a href="../public/index.php?route=addArticle">Nouvel article</a>
    <table>
        <tr>
            <td>Id</td>
            <td>Titre</td>
            <td>Contenu</td>
            <td>Auteur</td>
            <td>Date</td>
            <td>Actions</td>
        </tr>
        <?php
        foreach ($articles as $article)
        {
            ?>
            <tr>
                <td><?= htmlspecialchars($article->getId());?></td>
                <td><a href="../public/index.php?route=article&amp;articleId=<?= htmlspecialchars($article->getId())?>"><?= htmlspecialchars($article->getTitle()); ?></a></td>
            <td><?= substr(htmlspecialchars($article->getContent()), 0, 150);?></td>
            <td><?= htmlspecialchars($article->getAuthor());?></td>
            <td>Créé le : <?= htmlspecialchars($article->getCreatedAt());?></td>
            <td>
                <a href="../public/index.php?route=editArticle&amp;articleId=<?= $article->getId(); ?>">Modif</a>
                <a href="../public/index.php?route=deleteArticle&amp;articleId=<?= $article->getId(); ?>">Sup</a>
            </td>
            </tr>
            <?php
        }
        ?>
    </table>

    <h2>Commentaires signalés</h2>

    <h2>Utilisateurs</h2><?php
