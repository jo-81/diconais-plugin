<?php

namespace Diconais\Controller;

use Diconais\Inc\PostType\KanaPostType;
use Diconais\Abstract\AbstractController;

class KanaController extends AbstractController
{
    /**
     * load
     *
     * @return void
     */
    public function load(): void
    {
        if ($this->postTypeFactory) {
            $this->registerPostType();
        }
    }

    /**
     * registerPostType
     *
     * @return void
     */
    public function registerPostType(): void
    {
        $this->postTypeFactory->set('dn_kana', KanaPostType::get())->hook();
    }
}
