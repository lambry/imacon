<?php
/**
* Imacon Widget
*
* @package Imacon
*/

namespace Lambry\Imacon;

defined( 'ABSPATH' ) || exit;

/* Widget Class */
class Widget {

    /**
     * Instance
     *
     * Setup default instance.
     *
     * @access public
     * @return array $instance
     */
    public static function instance() {

        $instance = [];
        $setup = array_merge( Setup::fields(), Setup::options() );

        foreach ( $setup as $name => $value ) {
            $instance[$name] = ( isset( $value['default'] ) ) ? $value['default']: '';
        }

        return $instance;

    }

	/**
     * Santitize
     *
     * Santizize widget fields.
     *
     * @access public
     * @param  string $name
     * @param  array $setup
     * @param  array $new_instance
     * @return mixed $value
     */
    public static function santitize( $name, $setup, $new_instance ) {

        $validate = ( isset( $setup['validate'] ) && is_callable( $setup['validate'] ) ) ? $setup['validate'] : 'strip_tags';

        if ( is_array( $new_instance[$name] ) ) {
            $value = array_map( $validate, $new_instance[$name] );
        } else {
            $value = $validate( $new_instance[$name] );
        }

        return $value;

    }

}
