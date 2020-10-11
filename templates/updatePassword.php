<?php $this->title = 'Modifier mot mot de passe'; ?>
<h1>Mon blog</h1>
<p>En construction</p>
<div>
    <?php //TODO : demander l'ancien mot de passe pour changer : plus sécurité?>
    <h5>Le mot de passe de <?= $this->session->get('pseudo'); ?> sera modifié</h5>
    <form method="post" action="../public/index.php?route=updatePassword">
        <label for="password">Nouveau mot de passe</label><br>
        <input type="password" id="password" name="password"><br>
        <?= isset($errors) ? $errors['password'] : ''?>
        <input type="submit" value="Mettre à jour" id="submit" name="submit">
    </form>
</div>
<br>
<a href="../public/index.php">Retour à l'accueil</a>