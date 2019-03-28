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