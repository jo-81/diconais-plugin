<?php

namespace Diconais\Core\Metabox;

interface MetaboxInterface
{
    public function id(): string;

    public function title(): string;

    public function callback(): mixed;

    public function postType(): string;

    /**
     * context
     * Valeurs possbile: normal / side / advanced
     * Valeur par défaut: advanced
     *
     * @return string|null
     */
    public function context(): ?string;

    /**
     * priority
     * Valeurs possible: hight / core / default / low
     * Valeur par défaut: default
     *
     * @return string
     */
    public function priority(): ?string;

    /**
     * callbackArgs
     *
     * @return array<string, mixed>
     */
    public function callbackArgs(): array;
}
