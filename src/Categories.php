<?php 

namespace DL\WooMinPurchase;

defined('ABSPATH') || exit;

class Categories {
    
    /**
     * Agregamos campo en categorías de producto
     * @return void
     * @author Daniel Lucia
     */
    public function addCategoryMinField()
    {
        ?>
        <div class="form-field">
            <label for="dl_woo_min_purchase_cat"><?php esc_html_e('Minimum purchase amount for this category', 'dl-woo-min-purchase'); ?></label>
            <input type="number" min="0" step="0.01" name="dl_woo_min_purchase_cat" id="dl_woo_min_purchase_cat" value="" />
            <p class="description"><?php esc_html_e('If zero, there is no minimum purchase for this category.', 'dl-woo-min-purchase'); ?></p>
        </div>
        <?php
    }

    /**
     * Editamos campo en categorías de producto
     * @param mixed $term
     * @return void
     * @author Daniel Lucia
     */
    public function editCategoryMinField($term)
    {
        $value = get_term_meta($term->term_id, 'dl_woo_min_purchase_cat', true);
        ?>
        <tr class="form-field">
            <th scope="row"><label for="dl_woo_min_purchase_cat"><?php esc_html_e('Minimum purchase amount for this category', 'dl-woo-min-purchase'); ?></label></th>
            <td>
                <input type="number" min="0" step="0.01" name="dl_woo_min_purchase_cat" id="dl_woo_min_purchase_cat" value="<?php echo esc_attr($value); ?>" />
                <p class="description"><?php esc_html_e('If zero, there is no minimum purchase for this category.', 'dl-woo-min-purchase'); ?></p>
            </td>
        </tr>
        <?php
    }

    /**
     * Guardamos el campo de importe mínimo en la categoría
     * @param mixed $term_id
     * @return void
     * @author Daniel Lucia
     */
    public function saveCategoryMinField($term_id)
    {
        $value = isset($_POST['dl_woo_min_purchase_cat']) ? floatval($_POST['dl_woo_min_purchase_cat']) : 0;
        update_term_meta($term_id, 'dl_woo_min_purchase_cat', $value);
    }
}