<?php
/**
 * Widget admin template.
 */

$placeholder = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAADoUlEQVRo3u1ZTWgTURAOIYRSikjooUgpRXoQEREPHkRERELz/x/yhwnB/CAk9NBDERFKTqWIBykSPIlITyIiIj1J6al4EBFPOXiQ4KEUKUVEpNRvJBvfbt4mb3fzV9iBoZvdefNm3vtm5s2rxWKSSSaZZJIR8vl8m16v98RwIBBwyBzweDzHLpfr2O12/2OjzxKzv/v5jAU/0+GAZMBJYK4D7MqNO6s6IHmI39vgzTHhLT0Qco86sUjk9/sva4bQuDmgGULj5kDfIJTNZq0YfB/y38G/kJPfhUKhhWE40BcIweCacjsx9lssFjs1SAf6AqFqtWrF6wNe8YLC/KB3wDCE8vn8lFphwc6siBgTDoedWh3AsUEMQiIxALlPvB3AJNcFDFmE7BH+3tTqRCaTcWDcNSwUxd9n3VkI23lVghGznfVeBkSj0WkK/FbMfI3H41NanWCpUChYuQ6I1IFIJDILo1ewGmu0qiITQva1Igg3jDjQQYOsxNi1O5y4OeoGO+zYOYzLwdF7tFh4TiHTzXV1wGghg0FOTPakUqm0txdBuwBVh5wj8R/I3+LoiGK3ZHHG2oVv25C5oeqA3qNEMBi8RLHBwiOXy9mgd1flNLnKjqeYgHEvRU6iLUceI7BtMgf0QgirPIfxTUWaewiu8VIuZBuY3C6NTyaTE3i3o7UngBMvisWi1RCEgNXTGPuF15HxftNf4FlW9GDIBq/zwvtXkF0kxnNdRaaqG0KJRMKOce+1NCJQ+zOVSk0y0LtIAc2ThXGPGCeXVPQdQse0ZgiVy2UrNde8otZj298oVr/eRVbmgJocbF/WDCGqAXqaesTFA1aPFDsq8ODugFKeukdNEIIRd5WGijLwfFvSk06nHQqD3+JofkViFMx23sfzDPsN9j5lbN0XhhAM8FMO73at0o2Rw8OMUWcVUHgukjiIIL/KFkUhCJVKJRvsXyYY6GWs3nlJH9LnDAsJrQ4w9h6MrCfGvPvMnHtU+CTGYi0xsE2w3yDbZBqq3ZHdSrCZzEAWqo2sqacDncEs9Bs65jsgNMiLLUBD1tBQxdVbyKBvXcKiUBYRudztxZjrg+LESs1OgyP7A9xo8R5Hzw6OMva2A8O8naYegd0FHAdmYcNHNXlO8dpCRvt/EzLsy106wwC7F1gn0LBMUM9LK99lXBMyZbqfkgXTKP7BgTnXcaayWRQERybxLYhFXaPaAH5GmQbvnDgIdsibZJJJJplkmP4C0NWrxL0MRqkAAAAASUVORK5CYII=';
// Get Image
$image_src = wp_get_attachment_image_src( $iw_image, 'thumbnail' );
$image_src = ( $image_src ) ? $image_src[0] : $placeholder; ?>

<div class="image-widget-container">
    <div class="image-widget-row">
        <div class="image-widget-preview"><img src="<?php echo $image_src; ?>"></div>
        <input type="hidden" id="<?php echo $this->get_field_id( 'iw_image' ); ?>" name="<?php echo $this->get_field_name( 'iw_image' ); ?>" value="<?php echo $iw_image; ?>" class="image-widget-image" />
        <button class="image-widget-select button button-primary button-hero widefat"><?php _e( 'Select Image', 'mild-iw' ); ?></button>
    </div>
    <div class="image-widget-row">
        <label for="<?php echo $this->get_field_id( 'iw_icon' ); ?>"><?php _e( 'You can also use an icon:', 'mild-iw' ); ?></label>
        <select name="<?php echo $this->get_field_name( 'iw_icon' ); ?>" id="<?php echo $this->get_field_id( 'iw_icon' ); ?>" class="image-widget-icon">
            <option value=""><?php _e( 'Select Icon', 'mild-iw' ) ?></option>
            <?php include plugin_dir_path( __FILE__ ) . 'includes/list-icons.php'; ?>
        </select>
        <a href="http://fontawesome.io/cheatsheet/" target="_blank"><?php _e( 'Icon List', 'mild-iw' ); ?></a>
    </div>
    <div class="image-widget-row">
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'mild-iw' ); ?></label>
        <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" class="image-widget-title widefat" />
    </div>
    <div class="image-widget-row">
        <label for="<?php echo $this->get_field_id( 'iw_description' ); ?>"><?php _e( 'Description:', 'mild-iw' ); ?></label>
        <textarea id="<?php echo $this->get_field_id( 'iw_description' ); ?>" name="<?php echo $this->get_field_name( 'iw_description' ); ?>" class="image-widget-description widefat"><?php echo $iw_description; ?></textarea>
    </div>
    <div class="image-widget-row">
        <label for="<?php echo $this->get_field_id( 'iw_link' ); ?>"><?php _e( 'Link:', 'mild-iw' ); ?></label>
        <input type="text" id="<?php echo $this->get_field_id( 'iw_link' ); ?>" name="<?php echo $this->get_field_name( 'iw_link' ); ?>" value="<?php echo $iw_link; ?>" class="image-widget-link widefat" />
    </div>
    <div class="image-widget-row">
        <label for="<?php echo $this->get_field_id( 'iw_size' ); ?>"><?php _e( 'Image size:', 'mild-iw' ); ?></label>
        <select name="<?php echo $this->get_field_name( 'iw_size' ); ?>" id="<?php echo $this->get_field_id( 'iw_size' ); ?>" class="image-widget-icon widefat">
           <?php include plugin_dir_path( __FILE__ ) . 'includes/list-sizes.php'; ?>
        </select>
    </div>
    <div class="image-widget-row">
        <input id="<?php echo esc_attr( $this->get_field_id( 'iw_target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'iw_target' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $iw_target ); ?> />
        <label for="<?php echo $this->get_field_id( 'iw_target' ); ?>"><?php _e( 'Open in new window', 'mild-iw' ); ?></label>
    </div>
</div>
