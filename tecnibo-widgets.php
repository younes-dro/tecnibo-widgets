<?php

/*
 * Plugin Name: Tecnibo Widgets
 * Plugin URI: https://github.com/younes-dro
 * Description: Custom Widgets for tecnibo
 * Author: Younes DRO
 * Author URI: https://github.com/younes-dro
 * Version: 1.0
 * Text Domain: tecbnibo-widgets
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Tecnibo_Widgets {

    public function __construct() {
        
        add_action('init', array( $this, 'widget_textdomain' ) );
        include_once $this->plugin_path() . '/includes/sub-menu-3col.php';

        add_action('widgets_init', array($this, 'register_tecnibo_widgets'));
        add_action('wp_enqueue_scripts', array($this, 'register_widget_styles'));
    }

    public function register_tecnibo_widgets() {
        register_widget('Sub_Menu_3Col');
    }

    function register_widget_styles() {
        wp_enqueue_style('submenu-3col-css', $this->plugin_url() . '/assets/submenu-3col.css');
    }

    function widget_textdomain() {
        load_plugin_textdomain('tecnibo-widgets', false, $this->plugin_path() . '/lang/');
    }

    public static function plugin_url() {
        return untrailingslashit(plugins_url('/', __FILE__));
    }

    public static function plugin_path() {

        return untrailingslashit(plugin_dir_path(__FILE__));
    }

}

new Tecnibo_Widgets();
