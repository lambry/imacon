<?php
/**
 * Imacon Setup
 *
 * @package Imacon
 */

namespace Lambry\Imacon;

defined( 'ABSPATH' ) || exit;

/* Setup Class */
class Setup {

    /**
     * Get Fields
     *
     * @access public
     * @return $array $fields
     */
    public static function fields() {

        $fields = [
            'image' => [
                'label' => __( 'Image', 'imacon' ),
                'validate' => 'intval',
                'type' => 'image'
            ],
            'icon' => [
                'label' => __( 'Icon', 'imacon' ),
                'output' => 'selector',
                'type' => 'select',
                'fields' => Defaults::icons()
            ],
            'title' => [
                'label' => __( 'Title', 'imacon' ),
                'type' => 'text'
            ],
            'content' => [
                'label' => __( 'Content', 'imacon' ),
                'validate' => 'wp_kses_post',
                'type' => 'textarea'
            ]
        ];

        return apply_filters( 'imacon/fields', $fields );

    }

    /**
     * Get Options
     *
     * @access public
     * @return $array $fields
     */
    public static function options() {

        $options = [
            'sort' => [
                'type'  => 'hidden'
            ],
            'image_size' => [
                'label' => __( 'Image Size', 'imacon' ),
                'type'  => 'select',
                'fields' => Defaults::sizes()
            ],
            'link_wrap' => [
                'label' => __( 'Link Wrap', 'imacon' ),
                'attr' => 'multiple',
                'type' => 'select',
                'fields' => Defaults::fields()
            ],
            'link_to' => [
                'label' => __( 'Link To', 'imacon' ),
                'placeholder' => 'i.e. http://mysite.com/',
                'type' => 'text'
            ]
        ];

        return apply_filters( 'imacon/options', $options );

    }

}
