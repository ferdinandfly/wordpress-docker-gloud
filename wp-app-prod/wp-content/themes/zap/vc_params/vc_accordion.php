<?php
/**
* Add tabs params
*
* @author CMS-Theme
* @since 1.0.0
*/
vc_add_param("vc_accordion_tab", array(
    "type" => "colorpicker",
    "class" => "",
    "heading" => esc_html__("Accordion Background Color", 'zap'),
    "param_name" => "zo_accordion_bg_color",
    "value" => "",
));
vc_add_param("vc_accordion_tab", array(
    "type" => "colorpicker",
    "class" => "",
    "heading" => esc_html__("Accordion Border Color", 'zap'),
    "param_name" => "zo_accordion_border_color",
    "value" => "",
));
vc_add_param("vc_accordion_tab", array(
    "type" => "textfield",
    "heading" => esc_html__("Accordion Icon", 'zap'),
    "param_name" => "zo_accordion_icon",
    "description" => esc_html__("Select icon website(http://fortawesome.github.io/Font-Awesome/icons;https://icomoon.io/app/)",'zap')
));
