<?php

namespace Diconais\Abstract;

use Diconais\Core\PostTypeFactory;
use Diconais\Core\TaxonomyFactory;
use Diconais\Core\Filter\FilterFactory;
use Diconais\Core\Metabox\MetaboxFactory;
use Diconais\Interface\ControllerInterface;
use Diconais\Core\AdminColumn\AdminColumnFactory;

abstract class AbstractController implements ControllerInterface
{
    protected ?PostTypeFactory $postTypeFactory = null;

    protected ?TaxonomyFactory $taxonomyFactory = null;

    protected ?MetaboxFactory $metaboxFactory = null;

    protected ?AdminColumnFactory $adminColumnFactory = null;

    protected ?FilterFactory $FilterFactory = null;

    public function load(): void
    {
        $reflection = new \ReflectionClass($this);
        $properties = $reflection->getProperties();

        foreach ($properties as $property) {
            if (is_null($property->getValue($this))) {
                continue;
            }

            $name = str_replace('Factory', '', $property->getName());
            $registerMethod = 'register' . ucfirst($name);
            if (method_exists($this, $registerMethod)) {
                $this->$registerMethod();
            }
        }
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

    /**
     * setAdminColumnFactory
     *
     * @param  AdminColumnFactory $adminColumnFactory
     * @return self
     */
    public function setAdminColumnFactory(AdminColumnFactory $adminColumnFactory): self
    {
        $this->adminColumnFactory = $adminColumnFactory;

        return $this;
    }

    /**
     * setFilterFactory
     *
     * @param  FilterFactory $FilterFactory
     * @return self
     */
    public function setFilterFactory(FilterFactory $FilterFactory): self
    {
        $this->FilterFactory = $FilterFactory;

        return $this;
    }
}
