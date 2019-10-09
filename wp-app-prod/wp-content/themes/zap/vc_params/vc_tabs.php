<?php
/**
* Add tabs params
*
* @author CMS-Theme
* @since 1.0.0
*/
vc_add_param("vc_tab", array(
    "type" => "colorpicker",
    "class" => "",
    "heading" => esc_html__("Tab Background Color", 'zap'),
    "param_name" => "zo_tab_bg_color",
    "value" => ""
));
vc_add_param("vc_tab", array(
    "type" => "colorpicker",
    "class" => "",
    "heading" => esc_html__("Tab Border Color", 'zap'),
    "param_name" => "zo_tab_border_color",
    "value" => ""
));
vc_add_param("vc_tab", array(
    "type" => "textfield",
    "heading" => esc_html__("Tab Icon", 'zap'),
    "param_name" => "zo_tab_icon"
));
