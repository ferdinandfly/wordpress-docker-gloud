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

$zo_title_size = isset( $atts['zo_title_size'] ) ? $atts['zo_title_size'] : 'h2';
$zo_filter_style = isset( $atts['zo_filter_style'] ) ? $atts['zo_filter_style'] : '';
?>
<div class="zo-grid-wraper zo-portfolio-style-2 <?php echo esc_attr($atts['template']); ?>" id="<?php echo esc_attr($atts['html_id']); ?>">
    
	<!-- Get Filter Query -->
	<?php if (isset($atts['filter']) && $atts['filter'] == 1 && $atts['layout'] == 'masonry'): ?>
        <div class="zo-grid-filter <?php echo esc_attr($zo_filter_style); ?>">
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
	
    <div class="row zo-grid zo-grid-portfolio <?php echo esc_attr($atts['grid_class']); ?>">
        <?php
        $posts = $atts['posts'];
        while ($posts->have_posts()) {
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach (zoGetCategoriesByPostID(get_the_ID(), $taxonomy) as $category) {
                $groups[] = '"category-' . $category->slug . '"';
            }
            ?>
            <div class="<?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
                <article id="post-<?php the_ID(); ?>" <?php post_class('zo-portfolio-style-1'); ?>>
                    <div class="zo-portfolio">
                        <div class="zo-portfolio-image">
                            <?php if(has_post_thumbnail()) : ?>
	                            <?php echo zo_post_thumbnail(480, 330); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url($smof_data['thumbnail_default']['url']); ?>" alt="<?php the_title(); ?>"/>
                            <?php endif ?>
                        </div>
                        <div class="zo-portfolio-overlay">
                            <div class="zo-portfolio-category">
                                <?php the_terms( get_the_ID(), 'portfolio-category', '', ' / ' ); ?>
                            </div>
                            <<?php echo esc_attr($zo_title_size); ?> class="zo-portfolio-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_title(); ?></a></<?php echo esc_attr($zo_title_size); ?>>
                        </div>
                    </div>
                </article>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="clearfix"></div>
    <?php
    zo_paging_nav();
    wp_reset_postdata();
    ?>
</div>