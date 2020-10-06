<?php

//Constantes de configuration, non chargé par Composer car ne contient pas de classes
require '../config/dev.php';

//Centralisation de l'appel à l'autoloader
require '../vendor/autoload.php';

//Demarrage de la session utilisateur
session_start();

//Lancement du routeur pour interprétation de la route demandée
$router = new App\config\Router();
$router->run();
