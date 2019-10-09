<?php
global $smof_data;
    /* Get Categories */
    $taxo = 'category';
    $_category = array();
    if(!isset($atts['cat']) || $atts['cat']==''){
        $terms = get_terms($taxo);
        foreach ($terms as $cat){
            $_category[] = $cat->term_id;
        }
    } else {
        $_category  = explode(',', $atts['cat']);
    }
    $atts['categories'] = $_category;
?>
<div class="zo-grid-wraper <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">

    <div class="zo-grid zo-grid-blog-style-1 <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(zoGetCategoriesByPostID(get_the_ID()) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            $zo_title_size = isset( $atts['zo_title_size'] ) ? $atts['zo_title_size'] : 'h2';
        ?>
            <div class="<?php echo esc_attr($atts['item_class']);?>">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if(has_post_thumbnail()) : ?>
                    <div class="zo-news-image">
	                    <?php echo zo_post_thumbnail(480, 330); ?>
                    </div>
                    <?php endif; ?>
                    <div class="zo-news-info">
                        <div class="tag"><?php the_terms( get_the_ID(), 'category', '', ', ' ); ?></div>
                        <<?php echo esc_attr($zo_title_size); ?> class="zo-news-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_title(); ?></a></<?php echo esc_attr($zo_title_size); ?>>
                        <div class="zo-news-content">
                            <?php
								$trimcontent = get_the_excerpt();
								$shortcontent = wp_trim_words( $trimcontent, $num_words = 20, $more = '');
								echo do_shortcode($shortcontent);
							?>							
                        </div>
                        <a class="btn-readmore" title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php esc_html_e('Read More', 'zap'); ?> <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </article>
            </div>
            <?php
        }
        wp_reset_postdata();
        ?>
    </div>
</div>