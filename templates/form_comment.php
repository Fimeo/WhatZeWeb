<?php
$route = isset($post) && $post->get('id') ? 'editComment' : 'addComment';
$submit = $route === 'addComment' ? 'Ajouter' : 'Mettre à jour';
?>
<form action="../public/index.php?route=<?= $route; ?>&articleId=<?= htmlspecialchars($article->getId()) ?>"
      method="post">
    <label for="pseudo">
        <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo"
               value="<?= isset($post) ? htmlspecialchars($post->get('pseudo')) : ''; ?>">
    </label><br>
    <?= isset($errors['pseudo']) ? $errors['pseudo'] : ''; ?>
    <label for="content">
        <textarea name="content" id="content" cols="30" rows="10" placeholder="Votre commentaire"><?= isset($post) ? htmlspecialchars($post->get('content')): ''; ?></textarea>
        <?= isset($errors['content']) ? $errors['content'] : ''; ?>
    </label><br>
    <input type="submit" value="<?= $submit; ?>" name="submit" id="submit">
</form>