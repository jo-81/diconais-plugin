<?php

namespace Diconais;

use Diconais\Interface\ControllerInterface;

class Plugin
{
    private static ?self $_instance = null;

    /**
     * @var array<int, ControllerInterface>
     */
    private array $controllers = [];

    private function __construct()
    {
    }

    /**
     * get_instance
     *
     * @return self
     */
    public static function get_instance(): self
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * add_controller
     *
     * @param  ControllerInterface $controller
     * @return self
     */
    public function add_controller(ControllerInterface $controller): self
    {
        $this->controllers[] = $controller;

        return $this;
    }

    /**
     * boot
     *
     * @return void
     */
    public function boot(): void
    {
        foreach ($this->controllers as $controller) {
            $controller->load();
        }
    }
}
