<?php

namespace Diconais\Inc\Filter\Kana;

use Diconais\Core\Filter\AbstractFilter;

class KanaFilter extends AbstractFilter
{
    public function getPostType(): string
    {
        return 'dn_kana';
    }

    /**
     * getTaxonomiesData
     *
     * @return array<string, mixed>
     */
    public function getTaxonomiesData(): array
    {
        return [
            'dn_kana_type' => [
                'show_option_all' => 'Toutes les types',
                'taxonomy'        => 'dn_kana_type',
                'name'            => 'dn_kana_type',
                'orderby'         => 'name',
                'hierarchical'    => true,
                'show_count'      => true,
                'hide_empty'      => true,
            ],
        ];
    }

    /**
     * getPostMetaData
     *
     * @return array<string, mixed>
     */
    public function getPostMetaData(): array
    {
        return [
            'dn_kana_is_combinaison' => [
                'title'  => 'Tous les kana - Combinaisons',
                'values' => ['1' => 'Oui', '0' => 'Non'],
            ],
            'dn_kana_is_accent' => [
                'title'  => 'Tous les kana - Accents',
                'values' => ['1' => 'Oui', '0' => 'Non'],
            ],
        ];
    }
}
