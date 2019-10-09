<?php
wp_enqueue_script('zo-slick-main', get_template_directory_uri(). '/assets/js/zo_testimonial.js', array(), '1.0');
?>
<div class="zo-slick-wrap">

    <div class="zo-testimonial-default <?php echo esc_attr($atts['template']); ?>" id="<?php echo esc_attr($atts['html_id']); ?>">
        <?php $posts = $atts['posts']; ?>
        <div class="zo-testimonial-nav">
            <?php while($posts->have_posts()) :
                $posts->the_post();
                ?>
                <div>
                    <?php if(has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail( 'thumbnail' ); ?>
                    <?php endif ?>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="zo-testimonial-wrap">
            <?php while($posts->have_posts()) :
                $posts->the_post();
                $post_meta = zo_post_meta_data();
                ?>
                <div>
                    <div class="zo-testimonial-body">
                        <div class="zo-testimonial-content"><?php the_content(); ?></div>
                        <div class="zo-testimonial-line"><span></span></div>
                        <div class="zo-testimonial-info">
                            <h2 class="zo-testimonial-title"><?php the_title();?></h2>
                            <div class="zo-testimonial-position"><?php echo esc_attr($post_meta->_zo_testimonial_position); ?></div>
                        </div>
                    </div>
                </div>
            <?php endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>
