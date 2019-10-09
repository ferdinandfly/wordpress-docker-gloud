<?php
/**
* Add custom heading params
*
* @author CMS-Theme
* @since 1.0.0
*/
vc_add_param("vc_custom_heading", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("Custom Heading Style", 'zap'),
    "admin_label" => true,
    "param_name" => "zo_custom_heading",
    "value" => array(
        "Default" => 'default',
        "Default Style 2" => 'default-2',
        "Title Line Bottom - Style 1" => "style-1",
        "Title Line Bottom - Style 2" => "style-2",
		"Title Line Bottom - Style 3" => "style-3",
		"Title Line Bottom - Style 4" => "style-4",
		"Title Line Bottom - Style 5" => "style-5",
        "Sub Title Highlight" => "subtitle-highlight",
        "Title icon" => "title-icon"
    )
));
vc_add_param("vc_custom_heading", array(
    "type" => "textfield",
    "class" => "",
    "heading" => esc_html__("Sub Title", 'zap'),
    "admin_label" => true,
    "param_name" => "zo_subtitle",
    "value" => '',
    'dependency' => array(
        "element"=>"zo_custom_heading",
        "value"=>array(
            "default-2",
            "style-1",
            "style-2",
			"style-3",
			"style-4",
			"style-5",
            "subtitle-highlight"
        )
    )
));
vc_add_param("vc_custom_heading", array(
    "type" => "textfield",
    "class" => "",
    "heading" => esc_html__("Font Size", 'zap'),
    "admin_label" => true,
    "param_name" => "zo_subtitle_size",
    "value" => '',
    'dependency' => array(
        "element"=>"zo_custom_heading",
        "value"=>array(
            "default-2",
            "style-1",
            "style-2",
			"style-3",
			"style-4",
			"style-5",
            "subtitle-highlight"
        )
    )
));
vc_add_param("vc_custom_heading", array(
    "type" => "textfield",
    "class" => "",
    "heading" => esc_html__("Font Weight", 'zap'),
    "admin_label" => true,
    "param_name" => "zo_subtitle_font_weight",
    "value" => '',
    'dependency' => array(
        "element"=>"zo_custom_heading",
        "value"=>array(
            "default-2",
            "style-1",
            "style-2",
			"style-3",
			"style-4",
			"style-5",
            "subtitle-highlight"
        )
    )
));
vc_add_param("vc_custom_heading", array(
    "type" => "textfield",
    "class" => "",
    "heading" => esc_html__("Letter Spacing", 'zap'),
    "admin_label" => true,
    "param_name" => "zo_subtitle_letter_spacing",
    "value" => '',
    'dependency' => array(
        "element"=>"zo_custom_heading",
        "value"=>array(
            "default-2",
            "style-1",
            "style-2",
			"style-3",
			"style-4",
			"style-5",
            "subtitle-highlight"
        )
    )
));
vc_add_param("vc_custom_heading", array(
    "type" => "textfield",
    "class" => "",
    "heading" => esc_html__("Line height", 'zap'),
    "admin_label" => true,
    "param_name" => "zo_subtitle_lineheight",
    "value" => '',
    'dependency' => array(
        "element"=>"zo_custom_heading",
        "value"=>array(
            "default-2",
            "style-1",
            "style-2",
			"style-3",
			"style-4",
			"style-5",
            "subtitle-highlight"
        )
    )
));
vc_add_param("vc_custom_heading", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("Text Align", 'zap'),
    "admin_label" => true,
    "param_name" => "zo_subtitle_textalign",
    "value" => array(
        'Left' => 'left',
        'Center' => 'center',
        'Right' => 'right'
    ),
    'dependency' => array(
        "element"=>"zo_custom_heading",
        "value"=> array(
            "default-2",
            "style-1",
            "style-2",
			"style-3",
			"style-4",
			"style-5",
            "subtitle-highlight"
        )
    )
));

vc_add_param("vc_custom_heading", array(
    'type' => 'iconpicker',
    'heading' => esc_html__( 'Title icon', 'zap' ),
    'param_name' => 'zo_custom_heading_icon',
    'value' => '',
    'settings' => array(
        'emptyIcon' => true, // default true, display an "EMPTY" icon?
        'iconsPerPage' => 200, // default 100, how many icons per/page to display
    ),
    'dependency' => array(
        "element"=>"zo_custom_heading",
        "value"=>array(
            "title-icon",
        )
    ),
    'description' => esc_html__( 'Select icon from library.', 'zap' ),
));
