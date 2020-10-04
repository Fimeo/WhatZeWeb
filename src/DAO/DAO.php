<?php

namespace App\src\DAO;

use PDO;
use Exception;

/**
 * Classe concernant la base de données.
 * Gère la connexion à la base de données
 */
abstract class DAO
{
    private $PDOconnection;

    /**
     * Renvoie la connexion si elle est établie, sinon établie la connexion
     * et la renvoie.
     */
    private function check_connection()
    {
        if ($this->PDOconnection === null) {
            return $this->getConnection();
        }
        
        return $this->PDOconnection;
    }

    /**
     * Connexion à la base de données
     * Retourne l'instance PDO de la base de données si réussie
     */
    private function getConnection()
    {
        try {
            $PDOconnection = new PDO(DB_HOST, DB_USER, DB_PASS);
            $PDOconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $PDOconnection;
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
            $result->execute($parameters);
            return $result;
        }
        $result = $this->check_connection()->query($sql);
        return $result;
    }
}
