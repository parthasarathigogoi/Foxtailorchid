<?php
if (!defined('ABSPATH')) {
    exit;
}

class WC_Custom_Image_Upload {
    public function __construct() {
        // Add "Customize Now" button and modal
        add_action('woocommerce_before_add_to_cart_button', array($this, 'add_customize_button'));

        // Validate customization before adding to cart
        add_filter('woocommerce_add_to_cart_validation', array($this, 'validate_customization'), 10, 3);

        // Save customization data to cart item
        add_filter('woocommerce_add_cart_item_data', array($this, 'save_customization_data'), 10, 3);

        // Display customization data in cart
        add_filter('woocommerce_get_item_data', array($this, 'display_customization_data'), 10, 2);

        // Save customization data to order meta
        add_action('woocommerce_checkout_create_order_line_item', array($this, 'save_order_item_meta'), 10, 4);
    }

    // Add "Customize Now" button and modal
    public function add_customize_button() {
        global $product;
        if (get_post_meta($product->get_id(), '_enable_customization', true) === 'yes') {
            ?>
            <button id="customize-now-button" class="button">Customize Now</button>
            <div id="customize-modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form id="customization-form">
                        <label for="customer_name">Your Name:</label>
                        <input type="text" name="customer_name" id="customer_name" required>
                        <label for="customer_message">Your Message:</label>
                        <textarea name="customer_message" id="customer_message" required></textarea>
                        <label for="customer_images">Upload Images (Max 5MB each):</label>
                        <input type="file" name="customer_images[]" id="customer_images" multiple accept=".jpg,.jpeg,.png" required>
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
            <?php
        }
    }

    // Validate customization before adding to cart
    public function validate_customization($passed, $product_id, $quantity) {
        if (get_post_meta($product_id, '_enable_customization', true) === 'yes') {
            if (empty($_POST['customer_name']) || empty($_POST['customer_message']) || empty($_FILES['customer_images']['name'][0])) {
                wc_add_notice(__('Please complete the customization form.', 'woocommerce'), 'error');
                return false;
            }
        }
        return $passed;
    }

    // Save customization data to cart item
    public function save_customization_data($cart_item_data, $product_id, $variation_id) {
        if (isset($_POST['customer_name']) && isset($_POST['customer_message']) && isset($_FILES['customer_images'])) {
            $cart_item_data['customization'] = array(
                'customer_name' => sanitize_text_field($_POST['customer_name']),
                'customer_message' => sanitize_text_field($_POST['customer_message']),
                'customer_images' => array(),
            );

            foreach ($_FILES['customer_images']['tmp_name'] as $key => $tmp_name) {
                $file = array(
                    'name' => $_FILES['customer_images']['name'][$key],
                    'type' => $_FILES['customer_images']['type'][$key],
                    'tmp_name' => $tmp_name,
                    'error' => $_FILES['customer_images']['error'][$key],
                    'size' => $_FILES['customer_images']['size'][$key],
                );

                $upload = wp_handle_upload($file, ['test_form' => false]);
                if (isset($upload['file'])) {
                    $cart_item_data['customization']['customer_images'][] = $upload['url'];
                }
            }
        }
        return $cart_item_data;
    }

    // Display customization data in cart
    public function display_customization_data($item_data, $cart_item) {
        if (isset($cart_item['customization'])) {
            $item_data[] = array(
                'key' => __('Customer Name', 'woocommerce'),
                'value' => $cart_item['customization']['customer_name'],
            );
            $item_data[] = array(
                'key' => __('Customer Message', 'woocommerce'),
                'value' => $cart_item['customization']['customer_message'],
            );
            foreach ($cart_item['customization']['customer_images'] as $image) {
                $item_data[] = array(
                    'key' => __('Customer Image', 'woocommerce'),
                    'value' => '<img src="' . esc_url($image) . '" width="100" height="100">',
                );
            }
        }
        return $item_data;
    }

    // Save customization data to order meta
    public function save_order_item_meta($item, $cart_item_key, $values, $order) {
        if (isset($values['customization'])) {
            $item->add_meta_data(__('Customer Name', 'woocommerce'), $values['customization']['customer_name']);
            $item->add_meta_data(__('Customer Message', 'woocommerce'), $values['customization']['customer_message']);
            foreach ($values['customization']['customer_images'] as $image) {
                $item->add_meta_data(__('Customer Image', 'woocommerce'), $image);
            }
        }
    }
}