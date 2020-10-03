<?php

//Constantes de configuration, non chargé par Composer car ne contient pas de classes
require '../config/dev.php';

//Centralisation de l'appel à l'autoloader
require '../vendor/autoload.php';

/**
 * Paramètre route donne la vue concernée
 * article => single.php
 * sinon home.php
 */
try {
    if (isset($_GET['route'])) {
        if ($_GET['route'] === 'article') {
            require '../templates/single.php';
        } else {
            echo "Page inconnue";
        }
    } else {
        require '../templates/home.php';
    }
} catch (Exception $e) {
    echo 'Erreur';
}
