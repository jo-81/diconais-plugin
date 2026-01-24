<?php

namespace Diconais\Core\Validation\Validator;

use Diconais\Core\Validation\Interface\ValidatorInterface;

class IsNegative implements ValidatorInterface
{
    public function isValid(mixed $value): bool
    {
        $v = (int) $value;

        return $v > 0;
    }

    public function message(): string
    {
        return 'Cette valeur ne peut pas être négative.';
    }
}
