<?php


namespace App\src\constraint;


class Validator
{
    /**
     * Validation de données contenues dans $data, lance la vérification sur le type
     * de données associé au $name
     * @param $data mixed Données à valider
     * @param $name mixed Nom de la classe de validation
     * @return array Erreurs éventuelles de validation
     */
    public function validate($data, $name)
    {
        if($name === 'Article') {
            $articleValidation = new ArticleValidation();
            return $articleValidation->check($data);
        } elseif ($name === 'Comment') {
            $commentValidation = new CommentValidation();
            return $commentValidation->check($data);
        } elseif ($name === 'User') {
            $userValidation = new UserValidation();
            return $userValidation->check($data);
        }
    }
}