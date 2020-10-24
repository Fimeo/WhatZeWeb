<?php $this->title = "Accueil"; ?>
    <h1>Mon blog</h1>
    <p>En construction</p>
<?= $this->session->show('add_comment'); ?>
<?= $this->session->show('flag_comment'); ?>
<?= $this->session->show('register'); ?>
<?= $this->session->show('login_message'); ?>
<?= $this->session->show('logout'); ?>
<?= $this->session->show('delete_account'); ?>
<?php
//Menu dynamique si l'utilisateur est connecté
if ($this->session->getUserInfo('pseudo')) :
    ?>
    <p>Bienvenue sur votre espace <?= ucfirst(htmlspecialchars($this->session->getUserInfo('pseudo')))?></p>
    <a href="../public/index.php?route=logout">Déconnexion</a>
    <a href="../public/index.php?route=profile">Profil</a>
    <?php if($this->session->getUserInfo('role') === 'admin') :?>
    <a href="../public/index.php?route=administration">Administration</a>
    <?php endif;?>
<?php
else:
    ?>
    <a href="../public/index.php?route=register">Inscription</a>
    <a href="../public/index.php?route=login">Connexion</a>
<?php
endif;
?>

<?php
/** @var \App\src\model\Article $articles */
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