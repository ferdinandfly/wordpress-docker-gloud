<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body id="blog" <?php body_class(); ?>>
<header id="masthead" class="site-header">
    <?php global $sitepress; ?>
    <?php $currentLang = $sitepress->get_current_language(); ?>
    <div class="HeaderClass">
        <?php if ($currentLang == 'pl'): ?>
            <strong>ARDETEM I ZPAS: S&#322;upiecka 14 ,57-402 Nowa Ruda
                ,Polski&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&#9743;&nbsp;: <strong>00 48 748 724 706&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong>&#9993;&nbsp;
            <a style="color:#fff" href="mailto:ardetem@ardetem.com.pl">
                <strong>ardetem@ardetem.com.pl</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <?php elseif ($currentLang == 'zh-hans'): ?>
            <strong>ARDETEM ELECTRONIC METER CO.LTD: Building 3+ NO215 Yaohua RD Pudong
                District | Shanghai&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&#9743;&nbsp;: <strong>021-58883650&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&#9993;&nbsp;
            <a style="color:#fff" href="mailto:contact@ardetem-cn.com"><strong>contact@ardetem-cn.com</strong></a>
        <?php elseif ($currentLang === 'fr'): ?>
            <?php if ( (geoip_detect2_get_info_from_current_ip()->country->isoCode) === 'FR') : ?>
                <strong>ARDETEM SFERE: Parc d'arbora n°2 Route de brindas 69510 SOUCIEU EN JARREST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&#9743;&nbsp;:
                <strong>00 33 472313130&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&#9993;&nbsp;
                <a style="color:#fff" href="mailto:info@sfere-net.com">
                    <strong>info@sfere-net.com</strong>
                </a>&nbsp;&#9993;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="mailto:info@ardetem.com"><strong>info@ardetem.com</strong></a>
            <?php else : ?>
                <strong>DIARY &nbsp;&nbsp;&nbsp;</strong>&#9743;&nbsp;: <strong> 123456
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&#9993;
                                                           &nbsp;
                <a style="color:#fff"
                   href="mailto:info@sfere-net.com"><strong>diary@somewhere.com</strong></a>&nbsp;&#9993;
            <?php endif ?>
        <?php else: ?>
            <strong>DIARY &nbsp;&nbsp;&nbsp;</strong>&#9743;&nbsp;: <strong> 123456
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&#9993;&nbsp;
            <a style="color:#fff" href="mailto:info@sfere-net.com"><strong>diary@somewhere.com</strong></a>&nbsp;&#9993;
        <?php endif; ?>
    </div>
</header>
<div class="page-wrap">
    <?php get_template_part('template-parts/template-part', 'topnav'); ?>
