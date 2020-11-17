<?php
function energielinq_theme_locale() {
	load_child_theme_textdomain( 'energielinq', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'energielinq_theme_locale' );

function energielinq_enqueues() {

	wp_enqueue_style('fran-style' , get_template_directory_uri() . '/style.css');
	wp_enqueue_style('museo-sans', get_stylesheet_directory_uri() . '/fonts/museo-sans.css', '', wp_get_theme()->get('Version'));

	wp_enqueue_style('fancybox', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css', '', wp_get_theme()->get('Version'));
	wp_enqueue_script('fancybox', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', array( 'jquery' ), '3.5.7', true);
	wp_enqueue_script('script', get_stylesheet_directory_uri() . '/js/script.js', array( 'jquery' ), wp_get_theme()->get('Version'), true);

	wp_enqueue_style('fran-child-style', get_stylesheet_directory_uri() . '/style.css', array( 'fran-style' ), wp_get_theme()->get('Version'));
}
add_action( 'wp_enqueue_scripts', 'energielinq_enqueues' );

// google analytics tracking code
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

// hubspot tracking code
function hubspot() { ?>
<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/5349985.js"></script>
<!-- End of HubSpot Embed Code -->
<?php }
add_action('wp_footer', 'hubspot');

// modify exerpts
function energielinq_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'energielinq_excerpt_length', 1000 );

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

// set meta query on archive
function md_pre_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() )
		return;

	if ( is_post_type_archive( 'project' ) ) {

		$query->set('meta_key', 'projectstatus');
		$query->set('meta_value', 'Gerealiseerd');

		return;
	}

}
add_action( 'pre_get_posts', 'md_pre_query', 1 );

/**
 * Add search weight to more recently published entries
 */
function my_searchwp_add_weight_to_newer_posts( $sql ) {
	global $wpdb;

	// Adjust how much weight is given to newer publish dates. There
	// is no science here as it correlates with the other weights
	// in your engine configuration, and the content of your site.
	// Experiment until results are returned as you want them to be.
	$modifier = 25;

	$sql .= " + ( 100 * EXP( ( 1 - ABS( ( UNIX_TIMESTAMP( {$wpdb->prefix}posts.post_date ) - UNIX_TIMESTAMP( NOW() ) ) / 86400 ) ) / 1 ) * {$modifier} )";

	return $sql;
}

add_filter( 'searchwp_weight_mods', 'my_searchwp_add_weight_to_newer_posts' );