<?php

namespace Diconais\Core\Validation\Interface;

interface ValidatorInterface
{
    public function isValid(mixed $value): bool;

    public function message(): string;
}
