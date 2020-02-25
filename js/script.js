jQuery(document).ready(function($) {

	// Fancybox gallery on default gallery shortcode
	$('.gallery-icon a').fancybox().attr('data-fancybox', 'gallery');

	// Fancybox gallery on Gutenberg gallery block
	$('.wp-block-gallery .blocks-gallery-item a').fancybox().attr('data-fancybox', 'gallery');

});