<?php
/**
 * Plugin Name: Mild Image Widget
 * Plugin URI: https://github.com/lambry/mild-image-widget
 * Description: Adds an image (or icon) with optional title, description and link.
 * Version: 0.1.0
 * Author: David Featherston
 * Text Domain: mild-iw
 * Domain Path: /languages
 */

namespace Mild\ImageWidget;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) die;

/* Init Class */
class Init extends \WP_Widget {

    /*
    * Construct
    */
    public function __construct() {

        // Load text domain.
        load_plugin_textdomain( 'mild-iw', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

        // Widget details
        parent::__construct(
            'image-widget',
            __( 'Image Widget', 'mild' ),
            [
                'classname'   => 'image-widget',
                'description' => __( 'Adds an image (or icon) with optional title, description and link.', 'mild' )
            ]
        );

        // Register admin styles and scripts
        add_action( 'admin_print_styles', [ $this, 'register_admin_styles' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'register_admin_scripts' ] );

    }

    // Outputs the content of the widget.
    public function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        extract( $instance, EXTR_SKIP );

        echo $before_widget;
            include plugin_dir_path( __FILE__ ) . '/views/widget.php';
        echo $after_widget;
    }

    // Generates the administration form for the widget.
    public function form( $instance ) {
        $defaults = [
            'title' => '',
            'iw_image' => '',
            'iw_icon' => '',
            'iw_description' => '',
            'iw_link' => '',
            'iw_size' => '',
            'iw_target' => ''
        ];
        $instance = wp_parse_args(
            (array) $instance,
            $defaults
        );
        extract( $instance, EXTR_SKIP );
        include plugin_dir_path( __FILE__ ) . '/views/admin.php';
    }

    // Processes the widget's options to be saved.
    public function update( $new_instance, $old_instance ) {
        extract( $new_instance, EXTR_SKIP );
        $instance = $old_instance;
        $instance['title'] = strip_tags( $title );
        $instance['iw_image'] = intval( $iw_image );
        $instance['iw_icon'] = strip_tags( $iw_icon );
        $instance['iw_description'] = strip_tags( $iw_description );
        $instance['iw_link'] = strip_tags( $iw_link );
        $instance['iw_size'] = strip_tags( $iw_size );
        $instance['iw_target'] = intval( $iw_target );
        return $instance;
    }

    // Registers and enqueues admin-specific styles.
    public function register_admin_styles() {
        wp_enqueue_style( 'image-widget-admin-styles', plugin_dir_url( __FILE__ ) . 'assets/css/admin.css' );
    }
    // Registers and enqueues admin-specific JavaScript.
    public function register_admin_scripts() {
        wp_enqueue_media();
        wp_enqueue_script( 'image-widget-admin-script', plugin_dir_url( __FILE__ ) . 'assets/js/admin.js', ['jquery'] );
    }

}

// Register Image Widget.
add_action( 'widgets_init', function() {
    register_widget( 'Mild\ImageWidget\Init' );
});
