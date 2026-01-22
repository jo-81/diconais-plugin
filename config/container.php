<?php

use Diconais\Core\PostTypeFactory;
use Diconais\Controller\KanaController;
use Diconais\Core\TaxonomyFactory;

return [
    PostTypeFactory::class => fn() => new PostTypeFactory(),
    TaxonomyFactory::class => fn() => new TaxonomyFactory(),

    KanaController::class => function($c) {
        return (new KanaController())
            ->setPostTypeFactory($c->get(PostTypeFactory::class))
            ->setTaxonomyFactory($c->get(TaxonomyFactory::class))
        ;
    },
];