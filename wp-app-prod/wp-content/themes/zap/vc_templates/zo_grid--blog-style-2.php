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

    <div class="row zo-grid zo-grid-blog-style-2 <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(zoGetCategoriesByPostID(get_the_ID()) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
	        set_query_var('zo_image_size', 'zo-blog-medium');
	        ?>
            <div class="<?php echo esc_attr($atts['item_class']);?>">
                <?php get_template_part('single-templates/content/content', get_post_format()); ?>
            </div>
            <?php
        }
        wp_reset_postdata();
        ?>
    </div>
</div>