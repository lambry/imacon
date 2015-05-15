<?php
/**
 * Widget output template.
 */

// Get Image
$image_src = ( $iw_image ) ? wp_get_attachment_image_src( $iw_image, $iw_size )[0] : false;
// Set target
$iw_target = ( $iw_target ) ? '_blank' : '_self'; ?>

<?php if ( ! empty( $iw_link ) ) { ?>
	<a href="<?php echo $iw_link; ?>" target="<?php echo $iw_target; ?>">
<?php } ?>

<?php if ( ! empty( $title ) ) {
	echo $before_title . apply_filters( 'widget_title', $title ) . $after_title;
} ?>

<?php if ( ! empty( $image_src ) ) { ?>
	<img class="image-widget-image" src="<?php echo $image_src; ?>" />
<?php } ?>

<?php if ( ! empty( $iw_icon ) ) { ?>
	<i class="image-widget-icon fa fa-<?php echo $iw_icon; ?>"></i>
<?php } ?>

<?php if ( ! empty( $iw_description ) ) { ?>
	<div class="image-widget-description"><?php echo $iw_description; ?></div>
<?php } ?>

<?php if ( ! empty( $iw_link ) ) { ?>
	</a>
<?php } ?>
