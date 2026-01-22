<?php

namespace Diconais\Container;

use Diconais\Container\Exception\NotFoundException;

class Container
{
    /**
     * @var array<string, mixed>
     */
    private array $services = [];

    /**
     * @var array<string, mixed>
     */
    private array $resolved = [];

    public function loadFromFile(string $filepath): self
    {
        if (!file_exists($filepath)) {
            throw new NotFoundException(sprintf("Le fichier de configuration %s n'existe pas.", $filepath));
        }

        $services = require $filepath;
        if (! is_array($services)) {
            throw new \Exception(sprintf('Le fichier de configuration %s du container doit retourner un tableau.', $filepath));
        }

        foreach ($services as $name => $factory) {
            $this->register($name, $factory);
        }

        return $this;
    }

    /**
     * register
     *
     * @param  string $name
     * @param  mixed $factory
     * @return self
     */
    public function register(string $name, mixed $factory): self
    {
        $this->services[$name] = $factory;

        return $this;
    }

    /**
     * get
     *
     * @param  string $name
     * @return mixed
     */
    public function get(string $name): mixed
    {
        if (isset($this->resolved[$name])) {
            return $this->resolved[$name];
        }

        if (!$this->has($name)) {
            throw new NotFoundException(sprintf("Le service %s n'existe pas dans le container.", $name));
        }

        $factory = $this->services[$name];
        if (is_callable($factory)) {
            $this->resolved[$name] = call_user_func($factory, $this);
        } else {
            $this->resolved[$name] = $factory;
        }

        return $this->resolved[$name];
    }

    /**
     * has
     *
     * @param  string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return isset($this->services[$name]);
    }
}
