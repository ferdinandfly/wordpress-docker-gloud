<?php
global $zo_base;
/* get local fonts. */
$local_fonts = is_admin() ? $zo_base->getListLocalFontsName() : array() ;
/**
 * Home Options
 *
 * @author CMS-Theme
 */
$this->sections[] = array(
    'title' => esc_html__('Main Options', 'zap'),
    'icon' => 'el-icon-dashboard',
    'fields' => array(
        array(
            'id' => 'intro_product',
            'type' => 'intro_product',
        )
    )
);
/**
 * Header Options
 *
 * @author CMS-Theme
 */
$this->sections[] = array(
    'title' => esc_html__('Header', 'zap'),
    'icon' => 'el-icon-credit-card',
    'fields' => array(
        array(
            'id' => 'header_layout',
            'title' => esc_html__('Layouts', 'zap'),
            'subtitle' => esc_html__('select a layout for header', 'zap'),
            'default' => '',
            'type' => 'image_select',
            'options' => array(
                '' => get_template_directory_uri().'/inc/options/images/header/h-default.png',
                '1' => get_template_directory_uri().'/inc/options/images/header/header-1.png',
                '2' => get_template_directory_uri().'/inc/options/images/header/header-2.png',
                '3' => get_template_directory_uri().'/inc/options/images/header/header-3.png',
            )
        ),
        array(
            'id'       => 'header_height',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => esc_html__('Header Height', 'zap'),
            'output' => array('#zo-header'),
            'width' => false,
            'default'  => array(
                'height'  => '100px'
            ),
        ),
        array(
            'id' => 'header_margin',
            'title' => esc_html__('Margin', 'zap'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('body #zo-header'),
            'default' => array(
                'margin-top'     => '20px',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            )
        ),
        array(
            'id' => 'header_padding',
            'title' => esc_html__('Padding', 'zap'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('body #zo-header'),
            'default' => array(
                'padding-top'     => '50',
                'padding-right'   => '0',
                'padding-bottom'  => '0',
                'padding-left'    => '0',
                'units'          => 'px',
            )
        ),
        array(
            'subtitle' => esc_html__('enable transparent mode for header.', 'zap'),
            'id' => 'menu_transparent',
            'type' => 'switch',
            'title' => esc_html__('Transparent Header', 'zap'),
            'default' => true,
        ),
        array(
            'subtitle' => esc_html__('enable sticky mode for menu.', 'zap'),
            'id' => 'menu_sticky',
            'type' => 'switch',
            'title' => esc_html__('Sticky Header', 'zap'),
            'default' => false,
        ),
        array(
            'id'       => 'menu_sticky_height',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => esc_html__('Sticky Header Height', 'zap'),
            'width' => false,
            'default'  => array(
                'height'  => '100px'
            ),
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        ),
        array(
            'id' => 'menu_sticky_header_margin',
            'title' => esc_html__('Sticky Header Margin', 'zap'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('body #zo-header.header-fixed'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        ),
        array(
            'id' => 'menu_sticky_header_padding',
            'title' => esc_html__('Sticky Header Padding', 'zap'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('body #zo-header.header-fixed'),
            'default' => array(
                'padding-top'     => '0',
                'padding-right'   => '0',
                'padding-bottom'  => '0',
                'padding-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => esc_html__('enable sticky mode for menu Tablets.', 'zap'),
            'id' => 'menu_sticky_tablets',
            'type' => 'switch',
            'title' => esc_html__('Sticky Tablets', 'zap'),
            'default' => false,
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => esc_html__('enable sticky mode for menu Mobile.', 'zap'),
            'id' => 'menu_sticky_mobile',
            'type' => 'switch',
            'title' => esc_html__('Sticky Mobile', 'zap'),
            'default' => false,
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        )
    )
);

/* Header Top */

$this->sections[] = array(
    'title' => esc_html__('Header Top', 'zap'),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => esc_html__('Enable header top.', 'zap'),
            'id' => 'enable_header_top',
            'type' => 'switch',
            'title' => esc_html__('Enable Header Top', 'zap'),
            'default' => false,
        ),
        array(
            'id' => 'header_top_margin',
            'title' => esc_html__('Margin', 'zap'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('body #zo-header-top'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'enable_header_top', 1 => '=', 2 => 1 )
        ),
        array(
            'id' => 'header_top_padding',
            'title' => esc_html__('Padding', 'zap'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('body #zo-header-top'),
            'default' => array(
                'padding-top'     => '0',
                'padding-right'   => '0',
                'padding-bottom'  => '0',
                'padding-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'enable_header_top', 1 => '=', 2 => 1 )
        ),
    )
);

/* Logo */
$this->sections[] = array(
    'title' => esc_html__('Logo', 'zap'),
    'icon' => 'el-icon-picture',
    'subsection' => true,
    'fields' => array(
        array(
            'title' => esc_html__('Select Logo', 'zap'),
            'subtitle' => esc_html__('Select an image file for your logo.', 'zap'),
            'id' => 'main_logo',
            'type' => 'media',
            'url' => true,
            'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/logo.png'
            )
        ),
        array(
            'id'       => 'main_logo_height',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => esc_html__('Logo Height', 'zap'),
            'width' => false,
            'default'  => array(
                'height'  => '60px'
            ),
        ),
        array(
            'id'       => 'sticky_logo_height',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => esc_html__('Sticky Logo Height', 'zap'),
            'width' => false,
            'default'  => array(
                'height'  => '80px'
            ),
        ),
    )
);

/* Menu */
$this->sections[] = array(
    'title' => esc_html__('Menu', 'zap'),
    'icon' => 'el-icon-tasks',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Menu position.',
            'id' => 'menu_position',
            'options' => array(
                1 => 'Menu Left',
                2 => 'Menu Right',
                3 => 'Menu Center',
            ),
            'type' => 'select',
            'title' => esc_html__('Menu Position', 'zap'),
            'default' => '2'
        ),
        array(
            'id' => 'menu_margin_first_level',
            'title' => esc_html__('Menu Margin - First Level', 'zap'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('#zo-header-navigation .main-navigation .menu-main-menu > li > a',
                '#zo-header-navigation .main-navigation .menu-main-menu > ul > li > a'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '10px',
                'margin-bottom'  => '10px',
                'margin-left'    => '10px',
                'units'          => 'px',
            )
        ),
        array(
            'id' => 'menu_padding_first_level',
            'title' => esc_html__('Menu Padding - First Level', 'zap'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('#zo-header-navigation .main-navigation .menu-main-menu > li > a',
                '#zo-header-navigation .main-navigation .menu-main-menu > ul > li > a'),
            'default' => array(
                'padding-top'     => '0',
                'padding-right'   => '0',
                'padding-bottom'  => '20px',
                'padding-left'    => '0',
                'units'          => 'px',
            )
        ),
        array(
            'id' => 'menu_fontsize_first_level',
            'type' => 'typography',
            'title' => esc_html__('Menu Font Size - First Level', 'zap'),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('#zo-header-navigation .main-navigation .menu-main-menu > li > a',
                '#zo-header-navigation .main-navigation .menu-main-menu > ul > li > a'),
            'units' => 'px',
            'default' => array(
                'font-size' => '14px',
            )
        ),
        array(
            'id' => 'menu_fontsize_sub_level',
            'type' => 'typography',
            'title' => esc_html__('Menu Font Size - Sub Level', 'zap'),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('#zo-header-navigation .main-navigation .menu-main-menu > li ul a',
                '#zo-header-navigation .main-navigation .menu-main-menu > ul > li ul a'),
            'units' => 'px',
            'default' => array(
                'font-size' => '11px',
            )
        ),
        array(
            'subtitle' => esc_html__('enable sub menu border bottom.', 'zap'),
            'id' => 'menu_border_color_bottom',
            'type' => 'switch',
            'title' => esc_html__('Border Bottom Menu Item Sub Level', 'zap'),
            'default' => false,
        ),
        array(
            'subtitle' => esc_html__('Enable mega menu.', 'zap'),
            'id' => 'menu_mega',
            'type' => 'switch',
            'title' => esc_html__('Mega Menu', 'zap'),
            'default' => true,
        ),
        array(
            'subtitle' => esc_html__('Enable menu first level uppercase.', 'zap'),
            'id' => 'menu_first_level_uppercase',
            'type' => 'switch',
            'title' => esc_html__('Menu First Level Uppercase', 'zap'),
            'default' => false,
        ),
        array(
            'id' => 'menu_icon_font_size',
            'type' => 'typography',
            'title' => esc_html__('Menu Icon Font Size', 'zap'),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('#zo-header.zo-main-header .menu-main-menu > li > a i'),
            'units' => 'px',
            'default' => array(
                'font-size' => '12px',
            )
        ),
    )
);

/* Stick Menu */
$this->sections[] = array(
    'title' => esc_html__('Stick Menu', 'zap'),
    'icon' => 'el-icon-tasks',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'stick_menu_fontsize_first_level',
            'type' => 'typography',
            'title' => esc_html__('Stick Menu Font Size - First Level', 'zap'),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('#zo-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > li > a',
                '#zo-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > ul > li > a'),
            'units' => 'px',
            'default' => array(
                'font-size' => '14px',
            )
        ),
        array(
            'id' => 'sticky_menu_fontsize_sub_level',
            'type' => 'typography',
            'title' => esc_html__('Sticky Menu Font Size - Sub Level', 'zap'),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('#zo-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > li ul li a',
                '#zo-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > ul > li ul li a '),
            'units' => 'px',
            'default' => array(
                'font-size' => '11px',
            )
        ),
        array(
            'id' => 'sticky_menu_icon_font_size',
            'type' => 'typography',
            'title' => esc_html__('Sticky Menu Icon Font Size', 'zap'),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('#zo-header.zo-main-header.header-fixed .menu-main-menu > li > a i'),
            'units' => 'px',
            'default' => array(
                'font-size' => '11px',
            )
        ),

    )
);

/**
 * Page Title
 *
 * @author CMS-Theme
 */

/**
 * Page title settings
 *
 */
$page_title = array(
    array(
        'id' => 'page_title_layout',
        'title' => esc_html__('Layouts', 'zap'),
        'subtitle' => esc_html__('select a layout for page title', 'zap'),
        'default' => '5',
        'type' => 'image_select',
        'options' => array(
            '' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-0.png',
            '1' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-1.png',
            '2' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-2.png',
            '3' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-3.png',
            '4' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-4.png',
            '5' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-5.png',
            '6' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-6.png',
        )
    ),
    array(
        'id'       => 'page_title_background',
        'type'     => 'background',
        'title'    => esc_html__( 'Background', 'zap' ),
        'subtitle' => esc_html__( 'page title background with image, color, etc.', 'zap' ),
        'output'   => array('#zo-page-element-wrap'),
        'default'   => array(
            'background-color'=>'#ffffff',
            'background-image'=> get_template_directory_uri().'/assets/images/pagetitle.jpg',
            'background-repeat'=>'',
            'background-size'=>'cover',
            'background-attachment'=>'',
            'background-position'=>'center center'
        )
    ),
    array(
        'id' => 'page_title_margin',
        'title' => esc_html__('Margin', 'zap'),
        'type' => 'spacing',
        'units' => 'px',
        'mode' => 'margin',
        'output' => array('#zo-page-element-wrap'),
        'default' => array(
            'margin-top'     => '0',
            'margin-right'   => '0',
            'margin-bottom'  => '80px',
            'margin-left'    => '0',
            'units'          => 'px',
        )
    ),
    array(
        'id' => 'page_title_padding',
        'title' => esc_html__('Padding', 'zap'),
        'type' => 'spacing',
        'units' => 'px',
        'mode' => 'padding',
        'output' => array('#zo-page-element-wrap'),
        'default' => array(
            'padding-top'     => '345px',
            'padding-right'   => '0',
            'padding-bottom'  => '260px',
            'padding-left'    => '0',
            'units'          => 'px',
        )
    ),
    array(
        'id' => 'page_title_parallax',
        'title' => esc_html__('Enable Header Parallax', 'zap'),
        'type' => 'switch',
        'default' => false
    ),
    array(
        'id' => 'page_title_custom_post',
        'title' => esc_html__('Custom Background For Post Type', 'zap'),
        'type' => 'switch',
        'default' => false
    ),
);
/**
 * add custom background for post type
 */
$post_types = zo_list_post_types();
foreach( $post_types as $type => $name) {
    $page_title[] = array(
        'id'       => 'page_title_custom_post_' . $type,
        'type'     => 'background',
        'title'    => sprintf( __( 'Background For %s' , 'zap'), $name),
        'subtitle' => sprintf( __( 'Custom background image for post type %s', 'zap' ), $name),
        'output'   => array('.single-'.$type.' #zo-page-element-wrap', '.post-type-archive-'.$type.' #zo-page-element-wrap'),
        'background-color' => false,
        'background-repeat' => false,
        'background-size' => false,
        'background-attachment' => false,
        'background-position' => false,
        'default'   => array(
            'background-image'=> '',
        ),
        'required' => array( 'page_title_custom_post', '=', 1 )
    );
}
/**
 * Section settings
 */
$this->sections[] = array(
    'title' => esc_html__('Page Title & BC', 'zap'),
    'icon' => 'el-icon-map-marker',
    'fields' => $page_title
);

/* Page Title */
$this->sections[] = array(
    'icon' => 'el-icon-podcast',
    'title' => esc_html__('Page Title', 'zap'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'page_title_typography',
            'type' => 'typography',
            'title' => esc_html__('Typography', 'zap'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('.page-title #page-title-text h1'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with title text.', 'zap'),
            'default' => array(
                'color' => '#fff',
                'font-style' => 'normal',
                'font-weight' => '700',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '48px',
                'line-height' => '60px',
                'text-align' => 'center'
            )
        ),
        array(
            'id' => 'page_sub_title_typography',
            'type' => 'typography',
            'title' => esc_html__('Sub Title', 'zap'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('.page-title #page-title-text .page-sub-title'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with sub title text.', 'zap'),
            'default' => array(
                'color' => '#fff',
                'font-style' => 'normal',
                'font-weight' => '700',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '24px',
                'line-height' => '36px',
                'text-align' => 'center'
            )
        ),
    )
);
/* Breadcrumb */
$this->sections[] = array(
    'icon' => 'el-icon-random',
    'title' => esc_html__('Breadcrumb', 'zap'),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => esc_html__('The text before the breadcrumb home.', 'zap'),
            'id' => 'breacrumb_home_prefix',
            'type' => 'text',
            'title' => esc_html__('Breadcrumb Home Prefix', 'zap'),
            'default' => 'Home'
        ),
        array(
            'id' => 'breacrumb_typography',
            'type' => 'typography',
            'title' => esc_html__('Typography', 'zap'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('#breadcrumb #breadcrumb-text .breadcrumbs','#breadcrumb #breadcrumb-text ul li a'),
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with title text.', 'zap'),
            'default' => array(
                'color' => '',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '12px',
                'line-height' => '12px',
                'text-align' => 'center'
            )
        ),
    )
);

/**
 * Body
 *
 * @author CMS-Theme
 */
$this->sections[] = array(
    'title' => esc_html__('Body', 'zap'),
    'icon' => 'el-icon-website',
    'fields' => array(
        array(
            'id' => 'body_layout',
            'type' => 'select',
            'options' => array(
	            'zo-wide' => 'Wide',
	            'zo-boxed' => 'Boxed',
	            'zo-vertical-menu' => 'Vertical Menu',
            ),
            'title' => esc_html__('Layout', 'zap'),
            'default' => 'zo-wide',
        ),
        array(
            'id'       => 'body_background',
            'type'     => 'background',
            'title'    => esc_html__( 'Background', 'zap' ),
            'subtitle' => esc_html__( 'body background with image, color, etc.', 'zap' ),
            'output'   => array('body'),
        ),
        array(
            'id' => 'body_margin',
            'title' => esc_html__('Margin', 'zap'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('body #page'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            )
        ),
        array(
            'id' => 'body_padding',
            'title' => esc_html__('Padding', 'zap'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('body #page'),
            'default' => array(
                'padding-top'     => '0',
                'padding-right'   => '0',
                'padding-bottom'  => '0',
                'padding-left'    => '0',
                'units'          => 'px',
            )
        ),
    )
);

/**
 * Content
 *
 * Archive, Pages, Single, 404, Search, Category, Tags ....
 * @author CMS-Theme
 */
$this->sections[] = array(
    'title' => esc_html__('Content', 'zap'),
    'icon' => 'el-icon-compass',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'container_background',
            'type'     => 'background',
            'title'    => esc_html__( 'Background', 'zap' ),
            'subtitle' => esc_html__( 'Container background with image, color, etc.', 'zap' ),
            'output'   => array('#main'),
        ),
        array(
            'id' => 'container_margin',
            'title' => esc_html__('Margin', 'zap'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('body #page #main'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            )
        ),
        array(
            'id' => 'container_padding',
            'title' => esc_html__('Padding', 'zap'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('body #page #main'),
            'default' => array(
                'padding-top'     => '0',
                'padding-right'   => '0',
                'padding-bottom'  => '0',
                'padding-left'    => '0',
                'units'          => 'px',
            )
        )
    )
);

/**
 * Page Loadding
 *
 *
 * @author CMS-Theme
 */
$this->sections[] = array(
    'title' => esc_html__('Page Loadding', 'zap'),
    'icon' => 'el-icon-compass',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => esc_html__('Enable page loadding.', 'zap'),
            'id' => 'enable_page_loadding',
            'type' => 'switch',
            'title' => esc_html__('Enable Page Loadding', 'zap'),
            'default' => false,
        ),
        array(
            'subtitle' => esc_html__('Select Style Page Loadding.', 'zap'),
            'id' => 'page_loadding_style',
            'type' => 'select',
            'options' => array(
                '1' => 'Style 1',
                '2' => 'Style 2'
            ),
            'title' => esc_html__('Page Loadding Style', 'zap'),
            'default' => 'style-1',
            'required' => array( 0 => 'enable_page_loadding', 1 => '=', 2 => 1 )
        )
    )
);

/**
 * Footer
 *
 * @author CMS-Theme
 */
$this->sections[] = array(
    'title' => esc_html__('Footer', 'zap'),
    'icon' => 'el-icon-credit-card',
);

/* Footer top */
$this->sections[] = array(
    'title' => esc_html__('Footer Top', 'zap'),
    'icon' => 'el-icon-fork',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => esc_html__('Enable footer top.', 'zap'),
            'id' => 'enable_footer_top',
            'type' => 'switch',
            'title' => esc_html__('Enable Footer Top', 'zap'),
            'default' => true,
        ),
        array(
            'id'       => 'footer_background',
            'type'     => 'background',
            'title'    => esc_html__( 'Background', 'zap' ),
            'subtitle' => esc_html__( 'footer background with image, color, etc.', 'zap' ),
            'output'   => array('footer #zo-footer-top'),
            'default'   => array(
                'background-color'=>'#202020'
            ),
            'required' => array( 0 => 'enable_footer_top', 1 => '=', 2 => 1 )
        ),
        array(
            'id' => 'footer_margin',
            'title' => esc_html__('Margin', 'zap'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('footer #zo-footer-top'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'enable_footer_top', 1 => '=', 2 => 1 )
        ),
        array(
            'id' => 'footer_padding',
            'title' => esc_html__('Padding', 'zap'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('footer #zo-footer-top'),
            'default' => array(
                'padding-top'     => '60px',
                'padding-right'   => '0',
                'padding-bottom'  => '20px',
                'padding-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'enable_footer_top', 1 => '=', 2 => 1 )
        ),
    )
);

/* footer botton */
$this->sections[] = array(
    'title' => esc_html__('Footer Bottom', 'zap'),
    'icon' => 'el-icon-bookmark',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => esc_html__('Enable footer bottom.', 'zap'),
            'id' => 'enable_footer_bottom',
            'type' => 'switch',
            'title' => esc_html__('Enable Footer Bottom', 'zap'),
            'default' => false,
        ),
        array(
            'id'       => 'footer_botton_background',
            'type'     => 'background',
            'title'    => esc_html__( 'Background', 'zap' ),
            'subtitle' => esc_html__( 'background with image, color, etc.', 'zap' ),
            'output'   => array('footer #zo-footer-bottom'),
            'default'   => array(
                'background-color'=>'#202020'
            ),
            'required' => array( 0 => 'enable_footer_bottom', 1 => '=', 2 => 1 )
        ),
        array(
            'id' => 'footer_bottom_margin',
            'title' => esc_html__('Margin', 'zap'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('footer #zo-footer-bottom'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'enable_footer_bottom', 1 => '=', 2 => 1 )
        ),
        array(
            'id' => 'footer_bottom_padding',
            'title' => esc_html__('Padding', 'zap'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('footer #zo-footer-bottom'),
            'default' => array(
                'padding-top'     => '20px',
                'padding-right'   => '0',
                'padding-bottom'  => '20px',
                'padding-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'enable_footer_bottom', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => esc_html__('enable button back to top.', 'zap'),
            'id' => 'footer_botton_back_to_top',
            'type' => 'switch',
            'title' => esc_html__('Back To Top', 'zap'),
            'default' => true,
        )
    )
);

/**
 * Button Option
 *
 * @author CMS-Theme
 */
$this->sections[] = array(
    'title' => esc_html__('Button', 'zap'),
    'icon' => 'el el-bold',
    'fields' => array(
        array(
            'id' => 'button_font_size',
            'type' => 'typography',
            'title' => esc_html__('Button Font Size', 'zap'),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('.vc_general.vc_btn3.btn , button.vc_general.vc_btn3, a.vc_general.vc_btn3 , .button, .btn, input[type="submit"]'),
            'units' => 'px',
            'default' => array(
                'font-size' => '12px',
            )
        ),
        array(
            'subtitle' => esc_html__('Enable button uppercase.', 'zap'),
            'id' => 'button_text_uppercase',
            'type' => 'switch',
            'title' => esc_html__('Button Text Uppercase', 'zap'),
            'default' => true,
        ),
    )
);

/* Button Default */
$this->sections[] = array(
    'icon' => 'el el-minus',
    'title' => esc_html__('Button Default', 'zap'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'btn_default_padding',
            'title' => esc_html__('Button Default - Padding', 'zap'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('.btn, .vc_general.vc_btn3.btn , button.vc_general.vc_btn3, a.vc_general.vc_btn3, .button, .btn, input[type="submit"]'),
            'default' => array(
                'padding-top'     => '15px',
                'padding-right'   => '35px',
                'padding-bottom'  => '15px',
                'padding-left'    => '35px',
                'units'          => 'px',
            ),
        ),
        array(
            'id'       => 'btn_default_border',
            'type'     => 'border',
            'title'    => esc_html__('Button Default - Border', 'zap'),
            'output'   => array('.btn, .vc_general.vc_btn3.btn , button.vc_general.vc_btn3, a.vc_general.vc_btn3, .button, .btn, input[type="submit"]'),
            'default'  => array(
                'border-style'  => 'solid',
                'border-color'  => '#f0ba00',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'btn_default_border_hover',
            'type'     => 'border',
            'title'    => esc_html__('Button Default - Border Hover', 'zap'),
            'output'   => array('.btn, .vc_general.vc_btn3.btn:hover, button.vc_general.vc_btn3:hover, a.vc_general.vc_btn3:hover, .button:hover, .btn:hover, input[type="submit"]:hover, .vc_general.vc_btn3.btn:focus, button.vc_general.vc_btn3:focus, a.vc_general.vc_btn3:focus, .button:focus, .btn:focus, input[type="submit"]:focus'),
            'default'  => array(
                'border-style'  => 'solid',
                'border-color'  => '#f0ba00',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'btn_default_border_radius',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => esc_html__('Button Default - Border Radius', 'zap'),
            'width' => false,
            'default'  => array(
                'height'  => '0'
            ),
        ),
    )
);

/* Button Primary */
$this->sections[] = array(
    'icon' => 'el el-minus',
    'title' => esc_html__('Button Primary', 'zap'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'btn_primary_padding',
            'title' => esc_html__('Button Primary - Padding', 'zap'),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('.btn.btn-primary, .vc_general.btn.btn-primary'),
            'default' => array(
                'padding-top'     => '15px',
                'padding-right'   => '35px',
                'padding-bottom'  => '15px',
                'padding-left'    => '35px',
                'units'          => 'px',
            ),
        ),
        array(
            'id'       => 'btn_primary_border',
            'type'     => 'border',
            'title'    => esc_html__('Button Primary - Border', 'zap'),
            'output'   => array('.btn.btn-primary, .vc_general.vc_btn3.btn.btn-primary'),
            'default'  => array(
                'border-style'  => 'solid',
                'border-color'  => '#fcc403',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'btn_primary_border_hover',
            'type'     => 'border',
            'title'    => esc_html__('Button Primary - Border Hover', 'zap'),
            'output'   => array('.btn.btn-primary, .vc_general.vc_btn3.btn.btn-primary:hover, .vc_general.vc_btn3.btn.btn-primary:focus'),
            'default'  => array(
                'border-style'  => 'solid',
                'border-color'  => '#fcc403',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'btn_primary_border_radius',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => esc_html__('Button Primary - Border Radius', 'zap'),
            'width' => false,
            'default'  => array(
                'height'  => '0'
            ),
        ),
    )
);
/**
 * Styling
 *
 * css color.
 * @author CMS-Theme
 */
$this->sections[] = array(
    'title' => esc_html__('Styling', 'zap'),
    'icon' => 'el-icon-adjust',
    'fields' => array(
        array(
            'subtitle' => esc_html__('set color main color.', 'zap'),
            'id' => 'primary_color',
            'type' => 'color',
            'title' => esc_html__('Primary Color', 'zap'),
            'default' => '#fcc403'
        ),
        array(
            'id' => 'secondary_color',
            'type' => 'color',
            'title' => esc_html__('Secondary Color', 'zap'),
            'default' => '#ffdd00'
        ),
        array(
            'subtitle' => esc_html__('set color for tags <a></a>.', 'zap'),
            'id' => 'link_color',
            'type' => 'color',
            'title' => esc_html__('Link Color', 'zap'),
            'output'  => array('a'),
            'default' => '#333'
        ),
        array(
            'subtitle' => esc_html__('set color for tags <a></a>.', 'zap'),
            'id' => 'link_color_hover',
            'type' => 'color',
            'title' => esc_html__('Link Color Hover', 'zap'),
            'output'  => array('a:hover'),
            'default' => '#fcc403'
        ),
	    array(
		    'subtitle' => esc_html__('select presets color.', 'zap'),
		    'id' => 'presets_color',
		    'type' => 'image_select',
		    'title' => esc_html__('Presets Color', 'zap'),
		    'default' => '0',
		    'options' => array(
			    '0' => get_template_directory_uri().'/inc/options/images/presets/pr-c-1.jpg',
			    '1' => get_template_directory_uri().'/inc/options/images/presets/pr-c-2.jpg',
			    '2' => get_template_directory_uri().'/inc/options/images/presets/pr-c-3.jpg',
			    '3' => get_template_directory_uri().'/inc/options/images/presets/pr-c-4.jpg',
			    '4' => get_template_directory_uri().'/inc/options/images/presets/pr-c-5.jpg',
			    '5' => get_template_directory_uri().'/inc/options/images/presets/pr-c-6.jpg',
			    '6' => get_template_directory_uri().'/inc/options/images/presets/pr-c-7.jpg',
			    '7' => get_template_directory_uri().'/inc/options/images/presets/pr-c-8.jpg',
			    '8' => get_template_directory_uri().'/inc/options/images/presets/pr-c-9.jpg',
			    '9' => get_template_directory_uri().'/inc/options/images/presets/pr-c-10.jpg',
			    '10' => get_template_directory_uri().'/inc/options/images/presets/pr-c-11.jpg',
			    '11' => get_template_directory_uri().'/inc/options/images/presets/pr-c-12.jpg',
			    '12' => get_template_directory_uri().'/inc/options/images/presets/pr-c-13.jpg',
			    '13' => get_template_directory_uri().'/inc/options/images/presets/pr-c-14.jpg',
			    '14' => get_template_directory_uri().'/inc/options/images/presets/pr-c-15.jpg',
			    '15' => get_template_directory_uri().'/inc/options/images/presets/pr-c-16.jpg',
			    '16' => get_template_directory_uri().'/inc/options/images/presets/pr-c-17.jpg',
			    '17' => get_template_directory_uri().'/inc/options/images/presets/pr-c-18.jpg',
			    '18' => get_template_directory_uri().'/inc/options/images/presets/pr-c-19.jpg',
		    )
	    ),

    )
);

/** Header Top Color **/
$this->sections[] = array(
    'title' => esc_html__('Header Top Color', 'zap'),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => esc_html__('Set background color header top.', 'zap'),
            'id' => 'bg_header_top_color',
            'type' => 'color',
            'title' => esc_html__('Background Color', 'zap'),
            'default' => '#ececec'
        ),
        array(
            'subtitle' => esc_html__('Set color header top.', 'zap'),
            'id' => 'header_top_color',
            'type' => 'color',
            'title' => esc_html__('Font Color', 'zap'),
            'default' => ''
        )
    )
);

/** Header Main Color **/
$this->sections[] = array(
    'title' => esc_html__('Header Main Color', 'zap'),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => esc_html__('set color for header background color.', 'zap'),
            'id' => 'bg_header',
            'type' => 'color_rgba',
            'title' => esc_html__('Header Background Color', 'zap'),
            'default'   => array(
                'alpha'     => 0
            )
        )
    )
);

/** Sticky Header Color **/
$this->sections[] = array(
    'title' => esc_html__('Sticky Header', 'zap'),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => esc_html__('set color for sticky header.', 'zap'),
            'id' => 'bg_sticky_header',
            'type' => 'color_rgba',
            'title' => esc_html__('Sticky Background Color', 'zap'),
            'default'   => array(
                'alpha'     => 0
            ),
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        )
    )
);

/** Menu Color **/

$this->sections[] = array(
    'title' => esc_html__('Menu Color', 'zap'),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => esc_html__('Controls the text color of first level menu items.', 'zap'),
            'id' => 'menu_color_first_level',
            'type' => 'color',
            'title' => esc_html__('Menu Font Color - First Level', 'zap'),
            'default' => '#fff'
        ),
        array(
            'subtitle' => esc_html__('Controls the text hover color of first level menu items.', 'zap'),
            'id' => 'menu_color_hover_first_level',
            'type' => 'color',
            'title' => esc_html__('Menu Font Color Hover - First Level', 'zap'),
            'default' => '#fff'
        ),
        array(
            'subtitle' => esc_html__('Controls the text hover color of first level menu items.', 'zap'),
            'id' => 'menu_color_active_first_level',
            'type' => 'color',
            'title' => esc_html__('Menu Font Color Active - First Level', 'zap'),
            'default' => '#fff'
        ),
        array(
            'subtitle' => esc_html__('Controls the text color of sub level menu items.', 'zap'),
            'id' => 'menu_color_sub_level',
            'type' => 'color',
            'title' => esc_html__('Menu Font Color - Sub Level', 'zap'),
            'default' => '#909090'
        ),
        array(
            'subtitle' => esc_html__('Controls the text hover color of sub level menu items.', 'zap'),
            'id' => 'menu_color_hover_sub_level',
            'type' => 'color',
            'title' => esc_html__('Menu Font Color Hover - Sub Level', 'zap'),
            'default' => '#eeb013'
        ),
        array(
            'subtitle' => esc_html__('Controls the border color of sub level menu items.', 'zap'),
            'id' => 'menu_item_border_color',
            'type' => 'color',
            'title' => esc_html__('Border Color - Sub Level', 'zap'),
            'default' => '',
            'required' => array( 0 => 'menu_border_color_bottom', 1 => '=', 2 => 1 )
        )
    )
);

/** Button Color **/

$this->sections[] = array(
    'title' => esc_html__('Button Color', 'zap'),
    'icon' => 'el el-bold',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => esc_html__('Controls the button text color.', 'zap'),
            'id' => 'btn_default_color',
            'type' => 'color',
            'title' => esc_html__('Button Default - Font Color', 'zap'),
            'default' => '#000000'
        ),
        array(
            'subtitle' => esc_html__('Controls the button text hover color.', 'zap'),
            'id' => 'btn_default_color_hover',
            'type' => 'color',
            'title' => esc_html__('Button Default - Font Color Hover', 'zap'),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => esc_html__('Controls the button background color.', 'zap'),
            'id' => 'btn_default_bg_color',
            'type' => 'color',
            'title' => esc_html__('Button Default - Background Color', 'zap'),
            'default' => 'transparent'
        ),
        array(
            'subtitle' => esc_html__('Controls the button background color.', 'zap'),
            'id' => 'btn_default_bg_color_hover',
            'type' => 'color',
            'title' => esc_html__('Button Default - Background Color Hover', 'zap'),
            'default' => '#f0ba00'
        ),
        array(
            'subtitle' => esc_html__('Controls the button text color.', 'zap'),
            'id' => 'btn_primary_color',
            'type' => 'color',
            'title' => esc_html__('Button Primary - Font Color', 'zap'),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => esc_html__('Controls the button text hover color.', 'zap'),
            'id' => 'btn_primary_color_hover',
            'type' => 'color',
            'title' => esc_html__('Button Primary - Font Color Hover', 'zap'),
            'default' => '#fcc403'
        ),
        array(
            'subtitle' => esc_html__('Controls the button background color.', 'zap'),
            'id' => 'btn_primary_bg_color',
            'type' => 'color',
            'title' => esc_html__('Button Primary - Background Color', 'zap'),
            'default' => '#fcc403'
        ),
        array(
            'subtitle' => esc_html__('Controls the button background color.', 'zap'),
            'id' => 'btn_primary_bg_color_hover',
            'type' => 'color',
            'title' => esc_html__('Button Primary - Background Color Hover', 'zap'),
            'default' => 'transparent'
        ),
    )
);

/** Footer Top Color **/
$this->sections[] = array(
    'title' => esc_html__('Footer Top Color', 'zap'),
    'icon' => 'el-icon-chevron-up',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => esc_html__('Set color footer top.', 'zap'),
            'id' => 'footer_top_color',
            'type' => 'color',
            'title' => esc_html__('Footer Top Color', 'zap'),
            'default' => '#636363'
        ),
        array(
            'subtitle' => esc_html__('Set title color footer top.', 'zap'),
            'id' => 'footer_heading_color',
            'type' => 'color',
            'title' => esc_html__('Footer Heading Color', 'zap'),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => esc_html__('Set title link color footer top.', 'zap'),
            'id' => 'footer_top_link_color',
            'type' => 'color',
            'title' => esc_html__('Footer Link Color', 'zap'),
            'default' => '#636363'
        ),
        array(
            'subtitle' => esc_html__('Set title link color footer top.', 'zap'),
            'id' => 'footer_top_link_color_hover',
            'type' => 'color',
            'title' => esc_html__('Footer Link Color Hover', 'zap'),
            'default' => '#fcc403'
        )
    )
);

/** Footer Bottom Color **/
$this->sections[] = array(
    'title' => esc_html__('Footer Bottom Color', 'zap'),
    'icon' => 'el-icon-chevron-down',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => esc_html__('Set color footer top.', 'zap'),
            'id' => 'footer_bottom_color',
            'type' => 'color',
            'title' => esc_html__('Footer Bottom Color', 'zap'),
            'default' => '#3a3a3a'
        )
    )
);

/**
 * Typography
 *
 * @author CMS-Theme
 */
$this->sections[] = array(
    'title' => esc_html__('Typography', 'zap'),
    'icon' => 'el-icon-text-width',
    'fields' => array(
        array(
            'id' => 'font_body',
            'type' => 'typography',
            'title' => esc_html__('Body Font', 'zap'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body'),
            'units' => 'px',
            'default' => array(
                'color' => '#6f6f6f',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '14px',
                'line-height' => '30px',
                'text-align' => ''
            ),
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'zap'),
        ),
        array(
            'id' => 'font_h1',
            'type' => 'typography',
            'title' => esc_html__('H1', 'zap'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h1'),
            'units' => 'px',
            'default' => array(
                'color' => '#141414',
                'font-style' => 'normal',
                'font-weight' => 'bold',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '36px',
                'line-height' => '60px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h2',
            'type' => 'typography',
            'title' => esc_html__('H2', 'zap'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h2'),
            'units' => 'px',
            'default' => array(
                'color' => '#141414',
                'font-style' => 'normal',
                'font-weight' => 'bold',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '30px',
                'line-height' => '50px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h3',
            'type' => 'typography',
            'title' => esc_html__('H3', 'zap'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h3'),
            'units' => 'px',
            'default' => array(
                'color' => '#141414',
                'font-style' => 'normal',
                'font-weight' => 'bold',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '24px',
                'line-height' => '60px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h4',
            'type' => 'typography',
            'title' => esc_html__('H4', 'zap'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h4'),
            'units' => 'px',
            'default' => array(
                'color' => '#141414',
                'font-style' => 'normal',
                'font-weight' => 'bold',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '24px',
                'line-height' => '40px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h5',
            'type' => 'typography',
            'title' => esc_html__('H5', 'zap'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h5'),
            'units' => 'px',
            'default' => array(
                'color' => '#141414',
                'font-style' => 'normal',
                'font-weight' => 'bold',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '18px',
                'line-height' => '35px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h6',
            'type' => 'typography',
            'title' => esc_html__('H6', 'zap'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h6'),
            'units' => 'px',
            'default' => array(
                'color' => '#141414',
                'font-style' => 'normal',
                'font-weight' => 'bold',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '14px',
                'line-height' => '30px',
                'text-align' => ''
            )
        )
    )
);

/* extra font. */
$this->sections[] = array(
    'title' => esc_html__('Extra Fonts', 'zap'),
    'icon' => 'el el-fontsize',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'google-font-1',
            'type' => 'typography',
            'title' => esc_html__('Font 1', 'zap'),
            'google' => true,
            'font-backup' => false,
            'font-style' => false,
            'color' => false,
            'text-align'=> false,
            'line-height'=>false,
            'font-size'=> false,
            'subsets'=> false,
            'default' => array(
                'font-weight' => '400italic',
                'font-family' => 'Crimson Text'
            )
        ),
        array(
            'id' => 'google-font-selector-1',
            'type' => 'textarea',
            'title' => esc_html__('Selector 1', 'zap'),
            'subtitle' => esc_html__('add html tags ID or class (body,a,.class,#id)', 'zap'),
            'validate' => 'no_html',
            'default' => '.font-second',
        ),
        array(
            'id' => 'google-font-2',
            'type' => 'typography',
            'title' => esc_html__('Font 2', 'zap'),
            'google' => true,
            'font-backup' => false,
            'font-style' => false,
            'color' => false,
            'text-align'=> false,
            'line-height'=>false,
            'font-size'=> false,
            'subsets'=> false,
            'default' => array(
                'font-weight' => '700italic',
                'font-family' => 'Crimson Text'
            )
        ),
        array(
            'id' => 'google-font-selector-2',
            'type' => 'textarea',
            'title' => esc_html__('Selector 2', 'zap'),
            'subtitle' => esc_html__('add html tags ID or class (body,a,.class,#id)', 'zap'),
            'validate' => 'no_html',
            'default' => '.font-second-bold',
        ),
        array(
            'id' => 'google-font-3',
            'type' => 'typography',
            'title' => esc_html__('Font 3', 'zap'),
            'google' => true,
            'font-backup' => false,
            'font-style' => false,
            'color' => false,
            'text-align'=> false,
            'line-height'=>false,
            'font-size'=> false,
            'subsets'=> false,
            'default' => array(
                'font-weight' => '400',
                'font-family' => 'Crimson Text'
            )
        ),
        array(
            'id' => 'google-font-selector-3',
            'type' => 'textarea',
            'title' => esc_html__('Selector 3', 'zap'),
            'subtitle' => esc_html__('add html tags ID or class (body,a,.class,#id)', 'zap'),
            'validate' => 'no_html',
            'default' => '.font-second-normal',
        ),
    )
);

/* local fonts. */
$this->sections[] = array(
    'title' => esc_html__('Local Fonts', 'zap'),
    'icon' => 'el-icon-bookmark',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'local-fonts-1',
            'type'     => 'select',
            'title'    => esc_html__( 'Fonts 1', 'zap' ),
            'options'  => $local_fonts,
            'default'  => '',
        ),
        array(
            'id' => 'local-fonts-selector-1',
            'type' => 'textarea',
            'title' => esc_html__('Selector 1', 'zap'),
            'subtitle' => esc_html__('add html tags ID or class (body,a,.class,#id)', 'zap'),
            'validate' => 'no_html',
            'default' => '',
            'required' => array(
                0 => 'local-fonts-1',
                1 => '!=',
                2 => ''
            )
        ),
        array(
            'id'       => 'local-fonts-2',
            'type'     => 'select',
            'title'    => esc_html__( 'Fonts 2', 'zap' ),
            'options'  => $local_fonts,
            'default'  => '',
        ),
        array(
            'id' => 'local-fonts-selector-2',
            'type' => 'textarea',
            'title' => esc_html__('Selector 2', 'zap'),
            'subtitle' => esc_html__('add html tags ID or class (body,a,.class,#id)', 'zap'),
            'validate' => 'no_html',
            'default' => '',
            'required' => array(
                0 => 'local-fonts-2',
                1 => '!=',
                2 => ''
            )
        )
    )
);

/**
 * Custom CSS
 *
 * extra css for customer.
 * @author CMS-Theme
 */
$this->sections[] = array(
    'title' => esc_html__('Custom CSS', 'zap'),
    'icon' => 'el-icon-bulb',
    'fields' => array(
        array(
            'id' => 'custom_css',
            'type' => 'ace_editor',
            'title' => esc_html__('CSS Code', 'zap'),
            'subtitle' => esc_html__('create your css code here.', 'zap'),
            'mode' => 'css',
            'theme' => 'monokai',
        )
    )
);
/**
 * Animations
 *
 * Animations options for theme. libs css, js.
 * @author CMS-Theme
 */
$this->sections[] = array(
    'title' => esc_html__('Animations', 'zap'),
    'icon' => 'el-icon-magic',
    'fields' => array(
        array(
            'subtitle' => esc_html__('Enable animation parallax for images...', 'zap'),
            'id' => 'paralax',
            'type' => 'switch',
            'title' => esc_html__('Images Paralax', 'zap'),
            'default' => true
        ),
    )
);
/**
 * Optimal Core
 *
 * Optimal options for theme. optimal speed
 * @author CMS-Theme
 */
$this->sections[] = array(
    'title' => esc_html__('Optimal Core', 'zap'),
    'icon' => 'el-icon-idea',
    'fields' => array(
        array(
            'subtitle' => esc_html__('no minimize , generate css over time...', 'zap'),
            'id' => 'dev_mode',
            'type' => 'switch',
            'title' => esc_html__('Dev Mode (not recommended)', 'zap'),
            'default' => false
        )
    )
);