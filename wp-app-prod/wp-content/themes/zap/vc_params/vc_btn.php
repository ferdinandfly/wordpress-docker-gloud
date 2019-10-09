<?php
/**
 * New button implementation
 * array_merge is needed due to merging other shortcode data into params.
 * @since 4.5
 */
global $pixel_icons;
$icons_params = vc_map_integrate_shortcode( 'vc_icon', 'i_', '',
    array(
        'include_only_regex' => '/^(type|icon_\w*)/',
        // we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
    ), array(
        'element' => 'add_icon',
        'value' => 'true',
    )
);
// populate integrated vc_icons params.
if ( is_array( $icons_params ) && ! empty( $icons_params ) ) {
    foreach ( $icons_params as $key => $param ) {
        if ( is_array( $param ) && ! empty( $param ) ) {
            if ( $param['param_name'] == 'i_type' ) {
                // append pixelicons to dropdown
                $icons_params[ $key ]['value'][ esc_html__( 'Pixel', 'zap' ) ] = 'pixelicons';
            }
            if ( isset( $param['admin_label'] ) ) {
                // remove admin label
                unset( $icons_params[ $key ]['admin_label'] );
            }

        }
    }
}
$params = array_merge(
    array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Text Button', 'zap' ),
            'save_always' => true,
            'param_name' => 'title',
            // fully compatible to btn1 and btn2
            'value' => esc_html__( 'Text on the button', 'zap' ),
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'URL (Link)', 'zap' ),
            'param_name' => 'link',
            'description' => esc_html__( 'Add link to button.', 'zap' ),
            // compatible with btn2 and converted from href{btn1}
        ),
		
		/* Vu edit */
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => esc_html__("Button Type", 'zap'),
            "param_name" => "button_type",
            "value" => array(
                'Button Default' => 'btn btn-default',
                'Button Primary' => 'btn btn-primary',
				'Button Primary Transparent' => 'btn btn-primary-transparent',
				'Button White' => 'btn btn-white',
				'Button White Transparent' => 'btn btn-white-transparent',
				'Button Gray' => 'btn btn-gray',
				'Button Gray Transparent' => 'btn btn-gray-transparent',
				'Button Black' => 'btn btn-black',
                'Button Green' => 'btn btn-green',
				'Button Purple' => 'btn btn-purple',
                'Button Crimson' => 'btn btn-crimson',
            )
        ),
		array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Padding', 'zap' ),
            'param_name' => 'padding',
            'description' => esc_html__( 'Ex: 15px 35px 15px 35px.', 'zap' ),
        ),
		array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Border', 'zap' ),
            'param_name' => 'border',
            'value' => array(
                esc_html__( '1px', 'zap' ) => '',
                esc_html__( '2px', 'zap' ) => 'btn-border-2'
            )
        ),
		array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Style', 'zap' ),
            'param_name' => 'style',
            'value' => array(
                esc_html__( 'Default', 'zap' ) => '',
                esc_html__( 'Style 1', 'zap' ) => 'btn-style-1',
                esc_html__( 'Style 2', 'zap' ) => 'btn-style-2',
				esc_html__( 'Style 3', 'zap' ) => 'btn-style-3',
                esc_html__( 'Style 4', 'zap' ) => 'btn-style-4',
                esc_html__( 'Style 5', 'zap' ) => 'btn-style-5',
            )
        ),
		array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Letter Spacing', 'zap' ),
            'param_name' => 'letter_spacing',
            'value' => array(
                esc_html__( 'Default', 'zap' ) => '',
                esc_html__( 'Letter Spacing 50', 'zap' ) => '0.05em',
                esc_html__( 'Letter Spacing 100', 'zap' ) => '0.1em',
                esc_html__( 'Letter Spacing 200', 'zap' ) => '0.2em',
                esc_html__( 'Letter Spacing 300', 'zap' ) => '0.3em',
                esc_html__( 'Letter Spacing 400', 'zap' ) => '0.4em',
                esc_html__( 'Letter Spacing 500', 'zap' ) => '0.5em'
            )
        ),
		array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Radius', 'zap' ),
            'param_name' => 'radius',
            'description' => esc_html__( 'Ex: 15px 35px 15px 35px.', 'zap' ),
        ),
		/* Vu edit */
		
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Alignment', 'zap' ),
            'param_name' => 'align',
            'description' => esc_html__( 'Select button alignment.', 'zap' ),
            'value' => array(
                esc_html__( 'Inline', 'zap' ) => 'inline',
                // default as well
                esc_html__( 'Left', 'zap' ) => 'left',
                // default as well
                esc_html__( 'Right', 'zap' ) => 'right',
                esc_html__( 'Center', 'zap' ) => 'center'
            ),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Set full width button?', 'zap' ),
            'param_name' => 'button_block',
            'dependency' => array(
                'element' => 'align',
                'value_not_equal_to' => 'inline',
            ),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Add icon?', 'zap' ),
            'param_name' => 'add_icon',
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon Alignment', 'zap' ),
            'description' => esc_html__( 'Select icon alignment.', 'zap' ),
            'param_name' => 'i_align',
            'value' => array(
                esc_html__( 'Left', 'zap' ) => 'left',
                // default as well
                esc_html__( 'Right', 'zap' ) => 'right',
            ),
            'dependency' => array(
                'element' => 'add_icon',
                'value' => 'true',
            ),
        ),
    ),
    $icons_params,
    array(
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'zap' ),
            'param_name' => 'i_icon_pixelicons',
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'type' => 'pixelicons',
                'source' => $pixel_icons,
            ),
            'dependency' => array(
                'element' => 'i_type',
                'value' => 'pixelicons',
            ),
            'description' => esc_html__( 'Select icon from library.', 'zap' ),
        ),
    ),
    array(
        vc_map_add_css_animation( true ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'zap' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'zap' ),
        ),
    )
);
/**
 * @class WPBakeryShortCode_VC_Btn
 */
vc_map( array(
    'name' => esc_html__( 'Button', 'zap' ),
    'base' => 'vc_btn',
    'icon' => 'icon-wpb-ui-button',
    'category' => array(
        esc_html__( 'Content', 'zap' ),
    ),
    'description' => esc_html__( 'Eye catching button', 'zap' ),
    'params' => $params,
    'js_view' => 'VcButton3View',
    'custom_markup' => '{{title}}<div class="vc_btn3-container"><button class="vc_general vc_btn3 vc_btn3-size-sm vc_btn3-shape-{{ params.shape }} vc_btn3-style-{{ params.style }} vc_btn3-color-{{ params.color }}">{{{ params.title }}}</button></div>',
) );
