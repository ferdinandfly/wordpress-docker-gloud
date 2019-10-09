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

    <div class="row zo-grid zo-grid-service-style-2 <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
		$i = 1;
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(zoGetCategoriesByPostID(get_the_ID()) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            $zo_title_size = isset( $atts['zo_title_size'] ) ? $atts['zo_title_size'] : 'h2';
            $zo_image_size = isset( $atts['zo_image_size'] ) ? $atts['zo_image_size'] : 'thumbnail';
        ?>
            <div class="<?php echo esc_attr($atts['item_class']);?>">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="row">
					<?php if($i%2!=0){ ?>
						 <?php if(has_post_thumbnail()) : ?>
						<div class="zo-news-image col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<?php the_post_thumbnail( $zo_image_size ); ?>
						</div>
						<?php endif; ?>
					<?php }else{?>
						<?php if(has_post_thumbnail()) : ?>
							<div class="zo-news-image visible-xs col-xs-12">
								<?php the_post_thumbnail( $zo_image_size ); ?>
							</div>
						<?php endif; ?>
					<?php }?>
                    <div class="zo-news-info col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="tag"><?php the_terms( get_the_ID(), 'category', '', ', ' ); ?></div>
                        <<?php echo esc_attr($zo_title_size); ?> class="zo-news-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_title(); ?></a></<?php echo esc_attr($zo_title_size); ?>>
                        <div class="zo-news-content">
	                        <?php echo zo_limit_words(get_the_content(), 100); ?>
                        </div>
                        <a class="btn btn-gray-transparent btn-border-2 btn-ordernow" title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php esc_html_e('ORDER NOW', 'zap'); ?></a>
                    </div>
					<?php if($i%2==0){ ?>
						 <?php if(has_post_thumbnail()) : ?>
						<div class="zo-news-image hidden-xs col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<?php the_post_thumbnail( $zo_image_size ); ?>
						</div>
						<?php endif; ?>
					<?php }?>
					</div>
                </article>
            </div>
            <?php $i++;
        }
        wp_reset_postdata();
        ?>
    </div>
</div>