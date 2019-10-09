<?php 
    /* get categories */
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
    <?php if( isset($atts['filter']) && $atts['filter'] == 1 && $atts['layout']=='masonry'):?>
        <div class="zo-grid-filter">
            <ul class="zo-filter-category list-unstyled list-inline">
                <li><a class="active" href="#" data-group="all">All</a></li>
                <?php foreach($atts['categories'] as $category):?>
                    <?php $term = get_term( $category, $taxo );?>
                    <li><a href="#" data-group="<?php echo esc_attr('category-'.$term->slug);?>">
                            <?php echo esc_attr($term->name); ?>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    <?php endif;?>
    <div class="row zo-grid <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(zoGetCategoriesByPostID(get_the_ID(),$taxo) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
			$zo_title_size = isset( $atts['zo_title_size'] ) ? $atts['zo_title_size'] : 'h2';
            ?>
            <div class="zo-grid-item <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
				<?php if(has_post_thumbnail()) : ?>
					<div class="zo-portfolio-image">
						<?php the_post_thumbnail('zo-blog-thumbnail'); ?>
					</div>
				<?php endif ?>
                <<?php echo esc_attr($zo_title_size); ?> class="zo-grid-title"><?php the_title(); ?></<?php echo esc_attr($zo_title_size); ?>>
                <div class="zo-grid-content">
                    <?php the_excerpt();?>
                </div>
                <div class="zo-grid-button">
					<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" class="btn btn-gray-transparent btn-border-2 btn-readmore" ><?php esc_html_e("Read More", 'zap'); ?></a>
				</div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
    wp_reset_postdata();
    ?>
</div>