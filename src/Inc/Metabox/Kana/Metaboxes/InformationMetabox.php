<?php

namespace Diconais\Inc\Metabox\Kana\Metaboxes;

use Diconais\Core\Metabox\MetaboxInterface;

class InformationMetabox implements MetaboxInterface
{
    /**
     * __construct
     *
     * @param  array<string, mixed> $data
     * @return void
     */
    public function __construct(private array $data = [])
    {
    }

    public function id(): string
    {
        return 'information_kana';
    }

    public function title(): string
    {
        return 'Informations';
    }

    public function callback(): mixed
    {
        return fn ($post, $metabox) => include DN_TEMPLATES . 'admin/metabox/kana/information.php';
    }

    public function postType(): string
    {
        return 'dn_kana';
    }

    public function context(): ?string
    {
        return null;
    }

    public function priority(): ?string
    {
        return null;
    }

    /**
     * callbackArgs
     *
     * @return array<string, mixed>
     */
    public function callbackArgs(): array
    {
        return $this->data;
    }
}
