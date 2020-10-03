<?php
/**
 * Données de configuration de l'application pour serveur de production
 * Accès à la base de données
 * Il suffit de remplacer l'appel de dev.php vers prod.php dans ../public/index.php
 * pour utiliser les valeurs du serveur de production
 */

const HOST = 'localhost';
const DB_NAME = 'blog';
const CHARSET = 'utf8';
const DB_HOST = 'mysql:host='.HOST.';dbname='.DB_NAME.';charset='.CHARSET;
const DB_USER = '';
const DB_PASS = '';
