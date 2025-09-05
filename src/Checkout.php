<?php 

namespace DL\WooMinPurchase;

defined('ABSPATH') || exit;

class Checkout {

    /**
     * Validamos el importe mínimo en el checkout
     * @return void
     * @author Daniel Lucia
     */
    public function checkMinPurchase()
    {
        $global_min = floatval(get_option('dl_woo_min_purchase_global', 0));
        $cart_total = floatval(WC()->cart->get_total('edit'));

        // Validamos de forma global
        if ($global_min > 0 && $cart_total < $global_min) {
            wc_add_notice(
                sprintf(__('The minimum purchase amount is %s.', 'dl-woo-min-purchase'), wc_price($global_min)),
                'error'
            );
        }

        // Validación por categoría
        $cat_mins = [];
        foreach (WC()->cart->get_cart() as $cart_item) {
            $product_id = $cart_item['product_id'];
            $terms = get_the_terms($product_id, 'product_cat');
            if ($terms && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    $min = floatval(get_term_meta($term->term_id, 'dl_woo_min_purchase_cat', true));
                    if ($min > 0) {
                        if (!isset($cat_mins[$term->term_id])) {
                            $cat_mins[$term->term_id] = [
                                'min' => $min,
                                'total' => 0,
                                'name' => $term->name,
                            ];
                        }
                        $cat_mins[$term->term_id]['total'] += $cart_item['line_total'];
                    }
                }
            }
        }
        foreach ($cat_mins as $cat) {
            if ($cat['total'] < $cat['min']) {
                wc_add_notice(
                    sprintf(__('The minimum purchase amount for the category "%s" is %s.', 'dl-woo-min-purchase'), $cat['name'], wc_price($cat['min'])),
                    'error'
                );
            }
        }
    }
}