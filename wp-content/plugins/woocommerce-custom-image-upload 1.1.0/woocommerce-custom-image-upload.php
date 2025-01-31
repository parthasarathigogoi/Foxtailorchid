<?php
/**
 * Plugin Name: WooCommerce Custom Image Upload
 * Description: Adds a "Customize Now" button to product pages with a modal for text and image upload.
 * Version: 1.1.0
 * Author: MriduPawan Shandilya
 */

if (!defined('ABSPATH')) {
    exit;
}

// Define plugin path
define('WC_CUSTOM_IMAGE_UPLOAD_PATH', plugin_dir_path(__FILE__));

// Include necessary files
require_once WC_CUSTOM_IMAGE_UPLOAD_PATH . 'includes/class-wc-custom-image-upload.php';
require_once WC_CUSTOM_IMAGE_UPLOAD_PATH . 'includes/admin/class-wc-custom-image-upload-admin.php';

// Initialize the plugin
function wc_custom_image_upload_init() {
    $wc_custom_image_upload = new WC_Custom_Image_Upload();
    $wc_custom_image_upload_admin = new WC_Custom_Image_Upload_Admin();
}
add_action('plugins_loaded', 'wc_custom_image_upload_init');

// Enqueue CSS and JS
function wc_custom_image_upload_scripts() {
    if (is_product()) {
        // CSS
        wp_enqueue_style('wc-custom-image-upload-style', plugins_url('assets/css/style.css', __FILE__));

        // JavaScript
        wp_enqueue_script('wc-custom-image-upload-script', plugins_url('assets/js/script.js', __FILE__), array('jquery'), '1.0', true);

        // Localize script for AJAX
        wp_localize_script('wc-custom-image-upload-script', 'wc_custom_image_upload', array(
            'ajax_url' => admin_url('admin-ajax.php'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'wc_custom_image_upload_scripts');