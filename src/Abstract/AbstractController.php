<?php

namespace Diconais\Abstract;

use Diconais\Interface\ControllerInterface;

abstract class AbstractController implements ControllerInterface
{
    public function load(): void
    {
    }
}
