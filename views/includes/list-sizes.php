<?php
/**
* List Icons
*/

$sizes_array = get_intermediate_image_sizes();
$sizes_array[] = 'full';

foreach ( $sizes_array as $size ) : ?>
   
    <option value="<?php echo $size; ?>" <?php selected( $size, $iw_size ); ?>>
        <?php echo $size; ?>
    </option>

<?php endforeach; 