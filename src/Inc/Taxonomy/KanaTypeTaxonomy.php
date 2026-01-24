<?php

namespace Diconais\Inc\Taxonomy;

/**
 * @codeCoverageIgnore
 */
class KanaTypeTaxonomy
{
    /**
     * get
     *
     * @return array<string, mixed>
     */
    public static function get(): array
    {
        $labels = [
            'name'                       => 'Types',
            'singular_name'              => 'Type',
            'search_items'               => 'Chercher un type',
            'all_items'                  => 'Tous les types',
            'edit_item'                  => 'Editer le type',
            'update_item'                => 'Mettre à jour le type',
            'add_new_item'               => 'Ajouter un nouveau type',
            'new_item_name'              => 'Valeur du nouveau type',
            'separate_items_with_commas' => 'Séparer les types avec une virgule',
            'menu_name'                  => 'Type',
        ];

        return [
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_in_menu'      => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => [ 'slug' => 'type' ],
        ];
    }
}
