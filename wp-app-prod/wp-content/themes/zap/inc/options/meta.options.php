<?php
/**
 * Meta options
 * 
 * @author CMS-Theme
 * @since 1.0.0
 */
class ZOMetaOptions
{
    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('admin_enqueue_scripts', array($this, 'admin_script_loader'));
    }
    /* add script */
    function admin_script_loader()
    {
        global $pagenow;
        if (is_admin() && ($pagenow == 'post-new.php' || $pagenow == 'post.php')) {
            wp_enqueue_style('metabox', get_template_directory_uri() . '/inc/options/css/metabox.css');
            
            wp_enqueue_script('easytabs', get_template_directory_uri() . '/inc/options/js/jquery.easytabs.min.js');
            wp_enqueue_script('metabox', get_template_directory_uri() . '/inc/options/js/metabox.js');
        }
    }
    /* add meta boxs */
    public function add_meta_boxes()
    {
        $this->add_meta_box('template_page_options', esc_html__('Setting', 'zap'), 'page');
        $this->add_meta_box('testimonial_options', esc_html__('Testimonial about', 'zap'), 'testimonial');
        $this->add_meta_box('pricing_options', esc_html__('Pricing Option', 'zap'), 'pricing');
        $this->add_meta_box('team_options', esc_html__('Team About', 'zap'), 'team');
        $this->add_meta_box('portfolio_options', esc_html__('Portfolio About', 'zap'), 'portfolio');
    }
    
    public function add_meta_box($id, $label, $post_type, $context = 'advanced', $priority = 'default')
    {
        add_meta_box('_zo_' . $id, $label, array($this, $id), $post_type, $context, $priority);
    }
    /* --------------------- PAGE ---------------------- */
    function template_page_options() {
        global $smof_data;
        ?>
        <div class="tab-container clearfix">
	        <ul class='etabs clearfix'>
	           <li class="tab"><a href="#tabs-general"><i class="fa fa-server"></i><?php esc_html_e('General', 'zap'); ?></a></li>
	           <li class="tab"><a href="#tabs-header"><i class="fa fa-diamond"></i><?php esc_html_e('Header', 'zap'); ?></a></li>
	           <li class="tab"><a href="#tabs-page-title"><i class="fa fa-connectdevelop"></i><?php esc_html_e('Page Title', 'zap'); ?></a></li>
	        </ul>
	        <div class='panel-container'>
                <div id="tabs-general">
                <?php
                zo_options(array(
                    'id' => 'full_width',
                    'label' => esc_html__('Full Width','zap'),
                    'type' => 'switch',
                    'options' => array('on'=>'1','off'=>''),
                ));
                zo_options(array(
	                'id' => 'page_layout',
	                'label' => esc_html__("Page layout", 'zap'),
	                'type' => 'select',
	                'options' => array(
		                "" => "Default Wide",
		                "boxed" => "Boxed",
	                ),
                ));
                ?>
                </div>
                <div id="tabs-header">
                <?php
                /* header. */
                zo_options(array(
                    'id' => 'header',
                    'label' => esc_html__('Header','zap'),
                    'type' => 'switch',
                    'options' => array('on'=>'1','off'=>''),
                    'follow' => array('1'=>array('#page_header_enable'))
                ));
                ?>  <div id="page_header_enable"><?php
                zo_options(array(
                    'id' => 'header_layout',
                    'label' => esc_html__('Layout','zap'),
                    'type' => 'imegesselect',
                    'options' => array(
                        '' => get_template_directory_uri().'/inc/options/images/header/h-default.png',
                        '1' => get_template_directory_uri().'/inc/options/images/header/header-1.png',
                        '2' => get_template_directory_uri().'/inc/options/images/header/header-2.png',
						'3' => get_template_directory_uri().'/inc/options/images/header/header-3.png'
                    )
                ));
				zo_options(array(
					'id' => 'header_logo',
					'label' => esc_html__('Logo','zap'),
					'type' => 'image'
				));
				?>
				<div id="page_header_logo_menu_canvans">
				<?php
					zo_options(array(
						'id' => 'header_logo_canvans',
						'label' => esc_html__('Logo on canvans','zap'),
						'type' => 'image'
					));
				?>
				</div>
				<?php
                if($smof_data['menu_transparent']) {
                    zo_options(array(
                        'id' => 'disable_header_transparent',
                        'label' => esc_html__('Disable Header Transparent','zap'),
                        'type' => 'switch',
                        'options' => array('on'=>'1','off'=>''),
                    ));
                }
                /*
                 * Custom main menu color
                 */
                zo_options(array(
                    'id' => 'enable_header_menu',
                    'label' => esc_html__('Custom Header Menu Color','zap'),
                    'type' => 'switch',
                    'options' => array('on'=>'1','off'=>''),
                    'follow' => array('1'=>array('#page_header_menu_enable'))
                ));
                ?> <div id="page_header_menu_enable"><?php
                zo_options(array(
                    'id' => 'header_menu_color',
                    'label' => esc_html__('Menu Color - First Level','zap'),
                    'type' => 'color',
                    'default' => ''
                ));
                zo_options(array(
                    'id' => 'header_menu_color_hover',
                    'label' => esc_html__('Menu Hover - First Level','zap'),
                    'type' => 'color',
                    'default' => ''
                ));
                zo_options(array(
                    'id' => 'header_menu_color_active',
                    'label' => esc_html__('Menu Active - First Level','zap'),
                    'type' => 'color',
                    'default' => ''
                ));
                ?> </div><?php
                /*
                 * Custom menu color for header fixed
                 */
                zo_options(array(
                    'id' => 'enable_header_fixed',
                    'label' => esc_html__('Header Fixed','zap'),
                    'type' => 'switch',
                    'options' => array('on'=>'1','off'=>''),
                    'follow' => array('1'=>array('#page_header_fixed_enable'))
                ));
                ?> <div id="page_header_fixed_enable"><?php
                zo_options(array(
                    'id' => 'header_fixed_bg_color',
                    'label' => esc_html__('Header Fixed - Background Color','zap'),
                    'type' => 'color',
                    'default' => '#fff',
                    'rgba' => true
                ));
                zo_options(array(
                    'id' => 'header_fixed_menu_color',
                    'label' => esc_html__('Header Fixed - Menu Color - First Level','zap'),
                    'type' => 'color',
                    'default' => ''
                ));
                zo_options(array(
                    'id' => 'header_fixed_menu_color_hover',
                    'label' => esc_html__('Header Fixed - Menu Hover Color - First Level','zap'),
                    'type' => 'color',
                    'default' => ''
                ));
                zo_options(array(
                    'id' => 'header_fixed_menu_color_active',
                    'label' => esc_html__('Header Fixed - Menu Active Color - First Level','zap'),
                    'type' => 'color',
                    'default' => ''
                ));
                ?> </div><?php
                $menus = array();
                $menus[''] = 'Default';
                $obj_menus = wp_get_nav_menus();
                foreach ($obj_menus as $obj_menu){
                    $menus[$obj_menu->term_id] = $obj_menu->name;
                }
                $navs = get_registered_nav_menus();
                foreach ($navs as $key => $mav){
                    zo_options(array(
                    'id' => $key,
                    'label' => $mav,
                    'type' => 'select',
                    'options' => $menus
                    ));
                }
                ?>
                </div>
                </div>
                <div id="tabs-page-title">
                <?php
                /* page title. */
                zo_options(array(
                    'id' => 'page_title',
                    'label' => esc_html__('Page Title','zap'),
                    'type' => 'switch',
                    'options' => array('on'=>'1','off'=>''),
                    'follow' => array('1'=>array('#page_title_enable'))
                ));
                ?>  <div id="page_title_enable"><?php
                zo_options(array(
                    'id' => 'page_title_text',
                    'label' => esc_html__('Title','zap'),
                    'type' => 'text',
                ));
                zo_options(array(
                    'id' => 'page_title_sub_text',
                    'label' => esc_html__('Sub Title','zap'),
                    'type' => 'text',
                ));
                zo_options(array(
                    'id' => 'page_title_margin',
                    'label' => esc_html__('Page Title Margin','zap'),
                    'type' => 'text',
                ));
                zo_options(array(
                    'id' => 'page_title_background',
                    'label' => esc_html__('Page Title Background','zap'),
                    'type' => 'image',
                ));
                zo_options(array(
                    'id' => 'page_title_type',
                    'label' => esc_html__('Layout','zap'),
                    'type' => 'imegesselect',
                    'options' => array(
                        '' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-0.png',
                        '1' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-1.png',
                        '2' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-2.png',
                        '3' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-3.png',
                        '4' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-4.png',
                        '5' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-5.png',
                        '6' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-6.png',
                    )
                ));
                ?>
                </div>
                </div>
            </div>
        </div>
        <?php
    }
    /* --------------------- RATING TESTIMONIAL ---------------------- */
    function testimonial_options(){
        ?>
        <div class="testimonial-rating">
            <?php
                zo_options(array(
                    'id' => 'testimonial_position',
                    'label' => esc_html__('Client Position','zap'),
                    'type' => 'text',
                ));
            ?>
        </div>
        <?php
    }
    /* --------------------- PRICING ---------------------- */

    function pricing_options() {
        ?>
        <div class="pricing-option-wrap">
            <table class="wp-list-table widefat fixed">
                <tr>
                    <td>
                        <?php
						zo_options(array(
                            'id' => 'background',
                            'label' => esc_html__('Background Title','zap'),
                            'type' => 'image',
                        ));
						zo_options(array(
                            'id' => 'subtitle',
                            'label' => esc_html__('Sub Title','zap'),
                            'type' => 'text',
                        ));
                        zo_options(array(
                            'id' => 'price',
                            'label' => esc_html__('Price','zap'),
                            'type' => 'text',
                        ));
						
						zo_options(array(
                            'id' => 'hot',
                            'label' => esc_html__('Hot','zap'),
                            'type' => 'switch',
                            'options' => array('on'=>'1','off'=>''),
                        ));

                        zo_options(array(
                            'id' => 'value',
                            'label' => esc_html__('Value','zap'),
                            'type' => 'select',
                            'options' => array(
                                'Monthly' => 'Monthly',
                                'Year' => 'Year'
                            )
                        ));

                        zo_options(array(
                            'id' => 'icon_font',
                            'label' => esc_html__('Icon Font','zap'),
                            'type' => 'icon'
                        ));

                        zo_options(array(
                            'id' => 'icon_image',
                            'label' => esc_html__('Icon Image','zap'),
                            'type' => 'image'
                        ));

                        zo_options(array(
                            'id' => 'button_url',
                            'label' => esc_html__('Button Url','zap'),
                            'type' => 'text',
                        ));

                        zo_options(array(
                            'id' => 'button_text',
                            'label' => esc_html__('Button Text','zap'),
                            'type' => 'text',
                        ));

                        zo_options(array(
                            'id' => 'is_feature',
                            'label' => esc_html__('Is feature','zap'),
                            'type' => 'switch',
                            'options' => array('on'=>'1','off'=>''),
                        )); ?>
                    </td>
                    <td>
                        <div class="zo_metabox_group">
                            <?php
                            zo_options(array(
                                'id' => 'option1',
                                'label' => esc_html__('Option 1','zap'),
                                'type' => 'text',
                            )); ?>
                            <?php
                            zo_options(array(
                                'id' => 'option1_feature',
                                'label' => esc_html__('Option 1 Feature','zap'),
                                'type' => 'switch',
                                'options' => array('on'=>'1','off'=>''),
                            )); ?>
                            <!--end option-->
                        </div>
                        <div class="zo_metabox_group">
                            <?php
                            zo_options(array(
                                'id' => 'option2',
                                'label' => esc_html__('Option 2', 'zap'),
                                'type' => 'text',
                            )); ?>
                            <?php
                            zo_options(array(
                                'id' => 'option2_feature',
                                'label' => esc_html__('Option 2 Feature', 'zap'),
                                'type' => 'switch',
                                'options' => array('on' => '1', 'off' => ''),
                            )); ?>
                            <!--end option-->
                        </div>
                        <div class="zo_metabox_group">
                            <?php
                            zo_options(array(
                                'id' => 'option3',
                                'label' => esc_html__('Option 3', 'zap'),
                                'type' => 'text',
                            )); ?>
                            <?php
                            zo_options(array(
                                'id' => 'option3_feature',
                                'label' => esc_html__('Option 3 Feature', 'zap'),
                                'type' => 'switch',
                                'options' => array('on' => '1', 'off' => ''),
                            )); ?>
                            <!--end option-->
                        </div>
                        <div class="zo_metabox_group">
                            <?php
                            zo_options(array(
                                'id' => 'option4',
                                'label' => esc_html__('Option 4', 'zap'),
                                'type' => 'text',
                            )); ?>
                            <?php
                            zo_options(array(
                                'id' => 'option4_feature',
                                'label' => esc_html__('Option 4 Feature', 'zap'),
                                'type' => 'switch',
                                'options' => array('on' => '1', 'off' => ''),
                            )); ?>
                            <!--end option-->
                        </div>
                        <div class="zo_metabox_group">
                            <?php
                            zo_options(array(
                                'id' => 'option5',
                                'label' => esc_html__('Option 5', 'zap'),
                                'type' => 'text',
                            )); ?>
                            <?php
                            zo_options(array(
                                'id' => 'option5_feature',
                                'label' => esc_html__('Option 5 Feature', 'zap'),
                                'type' => 'switch',
                                'options' => array('on' => '1', 'off' => ''),
                            )); ?>
                            <!--end option-->
                        </div>
                        <div class="zo_metabox_group">
                            <?php
                            zo_options(array(
                                'id' => 'option6',
                                'label' => esc_html__('Option 6', 'zap'),
                                'type' => 'text',
                            )); ?>
                            <?php
                            zo_options(array(
                                'id' => 'option6_feature',
                                'label' => esc_html__('Option 6 Feature', 'zap'),
                                'type' => 'switch',
                                'options' => array('on' => '1', 'off' => ''),
                            )); ?>
                            <!--end option-->
                        </div>
                        <div class="zo_metabox_group">
                            <?php
                            zo_options(array(
                                'id' => 'option7',
                                'label' => esc_html__('Option 7', 'zap'),
                                'type' => 'text',
                            )); ?>
                            <?php
                            zo_options(array(
                                'id' => 'option7_feature',
                                'label' => esc_html__('Option 7 Feature', 'zap'),
                                'type' => 'switch',
                                'options' => array('on' => '1', 'off' => ''),
                            )); ?>
                            <!--end option-->
                        </div>
                        <div class="zo_metabox_group">
                            <?php
                            zo_options(array(
                                'id' => 'option8',
                                'label' => esc_html__('Option 8', 'zap'),
                                'type' => 'text',
                            )); ?>
                            <?php
                            zo_options(array(
                                'id' => 'option8_feature',
                                'label' => esc_html__('Option 8 Feature', 'zap'),
                                'type' => 'switch',
                                'options' => array('on' => '1', 'off' => ''),
                            )); ?>
                            <!--end option-->
                        </div>
                        <div class="zo_metabox_group">
                            <?php
                            zo_options(array(
                                'id' => 'option9',
                                'label' => esc_html__('Option 9', 'zap'),
                                'type' => 'text',
                            )); ?>
                            <?php
                            zo_options(array(
                                'id' => 'option9_feature',
                                'label' => esc_html__('Option 9 Feature', 'zap'),
                                'type' => 'switch',
                                'options' => array('on' => '1', 'off' => ''),
                            )); ?>
                            <!--end option-->
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    <?php
    }
    /* --------------------- PRICING ---------------------- */

    /*-----------------------TEAM-------------------------*/
    function team_options() {
        ?>

            <div class="tab-container clearfix">
                <ul class='etabs clearfix'>
                    <li class="tab"><a href="#tabs-position"><i class="fa fa-server"></i><?php esc_html_e('Position', 'zap'); ?></a></li>
                   <li class="tab"><a href="#tabs-general"><i class="fa fa-server"></i><?php esc_html_e('General', 'zap'); ?></a></li>
                </ul>
                <div class='panel-container'>
                    <div id="tabs-position">
                        <?php
                        zo_options(array(
                            'id' => 'team_position',
                            'label' => esc_html__('Position', 'zap'),
                            'type' => 'text',
                            'placeholder' => '',
                        ));
                        ?>
                    </div>
                    <div id="tabs-general">
                        <?php
                        zo_options(array(
                            'id' => 'socials',
                            'label' => esc_html__('Socials of team','zap'),
                            'type' => 'social',
                        ));
                        ?>
                    </div>
                </div>
            </div>
        <?php
    }
    /*-----------------------Portfolio-------------------------*/
    function portfolio_options() {
        ?>
        <div class="tab-container clearfix">
            <ul class='etabs clearfix'>
                <li class="tab"><a href="#tabs-about"><i class="fa fa-server"></i><?php esc_html_e('About', 'zap'); ?></a></li>
                <li class="tab"><a href="#tabs-layout"><i class="fa fa-server"></i><?php esc_html_e('Layout', 'zap'); ?></a></li>
            </ul>
            <div class='panel-container'>
                <div id="tabs-about">
                    <?php
                    zo_options(array(
                        'id' => 'portfolio_client',
                        'label' => esc_html__('Client', 'zap'),
                        'type' => 'text',
                        'placeholder' => '',
                    ));
                    zo_options(array(
                        'id' => 'portfolio_date',
                        'label' => esc_html__('Date', 'zap'),
                        'type' => 'date',
                        'placeholder' => '',
                    ));
                    zo_options(array(
                        'id' => 'portfolio_skills',
                        'label' => esc_html__('Skills', 'zap'),
                        'type' => 'text',
                        'placeholder' => '',
                    ));
                    zo_options(array(
                        'id' => 'portfolio_url',
                        'label' => esc_html__('URL', 'zap'),
                        'type' => 'text',
                        'value' => '#',
                    ));
                    zo_options(array(
                        'id' => 'portfolio_images',
                        'label' => esc_html__('Gallery', 'zap'),
                        'type' => 'images',
                    ));
                    ?>
                </div>
                <div id="tabs-layout">
                    <?php
                    zo_options(array(
                        'id' => 'portfolio_layout',
                        'label' => esc_html__('Layout', 'zap'),
                        'type' => 'select',
                        'options' => array(
                            '' => 'Default',
                            'gallery' => 'Gallery'
                        )
                    ));
                    ?>
                </div>
            </div>
        </div>


        <?php
    }
}

new ZOMetaOptions();