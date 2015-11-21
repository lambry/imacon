<?php
/**
* Imacon helpers
*
* @package Imacon
*/

namespace Lambry\Imacon;

defined( 'ABSPATH' ) || exit;

/* Helpers Class */
class Helpers {

	/**
     * Order
     *
     * Order the setup fields based on sort.
     *
     * @access public
     * @param  string $sort
     * @return array  $fields
     */
    public static function order( $sort ) {

        $fields = Setup::fields();

        if ( $sort ) {

            $order = array_filter( explode( ',', $sort ) );

            uksort( $fields, function( $a, $b ) use ( $order ) {
                return array_search( $a, $order ) - array_search( $b, $order );
            });

        }

        return $fields;

    }

    /**
     * Selected
     *
     * Order the setup fields based on sort.
     *
     * @access public
     * @param  string $id
     * @param  mixed  $value
     * @return string $selected
     */
    public static function selected( $id, $value ) {

        $selected = 'selected="selected"';

        if ( is_array( $value ) && in_array( $id, $value ) ) {
            return $selected;
        }

        if ( $id === $value ) {
            return $selected;
        }

        return '';

    }

    /**
     * Wrap
     *
     * Check whether or not to wrap a field.
     *
     * @access public
     * @param  mixed   $links
     * @param  string  $name
     * @return boolean $wrap
     */
    public static function wrap( $links, $name ) {

        return ( is_array( $links ) && in_array( $name, $links) );

    }

}
