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

    <div class="row zo-grid <?php echo esc_attr($atts['grid_class']);?>">
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
					<!--thumbnail, date-->
					<?php if(has_post_thumbnail()) : ?>
						<div class="zo-blog-image">
							<?php echo zo_post_thumbnail(200, 200); ?>
						</div>
                    <?php endif; ?>
					<!--detail-->
					<div class="zo-blog-detail">
						<<?php echo esc_attr($zo_title_size); ?> class="zo-blog-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_title(); ?></a></<?php echo esc_attr($zo_title_size); ?>>
						<div class="zo-blog-content">
                            <?php echo zo_limit_words(get_the_excerpt(), 20);?>
                        </div>
                    <a class="btn btn-primary btn-readmore" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'zap'); ?></a>
					</div>
                </article>
            </div>
            <?php
        }
        wp_reset_postdata();
        ?>
    </div>
</div>