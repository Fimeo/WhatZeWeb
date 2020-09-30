<?php

/**
 * Classe concernant la base de données. Gère la connection à la base de données.
 * Gère la connexion à la base de données
 */
class Database
{
    const DB_HOST = 'mysql:host=localhost;dbname=blog;charset=utf8';
    const DB_USER = 'user';
    const DB_PASS = 'password';

    /**
     * Connexion à la base de données
     */
    public function getConnection()
    {
        try {
            $connection = new PDO(self::DB_HOST, self::DB_USER, self::DB_PASS);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return 'Connexion OK';
        } catch (Exception $errorConnection) {
            die('Erreur de connexion à la base de données : ' . $errorConnection->getMessage());
        }
    }
}
