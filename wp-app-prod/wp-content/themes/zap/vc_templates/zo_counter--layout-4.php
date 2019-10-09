<div class="zo-counter-wraper <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
	<?php if($atts['title']!=''):?>
        <div class="zo-counter-head">
            <div class="zo-counter-title">
                <?php echo apply_filters('the_title',$atts['title']);?>
            </div>
            <div class="zo-counter-description">
                <?php echo apply_filters('the_content',$atts['description']);?>
            </div>
        </div>
    <?php endif;?>
    <div class="zo-counter-body">
        <?php
            $columns = ((int)$atts['zo_cols'])?(int)$atts['zo_cols']:1;
            $class_bootstrap = "";
            switch($columns){
              case "1 Column":
               $class_bootstrap = "";
               break;
              case "2 Columns":
               $class_bootstrap = "col-xs-12 col-sm-6 col-md-4 col-lg-6";
               break;
              case "3 Columns":
               $class_bootstrap = "col-xs-12 col-sm-6 col-md-4 col-lg-4";
               break;
              case "4 Columns":
               $class_bootstrap = "col-xs-12 col-sm-6 col-md-4 col-lg-3";
               break;
              case "6 Columns":
               $class_bootstrap = "col-xs-12 col-sm-6 col-md-4 col-lg-2";
               break;

              default:
               $class_bootstrap = "";
               break;
             }
            for($i=1;$i<=$columns;$i++){ ?>
                <?php if($i!=5):?>
                    <?php
                    $title = isset($atts['title'.$i])?$atts['title'.$i]:'';
                    $icon = isset($atts['icon'.$i])?$atts['icon'.$i]:'';
                    $type = isset($atts['type'.$i])?$atts['type'.$i]:'';
                    $suffix = isset($atts['suffix'.$i])?$atts['suffix'.$i]:'';
                    $digit = isset($atts['digit'.$i])?$atts['digit'.$i]:'60';
                    $description = isset($atts['description'.$i])?$atts['description'.$i]:'';
                    $zo_counter_text_color = isset( $atts['zo_counter_text_color'] ) ? $atts['zo_counter_text_color'] : '';
                    $zo_counter_title_color = isset( $atts['zo_counter_title_color'] ) ? $atts['zo_counter_title_color'] : '';
                    $zo_counter_content_color = isset( $atts['zo_counter_content_color'] ) ? $atts['zo_counter_content_color'] : '';
                    $zo_title_size = isset( $atts['zo_title_size'] ) ? $atts['zo_title_size'] : 'h2';
                    ?>
                  <div class="zo-counter-item <?php echo esc_attr($class_bootstrap);?>">
                      <div class="zo-counter-box zo-counter-process" data-percent="<?php echo esc_attr($digit);?>" style="color: <?php echo esc_attr($zo_counter_text_color); ?>;"  data-suffix="<?php echo esc_attr($suffix);?>">
                          <div class="ppc-progress">
                              <div class="ppc-progress-fill"></div>
                          </div>
                          <div class="zo-counter-middle ppc-percents">
                              <div class="pcc-percents-wrapper">
                                  <div class="pcc-percents-inner">
                                      <?php if( $icon ): ?>
                                          <span class="zo-counter-icon"><i class="fa <?php echo esc_attr($icon); ?>"></i></span>
                                      <?php endif; ?>
                                      <div id="counter_<?php echo esc_attr($atts['html_id'].'_item_'.$i);?>" class="zo-process-counter zo-counter-bg-<?php echo do_shortcode($i);?> font-second <?php echo esc_attr(strtolower($type));?>"></div>
                                  </div>
                              </div>
                          </div>
                      </div>
					<?php if($title):?>
                        <<?php echo esc_attr($zo_title_size); ?> class="zo-counter-title" style="color: <?php echo esc_attr($zo_counter_title_color); ?>">
                            <?php echo apply_filters('the_title',$title);?>
                        </<?php echo esc_attr($zo_title_size); ?>>
					<?php endif;?>
                    <div class="zo-counter-detail">
                      <?php if($description) :?>
                      <div class="zo-counter-description font-second font-style-italic font-16" style="color: <?php echo esc_attr($zo_counter_content_color); ?>">
						<?php echo esc_attr($description); ?>
                      </div>
                      <?php endif; ?>
                    </div>
                  </div>
                <?php endif;?>
            <?php }
        ?>
    </div>
</div>