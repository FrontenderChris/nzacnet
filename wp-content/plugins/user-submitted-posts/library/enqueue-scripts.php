<?php // User Submitted Posts - Enqueue Script & Style

if (!defined('ABSPATH')) die();

function usp_enqueueResources() {
	
	global $usp_options;
	
	$min_images  = isset($usp_options['min-images'])       ? $usp_options['min-images']       : null;
	$include_js  = isset($usp_options['usp_include_js'])   ? $usp_options['usp_include_js']   : null;
	$form_type   = isset($usp_options['usp_form_version']) ? $usp_options['usp_form_version'] : null;
	$display_url = isset($usp_options['usp_display_url'])  ? $usp_options['usp_display_url']  : null;
	$recaptcha   = isset($usp_options['usp_recaptcha'])    ? $usp_options['usp_recaptcha']    : null;
	$multi_cats  = isset($usp_options['multiple-cats'])    ? $usp_options['multiple-cats']    : null;
	
	$protocol = is_ssl() ? 'https://' : 'http://';
	
	$http_host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'undefined';
	
	$request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/na';
	
	$current_url = esc_url_raw($protocol . $http_host . $request_uri);
	
	$current_url = remove_query_arg(array('submission-error', 'error', 'success', 'post_id'), $current_url);
	
	$plugin_url  = plugins_url() .'/'. basename(dirname(dirname(__FILE__)));
	
	$custom_url  = get_stylesheet_directory_uri() .'/usp/usp.css';
	
	$custom_path = get_stylesheet_directory() .'/usp/usp.css';
	
	$usp_css = ($form_type === 'custom' && file_exists($custom_path)) ? $custom_url : $plugin_url . '/resources/usp.css';
	
	$display_js  = false;
	$display_css = false;
	
	if (!empty($display_url)) {
		
		$display_urls = explode(',', $display_url);
		
		foreach ($display_urls as $url) {
			
			$url = esc_url_raw(trim($url));
			
			if ($url === $current_url) {
				
				if ($include_js == true)      $display_js  = true;
				if ($form_type !== 'disable') $display_css = true;
				
				break;
				
			}
			
		}
		
	} else {
		
		if ($include_js == true)      $display_js  = true;
		if ($form_type !== 'disable') $display_css = true;
		
	}
	
	if ($display_css) {
		
		wp_enqueue_style('usp_style', $usp_css, array(), USP_VERSION, 'all');
		
	}
	
	if ($display_js) {
		
		$deps = array();
		
		if ($recaptcha === 'show') {
			
			wp_enqueue_script('usp_recaptcha', 'https://www.google.com/recaptcha/api.js', array(), USP_VERSION);
			
			array_push($deps, 'usp_recaptcha');
			
		}
		
		if ($multi_cats) {
			
			wp_enqueue_script('usp_chosen', $plugin_url .'/resources/jquery.chosen.js', array('jquery'), USP_VERSION);
			
			array_push($deps, 'jquery', 'usp_chosen');
			
		}
		
		array_push($deps, 'jquery', 'usp_cookie', 'usp_parsley');
		
		$deps = array_unique($deps);
		
		wp_enqueue_script('usp_cookie',  $plugin_url .'/resources/jquery.cookie.js',      array('jquery'), USP_VERSION);
		wp_enqueue_script('usp_parsley', $plugin_url .'/resources/jquery.parsley.min.js', array('jquery'), USP_VERSION);
		wp_enqueue_script('usp_core',    $plugin_url .'/resources/jquery.usp.core.js',    $deps,           USP_VERSION);
		
		usp_inline_script();
		
	}
	
}
add_action('wp_enqueue_scripts', 'usp_enqueueResources');

// WP >= 4.5
function usp_inline_script() {
	
	$wp_version = get_bloginfo('version');
	
	if (version_compare($wp_version, '4.5', '>=')) {
		
		global $usp_options;
		
		$min_images      = isset($usp_options['min-images'])           ? $usp_options['min-images']           : '';
		$max_images      = isset($usp_options['max-images'])           ? $usp_options['max-images']           : '';
		$custom_field    = isset($usp_options['custom_name'])          ? $usp_options['custom_name']          : '';
		$custom_checkbox = isset($usp_options['custom_checkbox_name']) ? $usp_options['custom_checkbox_name'] : '';
		$usp_casing      = isset($usp_options['usp_casing'])           ? $usp_options['usp_casing']           : '';
		$usp_response    = isset($usp_options['usp_response'])         ? $usp_options['usp_response']         : '';
		$multiple_cats   = isset($usp_options['multiple-cats'])        ? $usp_options['multiple-cats']        : '';
		
		$print_casing    = $usp_casing ? 'true' : 'false';
		$parsley_error   = apply_filters('usp_parsley_error', esc_html__('Incorrect response.', 'usp'));
		
		$script  = 'var usp_custom_field = '.       json_encode($custom_field)    .'; ';
		$script .= 'var usp_custom_checkbox = '.    json_encode($custom_checkbox) .'; ';
		$script .= 'var usp_case_sensitivity = '.   json_encode($print_casing)    .'; ';
		$script .= 'var usp_challenge_response = '. json_encode($usp_response)    .'; ';
		$script .= 'var usp_min_images = '.         json_encode($min_images)      .'; ';
		$script .= 'var usp_max_images = '.         json_encode($max_images)      .'; ';
		$script .= 'var usp_parsley_error = '.      json_encode($parsley_error)   .'; ';
		$script .= 'var usp_multiple_cats = '.      json_encode($multiple_cats)   .'; ';
		
		wp_add_inline_script('usp_core', $script, 'before');
		
	}
	
}

// WP < 4.5
function usp_print_scripts() { 
	
	$wp_version = get_bloginfo('version');
	
	if (version_compare($wp_version, '4.5', '<')) {
		
		global $usp_options;
		
		$min_images      = isset($usp_options['min-images'])           ? $usp_options['min-images']           : '';
		$max_images      = isset($usp_options['max-images'])           ? $usp_options['max-images']           : '';
		$custom_field    = isset($usp_options['custom_name'])          ? $usp_options['custom_name']          : '';
		$custom_checkbox = isset($usp_options['custom_checkbox_name']) ? $usp_options['custom_checkbox_name'] : '';
		$usp_casing      = isset($usp_options['usp_casing'])           ? $usp_options['usp_casing']           : '';
		$usp_response    = isset($usp_options['usp_response'])         ? $usp_options['usp_response']         : '';
		$multiple_cats   = isset($usp_options['multiple-cats'])        ? $usp_options['multiple-cats']        : '';
		 
		$print_casing    = $usp_casing ? 'true' : 'false';
		$parsley_error   = apply_filters('usp_parsley_error', esc_html__('Incorrect response.', 'usp'));
		
		if (!is_admin()) : ?>
			
			<script type="text/javascript">
				var usp_custom_field = <?php       echo json_encode($custom_field);    ?>; 
				var usp_custom_checkbox = <?php    echo json_encode($custom_checkbox); ?>; 
				var usp_case_sensitivity = <?php   echo json_encode($print_casing);    ?>; 
				var usp_challenge_response = <?php echo json_encode($usp_response);    ?>; 
				var usp_min_images = <?php         echo json_encode($min_images);      ?>; 
				var usp_max_images = <?php         echo json_encode($max_images);      ?>; 
				var usp_parsley_error = <?php      echo json_encode($parsley_error);   ?>; 
				var usp_multiple_cats = <?php      echo json_encode($multiple_cats);   ?>; 
			</script>
			
		<?php endif;
		
	}
	
}
add_action('wp_print_scripts','usp_print_scripts');

function usp_load_admin_styles($hook) {
	
	global $pagenow;
	
	/*
		wp_enqueue_style($handle, $src, $deps, $ver, $media)
		wp_enqueue_script($handle, $src, $deps, $ver, $in_footer)
	*/
	
	$base = plugins_url() .'/'. basename(dirname(dirname(__FILE__)));
	
	if ($hook === 'settings_page_user-submitted-posts/user-submitted-posts') {
		
		wp_enqueue_style('usp_admin_styles', $base .'/resources/usp-admin.css', array(), USP_VERSION, 'all');
		wp_enqueue_script('usp_admin_script', $base .'/resources/jquery.usp.admin.js', array('jquery'), USP_VERSION, false);
		
	}
	
	if ($pagenow === 'edit.php') {
		
		wp_enqueue_style('usp_posts_styles', $base .'/resources/usp-posts.css', array(), USP_VERSION, 'all');
		
	}
	
}
add_action('admin_enqueue_scripts', 'usp_load_admin_styles');