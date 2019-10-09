<?php
/**
 * Zo Theme functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package ZoTheme
 * @subpackage Zo Theme
 * @since 1.0.0
 */

require( get_template_directory() . '/inc/base.class.php' );

/* Add ReduxFramework. */
if(!class_exists('ReduxFramework')){
    require( get_template_directory() . '/inc/ReduxCore/framework.php' );
}

/* Add theme options. */
require( get_template_directory() . '/inc/options/functions.php' );

/* Add custom vc params. */
if(class_exists('Vc_Manager')){

    add_action('init', 'zo_vc_params');
    function zo_vc_params() {
        require( get_template_directory() . '/vc_params/vc_rows.php' );
        require( get_template_directory() . '/vc_params/vc_column.php' );
        require( get_template_directory() . '/vc_params/vc_btn.php' );
        require( get_template_directory() . '/vc_params/vc_separator.php' );
        require( get_template_directory() . '/vc_params/vc_tabs.php' );
        require( get_template_directory() . '/vc_params/vc_pie.php' );
        require( get_template_directory() . '/vc_params/vc_custom_heading.php' );
        require( get_template_directory() . '/vc_params/vc_images_carousel.php' );
    }
}
/* Remove Element VC */
if(class_exists('Vc_Manager')){
	vc_remove_element( "vc_button" );
	vc_remove_element( "vc_cta_button" );
	vc_remove_element( "vc_cta_button2" );
}
/* Add SCSS */
if(!class_exists('scssc')){
    require( get_template_directory() . '/inc/ReduxCore/inc/scssphp/scss.inc.php' );
}

/* Add Meta Core Options */
if(is_admin()){

    if(!class_exists('ZoCoreControl')){
        /* add mete core */
        require( get_template_directory() . '/inc/metacore/core.options.php' );
        /* add meta options */
        require( get_template_directory() . '/inc/options/meta.options.php' );
    }

    /* tmp plugins. */
    require( get_template_directory() . '/inc/options/require.plugins.php' );
}

/* Add Template functions */
require( get_template_directory() . '/inc/template.functions.php' );

/* Add Preset functions */
require( get_template_directory() . '/inc/options/presets.php' );
require( get_template_directory() . '/inc/presets/presets.php' );

/* Static css. */
require( get_template_directory() . '/inc/dynamic/static.css.php' );

/* Dynamic css*/
require( get_template_directory() . '/inc/dynamic/dynamic.css.php' );

function zo_megamenu_init() {
	global $smof_data;
	/* Add mega menu */
	if(isset($smof_data['menu_mega']) && $smof_data['menu_mega'] && !class_exists('HeroMenuWalker')){
		require( get_template_directory() . '/inc/megamenu/mega-menu.php' );
	}
}
add_action('init', 'zo_megamenu_init');

/* Add widgets */
require( get_template_directory() . '/inc/widgets/cart_search.php' );
require( get_template_directory() . '/inc/widgets/news_tabs.php' );
require( get_template_directory() . '/inc/widgets/recent_post_v2.php' );
require( get_template_directory() . '/inc/widgets/instagram.php' );
require( get_template_directory() . '/inc/widgets/tweets.php' );
require( get_template_directory() . '/inc/widgets/social.php' );
require( get_template_directory() . '/inc/widgets/recent-posts-widget-with-thumbnails.php' );
require( get_template_directory() . '/inc/widgets/flickr-badges-widget.php' );

// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 625;
/*
 * Limit Words
 */
if (!function_exists('zo_limit_words')) {
    function zo_limit_words($string, $word_limit) {
        $words = explode(' ', strip_tags($string), ($word_limit + 1));
        if (count($words) > $word_limit) {
            array_pop($words);
        }
        return apply_filters('the_excerpt', implode(' ', $words));
    }
}
/**
 * Zo ZAP setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Zo ZAP supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Zo ZAP 1.0
 */
function zo_setup() {
	/*
	 * Makes Zo ZAP available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Zo ZAP, use a find and replace
	 * to change 'zo-zap' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'zap', get_template_directory() . '/languages' );

	// Adds title tag
	add_theme_support( "title-tag" );
	
	// Add woocommerce
	add_theme_support( 'zap' );
	
	// Adds custom header
	add_theme_support( 'custom-header' );
	
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'video', 'audio' , 'gallery', 'link', 'quote',) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'zap' ) );

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	add_image_size('zo-blog-medium', 480, 330, true);
    add_image_size('zo-blog-thumbnail', 370, 340, true);
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'zo_setup' );

/**
 * Add Image Size to Media
 *
 * @param $sizes
 * @return array
 */
function zo_media_image_sizes($sizes) {
    return array_merge( $sizes, array(
        'zo-blog-thumbnail' => 'Image Size 370x340',
        'zo-blog-medium' => 'Image Size 480x330',
    ));
}
add_filter( 'image_size_names_choose', 'zo_media_image_sizes' );


/**
 * Get meta data.
 * @author CMS-Theme
 * @return mixed|NULL
 */
function zo_meta_data(){
    global $post, $zo_meta;

    if(!isset($post->ID)) return ;

    $zo_meta = json_decode(get_post_meta($post->ID, '_zo_meta_data', true));

    if(empty($zo_meta)) return ;

    foreach ($zo_meta as $key => $meta){
        $zo_meta->$key = rawurldecode($meta);
    }
}
add_action('wp', 'zo_meta_data');

/**
 * Get post meta data.
 * @author CMS-Theme
 * @return mixed|NULL
 */
function zo_post_meta_data(){
    global $post;

    if(!isset($post->ID)) return null;

    $post_meta = json_decode(get_post_meta($post->ID, '_zo_meta_data', true));

    if(empty($post_meta)) return null;

    foreach ($post_meta as $key => $meta){
        $post_meta->$key = rawurldecode($meta);
    }

    return $post_meta;
}

/**
 * Enqueue scripts and styles for front-end.
 * @author CMS-Theme
 * @since ZO SuperHeroes 1.0
 */
function zo_scripts_styles() {
    
	global $smof_data, $wp_styles, $wp_scripts;
	
	/** theme options. */
	$script_options = array(
	    'menu_sticky'=> $smof_data['menu_sticky'],
	    'menu_sticky_tablets'=> $smof_data['menu_sticky_tablets'],
	    'menu_sticky_mobile'=> $smof_data['menu_sticky_mobile'],
	    'paralax' => $smof_data['paralax'],
	    'back_to_top'=> $smof_data['footer_botton_back_to_top'],
	    'page_title_parallax'=> $smof_data['page_title_parallax'],
	);

	/*------------------------------------- JavaScript ---------------------------------------*/
	
	
	/** --------------------------libs--------------------------------- */

	/* Adds JavaScript Bootstrap. */
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '3.3.2');
	
	/* Add parallax plugin. */
	if($smof_data['paralax']){
	   wp_enqueue_script('parallax', get_template_directory_uri() . '/assets/js/jquery.parallax-1.1.3.js', array( 'jquery' ), '1.1.3', true);
	}

    /* Fancy box */
	wp_enqueue_script('fancybox', get_template_directory_uri() . '/assets/libs/fancybox/jquery.fancybox.pack.js', array( 'jquery' ), '2.1.5', true);
	wp_enqueue_style('fancybox', get_template_directory_uri() . '/assets/libs/fancybox/jquery.fancybox.css');
	wp_enqueue_script('fancybox-media', get_template_directory_uri() . '/assets/libs/fancybox/helpers/jquery.fancybox-media.js', array( 'fancybox' ), '2.1.5', true);
	/* Slick Slider */
	wp_enqueue_script('slick-js', get_template_directory_uri(). '/assets/js/slick.min.js', array('jquery'), '1.5.7', true);
	wp_enqueue_style('slick-css', get_template_directory_uri(). '/assets/css/slick.css');
	/** --------------------------custom------------------------------- */
	
	/* Add main.js */
	wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery'), '1.0.0', true);
	wp_localize_script('main', 'ZOOptions', $script_options);
	/* Add menu.js */
    wp_enqueue_script('menu', get_template_directory_uri() . '/assets/js/menu.js', array( 'jquery' ), '1.0.0', true);
    /* VC Pie Custom JS */
	wp_enqueue_script('progressCircle', get_template_directory_uri() . '/assets/js/process_cycle.js', array( 'jquery' ), '1.0.0', true);
	wp_enqueue_script('vc_pie_custom', get_template_directory_uri() . '/assets/js/vc_pie_custom.js', array( 'jquery' ), '1.0.0', true);

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

    /*------------------------------------- Stylesheet ---------------------------------------*/
	
	/** --------------------------libs--------------------------------- */
	/* Loads Animation stylesheet*/
	wp_enqueue_style('animation', get_template_directory_uri() . '/assets/css/animate.css', array(), '3.3.0');

	/* Loads Bootstrap stylesheet. */
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '3.3.2');
	
	/* Loads Bootstrap stylesheet. */
	wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.5.0');

	/* Loads Font Ionicons. */
	wp_enqueue_style('font-ionicons', get_template_directory_uri() . '/assets/css/ionicons.min.css', array(), '2.0.1');

	/* Loads Pe Icon. */
	wp_enqueue_style('pe-icon', get_template_directory_uri() . '/assets/css/pe-icon-7-stroke.css', array(), '1.0.1');
	
	/** --------------------------custom------------------------------- */
	
	/* Loads our main stylesheet. */
	wp_enqueue_style( 'style', get_stylesheet_uri(), array( 'bootstrap' ));

	/* Loads the Internet Explorer specific stylesheet. */
	wp_enqueue_style( 'ie', get_template_directory_uri() . '/assets/css/ie.css', array( 'style' ), '20121010' );
	$wp_styles->add_data( 'ie', 'conditional', 'lt IE 9' );
	
	/* Load static css*/
	wp_enqueue_style('static', get_template_directory_uri() . '/assets/css/static.css', array( 'style' ), '1.0.0');

    /**
     * IE Fallbacks
     */
	wp_enqueue_script( 'ie_html5shiv', get_template_directory_uri(). '/assets/js/html5shiv.min.js', array(), false, '3.7.2' );
    $wp_scripts->add_data( 'ie_html5shiv', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'ie_respond', get_template_directory_uri() . '/assets/js/respond.min.js', array(), false, '1.4.2' );
    $wp_scripts->add_data( 'ie_respond', 'conditional', 'lt IE 9' );

}
add_action( 'wp_enqueue_scripts', 'zo_scripts_styles' );

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since Fox
 */
function zo_widgets_init() {
	register_sidebar( array(
		'name' => esc_html__( 'Main Sidebar', 'zap' ),
		'id' => 'sidebar-1',
		'description' => esc_html__( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'zap' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title"><span>',
		'after_title' => '</span></h3>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Header Top Left', 'zap' ),
		'id' => 'sidebar-2',
		'description' => esc_html__( 'Appears when using the optional Header with a page set as Header top left', 'zap' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Header Top Right', 'zap' ),
		'id' => 'sidebar-3',
		'description' => esc_html__( 'Appears when using the optional Header with a page set as Header top right', 'zap' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => esc_html__( 'Menu Right', 'zap' ),
    	'id' => 'sidebar-4',
    	'description' => esc_html__( 'Appears when using the optional Menu with a page set as Menu right', 'zap' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => esc_html__( 'Content', 'zap' ),
    	'id' => 'sidebar-content',
    	'description' => esc_html__( 'Appears when using the optional Content with a page set as Content', 'zap' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );
	register_sidebar( array(
    	'name' => esc_html__( 'Content', 'zap' ),
    	'id' => 'sidebar-content',
    	'description' => esc_html__( 'Appears when using the optional Content with a page set as Content', 'zap' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => esc_html__( 'Footer Top 1', 'zap' ),
    	'id' => 'sidebar-5',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer Top 1', 'zap' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => esc_html__( 'Footer Top 2', 'zap' ),
    	'id' => 'sidebar-6',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer Top 2', 'zap' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => esc_html__( 'Footer Top 3', 'zap' ),
    	'id' => 'sidebar-7',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer Top 3', 'zap' ),
    	'before_widget' => '<aside class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => esc_html__( 'Footer Top 4', 'zap' ),
    	'id' => 'sidebar-8',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer Top 4', 'zap' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => esc_html__( 'Footer Bottom Left', 'zap' ),
    	'id' => 'sidebar-9',
    	'description' => esc_html__( 'Appears when using the optional Footer Bottom with a page set as Footer Bottom left', 'zap' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => esc_html__( 'Footer Bottom Right', 'zap' ),
    	'id' => 'sidebar-10',
    	'description' => esc_html__( 'Appears when using the optional Footer Bottom with a page set as Footer Bottom right', 'zap' ),
    	'before_widget' => '<aside class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

    register_sidebar( array(
        'name' => esc_html__( 'Shop Menu Sidebar', 'zap' ),
        'id' => 'sidebar-11',
        'description' => esc_html__( 'Appears when using the optional Shop with Menu attach Widget', 'zap' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ) );

    register_sidebar( array(
        'name' => esc_html__( 'Shop Sidebar', 'zap' ),
        'id' => 'sidebar-12',
        'description' => esc_html__( 'Appears when using the optional Shop with a page set as Shop page', 'zap' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ) );

    register_sidebar( array(
        'name' => esc_html__( 'Header Right', 'zap' ),
        'id' => 'header-right',
        'description' => esc_html__( 'Appears when using the optional Cart & Search', 'zap' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ) );
	
	register_sidebar( array(
        'name' => esc_html__( 'Header Top Sliders', 'zap' ),
        'id' => 'header-top-sliders',
        'description' => esc_html__( 'Appears when using the optional Revolution Sliders', 'zap' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ) );
}
add_action( 'widgets_init', 'zo_widgets_init' );

/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since 1.0.0
 */
function zo_page_menu_args( $args ) {
    if ( ! isset( $args['show_home'] ) )
        $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'zo_page_menu_args' );

/**
 * Add field subtitle to post.
 * 
 * @since 1.0.0
 */
function zo_add_subtitle_field(){
    global $post;
    
    /* get current_screen. */
    $screen = get_current_screen();
    
    /* show field in post. */
    if(in_array($screen->id, array('post'))){
        
        /* get value. */
        $value = get_post_meta($post->ID, 'post_subtitle', true);
        
        /* html. */
        echo '<div class="subtitle"><input type="text" name="post_subtitle" value="'.esc_attr($value).'" id="subtitle" placeholder = "'.esc_html__('Subtitle', 'zap').'" style="width: 100%;margin-top: 4px;"></div>';
    }
}

//add_action( 'edit_form_after_title', 'zo_add_subtitle_field' );

/**
 * Save custom theme meta. 
 * 
 * @since 1.0.0
 */
function zo_save_meta_boxes($post_id) {
    
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    /* update field subtitle */
    if(isset($_POST['post_subtitle'])){
        update_post_meta($post_id, 'post_subtitle', $_POST['post_subtitle']);
    }
}

add_action('save_post', 'zo_save_meta_boxes');
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since 1.0.0
 * @param null $query
 */
function zo_paging_nav($query = null) {
    // Don't print empty markup if there's only one page.
	if($query){
		$zo_query = $query;
	}else{
		$zo_query = $GLOBALS['wp_query'];		
	}
	if ( $zo_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $zo_query->max_num_pages,
			'current'  => $paged,
			'mid_size' => 1,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => wp_kses(__('<i class="fa fa-angle-double-left"></i>', 'zap' ), array('i' => array('class' => array()))),
			'next_text' => wp_kses(__('<i class="fa fa-angle-double-right"></i>', 'zap' ), array('i' => array('class' => array()))),
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation clearfix" role="navigation">
			<div class="pagination loop-pagination">
				<?php echo ''.$links; ?>
			</div><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
}

/**
* Display navigation to next/previous post when applicable.
*
* @since 1.0.0
*/
function zo_post_nav() {
    global $post;

    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>
	<nav class="navigation post-navigation" role="navigation">
		<div class="nav-links clearfix">
			<?php
			$prev_post = get_previous_post();
			if (!empty( $prev_post )): ?>
			  <a class="post-prev left" href="<?php echo get_permalink( $prev_post->ID ); ?>" title="<?php echo esc_attr($prev_post->post_title); ?>"><i class="fa fa-long-arrow-left"></i><?php echo esc_attr($prev_post->post_title); ?></a>
			<?php endif; ?>
			<?php
			$next_post = get_next_post();
			if ( is_a( $next_post , 'WP_Post' ) ) : ?>
			  <a class="post-next right" href="<?php echo get_permalink( $next_post->ID ); ?>" title="<?php echo get_the_title( $next_post->ID ); ?>"><?php echo get_the_title( $next_post->ID ); ?><i class="fa fa-long-arrow-right"></i></a>
            <?php endif; ?>
        </div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

/* Add Custom Comment */
function zo_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
<<?php echo esc_attr($tag) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
<?php if ( 'div' != $args['style'] ) : ?>
<div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
<?php endif; ?>
<div class="comment-author-image vcard">
	<?php echo get_avatar( $comment, 109 ); ?>
</div>
<div class="comment-main">
    <div class="comment-header">
        <?php printf( __( '<span class="comment-author">%s</span>', 'zap' ), get_comment_author_link() ); ?>
        <span class="comment-date">
            <?php echo get_comment_time('d.m.Y') .' '. esc_html__('at', 'zap') .' ' . get_comment_time('H:i'); ?>
        </span>
        <?php if ( $comment->comment_approved == '0' ) : ?>
            <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.' , 'zap'); ?></em>
        <?php endif; ?>
    </div>
	<div class="comment-content">
		<?php comment_text(); ?>
	</div>
    <div class="reply">
       <?php comment_reply_link(
           array_merge( $args, array(
               'add_below' => $add_below,
               'depth' => $depth,
               'max_depth' => $args['max_depth'] )
           )
       ); ?>
        <i class="fa fa-mail-forward"></i>
    </div>
</div>
<?php if ( 'div' != $args['style'] ) : ?>
</div>
<?php endif; ?>
<?php
}
/* End Custom Comment */

/* Custom excerpt length */
function zo_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'zo_excerpt_length', 999 );
function zo_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'zo_excerpt_more');
/* End Custom excerpt length */


/**
 * Ajax post like.
 *
 * @since 1.0.0
 */
function zo_post_like_callback(){

    $post_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

    $likes = null;

    if($post_id && !isset($_COOKIE['zo_post_like_'. $post_id])){

        /* get old like. */
        $likes = get_post_meta($post_id , '_zo_post_likes', true);

        /* check old like. */
        $likes = $likes ? $likes : 0 ;

        $likes++;

        /* update */
        update_post_meta($post_id, '_zo_post_likes' , $likes);

        /* set cookie. */
        setcookie('zo_post_like_'. $post_id, $post_id, time() * 20, '/');
    }

    echo esc_attr($likes);

    die();
}

add_action('wp_ajax_zo_post_like', 'zo_post_like_callback');
add_action('wp_ajax_nopriv_zo_post_like', 'zo_post_like_callback');

/**
 * Load ajax url.
 */
function zo_ajax_url_head() {
    echo '<script type="text/javascript"> var ajaxurl = "'.admin_url('admin-ajax.php').'"; </script>';
}
add_action( 'wp_head', 'zo_ajax_url_head');

/**
 * Count post view.
 *
 * @since 1.0.0
 */
function zo_set_count_view(){
    global $post;

    if(is_single() && !empty($post->ID) && !isset($_COOKIE['zo_post_view_'. $post->ID])){

        $views = get_post_meta($post->ID , '_zo_post_views', true);

        $views = $views ? $views : 0 ;

        $views++;

        update_post_meta($post->ID, '_zo_post_views' , $views);

        /* set cookie. */
        setcookie('zo_post_view_'. $post->ID, $post->ID, time() * 20, '/');
    }
}

add_action( 'wp', 'zo_set_count_view' );

/**
 * Get Post view
 * @return int|mixed
 */
function zo_get_count_view() {
    global $post;

    $views = get_post_meta($post->ID , '_zo_post_views', true);

    $views = $views ? $views : 0 ;
    return $views;
}

if( function_exists('zo_image_resize')) {
	/**
	 * Crop Image Size
	 *
	 * @param null $width
	 * @param null $height
	 * @param bool $crop
	 * @param bool $single
	 * @param bool $upscale
	 * @return null|string
	 */
	function zo_post_thumbnail($width = null, $height = null, $crop = true, $single = true, $upscale = true) {
		$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
		$url = zo_image_resize($image_url[0], $width, $height, $crop, $single, $upscale);
		return do_shortcode('<img src="'.esc_url($url).'" alt="' . get_the_title() . '" />');
	}
}

/**
 * Get list custom post type using for custom background header in theme options.
 *
 * @return array
 */
function zo_list_post_types() {
    $types = array();
    /*
     * Add Product Post Type of WooCommerce
     */
    if( class_exists( 'WooCommerce' ) ) {
        $types['product'] = esc_html__('Products', 'zap');
    }
    /*
     * Get list custom post type CPT
     */
    $post_types = get_option( 'cptui_post_types' , array());
    if( !empty($post_types) ) {
        foreach( $post_types as $type ) {
            $types[$type['name']] = $type['label'];
        }
    }

    return $types;
}
/* Woo support */
if(class_exists('Woocommerce')){
    //item per page
    require get_template_directory() . '/woocommerce/wc-template-functions.php';
    require get_template_directory() . '/woocommerce/wc-template-hooks.php';
}

/* Filter Search results */
function zo_searchfilter($query) {
    if ($query->is_search && !is_admin() ) {
        $query->set('post_type',array('post','team','portfolio','testimonial','pricing','service'));
    }
	return $query;
}
add_filter('pre_get_posts','zo_searchfilter');

/* Filter style loader tag, add attribute property */
add_filter('style_loader_tag', 'zo_slick_style_loader_tag');
function zo_slick_style_loader_tag($tag){
  return preg_replace("/id='zo-slick-css-css'/", "property='stylesheet' id='zo-slick-css-css'", $tag);
}
add_filter('style_loader_tag', 'zo_wp_mediaelement_style_loader_tag');
function zo_wp_mediaelement_style_loader_tag($tag){
  return preg_replace("/id='wp-mediaelement-css'/", "property='stylesheet' id='wp-mediaelement-css'", $tag);
}
add_filter('style_loader_tag', 'zo_mediaelement_style_loader_tag');
function zo_mediaelement_style_loader_tag($tag){
  return preg_replace("/id='mediaelement-css'/", "property='stylesheet' id='mediaelement-css'", $tag);
}
add_filter('style_loader_tag', 'zo_prettyphoto_style_loader_tag');
function zo_prettyphoto_style_loader_tag($tag){
  return preg_replace("/id='prettyphoto-css'/", "property='stylesheet' id='prettyphoto-css'", $tag);
}
add_filter('style_loader_tag', 'zo_carousel_style_loader_tag');
function zo_carousel_style_loader_tag($tag){
  return preg_replace("/id='vc_carousel_css-css'/", "property='stylesheet' id='vc_carousel_css-css'", $tag);
}
add_filter('style_loader_tag', 'zo_font_awesome_style_loader_tag');
function zo_font_awesome_style_loader_tag($tag){
  return preg_replace("/id='font-awesome-css'/", "property='stylesheet' id='font-awesome-css'", $tag);
}
add_filter('style_loader_tag', 'zo_icon_linearicons_css_tag');
function zo_icon_linearicons_css_tag($tag){
  return preg_replace("/id='zo-icon-linearicons-css'/", "property='stylesheet' id='zo-icon-linearicons-css'", $tag);
}


if( !function_exists('zo_custom_admin_styles')) {
	/**
	 * Remove Redux ADS
	 */
	function zo_custom_admin_styles() {
		?>
		<style type="text/css">
			#redux_rAds, .rAds {
				display: none !important;
				opacity: 0;
				height: 0;
			}
		</style>
	<?php
	}
}
add_action( 'admin_head', 'zo_custom_admin_styles' );