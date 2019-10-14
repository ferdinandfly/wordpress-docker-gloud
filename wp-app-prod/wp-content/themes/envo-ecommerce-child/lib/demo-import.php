<?php

/**
 * One click demo import
 */

/**
 * Set import files
 */
function envo_ecommerce_ocdi_import_files() {
	return array(
		array(
			'import_file_name'				 => 'Envo eCommerce',
			'local_import_file'				 => trailingslashit( get_template_directory() ) . 'includes/demo/default/default-content.xml',
			'local_import_widget_file'		 => trailingslashit( get_template_directory() ) . 'includes/demo/default/default-widgets.wie',
			'local_import_customizer_file'	 => trailingslashit( get_template_directory() ) . 'includes/demo/default/default-customizer.dat',
			'import_preview_image_url'		 => trailingslashit( get_template_directory_uri() ) . 'screenshot.jpg',
			/* translators: %1$s and %2$s plugin name strings */
			'import_notice'					 => sprintf( __( 'Before importing, install and activate these plugins: %1$s, %2$s', 'envo-ecommerce' ), '<a target="_blank" href="' . esc_url( 'https://wordpress.org/plugins/woocommerce/' ) . '">WooCommerce</a>', '<a target="_blank" href="' . esc_url( 'https://wordpress.org/plugins/elementor/' ) . '">Elementor</a>' ),
			'preview_url'					 => esc_url( 'https://envothemes.com/envo-ecommerce/' ),
		),
	);
}

add_filter( 'pt-ocdi/import_files', 'envo_ecommerce_ocdi_import_files' );

/**
 * Cleared problem with refreshing page after import.
 */
function envo_ecommerce_current_screen( $current_screen ) {
	if ( 'appearance_page_pt-one-click-demo-import' == $current_screen->base ) {
		delete_transient( 'ocdi_importer_data' );
	}
}

add_action( 'current_screen', 'envo_ecommerce_current_screen' );

/**
 * Automate common changes after import
 */
function envo_ecommerce_after_import_setup() {
	// Assign menus to their locations.
	$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
		'main_menu' => $main_menu->term_id,
	)
	);

	// Assign front page and posts page (blog page).
	$front_page_id	 = get_page_by_title( 'Home' );
	$blog_page_id	 = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

	// Assign WooCommerce pages if WooCommerce Exists
	if ( class_exists( 'WooCommerce' ) ) {

		$woopages = array(
			'woocommerce_shop_page_id'				 => 'Shop',
			'woocommerce_cart_page_id'				 => 'Cart',
			'woocommerce_checkout_page_id'			 => 'Checkout',
			'woocommerce_pay_page_id'				 => 'Checkout &#8594; Pay',
			'woocommerce_thanks_page_id'			 => 'Order Received',
			'woocommerce_myaccount_page_id'			 => 'My Account',
			'woocommerce_edit_address_page_id'		 => 'Edit My Address',
			'woocommerce_view_order_page_id'		 => 'View Order',
			'woocommerce_change_password_page_id'	 => 'Change Password',
			'woocommerce_logout_page_id'			 => 'Logout',
			'woocommerce_lost_password_page_id'		 => 'Lost Password'
		);

		foreach ( $woopages as $woo_page_name => $woo_page_title ) {

			$woopage = get_page_by_title( $woo_page_title );
			if ( isset( $woopage ) && $woopage->ID ) {
				update_option( $woo_page_name, $woopage->ID );
			}
		}
	}

	// Disable Woo Wizard
	add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );
	add_filter( 'woocommerce_show_admin_notice', '__return_false' );
	add_filter( 'woocommerce_prevent_automatic_wizard_redirect', '__return_false' );
}

add_action( 'pt-ocdi/after_import', 'envo_ecommerce_after_import_setup' );

/**
 * Disable branding
 */
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

/**
 * Better support for slower internet connections
 */
function envo_ecommerce_ocdi_change_time_of_single_ajax_call() {
	return 10;
}

add_action( 'pt-ocdi/time_for_one_ajax_call', 'envo_ecommerce_ocdi_change_time_of_single_ajax_call' );
