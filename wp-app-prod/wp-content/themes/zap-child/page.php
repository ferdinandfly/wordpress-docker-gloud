<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package ZoTheme
 * @subpackage Zo Theme
 * @since 1.0.0
 * @author CMS-Theme
 */

get_header(); ?>
<div id="page-default" class="<?php zo_main_class(); ?>">
	<div id="primary" class="row">
		<div id="content" role="main">
            <h2>
                <?php echo geoip_detect2_get_external_ip_adress(); ?>
                test:::::::!!!!<?php echo geoip_detect2_get_info_from_ip(geoip_detect2_get_external_ip_adress())->country->name ?>
            </h2>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'single-templates/content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
</div>
<?php get_footer(); ?>