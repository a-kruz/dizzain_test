<?php
/**
 * dizzain_test functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package dizzain_test
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'dizzain_test_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function dizzain_test_setup() {

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );


		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'dizzain_test' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);


		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'dizzain_test_setup' );


/**
 * Enqueue scripts and styles.
 */
function dizzain_test_scripts() {
	wp_enqueue_style( 'dizzain_test-style', get_stylesheet_uri(), array(), _S_VERSION );

    wp_deregister_script( 'jquery' );
    wp_register_script('jquery', 'https://code.jquery.com/jquery-1.11.0.min.js', NULL, '1.11.0', false);
    wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'dizzain_test-slick_slider', get_stylesheet_directory_uri() . '/js/slick.min.js', array('jquery') );
    wp_enqueue_script( 'dizzain_test-script', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), '1.0.1' );
}
add_action( 'wp_enqueue_scripts', 'dizzain_test_scripts' );


/**
 * Load SVG supporting
 */
function add_file_types_to_uploads($file_types) {
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');


/**
 * Add custom post type "Services":
 */
function register_custom_post_types() {

    register_post_type( 'service', [
        'label'  => null,
        'labels' => [
            'name'               => 'Services',
            'singular_name'      => 'Service',
        ],
        'description'         => 'Here is you can add new services on the home page',
        'public'              => true,
        'show_in_menu'        => null,
        'show_in_rest'        => true,
        'rest_base'           => null,
        'menu_position'       => 2,
        'menu_icon'           => 'dashicons-editor-ol',
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => [ 'title', 'editor' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'has_archive'         => false,
        'rewrite'             => true,
        'query_var'           => true,
    ] );
}
add_action( 'init', 'register_custom_post_types' );

