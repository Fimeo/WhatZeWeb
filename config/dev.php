<?php
/**
 * Données de configuration de l'application pour serveur de développement
 * Accès à la base de données
 * Il suffit de remplacer l'appel de prod.php vers dev.php dans ../public/index.php
 * pour utiliser les valeurs du serveur de développement
 */

const HOST = 'localhost';
const DB_NAME = 'blog';
const CHARSET = 'utf8';
const DB_HOST = 'mysql:host='.HOST.';dbname='.DB_NAME.';charset='.CHARSET;
const DB_USER = 'user';
const DB_PASS = 'password';
