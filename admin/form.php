<?php 
/**
 * Generate Admin View
 *
 * @package Imacon
 */

namespace Lambry\Imacon; ?>

<div class="imacon">

    <div class="imacon-sortable">
        <?php
            foreach ( Helpers::order( $sort ) as $name => $field ) {
                Fields::create( $name, $field, $$name, $widget );
            }
        ?>
    </div>

    <div class="imacon-options">
        <?php 
            foreach ( Setup::options() as $name => $field ) {
                Fields::create( $name, $field, $$name, $widget );
            }
        ?>
    </div>

</div>