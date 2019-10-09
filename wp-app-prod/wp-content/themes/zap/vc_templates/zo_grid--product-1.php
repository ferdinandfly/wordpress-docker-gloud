<?php
global $smof_data;
/* Get Categories */
$taxonomy = 'product_cat';
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
<div class="zo-grid-wraper zo-product-style-1 <?php echo esc_attr($atts['template']); ?>" id="<?php echo esc_attr($atts['html_id']); ?>">
    
	<!-- Get Filter Query -->
	<?php if (isset($atts['filter']) && $atts['filter'] == 1 && $atts['layout'] == 'masonry'): ?>
        <div class="zo-grid-filter style-2">
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
	
    <div class="row zo-grid zo-grid-product <?php echo esc_attr($atts['grid_class']); ?>">
        <?php
        $posts = $atts['posts'];
        while ($posts->have_posts()) {
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach (zoGetCategoriesByPostID(get_the_ID(), $taxonomy) as $category) {
                $groups[] = '"category-' . $category->slug . '"';
            }
            $zo_title_size = isset( $atts['zo_title_size'] ) ? $atts['zo_title_size'] : 'h2';
            ?>
            <div class="<?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>                  
                    <div class="zo-product-teaser">
                        <div class="zo-product-header">
                            <div class="zo-product-image">
                                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr('View detail', 'zap'); ?>">
                                    <?php
                                    /**
                                     * woocommerce_before_shop_loop_item_title hook
                                     *
                                     * @hooked woocommerce_show_product_loop_sale_flash - 10
                                     * @hooked woocommerce_template_loop_product_thumbnail - 10
                                     */
                                    do_action( 'woocommerce_before_shop_loop_item_title' );
                                    ?>
                                </a>
                            </div>
                            <div class="zo-product-overlay">
								<?php do_action('woocommerce_before_shop_loop_item'); ?>
                                <?php
                                /**
                                 * woocommerce_after_shop_loop_item hook
                                 *
                                 * @hooked woocommerce_template_loop_add_to_cart - 10
                                 */
                                do_action( 'woocommerce_after_shop_loop_item' );
                                ?>
                            </div>
                        </div>
                        <div class="zo-product-meta">
                            <h3 class="zo-product-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                            <?php
                            /**
                             * woocommerce_after_shop_loop_item_title hook
                             *
                             * @hooked woocommerce_template_loop_rating - 5
                             * @hooked woocommerce_template_loop_price - 10
                             */
                            remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
                            do_action( 'woocommerce_after_shop_loop_item_title' );
                            ?>
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