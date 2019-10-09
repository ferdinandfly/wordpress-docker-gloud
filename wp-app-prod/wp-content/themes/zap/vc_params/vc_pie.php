<?php
/**
* Add row params
*
* @author CMS-Theme
* @since 1.0.0
*/
vc_add_param("vc_pie", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("Heading size", 'zap'),
    "param_name" => "heading_size",
    "value" => array(
        "Default" => "h4",
        "Heading 1" => "h1",
        "Heading 2" => "h2",
        "Heading 3" => "h3",
        "Heading 4" => "h4",
        "Heading 5" => "h5",
        "Heading 6" => "h6"
    ),
    "description" => 'Select your heading size for title.'
));
vc_add_param("vc_pie", array(
    "type" => "colorpicker",
    "class" => "",
    "heading" => esc_html__('Title Color', 'zap'),
    "param_name" => "title_color",
));
vc_add_param("vc_pie", array(
    'type' => 'textfield',
    'heading' => esc_html__('Pie icon', 'zap'),
    'param_name' => 'icon',
    'value' => '',
    'admin_label' => true
));
vc_add_param("vc_pie", array(
    'type' => 'textfield',
    'heading' => esc_html__('Icon Size', 'zap'),
    'param_name' => 'icon_size',
    'description' => esc_html__('Font size of icon', 'zap'),
    'value' => '24',
    'admin_label' => true
));
vc_add_param("vc_pie", array(
    'type' => 'colorpicker',
    'heading' => esc_html__('Icon Color', 'zap'),
    'param_name' => 'icon_color',
    'value' => '#888',
    'admin_label' => true
));
vc_remove_param("vc_pie", "color");
vc_add_param("vc_pie", array(
    'type' => 'colorpicker',
    'heading' => esc_html__('Bar color', 'zap'),
    'param_name' => 'color',
    'value' => '#00c3b6', // $pie_colors,
    'description' => esc_html__('Select pie chart color.', 'zap'),
    'admin_label' => true,
    'param_holder_class' => 'vc-colored-dropdown'
));
vc_add_param("vc_pie", array(
    "type" => "textfield",
    "class" => "",
    "heading" => esc_html__("Bar Width", 'zap'),
    "param_name" => "pie_width",
    "value" => "12",
));
vc_add_param("vc_pie", array(
    "type" => "textfield",
    "class" => "",
    "heading" => esc_html__("Description", 'zap'),
    "param_name" => "desc",
    "value" => "",
));
vc_add_param("vc_pie", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("Style", 'zap'),
    "param_name" => "style",
    "value" => array(
        "Style 1" => "style1",
        "Style 2" => "style2"
    ),
    "description" => esc_html__("Select style for pie.", 'zap')
));
vc_add_param("vc_pie", array(
    "type" => "textfield",
    "class" => "",
    "heading" => esc_html__("Icon", 'zap'),
    "param_name" => "icon",
    "value" => "",
    "description" => esc_html__('You can find icon class at here: <a target="_blank" href="http://fontawesome.io/icons/">"http://fontawesome.io/icons/</a>. For example, fa fa-heart', 'zap')
));
