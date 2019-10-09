<?php
/* Get Categories */
$taxonomy = 'portfolio-category';
$_category = array();
if( !isset($atts['cat']) || $atts['cat']==''){
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
	<?php if ( $atts['filter'] == "true" && !$atts['loop'] ):?>
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
	
    <div class="zo-carousel zo-team-default <?php echo esc_attr($atts['template']); ?>" id="<?php echo esc_attr($atts['html_id']); ?>">
        <?php
        $posts = $atts['posts'];
        while($posts->have_posts()){
            $posts->the_post();
            $team_meta = zo_post_meta_data();
            $groups = array();
            $groups[] = 'zo-carousel-filter-item all';
            foreach (zoGetCategoriesByPostID(get_the_ID(), $taxonomy) as $category) {
                $groups[] = 'category-' . $category->slug;
            }

            ?>
            <div class="zo-carousel-item zo-team-wrap <?php echo implode(' ', $groups);?>">
                <div class="zo-team-inner">
                    <?php if(has_post_thumbnail()) : ?>
                        <div class="zo-team-image">
                            <?php the_post_thumbnail( 'full' ); ?>
                        </div>
                    <?php endif ?>
                    <div class="zo-team-overlay">
                        <h2 class="zo-team-title"><?php the_title(); ?></h2>
                        <div class="zo-team-position">
                            <span><?php echo do_shortcode($team_meta->_zo_team_position); ?></span>
                        </div>
                        <?php if(isset($team_meta->_zo_socials) && !empty($team_meta->_zo_socials)): ?>
                            <ul class="zo-team-socials">
                                <?php
                                $socials = json_decode($team_meta->_zo_socials);
                                if($socials):
                                    foreach($socials as $key => $item): ?>
                                        <li>
                                            <a href="<?php echo do_shortcode($item->link);?>" target="_blank">
                                                <i class="fa <?php echo do_shortcode($item->icon);?>"></i>
                                            </a>
                                        </li>
                                    <?php endforeach;
                                endif;
                                ?>
                            </ul>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        <?php
        }
        wp_reset_postdata();
        ?>
    </div>
</div>
