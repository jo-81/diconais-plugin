<?php

/**
 * Plugin Name: Diconais
 * Description: Ajoute des fonctionnalités pour le projet Diconais.
 * Version: 1.0.0
 * Author: Geoffroy Colpart
 */

use Diconais\Container\Container;
use Diconais\Plugin;

if (!defined('ABSPATH')) exit;

require_once __DIR__ . '/vendor/autoload.php';

$container = new Container;

$plugin = Plugin::get_instance();

$plugin->boot();