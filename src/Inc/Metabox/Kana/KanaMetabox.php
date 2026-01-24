<?php

namespace Diconais\Inc\Metabox\Kana;

use Diconais\Core\Metabox\AbstractMetabox;
use Diconais\Core\Metabox\MetaboxInterface;
use Diconais\Core\Validation\Validator\NotEmpty;
use Diconais\Core\Validation\Validator\IsNegative;
use Diconais\Inc\Metabox\Kana\Metaboxes\InformationMetabox;

class KanaMetabox extends AbstractMetabox
{
    /**
     * getMetaboxes
     *
     * @return MetaboxInterface[]
     */
    public function getMetaboxes(): array
    {
        return [
            new InformationMetabox($this->getDataForMetaboxes()),
        ];
    }

    public function getPostType(): string
    {
        return 'dn_kana';
    }

    /**
     * getDataForMetaboxes
     * Permet d'envoyer des données aux différentes métaboxes
     *
     * @return string[]
     */
    public function getDataForMetaboxes(): array
    {
        return [
            'nonce'  => 'dn_metabox_information_kana_nonce',
            'action' => 'dn_save_information_kana_action',
        ];
    }

    /**
     * getMethodVerifyByField
     *
     * @return array<string, string[]>
     */
    public function getMethodVerifyByField(): array
    {
        return [
            'dn_kana_position'       => [NotEmpty::class, IsNegative::class],
            'dn_kana_romaji'         => [NotEmpty::class],
            'dn_kana_kunrei'         => [],
            'dn_kana_is_combinaison' => [],
            'dn_kana_is_accent'      => [],
        ];
    }
}
