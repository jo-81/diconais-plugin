<?php

namespace Diconais\Core\Validation;

use Diconais\Core\Validation\Interface\ValidatorInterface;

class ValidatorFactory
{
    public static function create(string $validatorName): ValidatorInterface
    {
        if (! class_exists($validatorName)) {
            throw new \Exception(sprintf("La classe de validation %s n'existe pas", $validatorName));
        }

        $instance = new $validatorName();
        if (! is_a($instance, ValidatorInterface::class)) {
            throw new \Exception(sprintf("La classe %s n'implémente pas l'interface ValidatorInterface", $validatorName));
        }

        return $instance;
    }
}
