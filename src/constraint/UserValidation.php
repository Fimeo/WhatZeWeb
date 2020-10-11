<?php


namespace App\src\constraint;

/**
 * Class UserValidation, validation des données pour création de compte utilisateur
 * @package App\src\constraint
 */
class UserValidation extends Validation
{

    public function checkField($name, $value)
    {
        if ($name === 'pseudo') {
            $error = $this->checkPseudo($name, $value);
            $this->addError($name, $error);
        } elseif ($name === 'password') {
            $error = $this->checkPassword($name, $value);
            $this->addError($name, $error);
        }
    }

    public function checkPseudo($name, $value)
    {
        if ($this->constraint->notBlank($name, $value)){
            return $this->constraint->notBlank('pseudo', $value);
        } elseif ($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength('pseudo', $value, 2);
        } elseif ($this->constraint->maxLength($name, $value, 100)) {
            return $this->constraint->maxLength('pseudo', $value, 100);
        }
    }

    public function checkPassword($name, $value)
    {
        if ($this->constraint->notBlank($name, $value)){
            return $this->constraint->notBlank('password', $value);
        } elseif ($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength('password', $value, 2);
        } elseif ($this->constraint->maxLength($name, $value, 50)) {
            return $this->constraint->maxLength('password', $value, 50);
        }
    }
}