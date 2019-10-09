<?php
global $smof_data;
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
?>
<div class="zo-carousel-wrap">
	
	<!-- Get Filter Query -->
	<?php if ( $atts['filter'] == "true" && !$atts['loop'] ): ?>
        <div class="zo-carousel-filter">
            <ul>
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
		<div class="zo-carousel-filter-hidden" style="display: none"></div>
    <?php endif; ?>
	
    <div class="zo-carousel <?php echo esc_attr($atts['template']); ?>" id="<?php echo esc_attr($atts['html_id']); ?>">
        <?php
        $posts = $atts['posts'];
        while($posts->have_posts()){
            $posts->the_post();
            $post_meta = zo_post_meta_data();
            $groups = array();
            $groups[] = 'zo-carousel-filter-item all';
            foreach (zoGetCategoriesByPostID(get_the_ID(), $taxonomy) as $category) {
                $groups[] = 'category-' . $category->slug;
            }
            ?>
            <div class="zo-carousel-item zo-testimonial-wrap <?php echo implode(' ', $groups);?>">
                <article id="post-<?php the_ID(); ?>" <?php post_class('zo-portfolio-style-1'); ?>>
                    <div class="zo-portfolio">

						<?php if(has_post_thumbnail()) : ?>
							<div class="zo-portfolio-image">
								<?php echo zo_post_thumbnail(480, 330); ?>
							</div>
						<?php endif; ?>
						
                        <div class="zo-portfolio-overlay">
                            <div class="zo-portfolio-category">
                                <?php the_terms( get_the_ID(), 'portfolio-category', '', ' / ' ); ?>
                            </div>
                            <h2 class="zo-portfolio-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_title(); ?></a></h2>
                        </div>
                    </div>
                </article>
            </div>
            <?php
        }
        wp_reset_postdata();
        ?>
    </div>
</div>
