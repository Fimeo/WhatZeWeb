<?php

/**
 * Classe concernant la base de données.
 * Gère la connexion à la base de données
 */
abstract class Database
{
    const DB_HOST = 'mysql:host=localhost;dbname=blog;charset=utf8';
    const DB_USER = 'user';
    const DB_PASS = 'password';

    private $connection;

    /**
     * Renvoie la connexion si elle est établie, sinon établie la connexion
     * et la renvoie.
     */
    private function check_connection()
    {
        if ($this->connection === null) {
            return $this->getConnection();
        }
        
        return $this->connection;
    }

    /**
     * Connexion à la base de données
     * Retourne l'instance PDO de la base de données si réussie
     */
    private function getConnection()
    {
        try {
            $connection = new PDO(self::DB_HOST, self::DB_USER, self::DB_PASS);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (Exception $errorConnection) {
            die('Erreur de connexion à la base de données : ' . $errorConnection->getMessage());
        }
    }

    /**
     * Gère les requête sur la base de données, requête préparée si utilisation
     * de paramètres. Retourne le résultat de la requête.
     */
    public function createQuery($sql, $parameters=null)
    {
        // Utilisation de la même connexion si plusieurs requêtes
        // Si il y a des paramètres, requête préparée
        if ($parameters) {
            $result = $this->check_connection()->prepare($sql);
            //Conversion des données reçues en objet de la classe appelante
            $result->setFetchMode(PDO::FETCH_CLASS, static::class);
            $result->execute($parameters);
            return $result;
        }
        $result = $this->check_connection()->query($sql);
        $result->setFetchMode(PDO::FETCH_CLASS, static::class);
        return $result;
    }
}
