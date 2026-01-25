<?php

namespace Diconais\Core\AdminColumn;

/**
 * AbstractAdminColumn
 * Cette classe permet de gérer les colonnes d'administration d'un post / page :
 */
abstract class AbstractAdminColumn
{
    /**
     * columns
     *
     * @param  int $priority
     * @return self
     */
    public function columns(int $priority = 10): self
    {
        \add_filter('manage_' . $this->getPostType() . '_posts_columns', [$this, 'manageColumns'], $priority);
        \add_action('manage_' . $this->getPostType() . '_posts_custom_column', [$this, 'manageValues'], $priority, 2);

        return $this;
    }

    /**
     * sortable
     *
     * @param  int $priority
     * @return self
     */
    public function sortable(int $priority = 10): self
    {
        \add_filter('manage_edit-' . $this->getPostType() . '_sortable_columns', [$this, 'sortableColumns'], $priority);

        return $this;
    }

    /**
     * sortableColumns
     *
     * @param  string[] $columns
     * @return string[]
     */
    public function sortableColumns(array $columns): array
    {
        return array_merge($columns, $this->getColumnsSortable());
    }

    /**
     * manageColumns
     *
     * @param  string[] $columns
     * @return string[]
     */
    public function manageColumns(array $columns): array
    {
        if (empty($this->getColumns())) {
            return $columns;
        }

        $index = array_search('date', array_keys($columns), true);
        if ($index === false) {
            return array_merge($columns, $this->getColumns());
        }

        $before = array_slice($columns, 0, $index, true);
        $after = array_slice($columns, $index, null, true);

        $insert = $this->getColumns();

        return $before + $insert + $after;
    }

    /**
     * manageValues
     *
     * @param  string $column
     * @param  int $post_id
     * @return void
     */
    public function manageValues(string $column, int $post_id): void
    {
        foreach (array_keys($this->getColumns()) as $columnKey) {
            if ($column == $columnKey) {
                $value = \get_post_meta($post_id, $columnKey, true);

                echo $this->renderHtml($columnKey, $value);
            }
        }
    }

    /**
     * getPostType
     *
     * @return string
     */
    public function getPostType(): string
    {
        return 'post';
    }

    /**
     * renderHtml
     *
     * @param  string $key
     * @param  mixed $value
     * @return string
     */
    private function renderHtml(string $key, mixed $value): string
    {
        if (! str_contains($key, '_is')) {
            return $value;
        }

        $classes = 'dn_badge';
        if ($value) {
            $isValue = 'oui';
            $classes .= ' dn_is_true';
        } else {
            $isValue = 'non';
            $classes .= ' dn_is_false';
        }

        return sprintf("<span class='%s'>%s</span>", esc_attr($classes), $isValue);
    }

    /**
     * getColumns
     * Retourne la liste des colonnes à ajouter
     *
     * @return string[]
     */
    abstract public function getColumns(): array;

    /**
     * getColumnsSortable
     * Retourne la liste des colonnes à trier
     *
     * @return string[]
     */
    abstract public function getColumnsSortable(): array;
}
