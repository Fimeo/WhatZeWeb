<?php


namespace App\src\DAO;

use App\config\Parameter;

/**
 * Class UserDAO, gère les accès base de donnée pour les comptes utilisateurs
 * @package App\src\DAO
 */
class UserDAO extends DAO
{
    /**
     * Enregistre un utilisateur dans la base de données, mot de passe haché
     * @param Parameter $post Données utilisateur
     */
    public function register(Parameter $post)
    {
        $hashpassword = password_hash($post->get('password'), PASSWORD_DEFAULT);
        $sql = 'INSERT INTO user (pseudo, password, createdAt) VALUES (:pseudo, :password, NOW())';
        $this->createQuery($sql, [
            'pseudo' => $post->get('pseudo'),
            'password' => $hashpassword
        ]);
    }

    /**
     * Vérification si il n'existe pas déjà un compte pour cet utilisateur
     * Vérifaction stricte sur le pseudo, insensible à la casse
     * @param Parameter $post Données utilisateur
     */
    public function checkUser(Parameter $post)
    {
        $sql = 'SELECT COUNT(pseudo) FROM user WHERE pseudo=:pseudo';
        $result = $this->createQuery($sql, [
            'pseudo' => $post->get('pseudo')
        ]);
        $isUnique = $result->fetchColumn();
        if ($isUnique) {
            return "<p>Le pseudo existe déjà</p>";
        }
    }
}