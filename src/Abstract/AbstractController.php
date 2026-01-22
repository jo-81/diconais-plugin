<?php

namespace Diconais\Abstract;

use Diconais\Core\PostTypeFactory;
use Diconais\Interface\ControllerInterface;

abstract class AbstractController implements ControllerInterface
{
    protected ?PostTypeFactory $postTypeFactory = null;

    public function load(): void
    {
    }

    /**
     * setPostTypeFactory
     *
     * @param  PostTypeFactory $postTypeFactory
     * @return self
     */
    public function setPostTypeFactory(PostTypeFactory $postTypeFactory): self
    {
        $this->postTypeFactory = $postTypeFactory;

        return $this;
    }
}
