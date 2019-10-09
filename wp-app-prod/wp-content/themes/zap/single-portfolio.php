<?php
/**
 * The Template for displaying all single portfolios
 *
 * @package ZoTheme
 * @subpackage Zo Theme
 * @since 1.0.0
 */

get_header(); ?>
<div class="<?php zo_main_class(); ?>">
    <div class="row">
        <div id="primary" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div id="content" role="main">

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php
                    $meta_data = zo_post_meta_data();
                    $layout = !empty($meta_data->_zo_portfolio_layout) ? $meta_data->_zo_portfolio_layout : '' ;
                    ?>

                    <?php get_template_part( 'single-templates/portfolio/content', $layout); ?>

                <?php endwhile; // end of the loop. ?>

            </div><!-- #content -->
        </div><!-- #primary -->
    </div>
</div>
<?php get_footer(); ?>