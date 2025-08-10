<?php
/**
 * Plugin Name: DWC Nav Pro for Bricks
 * Plugin URI: https://yoursite.com
 * Description: Responsive navigation element for Bricks Builder with nestable components
 * Version: 1.0.0
 * Author: Your Name
 * License: GPL v2 or later
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants
define( 'DWC_NAV_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'DWC_NAV_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'DWC_NAV_VERSION', '1.0.0' );

class DWC_Nav_Pro_Plugin {
    
    public function __construct() {
        add_action( 'init', array( $this, 'init' ), 11 );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
    }
    
    public function init() {
        // Check if Bricks is active
        if ( ! class_exists( '\Bricks\Elements' ) ) {
            return;
        }
        
        // Register custom elements
        $element_files = [
            DWC_NAV_PLUGIN_PATH . 'elements/element-dwc-nav-container.php',
            DWC_NAV_PLUGIN_PATH . 'elements/element-dwc-nav-item.php',
            DWC_NAV_PLUGIN_PATH . 'elements/element-dwc-nav-dropdown.php',
            DWC_NAV_PLUGIN_PATH . 'elements/element-dwc-nav-toggle.php',
        ];
        
        foreach ( $element_files as $file ) {
            if ( file_exists( $file ) ) {
                \Bricks\Elements::register_element( $file );
            }
        }
    }
    
    public function enqueue_assets() {
        wp_enqueue_script( 
            'dwc-nav-frontend', 
            DWC_NAV_PLUGIN_URL . 'assets/js/frontend.js', 
            [], 
            DWC_NAV_VERSION, 
            true 
        );
        
        wp_enqueue_style( 
            'dwc-nav-frontend', 
            DWC_NAV_PLUGIN_URL . 'assets/css/frontend.css', 
            [], 
            DWC_NAV_VERSION 
        );
    }
    
    public function enqueue_admin_assets( $hook ) {
        // Only load on Bricks builder pages
        if ( isset( $_GET['bricks'] ) && $_GET['bricks'] === 'run' ) {
            wp_enqueue_script( 
                'dwc-nav-builder', 
                DWC_NAV_PLUGIN_URL . 'assets/js/builder.js', 
                ['jquery'], 
                DWC_NAV_VERSION, 
                true 
            );
        }
    }
}

// Initialize the plugin
new DWC_Nav_Pro_Plugin();