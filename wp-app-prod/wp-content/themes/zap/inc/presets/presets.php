<?php 
function zo_presets_selector_scripts(){

	wp_enqueue_script('zo-jquery-cookie', get_template_directory_uri()  . '/inc/presets/js/jquery_cookie.min.js', array( 'jquery' ), '1.4.0', true);
	wp_localize_script('zo-jquery-cookie', 'ZOPreset', array('theme_url' => get_template_directory_uri()) );
	wp_enqueue_script('zo-presets-script', get_template_directory_uri() . '/inc/presets/js/presets.js', array( 'jquery' ), '1.4.0', true);
	wp_enqueue_style('zo-presets-style', get_template_directory_uri() . '/inc/presets/css/presets.css');
}
add_action( 'wp_enqueue_scripts', 'zo_presets_selector_scripts' );

function zo_presets_selector(){
	global $smof_data;
	
	$presets_color = $smof_data['presets_color'];
	$body_layout = $smof_data['body_layout'];
	if( $body_layout == 1 && !empty($smof_data['bg_body_layout_boxed']) )
		$bg_body_layout_boxed = $smof_data['bg_body_layout_boxed'];
	else
		$bg_body_layout_boxed = '';
	if (isset($_COOKIE['presets_color'])) {
		$presets_color = $_COOKIE['presets_color'];	
	}
	if (isset($_COOKIE['body_layout'])) {
		$body_layout = $_COOKIE['body_layout'];
	}
	if (isset($_COOKIE['bg_body_layout_boxed'])) {
		$bg_body_layout_boxed = $_COOKIE['bg_body_layout_boxed'];
	}
?>
<div id="style_selector">
	<div class="style-toggle close"><i class="fa fa-cog"></i></div>
	<div id="style_selector_container">
        <div class="box-title"><?php esc_html_e('Predefined Color Schemes', 'zap'); ?></div>
        <div class="predefined">
            <a href="javascript:void(0);" class="preset0 <?php echo ($presets_color=='0')?'active':'';?>" id="0"></a>								
            <a href="javascript:void(0);" class="preset1 <?php echo ($presets_color=='1')?'active':'';?>" id="1"></a>								
            <a href="javascript:void(0);" class="preset2 <?php echo ($presets_color=='2')?'active':'';?>" id="2"></a>								
            <a href="javascript:void(0);" class="preset3 <?php echo ($presets_color=='3')?'active':'';?>" id="3"></a>								
            <a href="javascript:void(0);" class="preset4 <?php echo ($presets_color=='4')?'active':'';?>" id="4"></a>								
            <a href="javascript:void(0);" class="preset5 <?php echo ($presets_color=='5')?'active':'';?>" id="5"></a>								
            <a href="javascript:void(0);" class="preset6 <?php echo ($presets_color=='6')?'active':'';?>" id="6"></a>								
            <a href="javascript:void(0);" class="preset7 <?php echo ($presets_color=='7')?'active':'';?>" id="7"></a>								
            <a href="javascript:void(0);" class="preset8 <?php echo ($presets_color=='8')?'active':'';?>" id="8"></a>								
            <a href="javascript:void(0);" class="preset9 <?php echo ($presets_color=='9')?'active':'';?>" id="9"></a>					
            <a href="javascript:void(0);" class="preset10 <?php echo ($presets_color=='10')?'active':'';?>" id="10"></a>					
            <a href="javascript:void(0);" class="preset11 <?php echo ($presets_color=='11')?'active':'';?>" id="11"></a>					
            <a href="javascript:void(0);" class="preset12 <?php echo ($presets_color=='12')?'active':'';?>" id="12"></a>					
            <a href="javascript:void(0);" class="preset13 <?php echo ($presets_color=='13')?'active':'';?>" id="13"></a>					
            <a href="javascript:void(0);" class="preset14 <?php echo ($presets_color=='14')?'active':'';?>" id="14"></a>					
            <a href="javascript:void(0);" class="preset15 <?php echo ($presets_color=='15')?'active':'';?>" id="15"></a>					
            <a href="javascript:void(0);" class="preset16 <?php echo ($presets_color=='16')?'active':'';?>" id="16"></a>					
            <a href="javascript:void(0);" class="preset17 <?php echo ($presets_color=='17')?'active':'';?>" id="17"></a>					
            <a href="javascript:void(0);" class="preset18 <?php echo ($presets_color=='18')?'active':'';?>" id="18"></a>					
        </div>
	    <div class="box-title"><?php esc_html_e('Choose Your Layout Style', 'zap'); ?></div>
	    <div class="input-box">
		    <div class="input">
			    <select name="layout" class="layout">
				    <option value="0" <?php if( $body_layout == 0 ) echo "selected"; ?>><?php esc_html_e('Wide', 'zap'); ?></option>
				    <option  value="1" <?php if( $body_layout == 1 ) echo "selected"; ?>><?php esc_html_e('Boxed', 'zap'); ?></option>
			    </select>
		    </div>
	    </div>
    </div>
</div>
<?php 
}
?>