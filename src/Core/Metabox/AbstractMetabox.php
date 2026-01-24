<?php

namespace Diconais\Core\Metabox;

use Diconais\Core\Flash\MessageFlash;
use Diconais\Core\Validation\ValidatorFactory;

/**
 * AbstractMetabox
 * Cette permet de fournir des méthodes permettant pour chaque classe l'étendant de pouvoir :
 *  - enregistrer les métaboxes selon un custom post type
 *  - sauvegarder les données des métaboxes
 *  - faire des vérifications de données
 */
abstract class AbstractMetabox
{
    public function hook(int $priority = 10): void
    {
        \add_action('add_meta_boxes_' . $this->getPostType(), [$this, 'register'], $priority);
        \add_action('save_post_' . $this->getPostType(), [$this, 'save'], $priority);
    }

    /**
     * register
     *
     * @return void
     */
    public function register(): void
    {
        foreach ($this->getMetaboxes() as $metabox) {
            \add_meta_box(
                $metabox->id(),
                $metabox->title(),
                $metabox->callback(),
                $metabox->postType(),
                $metabox->context() ?? 'advanced',
                $metabox->priority() ?? 'default',
                $metabox->callbackArgs()
            );
        }
    }

    public function save(int $post_id): void
    {
        $data = $this->getDataForMetaboxes();
        if (!isset($data['nonce'], $data['action'])) {
            return;
        }

        if (!isset($_POST[$data['nonce']]) || !wp_verify_nonce($_POST[$data['nonce']], $data['action'])) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        foreach ($this->getMethodVerifyByField() as $field => $methods) {

            if (isset($_POST[$field])) {
                $value = sanitize_text_field(wp_unslash($_POST[$field]));
                if (empty($methods)) {
                    update_post_meta($post_id, $field, sanitize_text_field($value));
                } else {
                    foreach ($methods as $method) {
                        $validator = ValidatorFactory::create($method);
                        $result = $validator->isValid($value);
                        if ($result) {
                            update_post_meta($post_id, $field, sanitize_text_field($value));
                        } else {
                            MessageFlash::add($validator->message(), 'error', $field);
                        }
                    }
                }
            }
        }
    }

    /**
     * getMethodVerifyByField
     *
     * @return  array<string, string[]>
     */
    public function getMethodVerifyByField(): array
    {
        return [];
    }

    /**
     * getMetaboxes
     *
     * @return MetaboxInterface[]
     */
    abstract public function getMetaboxes(): array;

    abstract public function getPostType(): string;

    /**
     * getDataForMetaboxes
     *
     * @return array<string, mixed>
     */
    abstract public function getDataForMetaboxes(): array;
}
