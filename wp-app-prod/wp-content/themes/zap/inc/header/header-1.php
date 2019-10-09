<?php
/**
 * @name : Default
 * @package : ZoTheme
 * @author : Fox
 */
?>
<?php global $smof_data, $zo_meta; ?>
<div id="zo-header" class="zo-main-header zo-header-1 <?php if (!$smof_data['menu_sticky']) {
    echo 'no-sticky';
} ?> <?php if ($smof_data['menu_sticky_tablets']) {
    echo 'sticky-tablets';
} ?> <?php if ($smof_data['menu_sticky_mobile']) {
    echo 'sticky-mobile';
} ?> <?php if (!empty($zo_meta->_zo_enable_header_fixed)) {
    echo 'header-fixed-page';
} ?> <?php if (!empty($zo_meta->_zo_enable_header_menu)) {
    echo 'header-menu-custom';
} ?> <?php if ($smof_data['menu_transparent']) {
    echo 'header-transparent';
} ?> <?php if (!empty($zo_meta->_zo_disable_header_transparent)) {
    echo 'header-transparent-disable';
} ?>">
    <div class="container">
        <div class="row">
            <div id="zo-header-navigation-fixed" class="col-md-2 col-lg-2 col-sm-3 col-xs-2">
                <div id="zo-menu-mobile-fixed" class="navbar-collapse"><i class="fa fa-navicon"></i></div>
                <nav id="site-navigation" class="main-navigation-fixed ">
                    <span class="close">&times;</span>

                    <div class="main-navigation-logo">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <img alt="" src="<?php echo esc_url(zo_page_header_logo_canvas()); ?>">
                        </a>
                    </div>
                    <?php

                    $attr = array(
                        'menu' => zo_menu_location(),
                        'menu_class' => 'menu-main-menu',
                    );

                    $menu_locations = get_nav_menu_locations();

                    if (!empty($menu_locations['primary'])) {
                        $attr['theme_location'] = 'primary';
                    }

                    /* enable mega menu. */
                    if (class_exists('HeroMenuWalker')) {
                        $attr['walker'] = new HeroMenuWalker();
                    }

                    /* main nav. */
                    wp_nav_menu($attr); ?>
                </nav>
            </div>
            <div id="zo-header-logo" class="col-md-8 col-lg-8 col-sm-6 col-xs-8">
                <a href="<?php echo esc_url(home_url('/')); ?>"><img alt="" src="<?php echo esc_url(zo_page_header_logo()); ?>"></a>
            </div>
            <?php if (is_active_sidebar('header-right')): ?>
                <div id="zo-header-right" class="col-xs-2 col-sm-3 col-md-2 col-lg-2">
                    <?php dynamic_sidebar('header-right'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- #site-navigation -->
</div>
<!--#zo-header-->
