<?php

/**
 * Plugin Name: Minimum Purchase for WooCoomerce
 * Description: WooCommerce plugin to configure minimum purchase amounts globally and per category.
 * Version: 0.0.1
 * Author: Daniel Lúcia
 * Author URI: http://www.daniellucia.es
 * textdomain: dl-woo-min-purchase
 */


defined('ABSPATH') || exit;

require_once __DIR__ . '/vendor/autoload.php';

use DL\WooMinPurchase\Plugin;

define('DL_WOO_MIN_PURCHASE_VERSION', '0.0.1');
define('DL_WOO_MIN_PURCHASE_FILE', __FILE__);

add_action('plugins_loaded', function () {

    load_plugin_textdomain('dl-woo-min-purchase', false, dirname(plugin_basename(__FILE__)) . '/languages');

    $plugin = new Plugin();
    $plugin->init();
});
