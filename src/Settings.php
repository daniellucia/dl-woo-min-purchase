<?php

namespace DL\WooMinPurchase;

defined('ABSPATH') || exit;

class Settings
{

    /**
     * Creamos el menú de configuración
     * @return void
     * @author Daniel Lucia
     */
    public function addSettingsPage()
    {
        add_submenu_page(
            'woocommerce',
            __('Minimum purchase', 'dl-woo-min-purchase'),
            __('Minimum purchase', 'dl-woo-min-purchase'),
            'manage_woocommerce',
            'dl-woo-min-purchase',
            [$this, 'renderSettingsPage']
        );
    }

    /**
     * Registramos configuración
     * @return void
     */

    public function registerSettings()
    {
        register_setting('dl_woo_min_purchase_settings', 'dl_woo_min_purchase_global');
        add_settings_section('dl_woo_min_purchase_section', '', null, 'dl-woo-min-purchase');
        add_settings_field(
            'dl_woo_min_purchase_global',
            __('Minimum global purchase amount', 'dl-woo-min-purchase'),
            [$this, 'renderGlobalMinField'],
            'dl-woo-min-purchase',
            'dl_woo_min_purchase_section'
        );
    }

    /**
     * Mostramos página de configuración
     * @return void
     * @author Daniel Lucia
     */
    public function renderSettingsPage()
    {
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('Minimum purchase configuration', 'dl-woo-min-purchase'); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('dl_woo_min_purchase_settings');
                do_settings_sections('dl-woo-min-purchase');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Mostramos el campo de importe mínimo global
     * @return void
     * @author Daniel Lucia
     */
    public function renderGlobalMinField()
    {
        $value = get_option('dl_woo_min_purchase_global', 0);
        echo '<input type="number" min="0" step="0.01" name="dl_woo_min_purchase_global" value="' . esc_attr($value) . '" />';
        echo '<p class="description">' . esc_html__('If zero, there is no overall minimum purchase.', 'dl-woo-min-purchase') . '</p>';
    }
}
