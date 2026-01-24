<?php

/**
 * Plugin Name: Diconais
 * Description: Ajoute des fonctionnalités pour le projet Diconais.
 * Version: 1.0.0
 * Author: Geoffroy Colpart
 */

use Diconais\Plugin;
use Diconais\Container\Container;
use Diconais\Controller\KanaController;
use Diconais\Controller\EnqueueController;

if (!defined('ABSPATH')) exit;

define("DN_TEMPLATES", WP_PLUGIN_DIR . "/diconais/templates/");
define("DN_ASSETS", WP_PLUGIN_URL . "/diconais/assets/");

require_once __DIR__ . '/vendor/autoload.php';

$container = new Container;
$container->loadFromFile(__DIR__ . '/config/container.php');

$plugin = Plugin::get_instance();
$plugin
    ->add_controller($container->get(EnqueueController::class))
    ->add_controller($container->get(KanaController::class))
;

$plugin->boot();