<?php

namespace Diconais\Core;

/**
 * TaxonomyFactory
 * Permet d'enregistrer une taxonomie
 */
class TaxonomyFactory
{
    private ?string $name = null;

    /** @var array<string, mixed> */
    private array $data = [];

    /** @var string[] */
    private array $postTypes = [];

    public function hook(int $priority = 10): void
    {
        \add_action('init', [$this, 'register'], $priority);
    }

    /**
     * set
     *
     * @param  string $name
     * @param  array<string, mixed> $data
     * @param  string[] $postTypes
     * @return self
     */
    public function set(string $name, array $data, array $postTypes = []): self
    {
        $this->name = $this->getVerifyName($name);
        $this->data = $this->getVerifyData($data);
        $this->postTypes = $postTypes;

        return $this;
    }

    public function register(): void
    {
        \register_taxonomy($this->name, $this->postTypes, $this->data);
    }

    /**
     * getVerifyName
     *
     * @throw InvalidArgumentException si la taxonomie existe ou si la longeur n'est pas comprise entre 1 et 32 caractères
     *
     * @param  string $name
     * @return string
     */
    private function getVerifyName(string $name): string
    {
        if (empty($name) || strlen($name) > 32) {
            throw new \InvalidArgumentException('Le nom de la taxonomie doit avoir une longueur de 1 à 32 caractères.');
        }

        if (\taxonomy_exists($name)) {
            throw new \InvalidArgumentException(sprintf("'Le nom de la taxonomie %s existe déjà.'", $name));
        }

        return $name;
    }

    /**
     * getVerifyData
     *
     * @throw InvalidArgumentException si data est vide
     *
     * @param  array<string, mixed> $data
     * @return array<string, mixed>
     */
    private function getVerifyData(array $data): array
    {
        if (empty($data)) {
            throw new \InvalidArgumentException('Les données envoyées pour la taxonomie sont vides.');
        }

        return $data;
    }
}
