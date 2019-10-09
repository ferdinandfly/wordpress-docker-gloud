<?php 
    $icon_name = "icon_" . $atts['icon_type'];
    $iconClass = isset($atts[$icon_name])?$atts[$icon_name]:'';
?>
<div class="zo-fancyboxes-wraper <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php if($atts['title']!=''):?>
        <div class="zo-fancyboxes-head">
            <div class="zo-fancyboxes-title">
                <?php echo apply_filters('the_title',$atts['title']);?>
            </div>
            <div class="zo-fancyboxes-description">
                <?php echo apply_filters('the_content',$atts['description']);?>
            </div>
        </div>
    <?php endif;?>
    <div class="zo-fancybox-inner">
        <div class="zo-fancybox-item">
            <?php 
            $image_url = '';
            if (!empty($atts['image'])) {
                $attachment_image = wp_get_attachment_image_src($atts['image'], 'full');
                $image_url = $attachment_image[0];
            }
            ?>
            <?php if($image_url):?>
            <div class="zo-fancy-box-icon fancy-box-image">
                <img alt="<?php echo apply_filters('the_title',$atts['title']);?>" src="<?php echo esc_attr($image_url);?>" />
            </div>
            <?php else:?>
            <div class="zo-fancy-box-icon fancy-box-icon">
                <i class="<?php echo esc_attr($iconClass);?>"></i>
            </div>
            <?php endif;?>
			<div class="zo-fancy-box-info">
				<?php if($atts['title_item']):?>
					<h6 class="zo-fancy-box-title"><?php echo apply_filters('the_title',$atts['title_item']);?></h6>
				<?php endif;?>
				<?php if($atts['description_item']): ?>
					<div class="zo-fancy-box-content">
						<?php echo apply_filters('the_content',$atts['description_item']);?>
					</div>
				<?php endif; ?>
			</div>
            <?php if($atts['button_text']!=''):?>
                <div class="zo-fancyboxes-foot">
                    <?php
                    $class_btn = ($atts['button_type']=='button')?'btn btn-large':'';
                    ?>
                    <a href="<?php echo esc_url($atts['button_link']);?>" class="<?php echo esc_attr($class_btn);?>"><?php echo esc_attr($atts['button_text']);?></a>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>