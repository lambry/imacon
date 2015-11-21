<?php
/**
 * Plugin Name: Imacon
 * Plugin URI: https://github.com/lambry/imacon
 * Description: Display an image and or icon with optional title, description and link.
 * Version: 0.2.0
 * Author: Lambry
 * Author URI: http://lambry.com
 * Text Domain: imacon
 * Domain Path: /languages
 */

namespace Lambry\Imacon;

defined( 'ABSPATH' ) || exit;

/* Init Class */
class Init extends \WP_Widget {

    /*
     * Construct
     */
    public function __construct() {

        // Widget details
        parent::__construct( 'imacon', __( 'Imacon', 'imacon' ), [
            'classname'   => 'imacon',
            'description' => __( 'Add an image/icon with title, description and link.', 'imacon' )
        ] );

        // Include files
        $this->includes();

        // Load text domain
        load_plugin_textdomain( 'imacon', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

        // Add admin assets
        add_action( 'admin_enqueue_scripts', [ $this, 'admin_assets' ] );
        // Add public assets
        add_action( 'wp_enqueue_scripts', [ $this, 'public_assets'] );

    }

    /**
     * Includes
     *
     * Include the required classes.
     *
     * @access private
     * @return null
     */
    private function includes() {

        require 'includes/setup.php';
        require 'includes/defaults.php';
        require 'includes/helpers.php';

        if ( is_admin() ) {

            require 'admin/includes/widget.php';
            require 'admin/includes/fields.php';

        } else {

            require_once 'public/includes/output.php';

        }

    }

    /**
     * Admin Assets
     *
     * Include admin assets.
     *
     * @access public
     * @param  string $hook
     * @return null
     */
    public function admin_assets( $hook ) {

        if ( $hook === 'widgets.php' ) {

            // Add styles
            wp_enqueue_style( 'font-awesome', plugin_dir_url( __FILE__ ) . 'includes/font-awesome/css/font-awesome.min.css', [], '4.4.0' );
            wp_enqueue_style( 'select2', plugin_dir_url( __FILE__ ) . 'includes/select2/css/select2.min.css', [], '4.0.0' );
            wp_enqueue_style( 'imacon-admin', plugin_dir_url( __FILE__ ) . 'admin/assets/styles/admin.css', ['font-awesome', 'select2'], '0.2.0' );
            /// Add scripts
            wp_enqueue_media();
            wp_enqueue_script( 'select2', plugin_dir_url( __FILE__ ) . 'includes/select2/js/select2.min.js', ['jquery'], '4.0.0', true );
            wp_enqueue_script( 'imacon-admin', plugin_dir_url( __FILE__ ) . 'admin/assets/scripts/admin.min.js', ['jquery', 'select2'], '0.2.0', true );

        }

    }

    /**
     * Public Assets
     *
     * Include public assets.
     *
     * @access public
     * @return null
     */
    public function public_assets() {
        
        // Add styles
        wp_enqueue_style( 'font-awesome', plugin_dir_url( __FILE__ ) . 'includes/font-awesome/css/font-awesome.min.css', [], '4.4.0' );
        wp_enqueue_style( 'imacon-public', plugin_dir_url( __FILE__ ) . 'public/assets/styles/public.css', [], '0.2.0' );
    
    }

    /**
     * Widget
     *
     * Output the public Widget content.
     *
     * @access public
     * @param  array $args
     * @param  array $instance
     * @return null
     */
    public function widget( $args, $instance ) {

        extract( $args, EXTR_SKIP );
        extract( $instance, EXTR_SKIP );

        echo $before_widget;
            require 'public/widget.php';
        echo $after_widget;

    }

    /**
     * Form
     *
     * Output the admin Widget form.
     *
     * @access public
     * @return null
     */
    public function form( $instance ) {

        $instance = wp_parse_args( (array) $instance, Widget::instance() );
        extract( $instance, EXTR_SKIP );
        $widget = $this;

        require 'admin/form.php';      

    }

    /**
     * Update
     *
     * Update the widgets options.
     *
     * @access public
     * @return array $instance
     */
    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        foreach ( Setup::fields() as $name => $field ) {
            $instance[$name] = Widget::santitize( $name, $field, $new_instance );
        }

        foreach ( Setup::options() as $name => $option ) {
            $instance[$name] = Widget::santitize( $name, $option, $new_instance );
        }

        return $instance;

    }

}

// Register Imacon Widget.
add_action( 'widgets_init', function() {

    register_widget( 'Lambry\Imacon\Init' );

});
