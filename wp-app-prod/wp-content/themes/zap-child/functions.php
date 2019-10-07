<?php

function child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'static', get_stylesheet_directory_uri() . '/assets/css/static.css' );
    wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' );
    wp_enqueue_style( 'presets', get_stylesheet_directory_uri() . '/inc/presets/css/presets.css' );
}
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles' );

/* auto-detect the server so you only have to enter the front/from half of the email address, including the @ sign */
function xyz_filter_wp_mail_from($email){
/* start of code lifted from wordpress core, at http://svn.automattic.com/wordpress/tags/3.4/wp-includes/pluggable.php */
$sitename = strtolower( $_SERVER['SERVER_NAME'] );
if ( substr( $sitename, 0, 4 ) == 'www.' ) {
   $sitename = substr( $sitename, 4 );
   }
/* end of code lifted from wordpress core */
$myfront = "noreply@";
$myback = $sitename;
$myfrom = $myfront . $myback;
return $myfrom;
}
add_filter("wp_mail_from", "xyz_filter_wp_mail_from");

/* enter the full name you want displayed alongside the email address */
/* from http://miloguide.com/filter-hooks/wp_mail_from_name/ */
function xyz_filter_wp_mail_from_name($from_name){
return "ARDETEM SFERE";
}
add_filter("wp_mail_from_name", "xyz_filter_wp_mail_from_name");

/* Ajout d'un shortcode pour insérer une date de dernière modification dans les articles */
function date_de_maj_handler($atts, $content=null){
    $currentLang = qtranxf_getLanguage();
    if ($currentLang=="fr")
    {
    return the_modified_date( 'j F Y', 'Date de la dernière modification: ' , '', 0 );
    }
else
   {
    if ($currentLang=="en")
    {
    return the_modified_date( 'j F Y', 'Date of last modification: ' , '', 0 );
    }
    else
     {
     if ($currentLang=="zh")
      {
      return the_modified_date( 'j F Y', '上次修改日期: ' , '', 0 );
      }
     else
      {
      if ($currentLang=="pl")
       {
       return the_modified_date( 'j F Y', 'Data ostatniej modyfikacji: ' , '', 0 );
       }
      }
     }
   }
}
add_shortcode( 'date_de_maj', 'date_de_maj_handler' );

function my_get_permalink() {
 return  get_permalink();
}

add_shortcode( 'get_permalink', 'my_get_permalink' );


function qtranxf_setLanguage($lang) {
global $q_config;
$q_config['language'] = $lang;
qtranxf_set_language_cookie($lang);
}

add_filter('manage_users_columns', 'pippin_add_user_id_column');
function pippin_add_user_id_column($columns) {
    $columns['user_id'] = 'ID utilisateur';
    $columns['user_activated'] = 'Activation';
    return $columns;
}
 
add_action('manage_users_custom_column',  'pippin_show_user_id_column_content', 10, 3);
function pippin_show_user_id_column_content($value, $column_name, $user_id) {
    $user = get_userdata( $user_id );
	if ( 'user_id' == $column_name )
		return $user_id;
       if ( 'user_activated' == $column_name )
               {
		if ($user->is_activated) 
                  {
                  return 'ok';
                  }
               }
    return $value;
}

/*********** woocommerce **************************/
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<section id="main">';
}

function my_theme_wrapper_end() {
  echo '</section>';
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action('wp_enqueue_scripts', 'override_woo_frontend_styles');

function override_woo_frontend_styles(){
    $file_general = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/zap-child/';
    if( file_exists($file_general) ){
        wp_dequeue_style('woocommerce-general');
        wp_enqueue_style('woocommerce-general-custom', get_stylesheet_directory_uri() . '/custom.css');
    }
    if( file_exists($file_general) ){
        wp_dequeue_style('woocommerce-layout');
        wp_enqueue_style('woocommerce-layout-custom', get_stylesheet_directory_uri() . '/custom-layout.css');
    }

}

// Add the code below to your theme's functions.php file to add a confirm password field on the register form under My Accounts.
add_filter('woocommerce_registration_errors', 'registration_errors_validation', 10,3);
function registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
	global $woocommerce;
	extract( $_POST );
	if ( strcmp( $password, $password2 ) !== 0 ) {
		return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );
	}
	return $reg_errors;
}
add_action( 'woocommerce_register_form', 'wc_register_form_password_repeat' );
function wc_register_form_password_repeat() {
        $currentLang = qtranxf_getLanguage();
        if ($currentLang=="fr")
        {
	?>
	<p class="form-row form-row-wide">
		<label for="reg_password2"><?php _e( 'Répéter le mot de passe', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
	</p>
	<?php
        }
        else
        {
        if ($currentLang=="pl")
        {
	?>
	<p class="form-row form-row-wide">
		<label for="reg_password2"><?php _e( 'Powtórz hasło', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
	</p>
	<?php
        }
        else
         {
          if ($currentLang=="zh")
          {
	  ?>
	  <p class="form-row form-row-wide">
		<label for="reg_password2"><?php _e( '重复输入密码', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
	  </p>
	  <?php
          }
         else
          {
	  ?>
	  <p class="form-row form-row-wide">
		<label for="reg_password2"><?php _e( 'Repeat Password', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
	  </p>
	  <?php
          }
         }
        }
}

// Add a second password field to the checkout page in WC 3.x.
add_filter( 'woocommerce_checkout_fields', 'wc_add_confirm_password_checkout', 10, 1 );
function wc_add_confirm_password_checkout( $checkout_fields ) {
    $currentLang = qtranxf_getLanguage();
    if ( get_option( 'woocommerce_registration_generate_password' ) == 'no' ) {
        if ($currentLang=="fr")
        {
        $checkout_fields['account']['account_password2'] = array(
                'type'              => 'password',
                'label'             => __( 'Répéter le mot de passe', 'woocommerce' ),
                'required'          => true,
                'placeholder'       => _x( 'Répéter le mot de passe', 'placeholder', 'woocommerce' )
        );
        }
       else
        {
         if ($currentLang=="pl")
         {
         $checkout_fields['account']['account_password2'] = array(
                'type'              => 'password',
                'label'             => __( 'Powtórz hasło', 'woocommerce' ),
                'required'          => true,
                'placeholder'       => _x( 'Powtórz hasło', 'placeholder', 'woocommerce' )
         );
         }
        else
         {
         if ($currentLang=="zh")
          {
          $checkout_fields['account']['account_password2'] = array(
                'type'              => 'password',
                'label'             => __( '重复输入密码', 'woocommerce' ),
                'required'          => true,
                'placeholder'       => _x( '重复输入密码', 'placeholder', 'woocommerce' )
          );
          }
         else
          {
          $checkout_fields['account']['account_password2'] = array(
                'type'              => 'password',
                'label'             => __( 'Repeat Password', 'woocommerce' ),
                'required'          => true,
                'placeholder'       => _x( 'Repeat Password', 'placeholder', 'woocommerce' )
          );
          }
         }
        }
    }

    return $checkout_fields;
}

// Check the password and confirm password fields match before allow checkout to proceed.
add_action( 'woocommerce_after_checkout_validation', 'wc_check_confirm_password_matches_checkout', 10, 2 );
function wc_check_confirm_password_matches_checkout( $posted ) {
    $checkout = WC()->checkout;
    if ( ! is_user_logged_in() && ( $checkout->must_create_account || ! empty( $posted['createaccount'] ) ) ) {
        if ( strcmp( $posted['account_password'], $posted['account_password2'] ) !== 0 ) {
            wc_add_notice( __( 'Passwords do not match.', 'woocommerce' ), 'error' );
        }
    }
}


/**
* @snippet Add "Confirm Email Address" Field @ WooCommerce Checkout
* @how-to Watch tutorial @ https://businessbloomer.com/?p=19055
* @sourcecode https://businessbloomer.com/?p=72602
* @author Rodolfo Melogli
* @testedwith WooCommerce 3.0.7
*/
 
// ---------------------------------
// 1) Make original email field half width
// 2) Add new confirm email field
 
add_filter( 'woocommerce_checkout_fields' , 'my_add_email_verification_field_checkout' );
//add_filter( 'woocommerce_billing_fields' , 'my_add_email_verification_field_checkout' );
  
function my_add_email_verification_field_checkout( $fields ) {
$currentLang = qtranxf_getLanguage(); 
$fields['billing']['billing_email']['class'] = array('form-row-first');
if ($currentLang=="fr") 
    { 
    $fields['billing']['billing_em_ver'] = array(
    'label'     => __('Vérification de l\'adresse e-mail'),
    'required'  => true,
    'class'     => array('form-row-last'),
    'clear'     => true
    );
    }
else 
   {
    if ($currentLang=="pl") 
    { 
    $fields['billing']['billing_em_ver'] = array(
    'label'     => __('Weryfikacja adresu e-mail'),
    'required'  => true,
    'class'     => array('form-row-last'),
    'clear'     => true
    );
    } 
    else
    {
     if ($currentLang=="zh") { 
     $fields['billing']['billing_em_ver'] = array(
     'label'     => __('电子邮件地址验证'),
     'required'  => true,
     'class'     => array('form-row-last'),
     'clear'     => true
     );
     } 
     else
     {
     $fields['billing']['billing_em_ver'] = array(
     'label'     => __('Email Address Verification'),
     'required'  => true,
     'class'     => array('form-row-last'),
     'clear'     => true
     );
     }
   }
  } 
return $fields;
}
 
// ---------------------------------
// 3) Generate error message if field values are different
 
add_action('woocommerce_checkout_process', 'my_matching_email_addresses');
 
function my_matching_email_addresses() { 
$currentLang = qtranxf_getLanguage(); 
$email1 = $_POST['billing_email'];
$email2 = $_POST['billing_em_ver'];
if ( $email2 !== $email1 ) {
if ($currentLang=="fr") wc_add_notice( __( '<strong>Vos adresses e-mail ne correspondent pas</strong>'), 'error' );
else if ($currentLang=="pl") wc_add_notice( __( '<strong>Twoje adresy e-mail się nie zgadzają</strong>'), 'error' );
 else if ($currentLang=="zh") wc_add_notice( __( '<strong>您的电子邮件地址不匹配</strong>'), 'error' );
   else wc_add_notice( __( '<strong>Your email addresses do not match</strong>'), 'error' );
}
}

$array_prix_globale = array(
"adminARD@_ARdeSFeR" => 2.0,
"bilousfr" => 0.83333,
);

$array_remise_globale = array(
"adminARD@_ARdeSFeR" => "RE2017110001",
"bilousfr" => "RE2017110001",
);


/* Afficher "À partir de" pour les produits variables */
add_filter( 'woocommerce_variable_sale_price_html', 'wpm_variation_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'wpm_variation_price_format', 10, 2 );

function wpm_variation_price_format( $price, $product ) {
        $currentLang = qtranxf_getLanguage();
        $array_prix_locale=$GLOBALS['array_prix_globale'];
        $current_user = wp_get_current_user();
	//On récupère le prix min et max du produit variable
	$min_price = $product->get_variation_price( 'min', true );
        // recherche des keys ayant une remise
        while ($indice_key = current($array_prix_locale)) {
         if (key($array_prix_locale)==$current_user->user_login) {
          $min_price = $min_price * $array_prix_locale[key($array_prix_locale)];
          break;
         }
        next($array_prix_locale);
        }

	// on affiche "À partir de ..."
              if ($currentLang=="fr")
                {
                $price =is_product_category() ? sprintf( __( '<p style="margin-left:100px;">A partir de <b>%1$s</b></p>', 'woocommerce' ), wc_price( $min_price ) ) : sprintf( __( '<p style="margin-left:100px;">A partir de <b>%1$s</b></p>', 'woocommerce' ), wc_price( $min_price ) );
                }
              else
                {
                if ($currentLang=="zh")
                 {
                $price =is_product_category() ? sprintf( __( '<p style="margin-left:100px;">从 <b>%1$s</b></p>', 'woocommerce' ), wc_price( $min_price ) ) : sprintf( __( '<p style="margin-left:100px;">从  <b>%1$s</b></p>', 'woocommerce' ), wc_price( $min_price ) );
                 }
                else
                 {
                 if ($currentLang=="pl")
                   {
                   $price =is_product_category() ? sprintf( __( '<p style="margin-left:100px;">Od <b>%1$s</b></p>', 'woocommerce' ), wc_price( $min_price ) ) : sprintf( __( '<p style="margin-left:100px;">Od <b>%1$s</b></p>', 'woocommerce' ), wc_price( $min_price ) );
                   }
                 else
                   {
                   $price =is_product_category() ? sprintf( __( '<p style="margin-left:100px;">From <b>%1$s</b></p>', 'woocommerce' ), wc_price( $min_price ) ) : sprintf( __( '<p style="margin-left:100px;">From <b>%1$s</b></p>', 'woocommerce' ), wc_price( $min_price ) );
                   }
                 }
                }
	      return $price;
}

// Our hooked in function - $address_fields is passed via the filter!
function custom_override_default_address_fields( $address_fields ) {
     $address_fields['company']['required'] = true;

     return $address_fields;
}

function wooc_extra_register_fields() {

       ?>

 

       <p class="form-row form-row-first">

       <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?><span class="required">*</span></label>

       <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />

       </p>

 

       <p class="form-row form-row-last">

       <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?><span class="required">*</span></label>

       <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />

       </p>

       <?php  
      // Hook in
      add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields' );
      ?>


       <div class="clear"></div>


       <p class="form-row form-row-wide">

       <label for="reg_billing_company"><?php _e( 'Company', 'woocommerce' ); ?><span class="required">*</span></label>

       <input type="text" class="input-text" name="billing_company" id="reg_billing_company" value="<?php if ( ! empty( $_POST['billing_company'] ) ) esc_attr_e( $_POST['billing_company'] ); ?>" />
       </p>

       <p class="form-row form-row-wide">

       <label for="reg_billing_address_1"><?php _e( 'Address', 'woocommerce' ); ?></label>

       <input type="text" class="input-text" name="billing_address_1" id="reg_billing_address_1" value="<?php if ( ! empty( $_POST['billing_address_1'] ) ) esc_attr_e( $_POST['billing_address_1'] ); ?>" />

       </p>

       <p class="form-row form-row-wide">

       <label for="reg_billing_postcode"><?php _e( 'Postcode / ZIP', 'woocommerce' ); ?></label>

       <input type="text" class="input-text" name="billing_postcode" id="reg_billing_postcode" value="<?php if ( ! empty( $_POST['billing_postcode'] ) ) esc_attr_e( $_POST['billing_postcode'] ); ?>" />

       </p>

       <p class="form-row form-row-wide">

       <label for="reg_billing_city"><?php _e( 'City', 'woocommerce' ); ?><span class="required">*</span></label>

       <input type="text" class="input-text" name="billing_city" id="reg_billing_city" value="<?php if ( ! empty( $_POST['billing_city'] ) ) esc_attr_e( $_POST['billing_city'] ); ?>" />

       </p>

      <?php
      wp_enqueue_script('wc-country-select');
      woocommerce_form_field('billing_country',array(
        'type'        => 'country',
        'class'       => array('chzn-drop'),
        'label'      => __('Country','woocommerce' ),
        'placeholder'    => __('Select a country&hellip;', 'woocommerce'),
        'required'    => true,
        'clear'       => true,
        'default'     => ''
      ));
      ?>

       <p class="form-row form-row-wide">

       <label for="reg_billing_phone"><?php _e( 'Phone', 'woocommerce' ); ?></label>

       <input type="text" class="input-text" name="billing_phone" id="reg_billing_phone" value="<?php if ( ! empty( $_POST['billing_phone'] ) ) esc_attr_e( $_POST['billing_phone'] ); ?>" />

       </p>

       <?php



}

 

add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );

function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {

       if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {

              $validation_errors->add( 'billing_first_name_error', sprintf( __( '%s is a required field.', 'woocommerce' ), '<strong>' . __( 'First name', 'woocommerce' ) . '</strong>' ) );

       }

 

       if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {

              $validation_errors->add( 'billing_last_name_error', sprintf( __( '%s is a required field.', 'woocommerce' ), '<strong>' . __( 'Last name', 'woocommerce' ) . '</strong>' ) );

       }

 

 

       if ( isset( $_POST['billing_company'] ) && empty( $_POST['billing_company'] ) && (!is_checkout()) ) {

              $validation_errors->add( 'billing_company_error', sprintf( __( '%s is a required field.', 'woocommerce' ), '<strong>' . __( 'Company', 'woocommerce' ) . '</strong>' ) );

       }

       if ( isset( $_POST['billing_city'] ) && empty( $_POST['billing_city'] ) ) {

              $validation_errors->add( 'billing_city_error', sprintf( __( '%s is a required field.', 'woocommerce' ), '<strong>' . __( 'City', 'woocommerce' ) . '</strong>' ) );

       }

       if ( isset( $_POST['billing_country'] ) && empty( $_POST['billing_country'] ) ) {

              $validation_errors->add( 'billing_country_error', sprintf( __( '%s is a required field.', 'woocommerce' ), '<strong>' . __( 'Country', 'woocommerce' ) . '</strong>' ) );

       }


}

 

add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );

function wooc_save_extra_register_fields( $customer_id ) {

       if ( isset( $_POST['billing_first_name'] ) ) {

              // WordPress default first name field.

              update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );

 

              // WooCommerce billing first name.

              update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );

       }

 

       if ( isset( $_POST['billing_last_name'] ) ) {

              // WordPress default last name field.

              update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );

 

              // WooCommerce billing last name.

              update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );

       }

 

       if ( isset( $_POST['billing_company'] ) ) {

              // WooCommerce billing_company

              update_user_meta( $customer_id, 'billing_company', sanitize_text_field( $_POST['billing_company'] ) );

       }

       if ( isset( $_POST['billing_address_1'] ) ) {

              // WooCommerce billing_address_1

              update_user_meta( $customer_id, 'billing_address_1', sanitize_text_field( $_POST['billing_address_1'] ) );

       }

       if ( isset( $_POST['billing_postcode'] ) ) {

              // WooCommerce billing_postcode

              update_user_meta( $customer_id, 'billing_postcode', sanitize_text_field( $_POST['billing_postcode'] ) );

       }

       if ( isset( $_POST['billing_city'] ) ) {

              // WooCommerce billing_city

              update_user_meta( $customer_id, 'billing_city', sanitize_text_field( $_POST['billing_city'] ) );

       }

       if ( isset( $_POST['billing_country'] ) ) {

              // WooCommerce billing_country

              update_user_meta( $customer_id, 'billing_country', sanitize_text_field( $_POST['billing_country'] ) );

       }

       if ( isset( $_POST['billing_phone'] ) ) {

              // WooCommerce billing_phone

              update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );

       }

}

add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );

add_action('woocommerce_created_customer', 'admin_email_on_registration', 10 , 1);
function admin_email_on_registration( $customer_id) {
    wp_new_user_notification( $customer_id );
}

/*add_action( 'woocommerce_email', 'unhook_those_pesky_emails' );

function unhook_those_pesky_emails( $email_class ) {
//remove_action( 'woocommerce_created_customer_notification', array( $object, 'customer_new_account' ), 10, 3 );
remove_all_actions( 'woocommerce_created_customer_notification' );
}*/

add_filter( 'woocommerce_min_password_strength', 'reduce_min_strength_password_requirement' );
function reduce_min_strength_password_requirement( $strength ) {
    // 3 => Strong (default) | 2 => Medium | 1 => Weak | 0 => Very Weak (anything).
    return 2; 
}

/**
* Shortcode
* @param array $atts
* @param string $content
* @return boolean
*/
function ibenic_content( $attrs, $contents = "" ) {
  
  $attrs = shortcode_atts(array(
            'visible_to' => false,
                ), $attrs);

  if( $contents && !is_user_logged_in() ) {
     // Show the content to anyone who is not logged in
            if ($attrs['visible_to'] == "not_logged_in_users_only") {
                return $contents;
             }
  }

  if( $contents && is_user_logged_in() ) {
            // Do not show the content to anyone who is logged in
            if ($attrs['visible_to'] == "not_logged_in_users_only") {
                return "";
            }
            // Show content to anyone who is logged in
            if ($attrs['visible_to'] == "logged_in_users_only") {
                return $contents;
            }

  }
  
  
}
add_shortcode( 'protected_contents', 'ibenic_content' );
 
function my_woocommerce_login_redirect( $redirect_to , $user) {
        //First check if a the swpm_redirect_to argument is set (meaning the user needs to be redirected to the last page).
        if(isset($_REQUEST['swpm_redirect_to']) && !empty($_REQUEST['swpm_redirect_to'])){
            $redirect_to = esc_url_raw(sanitize_text_field($_REQUEST['swpm_redirect_to']));
            //Redirect to the membership level specific after login page.
            return $redirect_to;
        }
        //No redirection found. So stay on the current page.
        return $redirect_to;
}

function my_woocommerce_registration_redirect( $redirect_to) {
        //First check if a the swpm_redirect_to argument is set (meaning the user needs to be redirected to the last page).
        if(isset($_REQUEST['swpm_redirect_to']) && !empty($_REQUEST['swpm_redirect_to'])){
            $redirect_to = esc_url_raw(sanitize_text_field($_REQUEST['swpm_redirect_to']));
            //Redirect to the membership level specific after login page.
            return $redirect_to;
        }
        //No redirection found. So stay on the current page.
        return $redirect_to;
}

add_filter('woocommerce_registration_redirect', 'my_woocommerce_registration_redirect',10,1);
add_filter('woocommerce_login_redirect', 'my_woocommerce_login_redirect',10,2);
        
/*
 * Change the order of the endpoints that appear in My Account Page - WooCommerce 2.6
 * The first item in the array is the custom endpoint URL - ie http://mydomain.com/my-account/my-custom-endpoint
 * Alongside it are the names of the list item Menu name that corresponds to the URL, change these to suit
 */
function my_wc_get_account_menu_items() {
   $items = array(
        'dashboard'       => __( 'Dashboard', 'woocommerce' ),
        'orders'          => __( 'Orders', 'woocommerce' ),
	'edit-address'    => __( 'Addresses', 'woocommerce' ),
	'payment-methods' => __( 'Payment methods', 'woocommerce' ),
	'edit-account'    => __( 'Account details', 'woocommerce' ),
	'customer-logout' => __( 'Logout', 'woocommerce' ),
	); 
return $items ;
}
add_filter ( 'woocommerce_account_menu_items', 'my_wc_get_account_menu_items' );

// define the wc_aelia_eu_vat_assistant_eu_vat_countries callback 
function filter_wc_aelia_eu_vat_assistant_eu_vat_countries( $this_eu_vat_countries ) { 
            $this_eu_vat_countries[] = 'CH';
            return $this_eu_vat_countries; 
}; 

// add the filter 
add_filter( 'wc_aelia_eu_vat_assistant_eu_vat_countries', 'filter_wc_aelia_eu_vat_assistant_eu_vat_countries', 10, 1 ); 

add_action( 'woocommerce_before_cart', 'apply_matched_coupons' );

/*************  remise suivant client **************/
function apply_matched_coupons() {
    global $woocommerce;
    $array_remise_locale=$GLOBALS['array_remise_globale'];
    $current_user = wp_get_current_user();

   // recherche des keys ayant un prix non public
   while ($indice_key = current($array_remise_locale)) {
    if ( $woocommerce->cart->has_discount($array_remise_locale[key($array_remise_locale)]) ) return;
    if (key($array_remise_locale)==$current_user->user_login) {
          $woocommerce->cart->add_discount($array_remise_locale[key($array_remise_locale)]);
         break;
         }
    next($array_remise_locale);
    }
}

/* changer prix suivant le client **************/ 
function return_custom_price($price, $product) {
   $array_prix_locale=$GLOBALS['array_prix_globale'];
   $current_user = wp_get_current_user();

   // recherche des keys ayant un prix non public
   while ($indice_key = current($array_prix_locale)) {
   if (key($array_prix_locale)==$current_user->user_login) {
          $price = $price * $array_prix_locale[key($array_prix_locale)];
          break;
         }
        next($array_prix_locale);
   }
   return $price;
}
add_filter('woocommerce_product_variation_get_price', 'return_custom_price', 10, 2);
add_filter('woocommerce_product_get_price', 'return_custom_price', 10, 2);

/***** remise en % *****************/

function my_coupon($coupon_html,  $coupon,  $discount_amount_html)
{
    global $woocommerce;
    $array_remise_locale=$GLOBALS['array_remise_globale'];
    $current_user = wp_get_current_user();

    if($coupon->discount_type == 'percent' && !empty($coupon->coupon_amount))
    {
        $amt = "<b> ({$coupon->coupon_amount}%)</b>";
    }

   // recherche des keys ayant un prix non public
   while ($indice_key = current($array_remise_locale)) {
       if (key($array_remise_locale)==$current_user->user_login) {
         if ( is_string( $coupon ) ) {
		$coupon = new WC_Coupon( $coupon );
	  }
	 $coupon_html = '';

	 if ( $amount = WC()->cart->get_coupon_discount_amount( $coupon->get_code(), WC()->cart->display_cart_ex_tax ) ) {
		$coupon_html = '-' . wc_price( $amount );
	 } elseif ( $coupon->get_free_shipping() ) {
		$coupon_html = __( 'Free shipping coupon', 'woocommerce' );
	   } 
       break;        
       }
    next($array_remise_locale);
    }

    return $coupon_html.$amt;
}

add_filter('woocommerce_cart_totals_coupon_html','my_coupon',10,3);

/**
 * @snippet       Cart subtotal slashed if coupon applied @ WooCommerce Cart
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=21879
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 3.1.2
 */
 
add_filter( 'woocommerce_cart_subtotal', 'slash_cart_subtotal_if_discount', 99, 3 );
 
function slash_cart_subtotal_if_discount( $cart_subtotal, $compound, $obj ){
global $woocommerce;
if ( $woocommerce->cart->get_cart_discount_total() <> 0 ) {
$new_cart_subtotal = wc_price( $woocommerce->cart->subtotal_ex_tax- $woocommerce->cart->get_cart_discount_total() );
$cart_subtotal = sprintf( '<del>%s</del> <b>%s</b>', $cart_subtotal , $new_cart_subtotal  );
}
return $cart_subtotal;
}

add_filter( 'woocommerce_cart_item_subtotal', 'if_coupon_slash_item_subtotal', 99, 3 );
 
function if_coupon_slash_item_subtotal( $subtotal, $cart_item, $cart_item_key ){
   global $woocommerce;
   $array_remise_locale=$GLOBALS['array_remise_globale'];
   $current_user = wp_get_current_user();

   // recherche des keys ayant un prix non public
   while ($indice_key = current($array_remise_locale)) {
    if (key($array_remise_locale)==$current_user->user_login) {
       $coupon = $array_remise_locale[key($array_remise_locale)];
       if ( is_string( $coupon ) ) {
		$coupon = new WC_Coupon( $coupon );
	  }
       break;
       }
    next($array_remise_locale);
    }
   if ( $woocommerce->cart->get_cart_discount_total() <> 0 ) {
    $new_cart_subtotal = wc_price(($cart_item['data']->get_price()-(($coupon->coupon_amount)/100)*$cart_item['data']->get_price())*$cart_item['quantity']);
    $subtotal = sprintf( '<del>%s</del> <b>%s</b>', $subtotal , $new_cart_subtotal  );
   }
 
return $subtotal;
}

function change_product_price_display( $wc,  $cart_item,  $cart_item_key ) {
   global $woocommerce;
   $array_remise_locale=$GLOBALS['array_remise_globale'];
   $current_user = wp_get_current_user();

   // recherche des keys ayant un prix non public
   while ($indice_key = current($array_remise_locale)) {
    if (key($array_remise_locale)==$current_user->user_login) {
       $coupon = $array_remise_locale[key($array_remise_locale)];
       if ( is_string( $coupon ) ) {
		$coupon = new WC_Coupon( $coupon );
	  }
       break;
       }
    next($array_remise_locale);
    }

    if ( $woocommerce->cart->get_cart_discount_total() <> 0 ) {
      $new_wc=wc_price($cart_item['data']->get_price()-(($coupon->coupon_amount)/100)*$cart_item['data']->get_price());
      $wc = sprintf( '<del>%s</del> <b>%s</b>', $wc , $new_wc  );
      }
   return $wc;
}
//add_filter( 'woocommerce_get_price_html', 'sv_change_product_price_display' );
add_filter( 'woocommerce_cart_item_price', 'change_product_price_display',99,3 );

// Moving the catalog section up
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );

// Or moving result section below
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 40 );

// define the woocommerce_continue_shopping_redirect callback 
function filter_woocommerce_continue_shopping_redirect( $var ) { 
    $var=wc_get_page_permalink( 'shop' );
    return $var; 
}; 
         
// add the filter 
add_filter( 'woocommerce_continue_shopping_redirect', 'filter_woocommerce_continue_shopping_redirect', 10, 1 ); 

/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
function my_header_add_to_cart_fragment( $fragments ) {
 
    ob_start();
    $count = WC()->cart->cart_contents_count;
    $cart_total= WC()->cart->get_cart_total();
    ?><a class="bibi" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'Cart totals','woocommerce' ); ?>"><?php
    if ( $count > 0 ) {
        ?>
        <span class="bibi"><?php echo sprintf(_n('%d item', '%d items', $count, 'woocommerce'),$count);?></span>
        <span class="bibi"> -&nbsp;<?php echo $cart_total; ?></span>
        <?php            
    }
        ?></a><?php
 
    $fragments['a.bibi'] = ob_get_clean();
     
    return $fragments;
}

/*function my_header_add_to_cart_fragment( $fragments ) {
 
    $count = WC()->cart->cart_contents_count;
    $cart_total= WC()->cart->get_cart_total();
    $fragments['a.bibi'] = '<a class="bibi" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><?php _e( 'Cart totals', 'woocommerce'); ?>:<?php echo sprintf(_n('%d item', '%d items', $count, 'woocommerce'),$count);?>  -<?php echo $cart_total; ?>
</a>';
     
    return $fragments;
}*/

add_filter( 'woocommerce_add_to_cart_fragments', 'my_header_add_to_cart_fragment' );

/*add_action( 'wp_footer', 'cart_update_qty_script' );
function cart_update_qty_script() {
  if (is_cart()) :
   ?>
    <script>
        jQuery('div.woocommerce').on('change', '.qty', function(){
           jQuery("[name='update_cart']").removeAttr('disabled');
           jQuery("[name='update_cart']").trigger("click");
	   //window.location.reload();
        });
   </script>
<?php
endif;
}*/

// define the woocommerce_cart_actions callback 
/*function action_woocommerce_cart_actions(  ) { 
if (is_cart()) :
   ?>
    <script>
        jQuery('div.woocommerce').on('change', '.qty', function(){
           jQuery("[name='update_cart']").removeAttr('disabled');
           jQuery("[name='update_cart']").trigger("click");
	   //window.location.reload();
        });
   </script>
<?php
endif;
}
         
// add the action 
add_action( 'woocommerce_cart_actions', 'action_woocommerce_cart_actions', 1, 0 ); */


/********** verification email avant enregistrement ********************/

/* forcage de tous les is_activated à 1 */
/*$code = md5(time());
$args = array(
  'fields'       => 'all',
 );
$blogusers = get_users( $args);
foreach($blogusers as $key => $user){
  update_user_meta( $user->ID, 'is_activated', 1 );
  update_user_meta( $user->ID, 'activationcode', $code );
}	*/

// Rediriger l'utilisateur après l'enregistrement pour éviter qu'il soit directement connecté
function wc_registration_redirect( $redirect_to ) {
        wp_logout();
        wp_redirect( '/mon-compte/?q=');
        exit;
}
// Vérifier lorsqu'un utilisateur se connecte que son email a été validé
function my_wp_authenticate_user($user, $password) {
        $currentLang = qtranxf_getLanguage();
        $isActivated = get_user_meta($user->ID, 'is_activated', true);
        if ( !$isActivated ) {
              if ($currentLang=="fr")
                {
                $user = new WP_Error(
                                'inkfool_confirmation_error',
                                __( 'ERREUR : Votre compte doit être activé avant de pouvoir vous connecter. Vous pouvez renvoyer l’email de confirmation en cliquant <a href="/mon-compte/?u='.$user->ID.'">ici</a>', 'inkfool' )
                                );
                }
                else
                {
              if ($currentLang=="pl")
                {
                $user = new WP_Error(
                                'inkfool_confirmation_error',
                                __( 'BŁĄD: Twoje konto musi zostać aktywowane, zanim będziesz mógł się zalogować. Możesz wysłać e-mail z potwierdzeniem, klikając <a href="/mon-compte/?u='.$user->ID.'">tutaj</a>', 'inkfool' )
                                );
                }
                else
                 {
                 if ($currentLang=="zh")
                  {
                  $user = new WP_Error(
                                'inkfool_confirmation_error',
                                __( '错误：您必须先激活您的帐户，然后才能登录。 您可以通过单击发回确认电子邮件 <a href="/mon-compte/?u='.$user->ID.'">这里</a>', 'inkfool' )
                                );
                  }
                else
                  {
                  $user = new WP_Error(
                                'inkfool_confirmation_error',
                                __( 'ERROR: Your account must be activated before you can login. You can send back the confirmation email by clicking <a href="/mon-compte/?u='.$user->ID.'">here</a>', 'inkfool' )
                                );

                  }
                 }
                }
        }
        return $user;
}

// Envoyer un email à un utilisateur qui s'enregistre
function my_user_register($user_id) {
        $currentLang = qtranxf_getLanguage();
        // obtenir les données de l’utilisateur
        $user_info = get_userdata($user_id);
        // créer un hash md5 pour la vérification du compte
        $code = md5(time());
        // créer une chaine contenant le hash et l'id de l'utilisateur
        $string = array('id'=>$user_id, 'code'=>$code);
        // créer une meta_key "is_activated" pour l'utilisateur et lui mettre le statut 0
        update_user_meta($user_id, 'is_activated', 0);
        // créer une meta_key "activationcode" pour l'utilisateur et lui mettre en tant que valeur le code d'activation généré précédemment
        update_user_meta($user_id, 'activationcode', $code);
        // créer l'url qui figurera dans le mail
        $url = get_site_url(). '/mon-compte/?p=' .base64_encode( serialize($string));
        // contenu principal du mail
        if ($currentLang=="fr")
              {
              $content = __('Cliquez sur le lien suivant pour valider votre compte :');
              // titre de l'email
              $title = __('ardetem-sfere.com');
              // sous-titre de l'email
              $subtitle = __('Validation du compte');
              // signature de l'email
              $signature = __('Votre équipe ardetem-sfere.com.');
              }
        else
              {
              if ($currentLang=="pl")
               {
               $content = __('Kliknij poniższy link, aby potwierdzić swoje konto:');
               // titre de l'email
               $title = __('ardetem-sfere.com');
               // sous-titre de l'email
               $subtitle = __('Sprawdzanie konta');
               // signature de l'email
               $signature = __('Twój zespół ardetem-sfere.com.');
               }
              else
               {
               if ($currentLang=="zh")
                {
                $content = __('Kliknij poniższy link, aby potwierdzić swoje konto:');
                // titre de l'email
                $title = __('ardetem-sfere.com');
                // sous-titre de l'email
                $subtitle = __('Sprawdzanie konta');
                // signature de l'email
                $signature = __('Twój zespół ardetem-sfere.com.');
                }
               else
                {
                $content = __('点击以下链接验证您的帐户：');
                // titre de l'email
                $title = __('ardetem-sfere.com');
                // sous-titre de l'email
                $subtitle = __('帐户验证');
                // signature de l'email
                $signature = __('你的团队ardetem-sfere.com。');
                }
               }
              }
        // contenu html de l'email
        $html = <<<EOT
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta name="viewport" content="initial-scale=1.0">
                <meta name="format-detection" content="telephone=no">
                <title>Validation du compte</title>
                <style type="text/css">

                    .container {
                    border: none;
                    width: 100%;
                    background-color: white;

                    font-family: Verdana, Geneva, Tahoma, sans-serif;
                    margin-top: 30px;
                    margin-bottom: 30px;

                    }

                    .maintitle {
                    background-color: #50a160;
                    padding-top: 60px;
                    padding-bottom: 60px;
                    color: white;
                    font-weight: bold;
                    font-size: 30px;
                    text-align: center;
                    text-transform: uppercase;
                    }

                    .text {
                    padding-left: 30px;
                    padding-right: 30px;
                    color: lightgray;
                    }

                    .subtitle {
                    padding-left: 30px;
                    padding-right: 30px;
                    padding-top: 30px;
                    padding-bottom: 30px;
                    color: grey;
                    font-weight: bold;
                    font-size: 20px;
                    text-align: left;
                    text-transform: uppercase;
                    }

                    .signature {
                    padding-top: 30px;
                    padding-left: 30px;
                    padding-right: 30px;
                    color: lightgray;

                    }

                </style>
            </head>
            <body>
                <div class="main">
                    <table class="container">
                        <thead>
                            <tr>
                                <td class="maintitle">$title</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="subtitle">$subtitle</td>
                            </tr>
                            <tr>
                                <td class="text">
                                    $content <br/><br/> <a href="$url">$url</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="signature">
                                    $signature
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </body>
        </html>
EOT;
        
        // envoyer l'email à l'utilisateur
        if ($currentLang=="fr")
         {
         //@wp_mail($user_info->user_email, sprintf(__('[%s] Validation de votre compte utilisateur'), get_option('blogname')), $html);
         wc_mail($user_info->user_email, __('Validation de votre compte utilisateur'), $html);
         }
        else
         {
         if ($currentLang=="pl")
          {
          wc_mail($user_info->user_email, __('Sprawdzanie poprawności konta użytkownika'), $html);
          }
         else
          {
          if ($currentLang=="zh")
           {
           wc_mail($user_info->user_email, __('验证您的用户帐户'), $html);
           }
          else
           {
           wc_mail($user_info->user_email, __('Validation of your user account'), $html);
           }
          }
         }

    }


/*function hook_those_pesky_emails( $email_class ) {
add_action( 'woocommerce_created_customer_notification', array( $object, 'customer_new_account' ), 10, 3 );
}*/

// récupération et utilisation des valeurs passées en GET
function my_init(){
        $currentLang = qtranxf_getLanguage();
        // on vérifie si on a bien reçu le paramètre contenant le code d'activation et l'id de l'utilisateur
        if(isset($_GET['p'])){
                $data = unserialize(base64_decode($_GET['p']));
                $code = get_user_meta($data['id'], 'activationcode', true);
                // si oui, on vérifie que le code correspond à celui stocké dans la base de données pour l'utilisateur
                if($code == $data['code']){
                        // on met à jour le statut 'is_activated' du compte de l'utilisateur
                        update_user_meta($data['id'], 'is_activated', 1);
                        if ($currentLang=="fr") wc_add_notice( __( 'Succès : Votre compte a été activé avec succès !', 'inkfool' )  );
                        else
                         if ($currentLang=="pl") wc_add_notice( __( 'Sukces: Twoje konto zostało aktywowane pomyślnie!', 'inkfool' )  );
                           else if ($currentLang=="zh") wc_add_notice( __( '成功：您的帐户已成功激活！', 'inkfool' )  );
                              else wc_add_notice( __( 'Success: Your account has been activated successfully!', 'inkfool' )  );
                }else{
                        
                        if ($currentLang=="fr") wc_add_notice( __( 'Erreur : L\'activation a échouée, veuillez contacter l\'administrateur. ', 'inkfool' )  );
                        else
                         if ($currentLang=="pl") wc_add_notice( __( 'Błąd: aktywacja nie powiodła się, skontaktuj się z administratorem.', 'inkfool' )  );
                           else if ($currentLang=="zh") wc_add_notice( __( '错误：激活失败，请联系管理员。', 'inkfool' )  );
                              else wc_add_notice( __( 'Error: Activation failed, please contact the administrator.', 'inkfool' )  );

                }
        }
        if(isset($_GET['q'])){
                        if ($currentLang=="fr") wc_add_notice( __( 'Succès : Votre compte doit avoir été validé avant de pouvoir vous y connecter. Veuillez vérifier vos emails.', 'inkfool' ) );
                        else
                         if ($currentLang=="pl") wc_add_notice( __( 'Sukces: Twoje konto musiało zostać zweryfikowane przed zalogowaniem. Sprawdź swoje e-maile.', 'inkfool' )  );
                           else if ($currentLang=="zh") wc_add_notice( __( '成功：您的帐户必须经过验证，然后才能登录。 请检查您的电子邮件。', 'inkfool' )  );
                              else wc_add_notice( __( 'Success: Your account must have been verified before you can sign in. Please check your emails.', 'inkfool' )  );

                
        }
        if(isset($_GET['u'])){
                my_user_register($_GET['u']);
                if ($currentLang=="fr") wc_add_notice( __( 'Succès : Votre email d\'activation à été réenvoyé. Veuillez vérifier vos emails.', 'inkfool' ) );
                        else
                         if ($currentLang=="pl") wc_add_notice( __( 'Sukces: Twój e-mail aktywacyjny został wysłany ponownie. Sprawdź swoje e-maile.', 'inkfool' )  );
                           else if ($currentLang=="zh") wc_add_notice( __( '成功：您的激活邮件已被重新发送。 请检查您的电子邮件。', 'inkfool' )  );
                              else wc_add_notice( __( 'Success: Your activation email has been resent. Please check your emails.', 'inkfool' )  );
                
        }
}

// hooks et callbacks
//add_action( 'init', 'my_init' );
//add_filter('woocommerce_registration_redirect', 'wc_registration_redirect');
//add_filter('wp_authenticate_user', 'my_wp_authenticate_user',10,2);
//add_action('user_register', 'my_user_register',10,2);


/* WooCommerce. How to change ‘In Stock’ / ‘Out of Stock’ text displayed on a product page
*/

add_filter( 'woocommerce_get_availability', 'wcs_custom_get_availability', 1, 2);
function wcs_custom_get_availability( $availability, $product ) {
    $currentLang = qtranxf_getLanguage();
    // Change In Stock Text
    if ( $product->is_in_stock() ) {
        if ($currentLang=="fr")
        {
        $availability['availability'] =$product->get_stock_quantity().__(' Disponible(s) !', 'woocommerce');
        }
        else 
        if ($currentLang=="pl")
        {
        $availability['availability'] =$product->get_stock_quantity().__(' Dostępny !', 'woocommerce');    
        }
        else
        if ($currentLang=="zh")
        {
        $availability['availability'] =$product->get_stock_quantity().__(' 可得到 !', 'woocommerce');     
        }
        else
        {
        $availability['availability'] =$product->get_stock_quantity(). __(' Available !', 'woocommerce');    
        }
    }
    // Change Out of Stock Text
    if ( ! $product->is_in_stock() ) {
        if ($currentLang=="fr")
        {
        $availability['availability'] = __('Épuisé', 'woocommerce');
        }
        else 
        if ($currentLang=="pl")
        {
        $availability['availability'] = __('Wyprzedane', 'woocommerce');
        }
        else
        if ($currentLang=="zh")
        {
        $availability['availability'] = __('卖光了', 'woocommerce');
        }
        else
        {
        $availability['availability'] = __('Sold Out', 'woocommerce');
        }
        
    }
    return $availability;
}


/*add_action( 'woocommerce_checkout_update_order_meta', 'save_post_qwc_store_language', 100 );
function save_post_qwc_store_language ( $order_id ) {
	global $q_config;
	add_post_meta( $order_id, '_user_language', $q_config['language'], true );
}*/

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
         $fields['order']['language']['placeholder'] = '';
         $fields['order']['language']['type'] = 'text';
         $fields['order']['language']['label'] = 'language';
         $fields['order']['language']['class'] = array('hidden'); 
         $fields['order']['language']['default'] = get_locale();
     return $fields;
}

add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );
function my_custom_checkout_field_update_order_meta( $order_id ) {
    global $q_config;
    if ( ! empty( $_POST['language'] ) ) {
        update_post_meta( $order_id, 'language', sanitize_text_field( $_POST['language'] ) );
    }
	add_post_meta( $order_id, '_user_language', $q_config['language'], true );

}

// When changing the order status, change the qTranslate-x language to the one the customer used during the order process
/*add_action( 'wp_ajax_woocommerce_mark_order_status', function () {
    global $q_config;
    $order_id = absint( $_GET['order_id'] );
    $user_language = get_post_meta( $order_id, '_user_language', true );
    if ( $user_language ) {
        $q_config['language'] = $user_language;
        $locale               = $q_config['locale'][ $user_language ];
        qtranxf_localeForCurrentLanguage( $locale );
    }
}, 0 );*/

/*function monsite_woocommerce_payment_complete( $order_id ) {
global $q_config;
$lang=get_post_meta( $order_id, 'language', true);
$q_config['language']=substr('$lang', 0, 2);
}

add_action( 'woocommerce_payment_complete', 'monsite_woocommerce_payment_complete');*/



//add_filter('woocommerce_email_heading_new_order', 'waspdigital_order_complete_language_fix', 1, 2);

add_filter('woocommerce_email_subject_new_order', 'waspdigital_order_complete_language_fix', 1, 2);

//add_filter('woocommerce_email_recipient_new_order', 'waspdigital_order_complete_language_fix', 1, 2);

function waspdigital_order_complete_language_fix( $subject, $order){
    //global $woocommerce,$q_config;
    //$new_locale = 'en_US';//get_post_meta( $order_id, 'language', true);
    // set the current locale and send email with it active
    /*unload_textdomain('woocommerce');
    setlocale(LC_ALL, $new_locale);
    add_filter('plugin_locale',$new_locale);
    $q_config['language'] = substr($new_locale, 0, 2);
    $woocommerce->load_plugin_textdomain();*/
    
    /*$new_locale = 'fr_FR';//get_post_meta( $order_id, 'language', true);
    unload_textdomain('woocommerce');
    setlocale(LC_ALL, $new_locale);
    global $q_config, $woocommerce;
    $q_config['language'] = substr(get_locale(), 0, 2);
    $woocommerce->load_plugin_textdomain();*/
    
    return $subject;
}

/*add_filter('woocommerce_order_status_completed', 'hajoznijo_order_complete_language_fix', 1);
add_filter('woocommerce_order_status_cancelled', 'hajoznijo_order_complete_language_fix', 1);

function hajoznijo_customer_note_language_fix ( $args ) {
        $defaults = array(
        'order_id' => '',
        'customer_note' => ''
        );
        $args = wp_parse_args( $args, $defaults );
        extract( $args );
        hajoznijo_language_fix( $order_id);
        return ($args);
}
function hajoznijo_language_fix( $order_id ){
    $new_locale = get_post_meta( $order_id, 'language', true);
    unload_textdomain('woocommerce');
    setlocale(LC_ALL, $new_locale);
    global $q_config, $woocommerce;
    $q_config['language'] = substr($new_locale, 0, 2);
    $woocommerce->load_plugin_textdomain();
    return;
}
function hajoznijo_order_complete_language_fix( $order_id ){
    hajoznijo_language_fix ( $order_id );
    return $order_id;
} */

/*$user_language = get_post_meta( $order_id, '_user_language', true );*/
/*function custom_timeout( $timeout ) {
	return 0;
}
add_filter( 'wpephpcompat_scan_timeout', 'custom_timeout', 10 );*/

// Ajout defer pour tous les appels JavaScript
function ajout_defer( $url ) {
    if ( FALSE === strpos( $url, '.js' ) ) {
      return $url; // Pas notre fichier
    }
    if (is_user_logged_in()===TRUE) {
        return $url; // Pas de defer pour les utilisateurs connectés
    }
    return "$url' defer='defer";
}
add_filter( 'clean_url', 'ajout_defer', 11, 1 );

