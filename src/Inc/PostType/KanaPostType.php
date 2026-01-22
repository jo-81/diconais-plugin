<?php

namespace Diconais\Inc\PostType;

/**
 * @codeCoverageIgnore
 */
class KanaPostType
{
    /**
     * get
     *
     * @return array<string, mixed>
     */
    public static function get(): array
    {
        $labels = [
            'name'               => 'Kana',
            'singular_name'      => 'Kana',
            'menu_name'          => 'Kana',
            'all_items'          => 'Tous les kana',
            'view_item'          => 'Voir les kana',
            'add_new_item'       => 'Ajouter kana',
            'add_new'            => 'Ajouter',
            'edit_item'          => 'Editer le kana',
            'update_item'        => 'Modifier le kana',
            'search_items'       => 'Rechercher un kana',
            'not_found'          => 'Non trouvée',
            'not_found_in_trash' => 'Non trouvée dans la corbeille',
        ];

        return [
            'label'               => 'Kana',
            'description'         => 'La liste des kana',
            'exclude_from_search' => false,
            'labels'              => $labels,
            'supports'            => ['title'],
            'show_in_rest'        => false,
            'hierarchical'        => false,
            'public'              => true,
            'has_archive'         => true,
            'rewrite'             => [ 'slug' => 'kana'],
            'menu_position'       => 5,
        ];
    }
}
