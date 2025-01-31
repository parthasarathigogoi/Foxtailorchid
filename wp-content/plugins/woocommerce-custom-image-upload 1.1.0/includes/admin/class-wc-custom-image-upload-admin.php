<?php
if (!defined('ABSPATH')) {
    exit;
}

class WC_Custom_Image_Upload_Admin {
    public function __construct() {
        // Add meta box to product edit page
        add_action('add_meta_boxes', array($this, 'add_meta_box'));

        // Save meta box data
        add_action('save_post_product', array($this, 'save_meta_box'));
    }

    // Add meta box to product edit page
    public function add_meta_box() {
        add_meta_box(
            'wc_custom_image_upload', // Meta box ID
            'Enable Customization', // Title
            array($this, 'meta_box_callback'), // Callback function
            'product', // Post type (WooCommerce product)
            'side', // Context (side, normal, advanced)
            'default' // Priority
        );
    }

    // Meta box callback function
    public function meta_box_callback($post) {
        $enable_customization = get_post_meta($post->ID, '_enable_customization', true);
        $required_images = get_post_meta($post->ID, '_required_images', true);
        ?>
        <label for="enable_customization">
            <input type="checkbox" name="enable_customization" id="enable_customization" value="yes" <?php checked($enable_customization, 'yes'); ?>>
            Enable customization for this product
        </label>
        <label for="required_images">
            Number of Required Images:
            <input type="number" name="required_images" id="required_images" value="<?php echo esc_attr($required_images); ?>" min="1">
        </label>
        <?php
    }

    // Save meta box data
    public function save_meta_box($post_id) {
        if (isset($_POST['enable_customization'])) {
            update_post_meta($post_id, '_enable_customization', 'yes');
            update_post_meta($post_id, '_required_images', absint($_POST['required_images']));
        } else {
            delete_post_meta($post_id, '_enable_customization');
            delete_post_meta($post_id, '_required_images');
        }
    }
}