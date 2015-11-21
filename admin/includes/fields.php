<?php
/**
 * Imacon Fields
 *
 * @package Imacon
 */

namespace Lambry\Imacon;

defined( 'ABSPATH' ) || exit;

/* Fields Class */
class Fields {

    /**
     * Create
     *
     * Create the required field.
     *
     * @access public
     * @param  string $name
     * @param  array  $field
     * @param  mixed  $value
     * @param  object $widget
     * @return null
     */
	public static function create( $name, $field, $value, $widget ) {

        switch ( $field['type'] ) {

            case 'text':
                self::text( $name, $field, $value, $widget );
                break;

            case 'hidden':
                self::hidden( $name, $field, $value, $widget );
                break;

            case 'textarea':
                self::textarea( $name, $field, $value, $widget );
                break;

            case 'select':
                self::select( $name, $field, $value, $widget );
                break;

            case 'image':
                self::image( $name, $field, $value, $widget );
                break;

            default:
                self::text( $name, $field, $value, $widget );
                break;

        }

	}

    /**
     * Text
     *
     * Generates a text field.
     *
     * @access private
     * @param  string $name
     * @param  array  $field
     * @param  mixed  $value
     * @param  object $widget
     * @return void
     */
    private static function text( $name, $field, $value, $widget ) {

        if ( ! isset( $field['placeholder'] ) ) $field['placeholder'] = ''; ?>
    
        <p class="imacon-field" data-id="<?php echo $name ?>">
            <label for="<?php echo $widget->get_field_id( $name ); ?>"><?php echo $field['label']; ?></label>
            <input type="text" id="<?php echo $widget->get_field_id( $name ); ?>" name="<?php echo $widget->get_field_name( $name ); ?>" 
               value="<?php echo $value; ?>" class="imacon-<?php echo $name ?> widefat" placeholder="<?php echo $field['placeholder']; ?>" />
        </p>

    <?php }

    /**
     * Hidden
     *
     * Generates a hidden field.
     *
     * @access private
     * @param  string $name
     * @param  array  $field
     * @param  mixed  $value
     * @param  object $widget
     * @return void
     */
    private static function hidden( $name, $field, $value, $widget ) { ?>
	
		<p class="imacon-field-hidden" data-id="<?php echo $name ?>">
			<input type="hidden" id="<?php echo $widget->get_field_id( $name ); ?>" name="<?php echo $widget->get_field_name( $name ); ?>" 
			   value="<?php echo $value; ?>" class="imacon-<?php echo $name ?> widefat" />
		</p>

    <?php }

    /**
     * Textarea
     *
     * Generates a textarea.
     *
     * @access private
     * @param  string $name
     * @param  array  $field
     * @param  mixed  $value
     * @param  object $widget
     * @return void
     */
    private static function textarea( $name, $field, $value, $widget ) { ?>

		<p class="imacon-field" data-id="<?php echo $name ?>">
			<label for="<?php echo $widget->get_field_id( $name ); ?>"><?php echo $field['label']; ?></label>
			<textarea id="<?php echo $widget->get_field_id( 'content' ); ?>" name="<?php echo $widget->get_field_name( 'content' ); ?>" 
				      class="imacon-<?php echo $name ?> widefat"><?php echo $value; ?></textarea>
		</p>

    <?php }

    /**
     * Select
     *
     * Generates a select box.
     *
     * @access private
     * @param  string $name
     * @param  array  $field
     * @param  mixed  $value
     * @param  object $widget
     * @return void
     */
	private static function select( $name, $field, $value, $widget ) {

        $attr = ( isset( $field['attr'] ) ) ? $field['attr'] : ''; ?>

		<p class="imacon-field" data-id="<?php echo $name ?>">
			<label for="<?php echo $widget->get_field_id( $name ); ?>"><?php echo $field['label']; ?></label>
	        <select name="<?php echo $widget->get_field_name( $name ); echo ( $attr === 'multiple' ) ? '[]' : ''; ?>" <?php echo $attr; ?> 
                    id="<?php echo $widget->get_field_id( $name ); ?>" class="imacon-select imacon-<?php echo $name ?> widefat">
                <?php if ( $attr !== 'multiple' ) : ?>
	               <option value=""><?php _e( '-- select --', 'imacon' ) ?></option>
                <?php endif; ?>
	            <?php foreach ( $field['fields'] as $id => $title ) : ?>
	                <option value="<?php echo $id; ?>" <?php echo Helpers::selected( $id, $value ); ?>> <?php echo $title; ?></option>
	            <?php endforeach; ?>
	        </select>
        </p>

	<?php }

    /**
     * Image
     *
     * Generates an image area.
     *
     * @access private
     * @param  string $name
     * @param  array  $field
     * @param  mixed  $value
     * @param  object $widget
     * @return void
     */
    private static function image( $name, $field, $value, $widget ) {

    	$image_src = wp_get_attachment_image_src( $value, 'thumbnail' );
        $image = $image_src ? $image_src[0] : Defaults::placeholder(); ?>

        <div class="imacon-image-wrap imacon-field" data-id="<?php echo $name ?>">
            <div class="imacon-preview"><img src="<?php echo $image; ?>"></div>
            <span class="imacon-remove-image <?php echo ( ! $value ) ? 'hidden' : ''; ?>">x</span>
            <input type="hidden" id="<?php echo $widget->get_field_id( $name ); ?>" name="<?php echo $widget->get_field_name( $name ); ?>" value="<?php echo $value; ?>" class="imacon-<?php echo $name ?>" />
        </div>

    <?php }

}
