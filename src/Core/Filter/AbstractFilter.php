<?php

namespace Diconais\Core\Filter;

abstract class AbstractFilter
{
    public function hookTaxonomies(int $priority = 10): self
    {
        \add_action('restrict_manage_posts', [$this, 'filterTaxonomies'], $priority);
        \add_filter('request', [$this, 'filterTaxonomiesResults'], $priority);

        return $this;
    }

    public function hookFilterPostMetas(int $priority = 10): self
    {
        \add_action('restrict_manage_posts', [$this, 'filterPostMetas'], $priority);
        \add_action('parse_query', [$this, 'filterPostMetasResult'], $priority);

        return $this;
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

    public function filterPostMetas(): void
    {
        global $typenow;
        if ($typenow === $this->getPostType()) {
            foreach ($this->getPostMetaData() as $postMeta => $data) {
                $current = isset($_GET[$postMeta]) ? sanitize_text_field($_GET[$postMeta]) : '';

                echo '<select name="' . esc_attr($postMeta) . '">';
                echo '<option value="">' . esc_html($data['title']) . '</option>';
                foreach ($data['values'] as $val => $label) {
                    printf('<option value="%s" %s>%s</option>', esc_attr($val), selected($val, $current, false), $label);
                }
                echo '</select>';
            }
        }
    }

    /**
     * filterPostMetasResult
     *
     * @param  \WP_Query $query
     * @return void
     */
    public function filterPostMetasResult(\WP_Query $query): void
    {
        global $pagenow, $typenow;

        $metaFilters = [];
        foreach (array_keys($this->getPostMetaData()) as $meta_key) {
            if (
                is_admin() &&
                $pagenow === 'edit.php' &&
                $typenow === $this->getPostType() &&
                isset($_GET[$meta_key]) &&
                $_GET[$meta_key] !== ''
            ) {

                $metaFilters[] = [
                    'key'     => $meta_key,
                    'value'   => sanitize_text_field($_GET[$meta_key]),
                    'compare' => '=',
                ];
            }
        }

        if (!empty($metaFilters)) {
            $query->set('meta_query', [
                'relation' => 'AND',
                $metaFilters,
            ]);
        }
    }

    /**
     * filterTaxonomies
     *
     * @return void
     */
    public function filterTaxonomies(): void
    {
        global $typenow;

        if ($typenow === $this->getPostType()) {
            foreach ($this->getTaxonomiesData() as $taxonomy => $data) {
                $selected = isset($_GET[$taxonomy]) ? sanitize_text_field($_GET[$taxonomy]) : '';
                $data = array_merge($data, ['selected' => $selected]);
                wp_dropdown_categories($data);
            }
        }
    }

    /**
     * filterTaxonomiesResults
     *
     * @param  string[] $request
     * @return string[]
     */
    public function filterTaxonomiesResults(array $request): array
    {
        global $typenow;

        if (is_admin() && $typenow == $this->getPostType()) {
            foreach (array_keys($this->getTaxonomiesData()) as $taxonomy) {
                if (isset($request[$taxonomy]) && $request[$taxonomy]) {
                    $term = get_term_by('id', $request[$taxonomy], $taxonomy);
                    if ($term) {
                        $request[$taxonomy] = $term->slug;
                    }
                }
            }
        }

        return $request;
    }

    /**
     * getTaxonomiesData
     *
     * @return array<string, mixed>
     */
    abstract public function getTaxonomiesData(): array;

    /**
     * getPostMetaData
     *
     * @return array<string, mixed>
     */
    abstract public function getPostMetaData(): array;
}
