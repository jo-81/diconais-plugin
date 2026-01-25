<?php

namespace Diconais\Controller;

use Diconais\Inc\PostType\KanaPostType;
use Diconais\Abstract\AbstractController;
use Diconais\Inc\Metabox\Kana\KanaMetabox;
use Diconais\Inc\Taxonomy\KanaTypeTaxonomy;
use Diconais\Inc\AdminColumn\Kana\KanaAdminColumn;

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

        if ($this->taxonomyFactory) {
            $this->registerTaxonomy();
        }

        if ($this->metaboxFactory) {
            $this->registerMetabox();
        }

        if ($this->adminColumnFactory) {
            $this->registerAdminColum();
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

    /**
     * registerTaxonomy
     *
     * @return void
     */
    public function registerTaxonomy(): void
    {
        $this->taxonomyFactory->set('dn_kana_type', KanaTypeTaxonomy::get(), ['dn_kana'])->hook();
    }

    /**
     * registerMetabox
     *
     * @return void
     */
    public function registerMetabox(): void
    {
        $metabox = $this->metaboxFactory->create(KanaMetabox::class);
        $metabox->hook();
    }

    public function registerAdminColum(): void
    {
        $columnFactory = $this->adminColumnFactory->create(KanaAdminColumn::class);
        $columnFactory
            ->columns()
            ->sortable()
        ;
    }
}
