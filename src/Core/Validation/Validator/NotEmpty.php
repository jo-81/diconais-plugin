<?php

namespace Diconais\Core\Validation\Validator;

use Diconais\Core\Validation\Interface\ValidatorInterface;

class NotEmpty implements ValidatorInterface
{
    public function isValid(mixed $value): bool
    {
        return ! empty($value);
    }

    public function message(): string
    {
        return 'Ce champ ne peux pas être vide.';
    }
}
