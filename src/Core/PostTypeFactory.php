<?php

namespace Diconais\Core;

/**
 * PostTypeFactory
 * Permet d'enregister un custom post type
 */
class PostTypeFactory
{
    private ?string $name = null;

    /** @var array<string, mixed> */
    private array $data = [];

    public function hook(int $priority = 10): void
    {
        \add_action('init', [$this, 'register'], $priority);
    }

    /**
     * set
     *
     * @param  string $name
     * @param  array<string, mixed> $data
     * @return self
     */
    public function set(string $name, array $data): self
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('Le nom du post type ne peux pas être vide.');
        }

        $this->name = $name;
        $this->data = $data;

        return $this;
    }

    /**
     * register
     *
     * @return void
     */
    public function register(): void
    {
        \register_post_type($this->name, $this->data);
    }
}
