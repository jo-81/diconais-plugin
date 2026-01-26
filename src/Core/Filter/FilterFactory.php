<?php

namespace Diconais\Core\Filter;

class FilterFactory
{
    public function create(string $filterClassName): AbstractFilter
    {
        if (! class_exists($filterClassName)) {
            throw new \Exception(sprintf("La classe de filtre %s n'existe pas.", $filterClassName));
        }

        $instance = new $filterClassName();

        if (! is_a($instance, AbstractFilter::class)) {
            throw new \Exception(sprintf("La classe de filtre %s n'étends pas la classe AbstractFilter.", $filterClassName));
        }

        return new $filterClassName();
    }
}
