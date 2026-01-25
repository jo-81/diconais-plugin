<?php

namespace Diconais\Inc\AdminColumn\Kana;

use Diconais\Core\AdminColumn\AbstractAdminColumn;

class KanaAdminColumn extends AbstractAdminColumn
{
    public function getPostType(): string
    {
        return 'dn_kana';
    }

    /**
     * getColumns
     *
     * [
     *      'cb' => '<input .../>'
     *      'title' => 'Titre'
     *       ... <- données insérées ici
     *      'date' => 'Date'
     * ]
     *
     * @return string[]
     */
    public function getColumns(): array
    {
        return [
            'dn_kana_romaji'         => 'Romaji',
            'dn_kana_kunrei'         => 'Kunrei',
            'dn_kana_is_combinaison' => 'Combinaison ?',
            'dn_kana_is_accent'      => 'Accent ?',
        ];
    }

    /**
     * getColumnsSortable
     *
     * @return string[]
     */
    public function getColumnsSortable(): array
    {
        return array_merge($this->getColumns(), ['taxonomy-dn_kana_type' => 'Type']);
    }
}
