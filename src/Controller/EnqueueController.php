<?php

namespace Diconais\Controller;

use Diconais\Abstract\AbstractController;

class EnqueueController extends AbstractController
{
    public function load(): void
    {
        add_action('admin_enqueue_scripts', [$this, 'registerEnqueue']);
    }

    public function registerEnqueue(string $hook_suffix): void
    {
        wp_enqueue_style('dn_admin_css', DN_ASSETS . 'css/style.css');
    }
}
