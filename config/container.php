<?php

use Diconais\Core\PostTypeFactory;
use Diconais\Controller\KanaController;

return [
    PostTypeFactory::class => fn() => new PostTypeFactory(),

    KanaController::class => function($c) {
        return (new KanaController())
            ->setPostTypeFactory($c->get(PostTypeFactory::class))
        ;
    },
];