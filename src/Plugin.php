<?php

namespace DL\WooMinPurchase;

defined('ABSPATH') || exit;

class Plugin
{
    public function init()
    {
        $settings = new Settings();
        add_action('admin_menu', [$settings, 'addSettingsPage']);
        add_action('admin_init', [$settings, 'registerSettings']);

        $categories = new Categories();
        add_action('product_cat_add_form_fields', [$categories, 'addCategoryMinField']);
        add_action('product_cat_edit_form_fields', [$categories, 'editCategoryMinField']);
        add_action('created_product_cat', [$categories, 'saveCategoryMinField']);
        add_action('edited_product_cat', [$categories, 'saveCategoryMinField']);

        $checkout = new Checkout();
        add_action('woocommerce_checkout_process', [$checkout, 'checkMinPurchase']);

        $cart = new Cart();
        add_action('woocommerce_before_cart', [$cart, 'showMinPurchaseNotice']);
    }
}
