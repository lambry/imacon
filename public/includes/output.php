<?php
/**
 * Imacon Output
 *
 * @package Imacon
 */

namespace Lambry\Imacon;

defined( 'ABSPATH' ) || exit;

/* Output Class */
class Output {

    /**
     * Create
     *
     * Create a wrapping anchor.
     *
     * @access public
     * @param  string $link
     * @param  string $state
     * @return null
     */
    public static function anchor( $link, $state ) {

        if ( $state === 'open' ) {
            echo "<a href='{$link}'>";
        }

        if ( $state === 'close' ) {
            echo '</a>';
        }

    }

    /**
     * Field
     *
     * Create the outputted field.
     *
     * @access public
     * @param  string $name
     * @param  array  $field
     * @param  mixed  $value
     * @return null
     */
	public static function field( $name, $field, $value ) {

        if ( empty( $value ) ) {
            return;
        }

        switch ( $field['type'] ) {

            case 'text':
                self::text( $name, $value );
                break;

            case 'selector':
                self::selector( $name, $value );
                break;

            case 'textarea':
                self::textarea( $name, $value );
                break;

            case 'image':
                self::image( $name, $value, $field['image_size'] );
                break;

            default: break;

        }

	}

    /**
     * Selector
     *
     * Output an element with a specific class.
     *
     * @access private
     * @param  string $name
     * @param  array  $value
     * @return html   $text
     */
    private static function selector( $name, $value ) { ?>

        <i class="imacon-<?php echo $name . ' ' . $value; ?>"></i>

    <?php }

    /**
     * Text
     *
     * Output a text field.
     *
     * @access private
     * @param  string $name
     * @param  array  $value
     * @return html   $text
     */
    private static function text( $name, $value ) { ?>

        <h4 class="imacon-<?php echo $name; ?>"><?php echo $value; ?></h4>

    <?php }

    /**
     * Textarea
     *
     * Output a textarea.
     *
     * @access private
     * @param  string $name
     * @param  array  $value
     * @return html   $textarea
     */
    private static function textarea( $name, $value ) { ?>

        <div class="imacon-<?php echo $name; ?>"><?php echo apply_filters( 'the_content', $value ); ?></div>

    <?php }

    /**
     * Image
     *
     * Output an image area.
     *
     * @access private
     * @param  string $name
     * @param  array  $value
     * @param  string $size
     * @return html   $image
     */
    private static function image( $name, $value, $size ) { 

        $image = wp_get_attachment_image_src( $value, $size );

        if ( ! $image ) {
            return; 
        } ?>

        <div class="imacon-<?php echo $name; ?>"><img src="<?php echo $image[0]; ?>"></div>

    <?php }

}
