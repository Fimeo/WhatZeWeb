<?php
//Include de la connexion à la base de données.

require 'Database.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon blog</title>
</head>
<body>
    <h1>Mon blog</h1>
    <p>En construction</p>
    <?php
    
    //Création de la base de données
    $db = new Database();

    //Connection
    echo $db->getConnection();
    ?>
</body>
</html>