<?php
	
if ( ! isset( $content_width ) )
	$content_width = 700;
	
function conway_hall_init()  {
	remove_action( 'wp_head', 'wp_generator' );
	show_admin_bar( false );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	//add_theme_support( 'jetpack-responsive-videos' );
	set_post_thumbnail_size( 700, 394, true );
	add_image_size( 'carousel', 880, 395, true );
	add_image_size( 'full', 1000, 563, true );
	add_image_size( 'article', 350, 197, false );
	add_image_size( 'speaker', 290, 290, true );
	$defaults = array(
		'default-image'          => get_template_directory_uri() . '/img/header/header.png',
		'random-default'         => true,
		'width'                  => 1920,
		'height'                 => 200,
		'flex-height'            => false,
		'flex-width'             => false,
		'default-text-color'     => '',
		'header-text'            => false,
		'uploads'                => true,
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $defaults );
	add_editor_style( 'editor-style.css' );	
	$markup = array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', );
	add_theme_support( 'html5', $markup );	
	
}
add_action( 'after_setup_theme', 'conway_hall_init' );

function bbb_scripts() {
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js', false, '1.11.1', true );
	wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', false, '2.8.1', false );
	wp_register_script( 'gumby', get_template_directory_uri() . '/js/libs/gumby.min.js', false, '2.6', true );
	wp_register_script( 'owl', get_template_directory_uri() . '/owl-carousel/owl.carousel.min.js', false, '1.4.1', true );
	wp_register_script( 'capslide', get_template_directory_uri() . '/js/capSlide.js', false, '1.4.1', true );
	wp_register_script( 'cookie', get_template_directory_uri() . '/js/libs/cookie.js', false, '1.4.1', true );
	wp_register_script( 'main', get_template_directory_uri() . '/js/main.js', false, '2.6', true );	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'gumby' );
	wp_enqueue_script( 'owl' );
	wp_enqueue_script( 'capslide' );
	wp_enqueue_script( 'cookie' );
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'gumby' );

	wp_enqueue_script( 'main' );
}
add_action( 'wp_enqueue_scripts', 'bbb_scripts' );

function bbb_styles() {
	wp_register_style( 'open', '//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700', false, '2014' );
	wp_register_style( 'base', get_template_directory_uri() . '/css/base.css', false, '2.6' );
	wp_register_style( 'normalise', get_template_directory_uri() . '/css/normalize.css', false, '3.0.1' );
	wp_register_style( 'owl', get_template_directory_uri() . '/owl-carousel/owl.carousel.css', false, '3.0.1' );
	wp_register_style( 'theme', get_template_directory_uri() . '/owl-carousel/owl.theme.css', false, '3.0.1' );
	wp_enqueue_style( 'normalise' );
	wp_enqueue_style( 'owl' );
	wp_enqueue_style( 'theme' );
	wp_enqueue_style( 'open' );
	wp_enqueue_style( 'base' );
}
add_action( 'wp_enqueue_scripts', 'bbb_styles' );

function bbb_menu() {
	$locations = array(
		'bbbmenu' => __( 'Main Menu', 'bbb' ),
		'footermenu' => __( 'Footer Menu', 'bbb' ),
	);
	register_nav_menus( $locations );
}
add_action( 'init', 'bbb_menu' );

// Register Carousel Post Type
function carousel() {
	$labels = array(
		'name'                => _x( 'Carousels', 'Post Type General Name', 'bbb' ),
		'singular_name'       => _x( 'Carousel', 'Post Type Singular Name', 'bbb' ),
		'menu_name'           => __( 'Carousels', 'bbb' ),
		'parent_item_colon'   => __( 'Parent Carousel:', 'bbb' ),
		'all_items'           => __( 'All Carousels', 'bbb' ),
		'view_item'           => __( 'View Carousel', 'bbb' ),
		'add_new_item'        => __( 'Add New Carousel', 'bbb' ),
		'add_new'             => __( 'Add New', 'bbb' ),
		'edit_item'           => __( 'Edit Carousel', 'bbb' ),
		'update_item'         => __( 'Update Carousel', 'bbb' ),
		'search_items'        => __( 'Search Carousels', 'bbb' ),
		'not_found'           => __( 'Not found', 'bbb' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'bbb' ),
	);
	$args = array(
		'label'               => __( 'carousel', 'bbb' ),
		'description'         => __( 'Homepage Carousel', 'bbb' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'excerpt', 'thumbnail', 'page-attributes' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'carousel', $args );
}
// Hook into the 'init' action
add_action( 'init', 'carousel', 0 );

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
	echo '<div id="main" class="nine columns">';
}

function my_theme_wrapper_end() {
	echo '</div>';
}

function add_active_class_to_nav_menu($classes) {
    if (in_array('current-menu-item', $classes, true) || in_array('current_page_item', $classes, true)) {
        $classes = array_diff($classes, array('current-menu-item', 'current_page_item', 'active'));
        $classes[] = 'active';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_active_class_to_nav_menu');

class Walker_Page_Custom extends Walker_Nav_menu{
	function start_lvl(&$output, $depth=0, $args=array()){
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<div class=\"dropdown\"><ul>\n";
	}
	function end_lvl(&$output , $depth=0, $args=array()){
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul></div>\n";
	}
}

