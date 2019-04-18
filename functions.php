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