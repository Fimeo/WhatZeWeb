<?php $this->title = "Connexion"; ?>
<h1>Mon blog</h1>
<p>En construction</p>
<?= $this->session->show('error_login')?>
<?= $this->session->show('need_login');?>
<div>
    <form method="post" action="../public/index.php?route=login">
        <label for="pseudo">Pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo" value="<?= isset($post) ? htmlspecialchars($post->get('pseudo')) : '';?>"><br>
        <label for="password">Mot de passe</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Connexion" id="submit" name="submit">
    </form>
    <a href="../public/index.php?route=register">Pas encore inscrit ? C'est par ici</a>
    <a href="../public/index.php">Retour à l'accueil</a>
</div>