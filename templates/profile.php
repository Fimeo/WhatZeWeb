<?php
$this->title = 'Mon profil';
$user = $this->session->get('user');
//TODO: proteger les pages de comptes avec redirection vers page de connexion si non connecté
//TODO: enregister connexion après inscription
//TODO: si non connecté ou connexion espirée, redirect login
?>
<h1>Mon blog</h1>
<p>En construction</p>
<div>
    <h2><?= $this->session->get('pseudo'); ?></h2>
    <p><?= isset($user) && $user['id'] ? $user['id'] : '' ?></p>
    <a href="../public/index.php?route=updatePassword">Modifier son mot de passe</a>
</div>
<br>
<a href="../public/index.php">Retour à l'accueil</a>