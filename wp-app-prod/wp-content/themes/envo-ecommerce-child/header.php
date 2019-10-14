<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <!-- Piwik -->
    <?php
    $current_user = wp_get_current_user();

    $customer_id = get_current_user_id();
    $company = get_user_meta($customer_id, 'billing_company', true);
    $address_1 = get_user_meta($customer_id, 'billing_address_1', true);
    $postcode = get_user_meta($customer_id, 'billing_postcode', true);
    $city = get_user_meta($customer_id, 'billing_city', true);
    $country = get_user_meta($customer_id, 'billing_country', true);
    $country_name = WC()->countries->countries[$country];
    ?>
    <script type="text/javascript">
        var _paq = _paq || [];
        <?php if (is_user_logged_in()) {
            echo sprintf("_paq.push(['setUserId', '%s']);", $current_user->user_email);
        }?>
        _paq.push(['setCustomVariable', '1', 'Utilisateur', '<?php if (is_user_logged_in()) {
            echo $current_user->user_login;
        } else {
            echo 'Non Connecté';
        }  ?>', 'visit']);
        _paq.push(['setCustomVariable', '2', '<?php if (is_user_logged_in()) {
            echo 'Nom';
        } else {
            echo '';
        } ?>', '<?php if (is_user_logged_in()) {echo $current_user->user_lastname ?> <?php echo "Prenom : " ?> <?php echo $current_user->user_firstname;} else {
            echo 'Non Connecté';
        }  ?>', 'visit']);
        _paq.push(['setCustomVariable', '3', '<?php if (is_user_logged_in()) {
            echo 'Email';
        } else {
            echo '';
        } ?>', '<?php if (is_user_logged_in()) {
            echo $current_user->user_email;
        } else {
            echo '';
        } ?>', 'visit']);
        _paq.push(['setCustomVariable', '4', '<?php if (is_user_logged_in()) {
            echo 'Societe';
        } else {
            echo '';
        } ?>', '<?php if (is_user_logged_in()) {
            echo $company;
        } else {
            echo '';
        } ?>', 'visit']);
        _paq.push(['setCustomVariable', '5', '<?php if (is_user_logged_in()) {
            echo 'Adresse';
        } else {
            echo '';
        } ?>', '<?php if (is_user_logged_in()) {
            echo $address_1;
        } else {
            echo '';
        } ?>', 'visit']);
        _paq.push(['setCustomVariable', '6', '<?php if (is_user_logged_in()) {
            echo 'Code postal';
        } else {
            echo '';
        } ?>', '<?php if (is_user_logged_in()) {
            echo $postcode;
        } else {
            echo '';
        } ?>', 'visit']);
        _paq.push(['setCustomVariable', '7', '<?php if (is_user_logged_in()) {
            echo 'Ville';
        } else {
            echo '';
        } ?>', '<?php if (is_user_logged_in()) {
            echo $city;
        } else {
            echo '';
        } ?>', 'visit']);
        _paq.push(['setCustomVariable', '8', '<?php if (is_user_logged_in()) {
            echo 'Pays';
        } else {
            echo '';
        } ?>', '<?php if (is_user_logged_in()) {
            echo $country_name;
        } else {
            echo '';
        } ?>', 'visit']);
        /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function () {
            var u = "//ardetem-sfere.com/analytics/";
            _paq.push(['setTrackerUrl', u + 'piwik.php']);
            _paq.push(['setSiteId', '1']);
            var d = document, g = d.createElement('script'), s = d.getElementsByTagName('script')[0];
            g.type = 'text/javascript';
            g.async = true;
            g.defer = true;
            g.src = u + 'piwik.js';
            s.parentNode.insertBefore(g, s);
        })();
    </script>
    <!-- End Piwik Code -->
</head>
<body id="blog" <?php body_class(); ?>>
<header id="masthead" class="site-header">
    <?php global $sitepress; ?>
    <? $currentLang = $sitepress->get_current_language(); ?>
    <div class="HeaderClass">

    </div>
</header>
<div class="page-wrap">
    <?php get_template_part('template-parts/template-part', 'topnav'); ?>
