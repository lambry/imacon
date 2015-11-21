<?php
/**
 * Generate Public View
 *
 * @package Imacon
 */

namespace Lambry\Imacon; 

foreach ( Helpers::order( $sort ) as $name => $field ) {

    if ( Helpers::wrap( $instance['link_wrap'], $name ) ) {
    	Output::anchor( $instance['link_to'], 'open' );
    }

    if ( $name === 'title' && ! empty( $$name ) ) {
        echo $before_title . apply_filters( 'widget_title', $$name ) . $after_title;
        $$name = false;
    }

    if ( isset( $field['output'] ) && $field['output'] === 'selector' ) {
        $field['type'] = 'selector';
    }

    if ( isset( $field['type'] ) && $field['type'] === 'image' ) {
        $field['image_size'] = $instance['image_size'] ? $instance['image_size'] : 'thumbnail';
    }

    Output::field( $name, $field, $$name );

    if ( Helpers::wrap( $instance['link_wrap'], $name ) ) {
    	Output::anchor( $instance['link_to'], 'close' );
    }

}
