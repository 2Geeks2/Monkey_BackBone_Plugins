// ##################################################################
// ### SLIDE ANYTHING PLUGIN - JAVASCRIPT FOR WORDPRESS DASHBOARD ###
// ##################################################################

jQuery(function() {
	// ##### JQUERY-UI TOOLTIPS #####
	jQuery(".sa_tooltip").tooltip();
	
	// ##### JQUERY-UI - SLIDE DURATION SLIDER/INPUT #####
	var init_value = jQuery("#sa_slide_duration").val();
	jQuery("#jq_slider_duration").slider({
		range:"max",
		min:0,
		max:30,
		step:0.1,
		value:init_value,
		slide:function(event, ui) {
			jQuery("#sa_slide_duration").val(ui.value);
		}
	});
	jQuery("#sa_slide_duration").val(jQuery("#jq_slider_duration").slider("value"));
	
	// ##### JQUERY-UI - SLIDE TRANSITION SLIDER/INPUT #####
	var init_value = jQuery("#sa_slide_transition").val();
	jQuery("#jq_slider_transition").slider({
		range:"max",
		min:0,
		max:3,
		step:0.1,
		value:init_value,
		slide:function(event, ui) {
			jQuery("#sa_slide_transition").val(ui.value);
		}
	});
	jQuery("#sa_slide_transition").val(jQuery("#jq_slider_transition").slider("value"));
	
	// ##### CHANGE EVENT HANDLER FOR 'Disable Visual Editor' CHECKBOX #####
	jQuery('#sa_disable_visual_editor').change(function() {
		// save the custom post type
		jQuery('#sa_disable_visual_editor').css('cursor', 'wait');
		jQuery('body').css('cursor', 'wait');
		jQuery('#publish').click();
	})
	
	// ##### JQUERY-UI ACCORDION CONTAINING CONTENT FOR ALL SLIDES #####
	jQuery("#slider_accordion").accordion({
		heightStyle: "content"
	});
	
	// ##### CLICK EVENT HANDLER FOR THE 'Add Slide' BUTTON #####
	// increment the hidden 'number of slides' input field and save the custom post type
	jQuery('#sa_add_slide').click(function() {
		var num = + jQuery("#num_slides_id").val() + 1;
		jQuery("#num_slides_id").val(num);
		// set hidden input field to notify that a status message must be displayed
		var info_added = document.getElementById('sa_info_added');
		info_added.value = "1";
		// save the custom post type	
		jQuery('#sa_add_slide').css('cursor', 'wait');
		jQuery('body').css('cursor', 'wait');
		jQuery('#publish').click();
	});
	
	// ##### CLICK EVENT HANDLER FOR THE SHORTCODE 'Copy to Clipboard' BUTTON #####
	jQuery('#sa_shortcode_copy').click(function() {
		var shortcode = document.getElementById('sa_slider_shortcode').innerHTML;
		var aux = document.createElement("input"); // Create a "hidden" input
		aux.setAttribute("value", shortcode); // Assign it the value of the specified element
		document.body.appendChild(aux); // Append it to the body
		aux.select(); // Highlight its content
		document.execCommand("copy"); // Copy the highlighted text
		document.body.removeChild(aux); // Remove it from the body
		// DISPLAY 'Shortcode Copied' message 
		document.getElementById('sa_slider_shortcode').innerHTML = "Copied!";
		setTimeout(function(){ document.getElementById('sa_slider_shortcode').innerHTML = shortcode; }, 1000);
	});
	
	// ##### CHANGE EVENT HANDLER FOR CSS ID INPUT BOX #####
	jQuery('#sa_css_id').change(function() {
		var css_id = document.getElementById('sa_css_id').value;
		document.getElementById('css_note_value').innerHTML = '#' + css_id + ' .owl-item';
	});
	
	// ##### CLICK EVENT HANDLER FOR THE CSS SELECTOR 'Copy to Clipboard' BUTTON #####
	jQuery('#css_note_value').click(function() {
		var css_selector = document.getElementById('css_note_value').innerHTML;
		var aux = document.createElement("input"); // Create a "hidden" input
		aux.setAttribute("value", css_selector); // Assign it the value of the specified element
		document.body.appendChild(aux); // Append it to the body
		aux.select(); // Highlight its content
		document.execCommand("copy"); // Copy the highlighted text
		document.body.removeChild(aux); // Remove it from the body
		// DISPLAY 'Shortcode Copied' message 
		document.getElementById('css_note_value').innerHTML = "Copied!";
		setTimeout(function(){ document.getElementById('css_note_value').innerHTML = css_selector; }, 1000);
	});
	
	// ##### SPECTRUM COLOR PICKER - SLIDER BACKGROUND COLOR #####
	if (document.getElementById('sa_background_color')) {
		var background_color = document.getElementById('sa_background_color').value;
		jQuery("#sa_background_color").spectrum({
			showPaletteOnly: true,
			togglePaletteOnly: true,
			togglePaletteMoreText: 'more',
			togglePaletteLessText: 'less',
			showInput: true,
			allowEmpty:true,
			preferredFormat: "rgb",
			showAlpha: true,
			color: background_color,
			palette: [
				["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
				["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
				["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
				["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
				["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
				["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
				["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
				["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
			]
		});
	}
	
	// ##### JQUERY-UI SPINNER - SLIDER BORDER WIDTH #####
	jQuery("#sa_border_width").spinner({
		step: 1,
		min: 0,
		max: 10,
		numberFormat: "n"
	});
	// ##### CHANGE EVENT HANDLER - SLIDER BORDER WIDTH #####
	jQuery('#sa_border_width').change(function() {
		var border_width = document.getElementById('sa_border_width').value;
		if (jQuery.isNumeric(border_width)) {
			if ((border_width >= 0) && (border_width <= 10)) {
				// valid number
			} else {
				document.getElementById('sa_border_width').value = '0'; // number out of range
			}
		} else {
			document.getElementById('sa_border_width').value = '0'; // not a valid number
		}
	});
	// ##### SPECTRUM COLOR PICKER - SLIDER BORDER COLOR #####
	if (document.getElementById('sa_border_color')) {
		var border_color = document.getElementById('sa_border_color').value;
		jQuery("#sa_border_color").spectrum({
			showPaletteOnly: true,
			togglePaletteOnly: true,
			togglePaletteMoreText: 'more',
			togglePaletteLessText: 'less',
			showInput: true,
			allowEmpty:true,
			preferredFormat: "rgb",
			showAlpha: true,
			color: border_color,
			palette: [
				["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
				["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
				["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
				["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
				["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
				["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
				["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
				["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
			]
		});
	}
	
	// ##### JQUERY-UI SPINNER - SLIDER BORDER RADIUS #####
	jQuery("#sa_border_radius").spinner({
		step: 1,
		min: 0,
		max: 20,
		numberFormat: "n"
	});
	// ##### CHANGE EVENT HANDLER - SLIDER BORDER RADIUS #####
	jQuery('#sa_border_radius').change(function() {
		var border_radius = document.getElementById('sa_border_radius').value;
		if (jQuery.isNumeric(border_radius)) {
			if ((border_radius >= 0) && (border_radius <= 20)) {
				// valid number
			} else {
				document.getElementById('sa_border_radius').value = '0'; // number out of range
			}
		} else {
			document.getElementById('sa_border_radius').value = '0'; // not a valid number
		}
	});
	
	// ##### JQUERY-UI SPINNERS - WRAPPER PADDING (TOP, RIGHT, BOTTOM, LEFT) #####
	jQuery("#sa_wrapper_padd_top").spinner({ step: 1, min: 0, max: 99, numberFormat: "n" });
	jQuery("#sa_wrapper_padd_right").spinner({ step: 1, min: 0, max: 99, numberFormat: "n" });
	jQuery("#sa_wrapper_padd_bottom").spinner({ step: 1, min: 0, max: 99, numberFormat: "n" });
	jQuery("#sa_wrapper_padd_left").spinner({ step: 1, min: 0, max: 99, numberFormat: "n" });
	// ##### CHANGE EVENT HANDLER - WRAPPER PADDING TOP #####
	jQuery('#sa_wrapper_padd_top').change(function() {
		var wrapper_padding = document.getElementById('sa_wrapper_padd_top').value;
		if (jQuery.isNumeric(wrapper_padding)) {
			if ((wrapper_padding >= 0) && (wrapper_padding <= 30)) {
				// valid number
			} else {
				document.getElementById('sa_wrapper_padd_top').value = '0'; // number out of range
			}
		} else {
			document.getElementById('sa_wrapper_padd_top').value = '0'; // not a valid number
		}
	});
	// ##### CHANGE EVENT HANDLER - WRAPPER PADDING RIGHT #####
	jQuery('#sa_wrapper_padd_right').change(function() {
		var wrapper_padding = document.getElementById('sa_wrapper_padd_right').value;
		if (jQuery.isNumeric(wrapper_padding)) {
			if ((wrapper_padding >= 0) && (wrapper_padding <= 30)) {
				// valid number
			} else {
				document.getElementById('sa_wrapper_padd_right').value = '0'; // number out of range
			}
		} else {
			document.getElementById('sa_wrapper_padd_right').value = '0'; // not a valid number
		}
	});
	// ##### CHANGE EVENT HANDLER - WRAPPER PADDING BOTTOM #####
	jQuery('#sa_wrapper_padd_bottom').change(function() {
		var wrapper_padding = document.getElementById('sa_wrapper_padd_bottom').value;
		if (jQuery.isNumeric(wrapper_padding)) {
			if ((wrapper_padding >= 0) && (wrapper_padding <= 30)) {
				// valid number
			} else {
				document.getElementById('sa_wrapper_padd_bottom').value = '0'; // number out of range
			}
		} else {
			document.getElementById('sa_wrapper_padd_bottom').value = '0'; // not a valid number
		}
	});
	// ##### CHANGE EVENT HANDLER - WRAPPER PADDING LEFT #####
	jQuery('#sa_wrapper_padd_left').change(function() {
		var wrapper_padding = document.getElementById('sa_wrapper_padd_left').value;
		if (jQuery.isNumeric(wrapper_padding)) {
			if ((wrapper_padding >= 0) && (wrapper_padding <= 30)) {
				// valid number
			} else {
				document.getElementById('sa_wrapper_padd_left').value = '0'; // number out of range
			}
		} else {
			document.getElementById('sa_wrapper_padd_left').value = '0'; // not a valid number
		}
	});
		
	// ##### JQUERY-UI SPINNER FOR SLIDE MINIMUM HEIGHT #####
	jQuery("#sa_slide_min_height").spinner({
		step: 1,
		min: 0,
		max: 999,
		numberFormat: "n"
	});
	// ##### CHANGE EVENT HANDLER FOR SLIDE MINIMUM HEIGHT #####
	jQuery('#sa_slide_min_height').change(function() {
		var slide_min_height = document.getElementById('sa_slide_min_height').value;
		if (jQuery.isNumeric(slide_min_height)) {
			if ((slide_min_height >= 0) && (slide_min_height <= 999)) {
				// valid number
			} else {
				document.getElementById('sa_slide_min_height').value = '0'; // number out of range
			}
		} else {
			document.getElementById('sa_slide_min_height').value = '0'; // not a valid number
		}
	});
	
	// ##### JQUERY-UI SPINNER FOR SLIDE PADDING TOP/BOTTOM #####
	jQuery("#sa_slide_padding_tb").spinner({
		step: 0.1,
		min: 0,
		max: 30,
		numberFormat: "n"
	});
	// ##### CHANGE EVENT HANDLER FOR SLIDE PADDING TOP/BOTTOM #####
	jQuery('#sa_slide_padding_tb').change(function() {
		var slide_padding_tb = document.getElementById('sa_slide_padding_tb').value;
		if (jQuery.isNumeric(slide_padding_tb)) {
			if ((slide_padding_tb >= 0) && (slide_padding_tb <= 30)) {
				// valid number
			} else {
				document.getElementById('sa_slide_padding_tb').value = '0'; // number out of range
			}
		} else {
			document.getElementById('sa_slide_padding_tb').value = '0'; // not a valid number
		}
	});
	
	// ##### JQUERY-UI SPINNER FOR SLIDE PADDING LEFT/RIGHT #####
	jQuery("#sa_slide_padding_lr").spinner({
		step: 0.1,
		min: 0,
		max: 30,
		numberFormat: "n"
	});
	// ##### CHANGE EVENT HANDLER FOR SLIDE PADDING LEFT/RIGHT #####
	jQuery('#sa_slide_padding_lr').change(function() {
		var slide_padding_lr = document.getElementById('sa_slide_padding_lr').value;
		if (jQuery.isNumeric(slide_padding_lr)) {
			if ((slide_padding_lr >= 0) && (slide_padding_lr <= 30)) {
				// valid number
			} else {
				document.getElementById('sa_slide_padding_lr').value = '0'; // number out of range
			}
		} else {
			document.getElementById('sa_slide_padding_lr').value = '0'; // not a valid number
		}
	});
	
	// ##### JQUERY-UI SPINNER FOR SLIDE MARGIN LEFT/RIGHT #####
	jQuery("#sa_slide_margin_lr").spinner({
		step: 0.1,
		min: 0,
		max: 20,
		numberFormat: "n"
	});
	// ##### CHANGE EVENT HANDLER FOR SLIDE MARGIN LEFT/RIGHT #####
	jQuery('#sa_slide_margin_lr').change(function() {
		var slide_margin_lr = document.getElementById('sa_slide_margin_lr').value;
		if (jQuery.isNumeric(slide_margin_lr)) {
			if ((slide_margin_lr >= 0) && (slide_margin_lr <= 30)) {
				// valid number
			} else {
				document.getElementById('sa_slide_margin_lr').value = '0'; // number out of range
			}
		} else {
			document.getElementById('sa_slide_margin_lr').value = '0'; // not a valid number
		}
	});
})

	

jQuery(function() {
	// THE VAIRABLE THAT HOLDS THE IFRAME FOR WORDPRESS MEDIA UPLOADS
	var frame;
	
	// ##### CLICK EVENT HANDLER - 'Set Background Image' LINK (BUTTON) FOR ALL SLIDES #####
	jQuery('.slide_image_add').click(function(event) {
		// GET THE SLIDE NUMBER (GET parameter within anchor 'href' attribute)
		var anchor_element = event.target;
		var upload_url = anchor_element.getAttribute('href');
		var split_arr = upload_url.split("&slide=");
		var slide_no = split_arr[1];

		// PREVENT THE ANCHOR LINK FROM OPENING HREF TARGET PAGE
		event.preventDefault();
		
		// SET THE HTML ELEMENTS TO BE USED WITHIN THIS FUNCTION
		var thumb_preview = "#slide" + slide_no + "_thumb div";
		var image_id = "#sa_slide" + slide_no + "_image_id";
		var del_img_but = "#slide" + slide_no + "_image_del";
		
		// CREATE A NEW MEDIA UPLOAD FRAME
		frame = wp.media({
			title: 'Select the background image for your slide',
			button: {
				text: 'Use selected image'
			},
			multiple: false  // only a single file may be selected
		});
		
		// AN IMAGE HAS BEEN SELECTED WITHIN THE MEDIA UPLOAD FRAME...
		frame.on('select', function() {
			// Get media attachment details from the frame state
			var attachment = frame.state().get('selection').first().toJSON();
			// Set the background image of the thumbnail preview DIV to the attachment URL
			jQuery(thumb_preview).css('background-image', 'url(' + attachment.url + ')');
			// Send the attachment id to our hidden input box
			jQuery(image_id).val(attachment.id);
			// Unhide the delete image button
			jQuery(del_img_but).removeClass('sa_hidden');
		});
		// Finally, open the modal on click
		frame.open();
	});
})



// ##### CLICK EVENT HANDLER - 'Remove Background Image' BUTTON FOR ALL SLIDES #####
function remove_slide_bg_image(slide_no) {
	// SET THE HTML ELEMENTS TO BE USED WITHIN THIS FUNCTION
	var thumb_preview = "#slide" + slide_no + "_thumb div";
	var image_id = "#sa_slide" + slide_no + "_image_id";
	var del_img_but = "#slide" + slide_no + "_image_del";
	
	// Reset the background image of the thumbnail preview div
	jQuery(thumb_preview).css('background-image', '');
	// Delete the image id from the hidden input
	jQuery(image_id).val('');
	// Hide the delete image button
	jQuery(del_img_but).addClass('sa_hidden');
}



// ##### CHANGE EVENT HANDLER - BACKGROUND POSITION DROPDOWN FOR ALL SLIDES #####
function change_slide_image_pos(slide_no) {
	var background_pos = document.getElementById("sa_slide" + slide_no + "_image_pos").value;
	var thumb_preview = "#slide" + slide_no + "_thumb div";
	jQuery(thumb_preview).css('background-position', background_pos);
}



// ##### CHANGE EVENT HANDLER - BACKGROUND SIZE DROPDOWN FOR ALL SLIDES #####
function change_slide_image_size(slide_no) {
	var background_size = document.getElementById("sa_slide" + slide_no + "_image_size").value;
	var thumb_preview = "#slide" + slide_no + "_thumb div";
	jQuery(thumb_preview).css('background-size', background_size);
}



// ##### CHANGE EVENT HANDLER - BACKGROUND REPEAT DROPDOWN FOR ALL SLIDES #####
function change_slide_image_repeat(slide_no) {
	var background_repeat = document.getElementById("sa_slide" + slide_no + "_image_repeat").value;
	var thumb_preview = "#slide" + slide_no + "_thumb div";
	jQuery(thumb_preview).css('background-repeat', background_repeat);
}



jQuery(function() {
	if (document.getElementById('num_slides_id')) {
		var num_slides = parseInt(document.getElementById('num_slides_id').value);
		// ##### LOOP THRU EACH SLIDE #####
		for (i = 1; i <= num_slides; i++) {
			// ##### SPECTRUM COLOR PICKER - SLIDE BACKGROUND COLOR #####
			var color_picker_id = 'sa_slide' + i + '_image_color';
			var background_color = document.getElementById(color_picker_id).value;
			jQuery('#' + color_picker_id).spectrum({
				showPaletteOnly: true,
				togglePaletteOnly: true,
				togglePaletteMoreText: 'more',
				togglePaletteLessText: 'less',
				showInput: true,
				allowEmpty: true,
				preferredFormat: "rgb",
				showAlpha: true,
				color: background_color,
				palette: [
					["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
					["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
					["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
					["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
					["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
					["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
					["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
					["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
				]
			});
		}
	}
})
// ##### CHANGE EVENT HANDLER - SLIDE BACKGROUND COLOR PICKER #####
function change_slide_image_color(slide_no) {
	var background_color = document.getElementById("sa_slide" + slide_no + "_image_color").value;
	var thumb_preview = "#slide" + slide_no + "_thumb div";
	jQuery(thumb_preview).css('background-color', background_color);
}



// ##### CLICK EVENT HANDLER FOR THE 'Delete Slide' BUTTON (FOR EACH SLIDE) #####
// Set the hidden 'delete status' input field to zero and save the custom post type
function delete_sa_slide(delete_id) {
	jQuery(function() {
		var dialog_box = document.getElementById('sa_dialog_box');
		dialog_box.innerHTML = "Click the <strong>OK</strong> button to delete this slide.";
		jQuery("#sa_dialog_box").dialog({ title: 'DELETE SLIDE' });
		jQuery("#sa_dialog_box").dialog({
			buttons: {
				OK: function() {
					var del_status = document.getElementById(delete_id);
					del_status.value = "0";
					// set hidden input field to notify that a status message must be displayed
					var info_deleted = document.getElementById('sa_info_deleted');
					info_deleted.value = "1";
					// save the custom post type
					jQuery('body').css('cursor', 'wait');
					jQuery('.ui-button').css('cursor', 'wait');
					jQuery('#publish').click();
				},
				Cancel: function() {
					jQuery(this).dialog("close");
				}
			}
		});
		jQuery("#sa_dialog_box").dialog("open");
	})
}

// ##### CLICK EVENT HANDLER FOR THE 'Duplicate Slide' BUTTON (FOR EACH SLIDE) #####
// Set the hidden 'duplicate slide' input field to the slide number to be duplicated and save the custom post type
function duplicate_slide(slide_no) {
	jQuery(function() {
		var dialog_box = document.getElementById('sa_dialog_box');
		dialog_box.innerHTML = "Click the <strong>OK</strong> button to make a duplicate (copy) of this slide.";
		jQuery("#sa_dialog_box").dialog({ title: 'DUPLICATE SLIDE' });
		jQuery("#sa_dialog_box").dialog({
			buttons: {
				OK: function() {
					// set hidden 'duplicate slide' input field to the slide number to be duplicated
					var duplicate_slide = document.getElementById('sa_duplicate_slide');
					duplicate_slide.value = slide_no;
					// set hidden input field to notify that a status message must be displayed
					var info_duplicated = document.getElementById('sa_info_duplicated');
					info_duplicated.value = "1";
					// save the custom post type
					jQuery('body').css('cursor', 'wait');
					jQuery('.ui-button').css('cursor', 'wait');
					jQuery('#publish').click();
				},
				Cancel: function() {
					jQuery(this).dialog("close");
				}
			}
		});
		jQuery("#sa_dialog_box").dialog("open");
	})
}

// ##### CLICK EVENT HANDLER FOR THE 'Move Slide Up' BUTTON (FOR EACH SLIDE) #####
// Set the hidden 'move slide up' input field to the slide number to be moved up and save the custom post type
function move_slide_up(slide_no) {
	jQuery(function() {
		var dialog_box = document.getElementById('sa_dialog_box');
		dialog_box.innerHTML = "Click the <strong>OK</strong> button to move this slide up within the slide order.";
		jQuery("#sa_dialog_box").dialog({ title: 'MOVE SLIDE UP' });
		jQuery("#sa_dialog_box").dialog({
			buttons: {
				OK: function() {
					// set hidden 'move slide up' input field to the slide number to be moved
					var move_slide_up = document.getElementById('sa_move_slide_up');
					move_slide_up.value = slide_no;
					// set hidden input field to notify that a status message must be displayed
					var info_moved = document.getElementById('sa_info_moved');
					info_moved.value = "1";
					// save the custom post type
					jQuery('body').css('cursor', 'wait');
					jQuery('.ui-button').css('cursor', 'wait');
					jQuery('#publish').click();
				},
				Cancel: function() {
					jQuery(this).dialog("close");
				}
			}
		});
		jQuery("#sa_dialog_box").dialog("open");
	})
}


function preview_slider() {
	jQuery(function() {
		var preview_box = document.getElementById('sa_preview_box');
		jQuery("#sa_preview_box").dialog({
			title: 'PREVIEW SLIDER',
			modal: true,
			closeOnEscape: true,
			resizable: false,
			draggable: false
		});
		jQuery("#sa_preview_box").dialog({
			buttons: {
				Close: function() {
					jQuery(this).dialog("close");
				}
			}
		});
		jQuery("#sa_preview_box").dialog("open");
	})
}