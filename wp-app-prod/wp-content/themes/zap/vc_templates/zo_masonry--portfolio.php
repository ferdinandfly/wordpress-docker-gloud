<?php
/* Get Categories */
$taxonomy = 'portfolio-category';
$_category = array();
if(!isset($atts['cat']) || $atts['cat']==''){
    $terms = get_terms($taxonomy);
    foreach ($terms as $cat){
        $_category[] = $cat->term_id;
    }
} else {
    $_category  = explode(',', $atts['cat']);
}
$atts['categories'] = $_category;
$zo_title_size = isset( $atts['zo_title_size'] ) ? $atts['zo_title_size'] : 'h2';
$zo_filter_style = isset( $atts['zo_filter_style'] ) ? $atts['zo_filter_style'] : '';
?>
<div class="zo-masonry-wrapper <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
	
	<!-- Get Filter Query -->
	<?php if( isset($atts['filter']) && $atts['filter'] == 1 ) : ?>
        <div class="zo-masonry-filter <?php echo esc_attr($zo_filter_style); ?>">
            <ul class="zo-filter-category list-unstyled list-inline">
                <li><a class="active" href="#" data-group="all"><?php esc_html_e("All", 'zap');?></a></li>
				<?php
					$posts = $atts['posts'];
					$query = $posts->query;
					$taxs  = array();
					if(isset($query['tax_query'])){
						$tax_query=$query['tax_query'];
						foreach($tax_query as $tax){
							if(is_array($tax)){
								$taxs[] = $tax['terms'];
							}
						}
					}
					foreach ($atts['categories'] as $category):
						if(!empty($taxs)){
							if(in_array($category,$taxs)) {
								$term = get_term($category, $taxonomy); 
					?>
								<li><a href="#" data-group="<?php echo esc_attr('category-' . $term->slug); ?>"><?php echo esc_attr($term->name); ?></a></li>
				<?php 		}
						}else{
							$term = get_term($category, $taxonomy); 
				?>
							<li><a href="#" data-group="<?php echo esc_attr('category-' . $term->slug); ?>"><?php echo esc_attr($term->name); ?></a></li>
				<?php
						} 
					endforeach; 
				?>
            </ul>
        </div>
    <?php endif; ?>
	
    <div class="zo-masonry">
        <?php
        $posts = $atts['posts'];
        $i = 0;
        while($posts->have_posts()) {
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(zoGetCategoriesByPostID(get_the_ID(), $taxonomy) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            /**
             * Get Masonry Size
             * It require, don't remove it
             */
            $size = zo_masonry_size($atts['post_id'] , $atts['html_id'], $i);
        ?>
        <div class="zo-masonry-item item-w<?php echo esc_attr($size['width']); ?> item-h<?php echo esc_attr($size['height']); ?>"
             data-groups='[<?php echo implode(',', $groups);?>]' data-index="<?php echo esc_attr($i); ?>" data-id="<?php echo esc_attr($atts['post_id']); ?>">
                <?php 
                    if(has_post_thumbnail()):
                        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                        $thumbnail = $thumbnail[0];
                    else:
                        $thumbnail = ZO_IMAGES.'no-image.jpg';
                    endif;
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('zo-portfolio-style-1'); ?> style="background-image: url('<?php echo esc_url($thumbnail); ?>')">
                    <div class="zo-portfolio-overlay">
                        <div class="zo-portfolio-category">
                            <?php the_terms( get_the_ID(), 'portfolio-category', '', ' / ' ); ?>
                        </div>
                        <<?php echo esc_attr($zo_title_size); ?> class="zo-portfolio-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_title(); ?></a></<?php echo esc_attr($zo_title_size); ?>>
                    </div>
                </article>
            </div>
            <?php
            $i++;
        }
        ?>
    </div>
    <?php
    wp_reset_postdata();
    ?>
</div>