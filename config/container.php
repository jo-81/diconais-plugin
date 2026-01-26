<?php

use Diconais\Core\PostTypeFactory;
use Diconais\Core\TaxonomyFactory;
use Diconais\Controller\KanaController;
use Diconais\Core\Filter\FilterFactory;
use Diconais\Core\Metabox\MetaboxFactory;
use Diconais\Controller\EnqueueController;
use Diconais\Core\AdminColumn\AdminColumnFactory;

return [
    PostTypeFactory::class => fn() => new PostTypeFactory,
    TaxonomyFactory::class => fn() => new TaxonomyFactory,
    MetaboxFactory::class => fn() => new MetaboxFactory,
    AdminColumnFactory::class => fn() => new AdminColumnFactory,
    FilterFactory::class => fn() => new FilterFactory,

    KanaController::class => function($c) {
        return (new KanaController())
            ->setPostTypeFactory($c->get(PostTypeFactory::class))
            ->setTaxonomyFactory($c->get(TaxonomyFactory::class))
            ->setMetaboxFactory($c->get(MetaboxFactory::class))
            ->setAdminColumnFactory($c->get(AdminColumnFactory::class))
            ->setFilterFactory($c->get(FilterFactory::class))
        ;
    },

    EnqueueController::class => function($c) {
        return (new EnqueueController);
    }
];