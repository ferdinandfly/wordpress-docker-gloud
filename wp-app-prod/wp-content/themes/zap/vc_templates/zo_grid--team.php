<?php
global $smof_data;
    /* Get Categories */
        $taxonomy = 'team-category';
        $_category = array();
        if(!isset($atts['cat']) || $atts['cat']=='' && taxonomy_exists($taxonomy)){
            $terms = get_terms($taxonomy);
            foreach ($terms as $cat){
                $_category[] = $cat->term_id;
            }
        } else {
            $_category  = explode(',', $atts['cat']);
        }
        $atts['categories'] = $_category;
?>
<div class="zo-grid-wrapper zo-grid-team zo-team-layout-1 <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">

	<!-- Get Filter Query -->
	<?php if (isset($atts['filter']) && $atts['filter'] == 1 && $atts['layout'] == 'masonry'): ?>
        <div class="zo-grid-filter">
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
    <?php endif; ?>
	
    <div class="row <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(zoGetCategoriesByPostID(get_the_ID()) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            $team_meta = zo_post_meta_data();
            $zo_title_size = isset( $atts['zo_title_size'] ) ? $atts['zo_title_size'] : 'h2';
            ?>
            <div class="zo-team-wrap <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
                <div class="zo-team-inner">
                    <?php if(has_post_thumbnail()) : ?>
                    <div class="zo-team-image">
                        <?php the_post_thumbnail( 'medium' ); ?>
                    </div>
                    <?php endif ?>
                    <div class="zo-team-overlay">
                        <div class="zo-team-info">
                            <<?php echo esc_attr($zo_title_size); ?> class="zo-team-title"><?php the_title(); ?></<?php echo esc_attr($zo_title_size); ?>>
                            <div class="zo-team-position">
                                <span><?php echo do_shortcode($team_meta->_zo_team_position); ?></span>
                            </div>
                        </div>
                        <?php if(isset($team_meta->_zo_socials) && !empty($team_meta->_zo_socials)): ?>
                            <div class="zo-team-socials">
                                <ul class="zo-social">
                                    <?php
                                    $socials = json_decode($team_meta->_zo_socials);
                                    if($socials):
                                        foreach($socials as $key => $item): ?>
                                            <li>
                                                <a href="<?php echo esc_url($item->link);?>" data-original-title="<?php echo esc_attr($item->title);?>" data-placement="bottom" data-rel="tooltip" target="_blank">
                                                    <i class="fa <?php echo esc_attr($item->icon);?>"></i>
                                                </a>
                                            </li>
                                        <?php endforeach;
                                    endif;
                                    ?>
                                </ul>
                            </div>
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