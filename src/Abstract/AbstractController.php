<?php

namespace Diconais\Abstract;

use Diconais\Core\PostTypeFactory;
use Diconais\Core\TaxonomyFactory;
use Diconais\Core\Metabox\MetaboxFactory;
use Diconais\Interface\ControllerInterface;

abstract class AbstractController implements ControllerInterface
{
    protected ?PostTypeFactory $postTypeFactory = null;

    protected ?TaxonomyFactory $taxonomyFactory = null;

    protected ?MetaboxFactory $metaboxFactory = null;

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

    /**
     * setTaxonomyFactory
     *
     * @param  TaxonomyFactory $taxonomyFactory
     * @return self
     */
    public function setTaxonomyFactory(TaxonomyFactory $taxonomyFactory): self
    {
        $this->taxonomyFactory = $taxonomyFactory;

        return $this;
    }

    /**
     * setMetaboxFactory
     *
     * @param  MetaboxFactory $metaboxFactory
     * @return self
     */
    public function setMetaboxFactory(MetaboxFactory $metaboxFactory): self
    {
        $this->metaboxFactory = $metaboxFactory;

        return $this;
    }
}
