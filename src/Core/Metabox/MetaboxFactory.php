<?php

namespace Diconais\Core\Metabox;

class MetaboxFactory
{
    public function create(string $metaboxName): AbstractMetabox
    {
        return new $metaboxName();
    }
}
