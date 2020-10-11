<?php $this->title = "Inscription"; ?>
<h1>Mon blog</h1>
<p>En construction</p>
<div>
    <form method="post" action="../public/index.php?route=register">
        <label for="pseudo">Pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo" value="<?= isset($post) ? htmlspecialchars($post->get('pseudo')) : '' ?>"><br>
        <?= isset($errors['pseudo']) ? $errors['pseudo'] : ''?>
        <label for="password">Mot de passe</label><br>
        <input type="password" id="password" name="password" value="<?= isset($post) ? htmlspecialchars($post->get('password')) : ''; ?>"><br>
        <?= isset($errors['password']) ? $errors['password'] : ''?>
        <input type="submit" value="Inscription" id="submit" name="submit">
    </form>
    <a href="../public/index.php?route=login">Déjà inscrit ?</a>
    <a href="../public/index.php">Retour à l'accueil</a>
</div>