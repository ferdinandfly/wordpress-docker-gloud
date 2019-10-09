<?php
	$params = array(
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Title Size",'zap'),
			"param_name" => "zo_title_size",
			"value" => array(
					"H2" => "h2",
					"H3" => "h3",
					"H4" => "h4",
					"H5" => "h5",
					"H6" => "h6"
			)
		),
		array(
			"type" => "colorpicker",
			"heading" => esc_html__("Icon - Color",'zap'),
			"param_name" => "zo_fancybox_icon_color",
			"value" => "transparent",
		),
        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Icon - Border Color",'zap'),
            "param_name" => "zo_fancybox_border_color",
            "value" => "transparent",
        ),
		array(
            "type" => "textfield",
            "heading" => esc_html__("Icon - Font size",'zap'),
            "param_name" => "zo_fancybox_icon_size",
            "value" => "",
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Icon - Border Size",'zap'),
            "param_name" => "zo_fancybox_border_size",
            "value" => array(
                'Default' => '',
                'Large' => 'large'
            ),
            "template" => array('zo_fancybox--layout-1.php')
        ),
        array(
			"type" => "colorpicker",
			"heading" => esc_html__("Title Color",'zap'),
			"param_name" => "zo_fancybox_title_color",
			"value" => "#000",
		),
		array(
			"type" => "colorpicker",
			"heading" => esc_html__("Content Color",'zap'),
			"param_name" => "zo_fancybox_content_color",
			"value" => "#909090",
		),
        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Fancybox Border Bottom Color",'zap'),
            "param_name" => "zo_fancybox_border_bottom_color",
            "value" => "transparent",
            "template" => array('zo_fancybox--layout-2.php')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Fancybox Style",'zap'),
            "param_name" => "zo_fancybox_font_style",
            "value" => array(
                'Default' => '',
                'Style 1' => 'style-1'
            ),
            "template" => array('zo_fancybox--layout-2.php')
        ),
        //custom button more
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Custom Color Text More Info",'zap'),
            "param_name" => "text_more_info",
            "value" => array(
                'No' => '',
                'Yes' => 'yes'
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Color",'zap'),
            "param_name" => "text_more_info_color",
            'dependency' => array(
                "element"=>"text_more_info",
                "value"=>array(
                    "yes"
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Color Hover",'zap'),
            "param_name" => "text_more_info_color_hover",
            'dependency' => array(
                "element"=>"text_more_info",
                "value"=>array(
                    "yes"
                )
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Custom Color Button More Info",'zap'),
            "param_name" => "button_more_info",
            "value" => array(
                'No' => '',
                'Yes' => 'yes'
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Border Color",'zap'),
            "param_name" => "button_more_info_border_color",
            'dependency' => array(
                "element"=>"button_more_info",
                "value"=>array(
                    "yes"
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Border Color Hover",'zap'),
            "param_name" => "button_more_info_border_color_hover",
            'dependency' => array(
                "element"=>"button_more_info",
                "value"=>array(
                    "yes"
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Background Color",'zap'),
            "param_name" => "button_more_info_bg_color",
            'dependency' => array(
                "element"=>"button_more_info",
                "value"=>array(
                    "yes"
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Background Color Hover",'zap'),
            "param_name" => "button_more_info_bg_color_hover",
            'dependency' => array(
                "element"=>"button_more_info",
                "value"=>array(
                    "yes"
                )
            )
        ),
	);
