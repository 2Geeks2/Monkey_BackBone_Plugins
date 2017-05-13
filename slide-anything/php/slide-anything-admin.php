<?php
// #####################################################################
// ### SLIDE ANYTHING PLUGIN - PHP FUNCTIONS FOR WORDPRESS DASHBOARD ###
// #####################################################################

// ##### PLUGIN REGISTRATION HOOK - RUN WHEN THE PLUGIN IS ACTIVATED #####
function cpt_slider_plugin_activation() {
	// INSERT A 'SAMPLE SLIDER' CUSTOM POST INTO THE DATABASE
	$sample_post_title = 'Sample Slider';
	
	// check if the 'sample slider' already exists (plugin has been activated before)
	$cpt_post = get_page_by_title($sample_post_title, 'OBJECT', 'sa_slider');
	
	if (is_null($cpt_post)) {
		// create the post object
		$sample_post = array(
			'post_title' => $sample_post_title,
			'post_content'  => '',
			'post_status' => 'publish',
			'post_type' => 'sa_slider'
		);
		// insert the post into the database
		$cpt_id = wp_insert_post($sample_post);
		
		// insert meta data for the 'sample slider' slides
		for ($i = 1; $i <= 8; $i++) {
			if ($i == 1) {
				$color = "#f4cccc"; $image = "sample_logo1.png";
			} elseif ($i == 2) {
				$color = "#d9ead3"; $image = "sample_logo2.png";
			} elseif ($i == 3) {
				$color = "#fce5cd"; $image = "sample_logo3.png";
			} elseif ($i == 4) {
				$color = "#d0e0e3"; $image = "sample_logo4.png";
			} elseif ($i == 5) {
				$color = "#fff2cc"; $image = "sample_logo5.png";
			} elseif ($i == 6) {
				$color = "#cfe2f3"; $image = "sample_logo6.png";
			} elseif ($i == 7) {
				$color = "#d9d2e9"; $image = "sample_logo7.png";
			} elseif ($i == 8) {
				$color = "#ead1dc"; $image = "sample_logo8.png";
			}
			$content =  "<div style='text-align: center; padding-bottom: 10px;'>\n";
			$content .= "<div><img src='".plugins_url()."/slide-anything/images/".$image."' alt='Logo ".$i."' /></div>\n";
			$content .= "<h3>Company Name</h3>\n";
			$content .= "<p>Lorem ipsum dolor sit amet, cu usu cibo vituperata, id ius probo maiestatis inciderint, sit eu vide volutpat.</p>\n";
			$content .= "</div>\n";
			update_post_meta($cpt_id, "sa_slide".$i."_content", $content);
			update_post_meta($cpt_id, "sa_slide".$i."_image_id", "");
			update_post_meta($cpt_id, "sa_slide".$i."_image_pos", "left top");
			update_post_meta($cpt_id, "sa_slide".$i."_image_size", "contain");
			update_post_meta($cpt_id, "sa_slide".$i."_image_repeat", "no-repeat");
			update_post_meta($cpt_id, "sa_slide".$i."_image_color", $color);
		
		}
		// insert meta data for the 'sample slider' configuration
		update_post_meta($cpt_id, 'sa_disable_visual_editor', '0');
		update_post_meta($cpt_id, 'sa_num_slides', 8);
		update_post_meta($cpt_id, 'sa_slide_duration', 4);
		update_post_meta($cpt_id, 'sa_slide_transition', 0.3);
		update_post_meta($cpt_id, 'sa_loop_slider', '1');
		update_post_meta($cpt_id, 'sa_stop_hover', '1');
		update_post_meta($cpt_id, 'sa_nav_arrows', '1');
		update_post_meta($cpt_id, 'sa_pagination', '1');
		update_post_meta($cpt_id, 'sa_shortcodes', '1');
		update_post_meta($cpt_id, 'sa_random_order', '1');
		update_post_meta($cpt_id, 'sa_mouse_drag', '1');
		update_post_meta($cpt_id, 'sa_touch_drag', '1');
		update_post_meta($cpt_id, 'sa_items_width1', 1);
		update_post_meta($cpt_id, 'sa_items_width2', 2);
		update_post_meta($cpt_id, 'sa_items_width3', 3);
		update_post_meta($cpt_id, 'sa_items_width4', 4);
		update_post_meta($cpt_id, 'sa_items_width5', 4);
		update_post_meta($cpt_id, 'sa_items_width6', 4);
		update_post_meta($cpt_id, 'sa_transition', 'fade');
		update_post_meta($cpt_id, 'sa_css_id', 'sample_slider');
		update_post_meta($cpt_id, 'sa_background_color', '#fafafa');
		update_post_meta($cpt_id, 'sa_border_width', 1);
		update_post_meta($cpt_id, 'sa_border_color', '#f0f0f0');
		update_post_meta($cpt_id, 'sa_border_radius', 5);
		update_post_meta($cpt_id, 'sa_wrapper_padd_top', 8);
		update_post_meta($cpt_id, 'sa_wrapper_padd_right', 8);
		update_post_meta($cpt_id, 'sa_wrapper_padd_bottom', 8);
		update_post_meta($cpt_id, 'sa_wrapper_padd_left', 8);
		update_post_meta($cpt_id, 'sa_slide_min_height', 100);
		update_post_meta($cpt_id, 'sa_slide_padding_tb', 5);
		update_post_meta($cpt_id, 'sa_slide_padding_lr', 5);
		update_post_meta($cpt_id, 'sa_autohide_arrows', '1');
	}
}

/* ##### ACTION HOOK - REGISTER SCRIPTS (JS AND CSS) FOR WORDPRESS DASHBOARD ONLY ##### */
function cpt_register_admin_scripts() {
	$screen = get_current_screen();
	if ($screen->post_type == 'sa_slider') {
		// ONLY LOAD SCRIPTS (JS & CSS) WITHIN 'Slide Anything' SCREENS IN WORDPRESS DASHBOARD
		// load 'wordpress jquery-ui' scripts
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'jquery-ui-slider' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-ui-draggable' );
		wp_enqueue_script( 'jquery-ui-droppable' );
		wp_enqueue_script( 'jquery-ui-resize' );
		wp_enqueue_script( 'jquery-ui-dialog' );
		wp_enqueue_script( 'jquery-ui-button' );
		wp_enqueue_script( 'jquery-ui-tooltip' );
		wp_enqueue_script( 'jquery-ui-spinner' );
		// load 'spectrum colorpicker' script and css
		wp_register_script('spectrum_js', SA_PLUGIN_PATH.'spectrum/spectrum.js', array('jquery'));
		wp_enqueue_script('spectrum_js');
		wp_register_style('spectrum_css', SA_PLUGIN_PATH.'spectrum/spectrum.css');
		wp_enqueue_style('spectrum_css');
		// load 'jquery-ui' css
		wp_register_style('admin_ui_css', SA_PLUGIN_PATH.'css/admin-user-interface.min.css');
		wp_enqueue_style('admin_ui_css');
		// load 'slide-anything' custom javasript and css for wordpress admin
		wp_register_script('sa-slider-admin-script', SA_PLUGIN_PATH.'js/slide-anything-admin.js', array( 'jquery' ));
		wp_enqueue_script('sa-slider-admin-script');
		wp_register_style('sa-slider-admin-css', SA_PLUGIN_PATH.'css/slide-anything-admin.css');
		wp_enqueue_style('sa-slider-admin-css');
		// DISABLE AUTOSAVE FOR THIS CUSTOM POST TYPE (causes issues with preview modal popup)
		wp_dequeue_script('autosave');
	}
	// style for TINYMCE editor 'Slide Anything sliders' button
	wp_register_style('tinymce-css', SA_PLUGIN_PATH.'css/tinymce_style.css');
	wp_enqueue_style('tinymce-css');
}

// ##### ACTION HOOK - REGISTER THE 'Slide Anything' CUSTOM POST TYPE #####
function cpt_slider_register() {
	$labels = array(
		'name' => _x('SA Sliders', 'post type general name', 'sa_slider_textdomain'),
		'singular_name' => _x('Slider', 'post type singular name', 'sa_slider_textdomain'),
		'menu_name' => __('SA Sliders', 'sa_slider_textdomain'),
		'add_new' => __('Add New Slider', 'sa_slider_textdomain'),
		'add_new_item' => __('Add New Slider', 'sa_slider_textdomain'),
		'edit_item' => __('Edit Slider', 'sa_slider_textdomain'),
		'new_item' => __('New Slider', 'sa_slider_textdomain'),
		'view_item' => __('View Slider', 'sa_slider_textdomain'),
		'not_found' => __('No sliders found', 'sa_slider_textdomain'),
		'not_found_in_trash' => __('No sliders found in Trash', 'sa_slider_textdomain'),
	);
	$args = array(
		'labels' => $labels,
		'description' => __('Slide Anything carousel/slider', 'sa_slider_textdomain'),
		'public' => false,
		'exclude_from_search' => true,
		'publicly_queryable' => false,
		'show_ui' => true,
		'show_in_nav_menus' => false,
		'show_in_menu' => true,
		'menu_position' => 10,
		'menu_icon' => 'dashicons-images-alt2',
		'hierarchical' => false,
		'supports' => array('title'),
		'has_archive' => false,
		'query_var' => false,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post'
	);
	register_post_type('sa_slider', $args);
}



// ##### WP DASHBOARD - SLIDER LIST PAGE #####
// ACTION HOOK - ADD/REMOVE (HOVER-OVER) ROW ACTIONS WHEN THIS CUSTOM POST TYPE IS LISTED IN DASHBOARD
function cpt_slider_row_actions($actions, $post) {
	if ($post->post_type == 'sa_slider') {
		// REMOVE 'Quick Edit' ROW ACTION
		unset($actions['inline hide-if-no-js']);
	}
	return $actions;
}
// FILTER TO ADD/REMOVE COLUMNS DISPLAYED FOR THIS CUSTOM POST TYPE WITHIN THE DASHBOARD
function cpt_slider_modify_columns($columns) {
	// new columns to be added
	$new_columns = array(
		'slides' => 'Slides',
		'shortcode' => 'Shortcode',
		'css-id' => 'CSS ID'
	);	
	$columns = array_slice($columns, 0, 2, true) + $new_columns + array_slice($columns, 2, NULL, true);
	return $columns;
}
// DEFINE OUTPUT FOR EACH CUSTOM COLUMN DISPLAYED FOR THIS CUSTOM POST TYPE WITHIN THE DASHBOARD
function cpt_slider_custom_column_content($column) {
	// get post object for this row
	global $post;
	
	// output for the 'Slides' column
	if ($column == 'slides') {
		$num_slides = get_post_meta($post->ID, 'sa_num_slides', true);
		if ($num_slides == '') {
			$num_slides = '-';
		}
		echo esc_html($num_slides);
	}
	
	// output for the 'Shortcode' column
	if ($column == 'shortcode') {
		$shortcode = "[slide-anything id='".$post->ID."']";
		echo esc_html($shortcode);
	}
	
	// output for the 'CSS ID' column
	if ($column == 'css-id') {
		$css_id = get_post_meta($post->ID, 'sa_css_id', true);
		if ($css_id == '') {
			$css_id = '-';
		} else {
			$css_id = "#".$css_id;
		}
		echo esc_html($css_id);
	}
}



// ##### ADD A CUSTOM BUTTON TO WORDPRESS TINYMCE EDITOR (ON PAGES AND POSTS ONLY) #####
function add_tinymce_button() {
	global $typenow;
	// check user permissions
	if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
		return;
	}
	// verify the post type - only display button on posts and pages
	if (!in_array($typenow, array('post', 'page'))) {
		return;
	}
	// check if WYSIWYG is enabled
	if (get_user_option('rich_editing') == 'true') {
		add_filter('mce_external_plugins', 'add_tinymce_plugin');
		add_filter('mce_buttons', 'register_tinymce_button');
	}
}
function add_tinymce_plugin($plugin_array) {
	$plugin_array['tinymce_button'] = SA_PLUGIN_PATH.'js/add_tinymce_button.js';
	return $plugin_array;
}
function register_tinymce_button($buttons) {
	array_push($buttons, 'tinymce_button');
	return $buttons;
}
function get_tinymce_shortcode_array() {
	// display 2 javascript arrays (in footer) containing all the slide anything post titles and post ids
	// these 2 arrays are used to display the shortcode options by the TinyMCE button
	echo "<script type='text/javascript'>\n";
	echo "var sa_title_arr = new Array();\n";
	echo "var sa_id_arr = new Array();\n";
	
	$args = array('post_type' => 'sa_slider', 'post_status' => 'publish', 'posts_per_page' => -1);
	$sa_slider_query = new WP_Query($args);
	$count = 0;
	while ($sa_slider_query->have_posts()) : $sa_slider_query->the_post();
		$title = get_the_title();
		echo "sa_title_arr[".$count."] = '".$title."';\n";
		echo "sa_id_arr[".$count."] = '".get_the_ID()."';\n";
		$count++;
	endwhile;
	echo "</script>\n";
}



// ##### ACTION HOOK - ADD META BOXES TO THE 'Slide Anything' CUSTOM POST TYPE #####
function cpt_slider_add_meta_boxes() {
	global $post;
		
	$info_added = get_post_meta($post->ID, 'sa_info_added', true);
	$info_deleted = get_post_meta($post->ID, 'sa_info_deleted', true);
	$info_duplicated = get_post_meta($post->ID, 'sa_info_duplicated', true);
	$info_moved = get_post_meta($post->ID, 'sa_info_moved', true);
	if ($info_added == '1') {
		add_meta_box('cpt_slide_added', __('Information'), 'cpt_slide_added_content', 'sa_slider', 'normal', 'high');
		update_post_meta($post->ID, 'sa_info_added', '0');
	}
	if ($info_deleted == '1') {
		add_meta_box('cpt_slide_deleted', __('Information'), 'cpt_slide_deleted_content', 'sa_slider', 'normal', 'high');
		update_post_meta($post->ID, 'sa_info_deleted', '0');
	}
	if ($info_duplicated == '1') {
		add_meta_box('cpt_slide_duplicated', __('Information'), 'cpt_slide_duplicated_content', 'sa_slider', 'normal', 'high');
		update_post_meta($post->ID, 'sa_info_duplicated', '0');
	}
	if ($info_moved == '1') {
		add_meta_box('cpt_slide_moved', __('Information'), 'cpt_slide_moved_content', 'sa_slider', 'normal', 'high');
		update_post_meta($post->ID, 'sa_info_moved', '0');
	}
	add_meta_box('cpt_slider_settings', __('Slider Settings'), 'cpt_slider_settings_content', 'sa_slider', 'normal', 'high');
	add_meta_box('cpt_slider_slides', __('Slides'), 'cpt_slider_slides_content', 'sa_slider', 'normal', 'high');
	add_meta_box('cpt_slider_shortcode', __('Shortcode / Preview'), 'cpt_slider_shortcode_content', 'sa_slider', 'side', 'high');
	add_meta_box('cpt_slider_items', __('Items Displayed'), 'cpt_slider_items_content', 'sa_slider', 'side', 'default');
	add_meta_box('cpt_slider_style', __('Slider Style'), 'cpt_slider_style_content', 'sa_slider', 'side', 'default');
	remove_meta_box( 'mymetabox_revslider_0', 'sa_slider', 'normal' ); // remove revolution slider meta box
}



// ##### META BOX CONTENT - 'Information' (slide added) BOX #####
function cpt_slide_added_content() {
	echo "<h3 id='sa_slide_added_mess'>A new slide has been added to this slider.</h3>";
}



// ##### META BOX CONTENT - 'Information' (slide deleted) BOX #####
function cpt_slide_deleted_content() {
	echo "<h3 id='sa_slide_deleted_mess'>A slide has been deleted from this slider.</h3>";
}



// ##### META BOX CONTENT - 'Information' (slide duplicated) BOX #####
function cpt_slide_duplicated_content() {
	echo "<h3 id='sa_slide_duplicated_mess'>A slide has been duplicated (copied) within this slider.</h3>";
}



// ##### META BOX CONTENT - 'Information' (slide moved) BOX #####
function cpt_slide_moved_content() {
	echo "<h3 id='sa_slide_moved_mess'>The slide order of this slider has been has changed.</h3>";
}



// ##### META BOX CONTENT - 'Slider Settings' BOX #####
function cpt_slider_settings_content($post) {
	$num_slides = get_post_meta($post->ID, 'sa_num_slides', true);
	
	echo "<div id='sa_slider_settings'>\n";
	// NONCE TO PREVENT CSRF SECURITY ATTACKS
	wp_nonce_field(basename(__FILE__), 'nonce_save_slider');
	
	// HIDDEN FIELD - NUMBER OF SLIDES
	if ($num_slides == '') {
		// new slider is being created
		echo "<input type='hidden' id='num_slides_id' name='sa_num_slides' value='3'/>\n";
	} else {
		// existing slider
		$num_slides = intval($num_slides);
		echo "<input type='hidden' id='num_slides_id' name='sa_num_slides' value='".esc_attr($num_slides)."'/>\n";
	}
	// HIDDEN FIELD - SLIDE ADDED INDICATOR
	echo "<input type='hidden' id='sa_info_added' name='sa_info_added' value='0'/>\n";
	// HIDDEN FIELD - SLIDE DELETED INDICATOR
	echo "<input type='hidden' id='sa_info_deleted' name='sa_info_deleted' value='0'/>\n";
	// HIDDEN FIELD - SLIDE DUPLICATED INDICATOR
	echo "<input type='hidden' id='sa_info_duplicated' name='sa_info_duplicated' value='0'/>\n";
	// HIDDEN FIELD - SLIDE MOVED UP INDICATOR
	echo "<input type='hidden' id='sa_info_moved' name='sa_info_moved' value='0'/>\n";
	// HIDDEN FIELD - DUPLICATE SLIDE NUMBER
	echo "<input type='hidden' id='sa_duplicate_slide' name='sa_duplicate_slide' value='0'/>\n";
	// HIDDEN FIELD - MOVE SLIDE UP (SLIDE NUMBER)
	echo "<input type='hidden' id='sa_move_slide_up' name='sa_move_slide_up' value='0'/>\n";
	// SLIDE DURATION
	$slide_duration = get_post_meta($post->ID, 'sa_slide_duration', true);
	if ($slide_duration == '') {
		$slide_duration = 5;
	}
	echo "<div class='sa_slider_value'><span>Slide Duration:</span>";
	echo "<input type='text' id='sa_slide_duration' name='sa_slide_duration' readonly value='".esc_attr($slide_duration)."'><em>seconds</em>";
	echo "<em class='sa_tooltip' href='' title='Set to 0 to disable slider autoplay (manual slider navigation only)'></em></div>\n";
	echo "<div class='jquery_ui_slider' id='jq_slider_duration'></div><hr/>\n";
	// SLIDE TRANSITION
	$slide_transition = get_post_meta($post->ID, 'sa_slide_transition', true);
	if ($slide_transition == '') {
		$slide_transition = 0.2;
	}
	echo "<div class='sa_slider_value'><span>Slide Transition:</span>";
	echo "<input type='text' id='sa_slide_transition' name='sa_slide_transition' readonly value='".esc_attr($slide_transition)."'><em>seconds</em>\n";
	echo "<em class='sa_tooltip' href='' title='The time it takes to change from one slide to the next slide'></em></div>\n";
	echo "<div class='jquery_ui_slider' id='jq_slider_transition'></div><hr/>\n";
	echo "<div class='half_width_column'>\n";
	// LOOP SLIDER
	$loop_slider = get_post_meta($post->ID, 'sa_loop_slider', true);
	if ($loop_slider == '') {
		$loop_slider = '1';
	}
	echo "<div class='sa_setting_checkbox'><span>Loop Slider:</span>";
	if ($loop_slider == '1') {
		echo "<input type='checkbox' id='sa_loop_slider' name='sa_loop_slider' value='1' checked/>";
	} else {
		echo "<input type='checkbox' id='sa_loop_slider' name='sa_loop_slider' value='1'/>";
	}
	echo "<em class='sa_tooltip' href='' title='Only applies when slide duration is NOT zero (loops back to first slide after last slide is displayed)'></em>";
	echo "</div>\n";
	// STOP ON HOVER
	$stop_hover = get_post_meta($post->ID, 'sa_stop_hover', true);
	if ($stop_hover == '') {
		$stop_hover = '1';
	}
	echo "<div class='sa_setting_checkbox'><span>Stop on Hover:</span>";
	if ($stop_hover == '1') {
		echo "<input type='checkbox' id='sa_stop_hover' name='sa_stop_hover' value='1' checked/>";
	} else {
		echo "<input type='checkbox' id='sa_stop_hover' name='sa_stop_hover' value='1'/>";
	}
	echo "<em class='sa_tooltip' href='' title='Only applies when slide duration is NOT zero (slideshow is paused when hovering over a slide)'></em>";
	echo "</div>\n";
	// RANDOM ORDER
	$random_order = get_post_meta($post->ID, 'sa_random_order', true);
	if ($random_order == '') {
		$random_order = '0';
	}
	echo "<div class='sa_setting_checkbox'><span>Random Order:</span>";
	if ($random_order == '1') {
		echo "<input type='checkbox' id='sa_random_order' name='sa_random_order' value='1' checked/>";
	} else {
		echo "<input type='checkbox' id='sa_random_order' name='sa_random_order' value='1'/>";
	}
	echo "<em class='sa_tooltip' title='When checked slides will be randomly re-ordered whenever the slider is displayed'></em>";
	echo "</div>\n";
	// ALLOW SHORTCODES
	$shortcodes = get_post_meta($post->ID, 'sa_shortcodes', true);
	if ($shortcodes == '') {
		$shortcodes = '1';
	}
	echo "<div class='sa_setting_checkbox'><span>Allow Shortcodes:</span>";
	if ($shortcodes == '1') {
		echo "<input type='checkbox' id='sa_shortcodes' name='sa_shortcodes' value='1' checked/>";
	} else {
		echo "<input type='checkbox' id='sa_shortcodes' name='sa_shortcodes' value='1'/>";
	}
	echo "<em class='sa_tooltip' href='' title='NOTE: Running shortcodes in Slide Anything may cause issues with some Wordpress Page Builders'></em>\n";
	echo "</div>\n";
	echo "</div>\n";
	echo "<div class='half_width_column'>\n";
	// NAVIGATE ARROWS
	$nav_arrows = get_post_meta($post->ID, 'sa_nav_arrows', true);
	if ($nav_arrows == '') {
		$nav_arrows = '1';
	}
	echo "<div class='sa_setting_checkbox'><span>Navigate Arrows:</span>";
	if ($nav_arrows == '1') {
		echo "<input type='checkbox' id='sa_nav_arrows' name='sa_nav_arrows' value='1' checked/>";
	} else {
		echo "<input type='checkbox' id='sa_nav_arrows' name='sa_nav_arrows' value='1'/>";
	}
	echo "<em class='sa_tooltip' href='' title='Display the \"next slide\" amd \"previous slide\" buttons'></em>\n";
	echo "</div>\n";
	// SHOW PAGINATION
	$pagination = get_post_meta($post->ID, 'sa_pagination', true);
	if ($pagination == '') {
		$pagination = '1';
	}
	echo "<div class='sa_setting_checkbox'><span>Show Pagination:</span>";
	if ($pagination == '1') {
		echo "<input type='checkbox' id='sa_pagination' name='sa_pagination' value='1' checked/>";
	} else {
		echo "<input type='checkbox' id='sa_pagination' name='sa_pagination' value='1'/>";
	}
	echo "<em class='sa_tooltip' href='' title='Display slider pagination below the slider'></em>\n";
	echo "</div>\n";
	
	// MOUSE DRAG
	$mouse_drag = get_post_meta($post->ID, 'sa_mouse_drag', true);
	if ($mouse_drag == '') {
		$mouse_drag = '1';
	}
	echo "<div class='sa_setting_checkbox'><span>Mouse Drag:</span>";
	if ($mouse_drag == '1') {
		echo "<input type='checkbox' id='sa_mouse_drag' name='sa_mouse_drag' value='1' checked/>";
	} else {
		echo "<input type='checkbox' id='sa_mouse_drag' name='sa_mouse_drag' value='1'/>";
	}
	echo "<em class='sa_tooltip' href='' title='Allow navigation to previous/next slides by holding down left mouse button and dragging left/right'></em>\n";
	echo "</div>\n";
	// TOUCH DRAG
	$touch_drag = get_post_meta($post->ID, 'sa_touch_drag', true);
	if ($touch_drag == '') {
		$touch_drag = '1';
	}
	echo "<div class='sa_setting_checkbox'><span>Touch Drag:</span>";
	if ($touch_drag == '1') {
		echo "<input type='checkbox' id='sa_touch_drag' name='sa_touch_drag' value='1' checked/>";
	} else {
		echo "<input type='checkbox' id='sa_touch_drag' name='sa_touch_drag' value='1'/>";
	}
	echo "<em class='sa_tooltip' href='' title='Allow navigation to previous/next slides on mobile devices by touching screen and dragging left/right'></em>\n";
	echo "</div>\n";
	echo "</div>\n";
	echo "<div style='clear:both; float:none; width:100%; height:1px;'></div>\n";
	echo "</div>\n";
}



// ##### META BOX CONTENT - 'Slides' BOX #####
function cpt_slider_slides_content($post) {
	$num_slides = get_post_meta($post->ID, 'sa_num_slides', true);
	// DISABLE VISUAL EDITOR CHECKBOX
	$disable_visual_editor = get_post_meta($post->ID, 'sa_disable_visual_editor', true);
	if ($disable_visual_editor == '') {
		$disable_visual_editor = '0';
	}
	echo "<div id='sa_visual_editor_checkbox'><span>Disable Visual Editor:</span>";
	if ($disable_visual_editor == '1') {
		echo "<input type='checkbox' id='sa_disable_visual_editor' name='sa_disable_visual_editor' value='1' checked/></div>\n";
	} else {
		echo "<input type='checkbox' id='sa_disable_visual_editor' name='sa_disable_visual_editor' value='1'/></div>\n";
	}
	// SLIDER EDITOR BOX SETTINGS
	if ($disable_visual_editor == '1') {
		$editor_args = array('tinymce' => false, 'wpautop' => false, 'media_buttons' => true, 'editor_class' => 'sa_slide_content', 'editor_height' => '250');
	} else {
		$editor_args = array('tinymce' => true, 'wpautop' => false, 'media_buttons' => true, 'editor_class' => 'sa_slide_content', 'editor_height' => '250');
	}
	if ($num_slides == '') {
		// A NEW SLIDER IS BEING CREATED - ADD 3 INITIAL SLIDES
		$num_slides = 3;
		$slide_data[0]['edit_id'] = "sa_slide1_content";
		$slide_data[0]['content'] = "Slide content";
		$slide_data[0]['del_id'] = "sa_slide1_delete";
		$slide_data[0]['image_id'] = "sa_slide1_image_id";
		$slide_data[0]['thumb'] = "slide1_thumb";
		$slide_data[0]['image_del'] = "slide1_image_del";
		$slide_data[0]['image_pos'] = "sa_slide1_image_pos";
		$slide_data[0]['image_size'] = "sa_slide1_image_size";
		$slide_data[0]['image_repeat'] = "sa_slide1_image_repeat";
		$slide_data[0]['image_color'] = "sa_slide1_image_color";
		$slide_data[0]['slide_no'] = 1;
		$slide_data[1]['edit_id'] = "sa_slide2_content";
		$slide_data[1]['content'] = "Slide content";
		$slide_data[1]['del_id'] = "sa_slide2_delete";
		$slide_data[1]['image_id'] = "sa_slide2_image_id";
		$slide_data[1]['thumb'] = "slide2_thumb";
		$slide_data[1]['image_del'] = "slide2_image_del";
		$slide_data[1]['image_pos'] = "sa_slide2_image_pos";
		$slide_data[1]['image_size'] = "sa_slide2_image_size";
		$slide_data[1]['image_repeat'] = "sa_slide2_image_repeat";
		$slide_data[1]['image_color'] = "sa_slide2_image_color";
		$slide_data[1]['slide_no'] = 2;
		$slide_data[2]['edit_id'] = "sa_slide3_content";
		$slide_data[2]['content'] = "Slide content";
		$slide_data[2]['del_id'] = "sa_slide3_delete";
		$slide_data[2]['image_id'] = "sa_slide3_image_id";
		$slide_data[2]['thumb'] = "slide3_thumb";
		$slide_data[2]['image_del'] = "slide3_image_del";
		$slide_data[2]['image_pos'] = "sa_slide3_image_pos";
		$slide_data[2]['image_size'] = "sa_slide3_image_size";
		$slide_data[2]['image_repeat'] = "sa_slide3_image_repeat";
		$slide_data[2]['image_color'] = "sa_slide3_image_color";
		$slide_data[2]['slide_no'] = 3;	
	} else {
		// AN EXISTING SLIDER - GET SLIDE DATA FROM THE DATABASE AND SAVE WITHIN AN ARRAY
		$num_slides = intval($num_slides);
		$slide_data = array();
		$count = 0;
		for ($i = 1; $i <= $num_slides; $i++) {
			$slide_edit_id = "sa_slide".$i."_content";
			$slide_char_count = "sa_slide".$i."_char_count";
			$slide_data[$count]['edit_id'] = $slide_edit_id;
			$slide_data[$count]['content'] = get_post_meta($post->ID, $slide_edit_id, true);
			$slide_data[$count]['char_count'] = get_post_meta($post->ID, $slide_char_count, true);
			$slide_data[$count]['del_id'] = "sa_slide".$i."_delete";
			$slide_data[$count]['image_id'] = "sa_slide".$i."_image_id";
			$slide_data[$count]['thumb'] = "slide".$i."_thumb";
			$slide_data[$count]['image_del'] = "slide".$i."_image_del";
			$slide_data[$count]['image_pos'] = "sa_slide".$i."_image_pos";
			$slide_data[$count]['image_size'] = "sa_slide".$i."_image_size";
			$slide_data[$count]['image_repeat'] = "sa_slide".$i."_image_repeat";
			$slide_data[$count]['image_color'] = "sa_slide".$i."_image_color";
			$slide_data[$count]['slide_no'] = $i;
			$count++;
		}
	}
	
	// ###### LOOP TO DISPLAY INPUT ELEMENTS FOR EACH SLIDE ######
	echo "<div id='slider_accordion'>\n";
	for ($i = 0; $i < count($slide_data); $i++) {
		echo "<h3>Slide ".$slide_data[$i]['slide_no']."</h3>\n";
		echo "<div>\n";
		
		// ### DISPLAY THE SLIDE CONTENT EDITOR (textarea field) ###
		//wp_editor($slide_data[$i]['content'], wp_kses_post($slide_data[$i]['edit_id']), $editor_args);
		wp_editor($slide_data[$i]['content'], $slide_data[$i]['edit_id'], $editor_args);
		
		// ### BACKGROUND COLOR/IMAGE FIELDS ###
		// GET BACKGROUND IMAGE DATA FOR THIS SLIDE (image id, position, size, repeat and color)
		$slide_image_id = get_post_meta($post->ID, $slide_data[$i]['image_id'], true);
		$slide_image_pos = get_post_meta($post->ID, $slide_data[$i]['image_pos'], true);
		if ($slide_image_pos == '') {
			$slide_image_pos = 'left top';
		}
		$slide_image_size = get_post_meta($post->ID, $slide_data[$i]['image_size'], true);
		if ($slide_image_size == '') {
			$slide_image_size = 'contain';
		}
		$slide_image_repeat = get_post_meta($post->ID, $slide_data[$i]['image_repeat'], true);
		if ($slide_image_repeat == '') {
			$slide_image_repeat = 'no-repeat';
		}
		$slide_image_color = get_post_meta($post->ID, $slide_data[$i]['image_color'], true);
		if ($slide_image_color == '') {
			$slide_image_color = "rgba(0,0,0,0)";
		}
		
		// SLIDE BACKGROUND IMAGE - THUMBNAIL AND 'SET IMAGE' BUTTON
		// get wordpress media upload frame url
		$upload_frame_url = esc_url(get_upload_iframe_src('image', $post->ID)."&slide=".$slide_data[$i]['slide_no']);
		// Get image src for slide background image
		$slide_image_src = wp_get_attachment_image_src($slide_image_id, 'full');
		// check if the slide background image id already exists
		$image_exists = is_array($slide_image_src);
		// slide backround image - thumbnail (and delete button)
		echo "<div class='sa_slide_bg_wrapper'>\n";
		echo "<h4>Slide Background</h4>\n";
		echo "<div id='".$slide_data[$i]['thumb']."' class='sa_slide_thumb'>\n";
		if ($image_exists) {
			echo "<div style='background-image:url(\"".esc_attr($slide_image_src[0])."\"); background-size:".esc_attr($slide_image_size)."; ";
			echo "background-repeat:".esc_attr($slide_image_repeat)."; background-color:".esc_attr($slide_image_color)."; ";
			echo "background-position:".esc_attr($slide_image_pos).";'></div>\n";
			echo "<span id='".esc_attr($slide_data[$i]['image_del'])."' onClick='remove_slide_bg_image(\"".esc_attr($slide_data[$i]['slide_no'])."\");' title='Delete the background image for this slide'>X</span>\n";
			echo "</div>\n";
		} else {
			echo "<div style='background-color:#ffffff; background-size:".esc_attr($slide_image_size)."; ";
			echo "background-repeat:".esc_attr($slide_image_repeat)."; background-color:".esc_attr($slide_image_color)."; ";
			echo "background-position:".esc_attr($slide_image_pos).";'></div>\n";
			echo "<span id='".esc_attr($slide_data[$i]['image_del'])."' class='sa_hidden' onClick='remove_slide_bg_image(\"".esc_attr($slide_data[$i]['slide_no'])."\");' title='Delete the background image for this slide'>X</span>\n";
			echo "</div>\n";
		}
		// slide background image - 'set image' button
		echo "<a class='button button-secondary slide_image_add' href='".esc_attr($upload_frame_url)."' title='Set the background image for this slide'>Set Image</a>\n";
		// slide background image - image id text field
		echo "<input type='hidden' id='".esc_attr($slide_data[$i]['image_id'])."' name='".esc_attr($slide_data[$i]['image_id'])."' value='".esc_attr($slide_image_id)."'/>\n";
		
		// SLIDE BACKGROUND IMAGE - BACKGROUND POSITION (dropdown box)
		echo "<div class='slide_image_settings_line'>";
		echo "<span>Background Position:</span>";
		$option_arr = array();
		$option_arr[0]['desc'] = 'Top Left'; $option_arr[0]['value'] = 'left top';
		$option_arr[1]['desc'] = 'Top Center'; $option_arr[1]['value'] = 'center top';
		$option_arr[2]['desc'] = 'Top Right'; $option_arr[2]['value'] = 'right top';
		$option_arr[3]['desc'] = 'Center Left'; $option_arr[3]['value'] = 'left center';
		$option_arr[4]['desc'] = 'Center'; $option_arr[4]['value'] = 'center center';
		$option_arr[5]['desc'] = 'Center Right'; $option_arr[5]['value'] = 'right center';
		$option_arr[6]['desc'] = 'Bottom Left'; $option_arr[6]['value'] = 'left bottom';
		$option_arr[7]['desc'] = 'Bottom Center'; $option_arr[7]['value'] = 'center bottom';
		$option_arr[8]['desc'] = 'Bottom Right'; $option_arr[8]['value'] = 'right bottom';
		echo "<select id='".esc_attr($slide_data[$i]['image_pos'])."' name='".esc_attr($slide_data[$i]['image_pos'])."' onChange='change_slide_image_pos(".esc_attr($slide_data[$i]['slide_no']).");'>";
		for ($j = 0; $j < count($option_arr); $j++) {
			if ($slide_image_pos == $option_arr[$j]['value']) {
				echo "<option value='".esc_attr($option_arr[$j]['value'])."' selected>".esc_html($option_arr[$j]['desc'])."</option>";
			} else {
				echo "<option value='".esc_attr($option_arr[$j]['value'])."'>".esc_html($option_arr[$j]['desc'])."</option>";
			}
		}
		echo "</select>";
		echo "</div>\n";
		
		// SLIDE BACKGROUND IMAGE - BACKGROUND SIZE (dropdown box)
		echo "<div class='slide_image_settings_line'>";
		echo "<span>Background Size:</span>";
		$option_arr = array();
		$option_arr[0]['value'] = 'auto'; $option_arr[0]['desc'] = 'no resize';
		$option_arr[1]['value'] = 'contain'; $option_arr[1]['desc'] = 'contain';
		$option_arr[2]['value'] = 'cover'; $option_arr[2]['desc'] = 'cover';
		$option_arr[3]['value'] = '100% 100%'; $option_arr[3]['desc'] = '100%';
		$option_arr[4]['value'] = '100% auto'; $option_arr[4]['desc'] = '100% width';
		$option_arr[5]['value'] = 'auto 100%'; $option_arr[5]['desc'] = '100% height';
		echo "<select id='".esc_attr($slide_data[$i]['image_size'])."' name='".esc_attr($slide_data[$i]['image_size'])."' onChange='change_slide_image_size(".esc_attr($slide_data[$i]['slide_no']).");'>";
		for ($j = 0; $j < count($option_arr); $j++) {
			if ($slide_image_size == $option_arr[$j]['value']) {
				echo "<option value='".esc_attr($option_arr[$j]['value'])."' selected>".esc_html($option_arr[$j]['desc'])."</option>";
			} else {
				echo "<option value='".esc_attr($option_arr[$j]['value'])."'>".esc_html($option_arr[$j]['desc'])."</option>";
			}
		}
		echo "</select>";
		echo "</div>\n";

		// SLIDER BACKGROUND IMAGE - BACKGROUND REPEAT (dropdown box)
		echo "<div class='slide_image_settings_line'>";
		echo "<span>Background Repeat:</span>";
		$option_arr = array();
		$option_arr[0] = 'no-repeat';
		$option_arr[1] = 'repeat';
		$option_arr[2] = 'repeat-x';
		$option_arr[3] = 'repeat-y';
		echo "<select id='".esc_attr($slide_data[$i]['image_repeat'])."' name='".esc_attr($slide_data[$i]['image_repeat'])."' ";
		echo "onChange='change_slide_image_repeat(".esc_attr($slide_data[$i]['slide_no']).");'>";
		for ($j = 0; $j < count($option_arr); $j++) {
			if ($slide_image_repeat == $option_arr[$j]) {
				echo "<option value='".esc_attr($option_arr[$j])."' selected>".esc_html($option_arr[$j])."</option>";
			} else {
				echo "<option value='".esc_attr($option_arr[$j])."'>".esc_html($option_arr[$j])."</option>";
			}
		}
		echo "</select>";		
		echo "</div>\n";
		
		// SLIDER BACKGROUND IMAGE - BACKGROUND COLOR (color picker)
		echo "<div class='slide_image_settings_line'>";
		echo "<span>Background Color:</span>";
		echo "<input type='text' id='".esc_attr($slide_data[$i]['image_color'])."' name='".esc_attr($slide_data[$i]['image_color'])."' value='".esc_attr($slide_image_color)."' ";
		echo "onChange='change_slide_image_color(".esc_attr($slide_data[$i]['slide_no']).");'>";
		echo "</div>\n";
				
		echo "<div style='clear:both; float:none; width:100%; height:1px;'></div>\n";
		echo "</div>\n";

		// 3. DELETE STATUS FIELD (hidden) AND DELETE SLIDE BUTTON
		echo "<input type='hidden' id='".esc_attr($slide_data[$i]['del_id'])."' name='".esc_attr($slide_data[$i]['del_id'])."' value='1'/>\n";
		echo "<div class='button button-secondary' onClick='delete_sa_slide(\"".esc_attr($slide_data[$i]['del_id'])."\");' title='Delete this slide'>Delete Slide</div>\n";
		
		// 4. DUPLICATE SLIDE BUTTON
		echo "<div class='button button-secondary' onClick='duplicate_slide(\"".esc_attr($slide_data[$i]['slide_no'])."\");' title='Duplicate this slide'>Duplicate Slide</div>\n";
		
		// 5. MOVE SLIDE UP BUTTON
		if ($slide_data[$i]['slide_no'] != 1) {
			echo "<div class='button button-secondary' onClick='move_slide_up(\"".esc_attr($slide_data[$i]['slide_no'])."\");' title='Move this slide up within the slide order'>Move Slide Up</div>\n";
		}
		
		echo "</div>\n";
	}
	echo "</div>\n";
		
	// ADD SLIDE BUTTON
	if ($num_slides < 50) {
		// a maximum of 50 slides allowed
		echo "<div id='sa_add_slide' class='button button-primary button-large' title='Add a new slide'>Add Slide</div>\n";
	}
	
	// JQUERY-UI DIALOG BOX DIV - FOR CONFIRMATION DIALOG BOXES
	echo "<div id='sa_dialog_box'></div>\n";
}



// ##### META BOX CONTENT - 'Slider Preview/Shortcode' BOX #####
function cpt_slider_shortcode_content($post) {
	$shortcode = "[slide-anything id='".$post->ID."']";
	echo "<div id='sa_slider_shortcode'>".esc_html($shortcode)."</div>\n";
		
	$metadata = get_metadata('post', $post->ID);
	if (count($metadata) != 0) {
		// PREVIEW SLIDER BUTTON
		echo "<div id='sa_preview_slider' class='button button-secondary button-large' title='Preview the current saved version of this slider' ";
		echo "onClick='preview_slider();'>Preview</div>\n";
		
		// JQUERY-UI DIALOG BOX DIV - FOR PREVIEW POPUP BOX
		$shortcode = "[slide-anything id='".$post->ID."']";
		echo "<div id='sa_preview_box'>".do_shortcode($shortcode);
		echo "<div id='sa_preview_note'><strong>NOTE:</strong> The typography and fonts of this preview may differ from what you see on the front-end website.";
		echo "<br/>Each WordPress Theme defines its own style for fonts and typography which may differ from what you see within the WordPress Dashboard.</div></div>\n";
	}
	echo "<div id='sa_shortcode_copy' class='button button-secondary'>Copy to Clipboard</div>\n";
	echo "<div style='clear:both; width:100%; height:1px;'></div>\n";
}



// ##### META BOX CONTENT - 'Items Displayed' BOX #####
function cpt_slider_items_content($post) {
	$items_width1 = intval(get_post_meta($post->ID, 'sa_items_width1', true));
	$items_width2 = intval(get_post_meta($post->ID, 'sa_items_width2', true));
	$items_width3 = intval(get_post_meta($post->ID, 'sa_items_width3', true));
	$items_width4 = intval(get_post_meta($post->ID, 'sa_items_width4', true));
	$items_width5 = intval(get_post_meta($post->ID, 'sa_items_width5', true));
	$items_width6 = intval(get_post_meta($post->ID, 'sa_items_width6', true));
	if ($items_width1 == 0) { $items_width1 = 1; }
	if ($items_width2 == 0) { $items_width2 = 1; }
	if ($items_width3 == 0) { $items_width3 = 1; }
	if ($items_width4 == 0) { $items_width4 = 1; }
	if ($items_width5 == 0) { $items_width5 = 1; }
	if ($items_width6 == 0) { $items_width6 = $items_width5; }
	
	echo "<div id='items_displayed_metabox'>\n";
	echo "<h4>Browser/Device Width:</h4>\n";
	// items for browser width category 1
	echo "<div><em class='sa_tooltip' href='' title='Up to 479 pixels'></em><span>Mobile Portrait</span><select name='sa_items_width1'>";
	for ($i = 1; $i <= 12; $i++) {
		if ($i == $items_width1) {
			echo "<option value='".esc_attr($i)."' selected>".esc_html($i)."</option>";
		} else {
			echo "<option value='".esc_attr($i)."'>".esc_html($i)."</option>";
		}
	}
	echo "</select></div>\n";
	// items for browser width category 2
	echo "<div><em class='sa_tooltip' href='' title='480 to 767 pixels'></em><span>Mobile Landscape</span><select name='sa_items_width2'>";
	for ($i = 1; $i <= 12; $i++) {
		if ($i == $items_width2) {
			echo "<option value='".esc_attr($i)."' selected>".esc_html($i)."</option>";
		} else {
			echo "<option value='".esc_attr($i)."'>".esc_html($i)."</option>";
		}
	}
	echo "</select></div>\n";
	// items for browser width category 3
	echo "<div><em class='sa_tooltip' href='' title='768 to 979 pixels'></em><span>Tablet Portrait</span><select name='sa_items_width3'>";
	for ($i = 1; $i <= 12; $i++) {
		if ($i == $items_width3) {
			echo "<option value='".esc_attr($i)."' selected>".esc_html($i)."</option>";
		} else {
			echo "<option value='".esc_attr($i)."'>".esc_html($i)."</option>";
		}
	}
	echo "</select></div>\n";
	// items for browser width category 4
	echo "<div><em class='sa_tooltip' href='' title='980 to 1199 pixels'></em><span>Desktop Small</span><select name='sa_items_width4'>";
	for ($i = 1; $i <= 12; $i++) {
		if ($i == $items_width4) {
			echo "<option value='".esc_attr($i)."' selected>".esc_html($i)."</option>";
		} else {
			echo "<option value='".esc_attr($i)."'>".esc_html($i)."</option>";
		}
	}
	echo "</select></div>\n";
	// items for browser width category 5
	echo "<div><em class='sa_tooltip' href='' title='1200 to 1399 pixels'></em><span>Desktop Large</span><select name='sa_items_width5'>";
	for ($i = 1; $i <= 12; $i++) {
		if ($i == $items_width5) {
			echo "<option value='".esc_attr($i)."' selected>".esc_html($i)."</option>";
		} else {
			echo "<option value='".esc_attr($i)."'>".esc_html($i)."</option>";
		}
	}
	echo "</select></div>\n";
	// items for browser width category 6
	echo "<div><em class='sa_tooltip' href='' title='Over 1400 pixels'></em><span>Desktop X-Large</span><select name='sa_items_width6'>";
	for ($i = 1; $i <= 12; $i++) {
		if ($i == $items_width6) {
			echo "<option value='".esc_attr($i)."' selected>".esc_html($i)."</option>";
		} else {
			echo "<option value='".esc_attr($i)."'>".esc_html($i)."</option>";
		}
	}
	echo "</select></div>\n";
	// slide transition effect
	$transition = get_post_meta($post->ID, 'sa_transition', true);
	if ($transition == '') {
		$transition = 'fade';
	}
	$option_arr = array();
	$option_arr[0] = 'slide';
	$option_arr[1] = 'fade';
	$option_arr[2] = 'backSlide';
	$option_arr[3] = 'goDown';
	$option_arr[4] = 'fadeUp';
	echo "<div><em class='sa_tooltip' href='' title='NOTE: Slide transitions only work when the above items displayed are ALL SET TO 1'></em>";
	echo "<span style='color:firebrick !important;'>Slide Transition</span><select style='max-width:100px !important;' name='sa_transition'>";
	for ($i = 0; $i < count($option_arr); $i++) {
		if ($transition == $option_arr[$i]) {
			echo "<option value='".esc_attr($option_arr[$i])."' selected>".esc_html($option_arr[$i])."</option>";
		} else {
			echo "<option value='".esc_attr($option_arr[$i])."'>".esc_html($option_arr[$i])."</option>";
		}
	}
	echo "</select></div>\n";
	
	echo "</div>\n";
}



// ##### META BOX CONTENT - 'Slider Style' BOX #####
function cpt_slider_style_content($post) {
	// CSS ID
	$css_id = get_post_meta($post->ID, 'sa_css_id', true);
	if ($css_id == '') {
		$css_id = "slider_".$post->ID;
	}
	echo "<div id='slider_style_metabox'>\n";
	echo "<h4>CSS <span>#id</span> for Slider:</h4>\n";
	echo "<input type='text' id='sa_css_id' name='sa_css_id' value='".esc_attr($css_id)."'/>\n";
	echo "<div id='css_note_text'>To style slides use CSS selector:</div>";
	echo "<div id='css_note_value'>#".esc_html($css_id)." .owl-item</div>";
	echo "<div class='ca_style_hr'></div>\n";
	
	// SLIDER PADDING (TOP, RIGHT, BOTTOM, LEFT)
	$wrapper_padd_top = get_post_meta($post->ID, 'sa_wrapper_padd_top', true);
	if ($wrapper_padd_top == '') { $wrapper_padd_top = '0'; }
	$wrapper_padd_right = get_post_meta($post->ID, 'sa_wrapper_padd_right', true);
	if ($wrapper_padd_right == '') { $wrapper_padd_right = '0'; }
	$wrapper_padd_bottom = get_post_meta($post->ID, 'sa_wrapper_padd_bottom', true);
	if ($wrapper_padd_bottom == '') { $wrapper_padd_bottom = '0'; }
	$wrapper_padd_left = get_post_meta($post->ID, 'sa_wrapper_padd_left', true);
	if ($wrapper_padd_left == '') { $wrapper_padd_left = '0'; }
	$tooltip = "Padding space around the entire carousel/slider";
	echo "<h4>Padding <span>(pixels)</span>:<em class='sa_tooltip' title='".esc_attr($tooltip)."'></em></h4>";
	echo "<div class='ca_style_padding'>";
	echo "<div id='padd_top'>";
	echo "<input type='text' id='sa_wrapper_padd_top' name='sa_wrapper_padd_top' value='".esc_attr($wrapper_padd_top)."'></div>";
	echo "<div id='padd_right'>";
	echo "<input type='text' id='sa_wrapper_padd_right' name='sa_wrapper_padd_right' value='".esc_attr($wrapper_padd_right)."'></div>";
	echo "<div type='text' id='padd_bottom'>";
	echo "<input type='text' id='sa_wrapper_padd_bottom' name='sa_wrapper_padd_bottom' value='".esc_attr($wrapper_padd_bottom)."'></div>";
	echo "<div id='padd_left'>";
	echo "<input type='text' id='sa_wrapper_padd_left' name='sa_wrapper_padd_left' value='".esc_attr($wrapper_padd_left)."'></div>";
	echo "</div>\n";
	echo "<div style='clear:both; float:none; width:100%; height:10px;'></div>";
	
	$tooltip = "Style settings for the slider navigation arrows and slider pagination";
	echo "<h4>Slider Navigation:<em class='sa_tooltip' title='".esc_attr($tooltip)."'></em></h4>";
	
	// AUTOHIDE ARROWS
	$autohide_arrows = get_post_meta($post->ID, 'sa_autohide_arrows', true);
	if ($autohide_arrows == '') {
		$autohide_arrows = '1';
	}
	echo "<div class='ca_style_setting_line'><span>Autohide Arrows</span>";
	if ($autohide_arrows == '1') {
		echo "<input type='checkbox' id='sa_autohide_arrows' name='sa_autohide_arrows' value='1' checked/>";
	} else {
		echo "<input type='checkbox' id='sa_autohide_arrows' name='sa_autohide_arrows' value='1'/>";
	}
	echo "</div>\n";

	$tooltip = "The background color and border around the entire carousel/slider";
	echo "<h4>Background/Border:<em class='sa_tooltip' title='".esc_attr($tooltip)."'></em></h4>";
	
	// SLIDER BACKGROUND COLOR
	$background_color = get_post_meta($post->ID, 'sa_background_color', true);
	if ($background_color == '') {
		$background_color = 'rgba(0,0,0,0)';
	}
	echo "<div class='ca_style_setting_line'><span>Background:</span>";
	echo "<input type='text' id='sa_background_color' name='sa_background_color' value='".esc_attr($background_color)."'></div>\n";
	
	// SLIDER BORDER (WIDTH & COLOR)
	$border_width = get_post_meta($post->ID, 'sa_border_width', true);
	if ($border_width == '') {
		$border_width = '0';
	}
	$border_color = get_post_meta($post->ID, 'sa_border_color', true);
	if ($border_color == '') {
		$border_color = 'rgba(0,0,0,0)';
	}
	echo "<div class='ca_style_setting_line'><span>Border Style:</span>";
	echo "<input type='text' id='sa_border_width' name='sa_border_width' value='".esc_attr($border_width)."'><em>px</em>";
	echo "<input type='text' id='sa_border_color' name='sa_border_color' value='".esc_attr($border_color)."'></div>\n";
	
	// SLIDER BORDER RADIUS
	$border_radius = get_post_meta($post->ID, 'sa_border_radius', true);
	if ($border_radius == '') {
		$border_radius = '0';
	}
	echo "<div class='ca_style_setting_line'><span>Border Radius:</span>";
	echo "<input type='text' id='sa_border_radius' name='sa_border_radius' value='".esc_attr($border_radius)."'></div>\n";
	
	echo "<div class='ca_style_hr' style='margin-top:10px;'></div>\n";
	
	$tooltip = "The style settings for each individual slide (within the slider/carousel)";
	echo "<h4>SLIDE STYLE:<em class='sa_tooltip' title='".esc_attr($tooltip)."'></em></h4>";
	
	// SLIDE - MINIMUM HEIGHT
	$slide_min_height = get_post_meta($post->ID, 'sa_slide_min_height', true);
	if ($slide_min_height == '') {
		$slide_min_height = '100';
	}
	echo "<div class='ca_style_setting_line'><span>Min Height:</span>";
	echo "<input type='text' id='sa_slide_min_height' name='sa_slide_min_height' value='".esc_attr($slide_min_height)."'><em>px</em></div>\n";
	
	// SLIDE - PADDING TOP/BOTTOM
	$slide_padding_tb = get_post_meta($post->ID, 'sa_slide_padding_tb', true);
	if ($slide_padding_tb == '') {
		$slide_padding_tb = '5';
	}
	$tooltip = "Padding space top/bottom for each individual slide";
	echo "<div class='ca_style_setting_line' id='ca_style_padding_top_bottom'><span class='sa_tooltip' title='".esc_attr($tooltip)."'>Padding:</span>";
	echo "<input type='text' id='sa_slide_padding_tb' name='sa_slide_padding_tb' value='".esc_attr($slide_padding_tb)."'><em>%</em></div>\n";
	
	// SLIDE - PADDING LEFT/RIGHT
	$slide_padding_lr = get_post_meta($post->ID, 'sa_slide_padding_lr', true);
	if ($slide_padding_lr == '') {
		$slide_padding_lr = '5';
	}
	$tooltip = "Padding space left/right for each individual slide";
	echo "<div class='ca_style_setting_line' id='ca_style_padding_left_right'><span class='sa_tooltip' title='".esc_attr($tooltip)."'>Padding:</span>";
	echo "<input type='text' id='sa_slide_padding_lr' name='sa_slide_padding_lr' value='".esc_attr($slide_padding_lr)."'><em>%</em></div>\n";
	
	// SLIDE - MARGIN LEFT/RIGHT
	$slide_margin_lr = get_post_meta($post->ID, 'sa_slide_margin_lr', true);
	if ($slide_margin_lr == '') {
		$slide_margin_lr = '0';
	}
	$tooltip = "Margin space left and right of each slide";
	echo "<div class='ca_style_setting_line' id='ca_style_margin_left_right'><span class='sa_tooltip' title='".esc_attr($tooltip)."'>Margin:</span>";
	echo "<input type='text' id='sa_slide_margin_lr' name='sa_slide_margin_lr' value='".esc_attr($slide_margin_lr)."'><em>%</em></div>\n";
	
	echo "</div>\n";
}



// ##### ACTION HOOK - SAVE CUSTOM POST TYPE ('Slide Anything') DATA #####
function cpt_slider_save_postdata() {
	global $post;
	
	// ### VERIFY 1) LOGGED-IN USER IS ADMINISTRATOR AND 2) VALID NONCE TO PREVENT CSRF HACKER ATTACKS ###
	if (current_user_can('manage_options') &&
		 isset($_POST['nonce_save_slider']) && wp_verify_nonce($_POST['nonce_save_slider'], basename(__FILE__))) {
		$total_slides = intval($_POST['sa_num_slides']);
		if (($_POST['sa_duplicate_slide'] == '') || ($_POST['sa_duplicate_slide'] == '0')) {
			$duplicate_slide = 0;
		} else {
			// A SLIDE NEEDS TO BE DUPLICATED
			$duplicate_slide = intval($_POST['sa_duplicate_slide']);
		}
		if (($_POST['sa_move_slide_up'] == '') || ($_POST['sa_move_slide_up'] == '0')) {
			$move_slide_up = 0;
		} else {
			// A SLIDE NEEDS TO BE MOVED
			$move_slide_up = intval($_POST['sa_move_slide_up']);
		}
	
		// UPDATE CONTENT FOR EACH SLIDE
		$slides_saved = 0;
		for ($i = 1; $i <= $total_slides; $i++) {
			$slide_edit_id = "sa_slide".$i."_content";
			$slide_image_id = "sa_slide".$i."_image_id";
			$slide_image_pos = "sa_slide".$i."_image_pos";
			$slide_image_size = "sa_slide".$i."_image_size";
			$slide_image_repeat = "sa_slide".$i."_image_repeat";
			$slide_image_color = "sa_slide".$i."_image_color";
			//$slide_content = wp_kses_post($_POST[$slide_edit_id]);								// SANATIZE (slide 'wp_editor' content to contain valid HTML tags)
			$slide_content = balanceTags($_POST[$slide_edit_id], true);
			$slide_image_id_val = abs(intval($_POST[$slide_image_id]));							// SANATIZE (slide BG image ID is a valid integer)
			$slide_image_pos_val = sanitize_text_field($_POST[$slide_image_pos]);			// SANATIZE (BG image position is a valid text-input string)
			$slide_image_size_val = sanitize_text_field($_POST[$slide_image_size]);			// SANATIZE (BG image size is a valid text-input string)
			$slide_image_repeat_val = sanitize_text_field($_POST[$slide_image_repeat]);	// SANATIZE (BG image repeat is a valid text-input string)
			$slide_image_color_val = sanitize_text_field($_POST[$slide_image_color]);		// SANATIZE (BG color is a valid text-input string)
			// check delete status for slide
			$del_status_id = "sa_slide".$i."_delete";
			if (isset($_POST[$del_status_id]) && ($_POST[$del_status_id] != '')) {
				$del_status = $_POST[$del_status_id];
			} else {
				// a new slide has been added
				$del_status = '1';
				$slide_content = '';
			}
			if ($del_status == '1') {
				// save slide content only if slide has not been marked for deletion
				$slides_saved++;
				$slide_edit_id_save = "sa_slide".$slides_saved."_content";
				$slide_image_id_saved = "sa_slide".$slides_saved."_image_id";
				$slide_image_pos_saved = "sa_slide".$slides_saved."_image_pos";
				$slide_image_size_saved = "sa_slide".$slides_saved."_image_size";
				$slide_image_repeat_saved = "sa_slide".$slides_saved."_image_repeat";
				$slide_image_color_saved = "sa_slide".$slides_saved."_image_color";
				update_post_meta($post->ID, $slide_edit_id_save, $slide_content);
				update_post_meta($post->ID, $slide_image_id_saved, $slide_image_id_val);
				update_post_meta($post->ID, $slide_image_pos_saved, $slide_image_pos_val);
				update_post_meta($post->ID, $slide_image_size_saved, $slide_image_size_val);
				update_post_meta($post->ID, $slide_image_repeat_saved, $slide_image_repeat_val);
				update_post_meta($post->ID, $slide_image_color_saved, $slide_image_color_val);
				if ($i == $duplicate_slide) {
					// the 'duplicate slide' button has been click for this slide - create a new slide that is an exact copy of previous slide
					// (REPEAT THE CODE ABOVE HERE!!!)
					$slides_saved++;
					$slide_edit_id_save = "sa_slide".$slides_saved."_content";
					$slide_image_id_saved = "sa_slide".$slides_saved."_image_id";
					$slide_image_pos_saved = "sa_slide".$slides_saved."_image_pos";
					$slide_image_size_saved = "sa_slide".$slides_saved."_image_size";
					$slide_image_repeat_saved = "sa_slide".$slides_saved."_image_repeat";
					$slide_image_color_saved = "sa_slide".$slides_saved."_image_color";
					update_post_meta($post->ID, $slide_edit_id_save, $slide_content);
					update_post_meta($post->ID, $slide_image_id_saved, $slide_image_id_val);
					update_post_meta($post->ID, $slide_image_pos_saved, $slide_image_pos_val);
					update_post_meta($post->ID, $slide_image_size_saved, $slide_image_size_val);
					update_post_meta($post->ID, $slide_image_repeat_saved, $slide_image_repeat_val);
					update_post_meta($post->ID, $slide_image_color_saved, $slide_image_color_val);
				}
			}
		}
	
		if ($move_slide_up != 0) {
			// A SLIDE NEEDS TO BE MOVED (TWO SLIDES ARE SWAPPED)
			$slide2 = $move_slide_up;
			$slide1 = intval($move_slide_up) - 1;
			//$slide1_content = wp_kses_post($_POST["sa_slide".$slide1."_content"]);						// SANATIZE (slide 'wp_editor' content to contain valid HTML tags)
			$slide1_content = balanceTags($_POST["sa_slide".$slide1."_content"], true);
			$slide1_image_id = abs(intval($_POST["sa_slide".$slide1."_image_id"]));							// SANATIZE (slide BG image ID is a valid integer)
			$slide1_image_pos = sanitize_text_field($_POST["sa_slide".$slide1."_image_pos"]);			// SANATIZE (BG image position is a valid text-input string)
			$slide1_image_size = sanitize_text_field($_POST["sa_slide".$slide1."_image_size"]);			// SANATIZE (BG image size is a valid text-input string)
			$slide1_image_repeat = sanitize_text_field($_POST["sa_slide".$slide1."_image_repeat"]);	// SANATIZE (BG image repeat is a valid text-input string)
			$slide1_image_color = sanitize_text_field($_POST["sa_slide".$slide1."_image_color"]);		// SANATIZE (BG color is a valid text-input string)
			//$slide2_content = wp_kses_post($_POST["sa_slide".$slide2."_content"]);						// SANATIZE (slide 'wp_editor' content to contain valid HTML tags)
			$slide2_content = balanceTags($_POST["sa_slide".$slide2."_content"], true);
			$slide2_image_id = abs(intval($_POST["sa_slide".$slide2."_image_id"]));							// SANATIZE (slide BG image ID is a valid integer)
			$slide2_image_pos = sanitize_text_field($_POST["sa_slide".$slide2."_image_pos"]);			// SANATIZE (BG image position is a valid text-input string)
			$slide2_image_size = sanitize_text_field($_POST["sa_slide".$slide2."_image_size"]);			// SANATIZE (BG image size is a valid text-input string)
			$slide2_image_repeat = sanitize_text_field($_POST["sa_slide".$slide2."_image_repeat"]);	// SANATIZE (BG image repeat is a valid text-input string)
			$slide2_image_color = sanitize_text_field($_POST["sa_slide".$slide2."_image_color"]);		// SANATIZE (BG color is a valid text-input string)
			update_post_meta($post->ID, "sa_slide".$slide2."_content", $slide1_content);
			update_post_meta($post->ID, "sa_slide".$slide2."_image_id", $slide1_image_id);
			update_post_meta($post->ID, "sa_slide".$slide2."_image_pos", $slide1_image_pos);
			update_post_meta($post->ID, "sa_slide".$slide2."_image_size", $slide1_image_size);
			update_post_meta($post->ID, "sa_slide".$slide2."_image_repeat", $slide1_image_repeat);
			update_post_meta($post->ID, "sa_slide".$slide2."_image_color", $slide1_image_color);
			update_post_meta($post->ID, "sa_slide".$slide1."_content", $slide2_content);
			update_post_meta($post->ID, "sa_slide".$slide1."_image_id", $slide2_image_id);
			update_post_meta($post->ID, "sa_slide".$slide1."_image_pos", $slide2_image_pos);
			update_post_meta($post->ID, "sa_slide".$slide1."_image_size", $slide2_image_size);
			update_post_meta($post->ID, "sa_slide".$slide1."_image_repeat", $slide2_image_repeat);
			update_post_meta($post->ID, "sa_slide".$slide1."_image_color", $slide2_image_color);
		}
		
		// UPDATE SLIDE CONTENT CHARACTER COUNT
		$total_slides = get_post_meta($post->ID, 'sa_num_slides', true);
		for ($i = 1; $i <= $total_slides; $i++) {
			$slide_content = get_post_meta($post->ID, "sa_slide".$i."_content", true);
			$char_count = strlen($slide_content);
			update_post_meta($post->ID, "sa_slide".$i."_char_count", $char_count);
		}		
	
		// UPDATE SLIDER SETTINGS
		update_post_meta($post->ID, 'sa_num_slides', abs(intval($slides_saved)));												// SANATIZE (valid integer value)
		if (isset($_POST['sa_disable_visual_editor']) && ($_POST['sa_disable_visual_editor'] == '1')) {
			update_post_meta($post->ID, 'sa_disable_visual_editor', '1');
		} else {
			update_post_meta($post->ID, 'sa_disable_visual_editor', '0');
		}
		update_post_meta($post->ID, 'sa_info_added', abs(intval($_POST['sa_info_added'])));									// SANATIZE (valid integer value)
		update_post_meta($post->ID, 'sa_info_deleted', abs(intval($_POST['sa_info_deleted'])));							// SANATIZE (valid integer value)
		update_post_meta($post->ID, 'sa_duplicate_slide', abs(intval($_POST['sa_duplicate_slide'])));					// SANATIZE (valid integer value)
		update_post_meta($post->ID, 'sa_info_duplicated', abs(intval($_POST['sa_info_duplicated'])));					// SANATIZE (valid integer value)
		update_post_meta($post->ID, 'sa_move_slide_up', abs(intval($_POST['sa_move_slide_up'])));							// SANATIZE (valid integer value)
		update_post_meta($post->ID, 'sa_info_moved', abs(intval($_POST['sa_info_moved'])));									// SANATIZE (valid integer value)
		update_post_meta($post->ID, 'sa_slide_duration', abs(floatval($_POST['sa_slide_duration'])));					// SANATIZE (valid float value)
		update_post_meta($post->ID, 'sa_slide_transition', abs(floatval($_POST['sa_slide_transition'])));				// SANATIZE (valid float value)
		if (isset($_POST['sa_loop_slider']) && ($_POST['sa_loop_slider'] == '1')) {
			update_post_meta($post->ID, 'sa_loop_slider', '1');
		} else {
			update_post_meta($post->ID, 'sa_loop_slider', '0');
		}
		if (isset($_POST['sa_stop_hover']) && ($_POST['sa_stop_hover'] == '1')) {
			update_post_meta($post->ID, 'sa_stop_hover', '1');
		} else {
			update_post_meta($post->ID, 'sa_stop_hover', '0');
		}
		if (isset($_POST['sa_nav_arrows']) && ($_POST['sa_nav_arrows'] == '1')) {
			update_post_meta($post->ID, 'sa_nav_arrows', '1');
		} else {
			update_post_meta($post->ID, 'sa_nav_arrows', '0');
		}
		if (isset($_POST['sa_pagination']) && ($_POST['sa_pagination'] == '1')) {
			update_post_meta($post->ID, 'sa_pagination', '1');
		} else {
			update_post_meta($post->ID, 'sa_pagination', '0');
		}
		if (isset($_POST['sa_random_order']) && ($_POST['sa_random_order'] == '1')) {
			update_post_meta($post->ID, 'sa_random_order', '1');
		} else {
			update_post_meta($post->ID, 'sa_random_order', '0');
		}
		if (isset($_POST['sa_shortcodes']) && ($_POST['sa_shortcodes'] == '1')) {
			update_post_meta($post->ID, 'sa_shortcodes', '1');
		} else {
			update_post_meta($post->ID, 'sa_shortcodes', '0');
		}
		if (isset($_POST['sa_mouse_drag']) && ($_POST['sa_mouse_drag'] == '1')) {
			update_post_meta($post->ID, 'sa_mouse_drag', '1');
		} else {
			update_post_meta($post->ID, 'sa_mouse_drag', '0');
		}
		if (isset($_POST['sa_touch_drag']) && ($_POST['sa_touch_drag'] == '1')) {
			update_post_meta($post->ID, 'sa_touch_drag', '1');
		} else {
			update_post_meta($post->ID, 'sa_touch_drag', '0');
		}
	
		// UPDATE SLIDER ITEMS DISPLAYED
		update_post_meta($post->ID, 'sa_items_width1', abs(intval($_POST['sa_items_width1'])));		// SANATIZE (valid integer value)
		update_post_meta($post->ID, 'sa_items_width2', abs(intval($_POST['sa_items_width2'])));		// SANATIZE (valid integer value)
		update_post_meta($post->ID, 'sa_items_width3', abs(intval($_POST['sa_items_width3'])));		// SANATIZE (valid integer value)
		update_post_meta($post->ID, 'sa_items_width4', abs(intval($_POST['sa_items_width4'])));		// SANATIZE (valid integer value)
		update_post_meta($post->ID, 'sa_items_width5', abs(intval($_POST['sa_items_width5'])));		// SANATIZE (valid integer value)
		update_post_meta($post->ID, 'sa_items_width6', abs(intval($_POST['sa_items_width6'])));		// SANATIZE (valid integer value)
		update_post_meta($post->ID, 'sa_transition', sanitize_text_field($_POST['sa_transition']));	// SANATIZE (valid text-input string)
	
		// UPDATE SLIDER STYLE
		update_post_meta($post->ID, 'sa_css_id', sanitize_text_field($_POST['sa_css_id']));								// SANATIZE (valid text-input string)
		update_post_meta($post->ID, 'sa_background_color', sanitize_text_field($_POST['sa_background_color']));	// SANATIZE (valid text-input string)
		update_post_meta($post->ID, 'sa_border_width', abs(intval($_POST['sa_border_width'])));						// SANATIZE (valid integer value)
		update_post_meta($post->ID, 'sa_border_color', sanitize_text_field($_POST['sa_border_color']));				// SANATIZE (valid text-input string)
		update_post_meta($post->ID, 'sa_border_radius', abs(intval($_POST['sa_border_radius'])));						// SANATIZE (valid integer value)
		update_post_meta($post->ID, 'sa_wrapper_padd_top', abs(intval($_POST['sa_wrapper_padd_top'])));				// SANATIZE (valid integer value)
		update_post_meta($post->ID, 'sa_wrapper_padd_right', abs(intval($_POST['sa_wrapper_padd_right'])));		// SANATIZE (valid integer value)
		update_post_meta($post->ID, 'sa_wrapper_padd_bottom', abs(intval($_POST['sa_wrapper_padd_bottom'])));		// SANATIZE (valid integer value)
		update_post_meta($post->ID, 'sa_wrapper_padd_left', abs(intval($_POST['sa_wrapper_padd_left'])));			// SANATIZE (valid integer value)
		update_post_meta($post->ID, 'sa_slide_min_height', abs(intval($_POST['sa_slide_min_height'])));				// SANATIZE (valid integer value)
		update_post_meta($post->ID, 'sa_slide_padding_tb', abs(floatval($_POST['sa_slide_padding_tb'])));			// SANATIZE (valid float value)
		update_post_meta($post->ID, 'sa_slide_padding_lr', abs(floatval($_POST['sa_slide_padding_lr'])));			// SANATIZE (valid float value)
		update_post_meta($post->ID, 'sa_slide_margin_lr', abs(floatval($_POST['sa_slide_margin_lr'])));				// SANATIZE (valid float value)
		if (isset($_POST['sa_autohide_arrows']) && ($_POST['sa_autohide_arrows'] == '1')) {
			update_post_meta($post->ID, 'sa_autohide_arrows', '1');
		} else {
			update_post_meta($post->ID, 'sa_autohide_arrows', '0');
		}
	}
}
?>