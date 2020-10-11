<?php

namespace App\src\DAO;

use http\Exception\InvalidArgumentException;
use PDO;
use Exception;
use PDOStatement;

/**
 * Class DAO gestion de la connexion à la base de données
 * @package App\src\DAO
 */
abstract class DAO
{
    private $PDOconnection;

    /**
     * Création d'une requête et exécution sur la base de données. Avec ou sans paramètres.
     * @param $sql string Requête sql textuelle à effectuer
     * @param null $parameters Paramètres de requête pour requête préparée
     * @return bool|PDOStatement Résultat brute de la requête, false si échec.
     */
    public function createQuery($sql, $parameters = null)
    {
        // Utilisation de la même connexion si plusieurs requêtes
        // Si il y a des paramètres, requête préparée
        if ($parameters) {
            $result = $this->check_connection()->prepare($sql);
            $result->execute($parameters);
        } else {
            $result = $this->check_connection()->query($sql);
        }
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result;
    }

    /** Renvoie la connexion actuelle à la base de données, créée si besoin
     * @return PDO Connexion à la base de données
     */
    private function check_connection()
    {
        if ($this->PDOconnection === null) {
            return $this->getConnection();
        }
        return $this->PDOconnection;
    }
    
    /**
     * Etablissement de la connexion à la base de données, les données de
     * configuration sont contenues dans le fichier dev.php
     * @return PDO Connexion à la base de données
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
}
