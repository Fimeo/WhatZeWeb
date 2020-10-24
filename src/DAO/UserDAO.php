<?php


namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\User;

/**
 * Class UserDAO, gère les accès base de donnée pour les comptes utilisateurs
 * @package App\src\DAO
 */
class UserDAO extends DAO
{
    private function buildObject($row)
    {
        $user = new User();
        $user->setId($row['id']);
        $user->setPseudo($row['pseudo']);
        $user->setCreatedAt($row['createdAt']);
        $user->setRole($row['name']);
        return $user;
    }

    public function getUsers()
    {
        $sql = 'SELECT user.id, user.pseudo, user.createdAt, role.name FROM user INNER JOIN role ON user.role_id = role.id ORDER BY user.id DESC';
        $result = $this->createQuery($sql);
        $users = [];
        foreach ($result as $row){
            $userId = $row['id'];
            $users[$userId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $users;
    }

    /**
     * Enregistre un utilisateur dans la base de données, mot de passe haché
     * @param Parameter $post Données utilisateur
     */
    public function register(Parameter $post)
    {
        //TODO : récupérer dynmamiquement l'id du type user dans table role
        $hashpassword = password_hash($post->get('password'), PASSWORD_DEFAULT);
        $sql = 'INSERT INTO user (pseudo, password, createdAt, role_id) VALUES (:pseudo, :password, NOW(), :roleid)';
        $this->createQuery($sql, [
            'pseudo' => $post->get('pseudo'),
            'password' => $hashpassword,
            'roleid' => 2
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

    /**
     * Vérification des données de connexion pour un utilisateur
     * @param Parameter $post Données de connexion
     * @return array
     */
    public function login(Parameter $post)
    {
        //TODO : vérification si bien un seuil utilisateur avec ce pseudo !
        $sql = 'SELECT u.id, u.pseudo, u.role_id, u.password, r.name AS role FROM user as u INNER JOIN role as r ON r.id = u.role_id WHERE pseudo=:pseudo';
        $data = $this->createQuery($sql, [
            'pseudo' => $post->get('pseudo')
        ]);
        $result = $data->fetch();
        if ($result) {
            $isPasswordValid = password_verify($post->get('password'), $result['password']);
            if ($isPasswordValid) {
                return [
                    'result' => $result,
                    'isPasswordValid' => $isPasswordValid
                ];
            }

        }
        return [];
    }

    /**
     * Mise à jour du mot de passe de l'utilisateur userProfile dans la base de données
     * @param Parameter $post Nouveau mot de passe
     * @param $userProfile mixed Profile de l'utilisateur concerné
     * @return false Si une erreur survient
     */
    public function updatePassword(Parameter $post, $userProfile)
    {
        if (key_exists('password', $post)) {
            $sql = 'UPDATE user SET password=:password WHERE id=:id AND pseudo=:pseudo';
            $this->createQuery($sql, [
                //'password' => password_hash($post->get('password'), PASSWORD_DEFAULT),
                'id' => $userProfile['id'],
                'pseudo' => $userProfile['pseudo'],
                'password' => $post->get('password')
            ]);
        }
        return false;
        //TODO : gérer si retourne false, mettre un autre msg
    }

    /**
     * Suppression d'un compte dans la base de données
     * @param $user mixed Compte à supprimer
     */
    public function deleteAccount($user)
    {
        $sql = 'DELETE FROM user WHERE id=:id';
        $this->createQuery($sql, [
            'id' => $user['id']
        ]);
    }

    public function deleteUser($pseudo)
    {
        $sql = 'DELETE FROM user WHERE id = ?';
        $this->createQuery($sql, [$pseudo]);
    }
}