<?php

/**
 * Plugin Name: Minimum Purchase for WooCoomerce
 * Description: WooCommerce plugin to configure minimum purchase amounts globally and per category.
 * Version: 0.0.1
 * Author: Daniel Lúcia
 * Author URI: http://www.daniellucia.es
 * textdomain: dl-woo-min-purchase
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

/*
Copyright (C) 2025  Daniel Lucia (https://daniellucia.es)

Este programa es software libre: puedes redistribuirlo y/o modificarlo
bajo los términos de la Licencia Pública General GNU publicada por
la Free Software Foundation, ya sea la versión 2 de la Licencia,
o (a tu elección) cualquier versión posterior.

Este programa se distribuye con la esperanza de que sea útil,
pero SIN NINGUNA GARANTÍA; ni siquiera la garantía implícita de
COMERCIABILIDAD o IDONEIDAD PARA UN PROPÓSITO PARTICULAR.
Consulta la Licencia Pública General GNU para más detalles.

Deberías haber recibido una copia de la Licencia Pública General GNU
junto con este programa. En caso contrario, consulta <https://www.gnu.org/licenses/gpl-2.0.html>.
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
