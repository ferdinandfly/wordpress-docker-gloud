<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head><meta http-equiv="Content-Type" content="text/html; charset=euc-kr"> section and everything up till <div id="main">
 *
 * @package ZoTheme
 * @subpackage Zo Theme
 * @since 1.0.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>

        <!-- Piwik -->
        <?php
        $current_user = wp_get_current_user();

        $customer_id = get_current_user_id();
        $company=get_user_meta( $customer_id, 'billing_company', true );
        $address_1=get_user_meta( $customer_id, 'billing_address_1', true );
        $postcode=get_user_meta( $customer_id, 'billing_postcode', true );
        $city=get_user_meta( $customer_id, 'billing_city', true );
        $country=get_user_meta( $customer_id, 'billing_country', true );
        $country_name=WC()->countries->countries[$country];
        ?>
        <script type="text/javascript">
        var _paq = _paq || [];
        <?php if (is_user_logged_in()) {echo sprintf("_paq.push(['setUserId', '%s']);", $current_user->user_email);}?>
        _paq.push(['setCustomVariable','1','Utilisateur','<?php if (is_user_logged_in()) {echo $current_user->user_login;} else {echo 'Non Connecté';}  ?>', 'visit']);
        _paq.push(['setCustomVariable','2','<?php if (is_user_logged_in()) {echo 'Nom';} else {echo '';} ?>','<?php if (is_user_logged_in()) {echo $current_user->user_lastname ?> <?php echo "Prenom : " ?> <?php echo $current_user->user_firstname;} else {echo 'Non Connecté';}  ?>', 'visit']);
        _paq.push(['setCustomVariable','3','<?php if (is_user_logged_in()) {echo 'Email';} else {echo '';} ?>','<?php if (is_user_logged_in()) {echo $current_user->user_email;} else {echo '';} ?>', 'visit']);
        _paq.push(['setCustomVariable','4','<?php if (is_user_logged_in()) {echo 'Societe';} else {echo '';} ?>','<?php if (is_user_logged_in()) {echo $company;} else {echo '';} ?>', 'visit']);
        _paq.push(['setCustomVariable','5','<?php if (is_user_logged_in()) {echo 'Adresse';} else {echo '';} ?>','<?php if (is_user_logged_in()) {echo $address_1;} else {echo '';} ?>', 'visit']);
        _paq.push(['setCustomVariable','6','<?php if (is_user_logged_in()) {echo 'Code postal';} else {echo '';} ?>','<?php if (is_user_logged_in()) {echo $postcode;} else {echo '';} ?>', 'visit']);
        _paq.push(['setCustomVariable','7','<?php if (is_user_logged_in()) {echo 'Ville';} else {echo '';} ?>','<?php if (is_user_logged_in()) {echo $city;} else {echo '';} ?>', 'visit']);
        _paq.push(['setCustomVariable','8','<?php if (is_user_logged_in()) {echo 'Pays';} else {echo '';} ?>','<?php if (is_user_logged_in()) {echo $country_name;} else {echo '';} ?>', 'visit']);
        /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
        var u="//ardetem-sfere.com/analytics/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', '1']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
        })();
       </script>
       <!-- End Piwik Code -->
       <!-- desactive clic droit -->
      <!--<script type="text/javascript">
      document.oncontextmenu = new Function ("return false");
      </script> -->
</head>
<body <?php body_class(zo_page_class()); ?>>
<?php
zo_get_page_loading();
if(function_exists ( 'zo_presets_selector' )) zo_presets_selector();
?>
   <div id="page">
   <header id="masthead" class="site-header">
<?php global $woocommerce; ?>
   <? $currentLang = qtranxf_getLanguage();if ($currentLang=='pl'): ?>
   <div class="HeaderClass"><strong>ARDETEM I ZPAS: S&#322;upiecka 14 ,57-402 Nowa Ruda ,Polski&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&#9743;&nbsp;: <strong>00 48 748 724 706&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong>&#9993;&nbsp;<a style="color:#fff" href="mailto:ardetem@ardetem.com.pl"><strong>ardetem@ardetem.com.pl</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   </div>
<? elseif ($currentLang=='zh'): ?>
   <div class="HeaderClass"><strong>ARDETEM ELECTRONIC METER CO.LTD: Building 3+ NO215 Yaohua RD Pudong District | Shanghai&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&#9743;&nbsp;: <strong>021-58883650&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&#9993;&nbsp;<a style="color:#fff" href="mailto:contact@ardetem-cn.com"><strong>contact@ardetem-cn.com</strong></a>
   </div>
<?php elseif ($currentLang === 'fr'):?>
       <div class="HeaderClass">
            <?php  if (geoip_detect2_get_info_from_current_ip()->country->isoCode === 'FR') : ?>
                <strong>ARDETEM SFERE: Parc d'arbora n°2 Route de brindas 69510 SOUCIEU EN JARREST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&#9743;&nbsp;:
                <strong>00 33 472313130&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&#9993;&nbsp;
                <a style="color:#fff" href="mailto:info@sfere-net.com">
                    <strong>info@sfere-net.com</strong>
                </a>&nbsp;&#9993;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="mailto:info@ardetem.com"><strong>info@ardetem.com</strong></a>
            <?php else : ?>
                <strong>DIARY &nbsp;&nbsp;&nbsp;</strong>&#9743;&nbsp;: <strong> 123456 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&#9993;
           &nbsp;<a style="color:#fff" href="mailto:info@sfere-net.com"><strong>diary@somewhere.com</strong></a>&nbsp;&#9993;
           <?endif?>
       </div>
<? else: ?>
       <strong>DIARY &nbsp;&nbsp;&nbsp;</strong>&#9743;&nbsp;: <strong> 123456 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&#9993;
      &nbsp;<a style="color:#fff" href="mailto:info@sfere-net.com"><strong>diary@somewhere.com</strong></a>&nbsp;&#9993;
   <? endif; ?>


   <?php zo_header(); ?>
   </header>
   <?php zo_page_title(); ?>
	<div id="main">