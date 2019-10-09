<?php
/**
 * Add row params
 *
 * @author ZoTheme
 * @since 1.0.0
 */
vc_remove_param("vc_row", 'gap');
vc_add_param("vc_row",array(
	'type' => 'dropdown',
	'heading' => esc_html__( 'Parallax', 'zap' ),
	'param_name' => 'parallax',
	'value' => array(
		esc_html__( 'None', 'zap' ) => '',
		esc_html__( 'Simple', 'zap' ) => 'content-moving',
		esc_html__( 'With fade', 'zap' ) => 'content-moving-fade',
	),
	'description' => esc_html__( 'Add parallax type background for row (Note: If no image is specified, parallax will use background image from Design Options).', 'zap' ),
	'dependency' => array(
		'element' => 'video_bg',
		'is_empty' => true,
	),
));
vc_add_param("vc_row", array(
	'type' => 'attach_image',
	'heading' => esc_html__( 'Image', 'zap' ),
	'param_name' => 'parallax_image',
	'value' => '',
	'description' => esc_html__( 'Select image from media library.', 'zap' ),
	'dependency' => array(
		'element' => 'parallax',
		'not_empty' => true,
	),
));
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__("Animation", 'zap'),
	"admin_label" => true,
	"param_name" => "animation",
	"value" => array(
		"None" => "",
		"bounce" => "bounce",
		"flash" => "flash",
		"pulse" => "pulse",
		"rubberBand" => "rubberBand",
		"shake" => "shake",
		"swing" => "swing",
		"tada" => "tada",
		"wobble" => "wobble",
		"jello" => "jello",
		"bounceIn" => "bounceIn",
		"bounceInDown" => "bounceInDown",
		"bounceInLeft" => "bounceInLeft",
		"bounceInRight" => "bounceInRight",
		"bounceInUp" => "bounceInUp",
		"fadeIn" => "fadeIn",
		"fadeInDown" => "fadeInDown",
		"fadeInDownBig" => "fadeInDownBig",
		"fadeInLeft" => "fadeInLeft",
		"fadeInLeftBig" => "fadeInLeftBig",
		"fadeInRight" => "fadeInRight",
		"fadeInRightBig" => "fadeInRightBig",
		"fadeInUp" => "fadeInUp",
		"fadeInUpBig" => "fadeInUpBig",
		"flip" => "flip",
		"flipInX" => "flipInX",
		"flipInY" => "flipInY",
		"lightSpeedIn" => "lightSpeedIn",
		"lightSpeedOut" => "lightSpeedOut",
		"rotateIn" => "rotateIn",
		"rotateInDownLeft" => "rotateInDownLeft",
		"rotateInDownRight" => "rotateInDownRight",
		"rotateInUpLeft" => "rotateInUpLeft",
		"rotateInUpRight" => "rotateInUpRight",
		"slideInUp" => "slideInUp",
		"slideInDown" => "slideInDown",
		"slideInLeft" => "slideInLeft",
		"slideInRight" => "slideInRight",
		"zoomIn" => "zoomIn",
		"zoomInDown" => "zoomInDown",
		"zoomInLeft" => "zoomInLeft",
		"zoomInRight" => "zoomInRight",
		"zoomInUp" => "zoomInUp",
		"rollIn" => "rollIn",
	),
	'description' => esc_html__('View animation effect at https://daneden.github.io/animate.css/', 'zap')
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => esc_html__('Animation Delay', 'zap'),
	"param_name" => "animation_delay",
	"value" => "0",
	"dependency" => array(
		"element" => "animation",
		"not_empty" => true,
	),
	"description" => esc_html__('Delay before the animation starts. Ex: 200ms, 0.5s, 1s...', 'zap')
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__("Background Position", 'zap'),
	"param_name" => "background_position",
	"value" => array(
		"Theme Default" => "",
		"Left Top" => "left top",
		"Left Center" => "left center",
		"Left Bottom" => "left bottom",
		"Right Top" => "right top",
		"Right Center" => "right center",
		"Right Bottom" => "right bottom",
		"Center Top" => "center top",
		"Center Center" => "center center",
		"Center Bottom" => "center bottom"
	),
	"group" => 'Design Options',
));


vc_add_param('vc_row', array(
	'type' => 'dropdown',
	'heading' => esc_html__("Overlay Color", 'zap'),
	'param_name' => 'overlay_row',
	'value' => array(
		'No' => '',
		'Yes' => 'yes'
	),
	'group' => 'Design Options'
));
vc_add_param("vc_row", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_html__('Color', 'zap'),
	"param_name" => "overlay_color",
	'group' => 'Design Options',
	"dependency" => array(
		"element" => "overlay_row",
		"value" => array(
			"yes"
		)
	),
	"description" => ''
));