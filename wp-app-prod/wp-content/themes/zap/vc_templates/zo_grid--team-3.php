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

	<!-- Get Filter Query -->
	<?php if (isset($atts['filter']) && $atts['filter'] == 1 && $atts['layout'] == 'masonry'): ?>
        <div class="zo-grid-filter">
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
	
    <div class="row zo-grid <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        $size = ( isset($atts['layout']) && $atts['layout']=='basic')?'thumbnail':'medium';
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(zoGetCategoriesByPostID(get_the_ID(),$taxo) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
			$zo_title_size = isset( $atts['zo_title_size'] ) ? $atts['zo_title_size'] : 'h2';
			$zo_meta_data = zo_post_meta_data();
			$team_position = (isset($zo_meta_data->_zo_team_position) && !empty($zo_meta_data->_zo_team_position)) ? $zo_meta_data->_zo_team_position : '';
            ?>
            <div class="zo-grid-item <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
				<div class="zo-grid-wrap">
					<?php if(has_post_thumbnail()) : ?>
						<div class="zo-grid-media"><?php echo zo_post_thumbnail(480, 460); ?></div>
					<?php endif ?>
					<div class="zo-grid-detail">				
                        <!-- Title -->
                        <<?php echo esc_attr($zo_title_size); ?> class="zo-grid-title"><?php the_title(); ?></<?php echo esc_attr($zo_title_size); ?>>
                        <!-- Position -->
                        <?php if($team_position):?>
                            <div class="zo-grid-position font-second">
                                <?php echo do_shortcode($team_position);?>
                            </div>
                        <?php endif;?>
                        <!-- Social -->
                        <?php if(isset($zo_meta_data->_zo_socials) && !empty($zo_meta_data->_zo_socials)): ?>
                            <div class="zo-grid-socials">
                                <ul class="zo-social">
                                <?php
                                    $socials = json_decode($zo_meta_data->_zo_socials);
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
        ?>
    </div>
    <?php
    wp_reset_postdata();
    ?>
</div>