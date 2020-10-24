<?php
echo $this->session->show('not_admin');
$this->title = 'Mon profil';
$user = $this->session->get('user');
//TODO: proteger les pages de comptes avec redirection vers page de connexion si non connecté
//TODO: enregister connexion après inscription
//TODO: si non connecté ou connexion espirée, redirect login
?>
<h1>Mon blog</h1>
<p>En construction</p>
<div>
    <h2>Votre profil <?= $this->session->getUserInfo('pseudo'); ?></h2>
    <p>Identifiant du compte : <?= $this->session->getUserInfo('id') ?></p>
    <p>Type du compte : <?= $this->session->getUserInfo('role') ?></p>
    <a href="../public/index.php?route=updatePassword">Modifier son mot de passe</a>
    <a href="../public/index.php?route=deleteAccount">Supprimer mon compte</a>
</div>
<br>
<a href="../public/index.php">Retour à l'accueil</a>