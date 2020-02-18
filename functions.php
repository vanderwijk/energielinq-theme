<?php

function fran_child_theme_locale() {
	load_child_theme_textdomain( 'fran', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'fran_child_theme_locale' );

function fran_child_enqueue_styles() {

	wp_register_style( 'font-poppins-sans', '//fonts.googleapis.com/css?family=Poppins:400,400i,600' );
	wp_enqueue_style( 'font-poppins-sans' );

	wp_enqueue_style( 'fran-style' , get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'fran-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'fran-style' ),
		wp_get_theme()->get('Version')
	);
}
add_action( 'wp_enqueue_scripts', 'fran_child_enqueue_styles' );

// Google analytics tracking code
function google_analytics() { ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-138561833-1"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-138561833-1');
</script>
<?php }
add_action('wp_head', 'google_analytics');

// Hubspot tracking code
function hubspot() { ?>
<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/5349985.js"></script>
<!-- End of HubSpot Embed Code -->
<?php }
add_action('wp_footer', 'hubspot');

/**
 * Save file upload fields under custom post field to the library
 *
 * @param    $post_id  The post identifier
 * @param    $entry     The entry
 * @param    $form      The form
 */
function gf_add_to_media_library ( $post_id, $entry, $form ) {
	foreach($form['fields'] as $field){

	//get media upload dir
		$uploads = wp_upload_dir();     
		$uploads_dir = $uploads['path'];      
		$uploads_url = $uploads['url'];

	//if its a custom field with input type file upload. 
	if( $field['type'] == 'post_custom_field' && $field['inputType'] == 'fileupload'){
		$entry_id = $field['id'];
		$files = rgar ( $entry, $entry_id );
		$custom_field = $field['postCustomFieldName']; //custom field key

	//if file field is not empty or not []
		if ( $files !== '' && $files !== "[]"){

			$patterns = ['[', ']', '"']; //get rid of crap
			$file_entry = str_replace($patterns, '', $files);
			$files = explode ( ',', $file_entry  );

				foreach ($files as $file) {
					//each file is a url
					//get the filename from end of url in match[1]
						$filename = pathinfo($file, PATHINFO_FILENAME);
						//add to media library
						//WordPress API for image uploads.
						include_once( ABSPATH . 'wp-admin/includes/image.php' );
						include_once( ABSPATH . 'wp-admin/includes/file.php' );
						include_once( ABSPATH . 'wp-admin/includes/media.php' );
					 
						$new_url = stripslashes($file);
						$result = media_sideload_image( $new_url, $post_id, $filename, 'src');
						//saving the image to field or thumbnail
						
						if( strpos($field['cssClass'], 'thumb') === false  ){
							$attachment_ids[] = (int)  get_attachment_id_from_src($result);
						}
						else{
							set_post_thumbnail($post_id, (int)  get_attachment_id_from_src($result) );
						}
						 
				} //end foreach file
				if ( isset( $attachment_ids ) ){
					update_post_meta ($post_id, $custom_field, $attachment_ids);
				}
			} //end if files not empty
		} //end if custom field of uploadfile
	}
} //end for each form field
add_action( 'gform_after_create_post', 'gf_add_to_media_library', 10, 3 );

function get_attachment_id_from_src($image_src) {
	global $wpdb;
	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
	$id = $wpdb->get_var($query);
	return $id;
}