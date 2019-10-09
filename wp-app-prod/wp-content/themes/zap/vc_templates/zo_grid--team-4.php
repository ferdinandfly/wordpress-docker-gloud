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
	
    <div class="<?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        $zo_title_size = isset( $atts['zo_title_size'] ) ? $atts['zo_title_size'] : 'h2';
        $zo_team_more_text = isset( $atts['zo_team_more_text'] ) ? $atts['zo_team_more_text'] : '';
        $zo_team_more_icon = isset( $atts['zo_team_more_icon'] ) ? $atts['zo_team_more_icon'] : '';
        $zo_team_more_link = isset( $atts['zo_team_more_link'] ) ? $atts['zo_team_more_link'] : '#';

        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(zoGetCategoriesByPostID(get_the_ID(),$taxo) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
			$zo_meta_data = zo_post_meta_data();
			$team_position = (isset($zo_meta_data->_zo_team_position) && !empty($zo_meta_data->_zo_team_position)) ? $zo_meta_data->_zo_team_position : '';
            ?>
            <div class="<?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
				<div class="zo-team-wrap">
					<?php if(has_post_thumbnail()) : ?>
						<div class="zo-team-image"><?php the_post_thumbnail( 'thumbnail' ); ?></div>
					<?php endif ?>
                    <<?php echo esc_attr($zo_title_size); ?> class="zo-team-title"> <?php the_title(); ?><i class="fa fa-plus"></i> </<?php echo esc_attr($zo_title_size); ?>>
				</div>
            </div>
            <?php
        }
        ?>
        <?php if(!empty($zo_team_more_text)) : ?>
        <div class="<?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
            <div class="zo-team-more">
                <a href="<?php echo esc_url($zo_team_more_link); ?>">
                    <span class="zo-team-more-text"><?php echo esc_attr($zo_team_more_text); ?></span>
                    <i class="<?php echo esc_attr($zo_team_more_icon); ?>"></i>
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php
    wp_reset_postdata();
    ?>
</div>