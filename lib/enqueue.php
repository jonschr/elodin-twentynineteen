<?php 

add_action('wp_enqueue_scripts', 'elodin_twentynineteen_enqueue_scripts_styles');
function elodin_twentynineteen_enqueue_scripts_styles() {

    wp_enqueue_style('genesis-sample-fonts',
        '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,700&display=swap',
        array(),
        CHILD_THEME_VERSION);

    // Add the main stylesheet
    wp_enqueue_style('theme-style',
        get_stylesheet_directory_uri() . "/css/theme-style.css",
        array(),
        CHILD_THEME_VERSION);

    wp_enqueue_style('dashicons');

    $suffix=(defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '': '.min';
    wp_enqueue_script('genesis-sample-responsive-menu',
        get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js",
        array('jquery'),
        CHILD_THEME_VERSION,
        true);

    wp_localize_script('genesis-sample-responsive-menu',
        'genesis_responsive_menu',
        genesis_sample_responsive_menu_settings());

    // wp_enqueue_script(
    // 	'genesis-sample',
    // 	get_stylesheet_directory_uri() . '/js/genesis-sample.js',
    // 	array( 'jquery' ),
    // 	CHILD_THEME_VERSION,
    // 	true
    // );

    wp_enqueue_script('nav-scroll-detection',
        get_stylesheet_directory_uri() . '/js/nav-scroll-detection.js',
        array('jquery'),
        CHILD_THEME_VERSION,
        true);

    // wp_enqueue_script(
    // 	'smoothscroll',
    // 	get_stylesheet_directory_uri() . '/js/smoothscroll.js',
    // 	array( 'jquery' ),
    // 	CHILD_THEME_VERSION,
    // 	true
    // );

    wp_register_script('slick-main-theme',
        get_stylesheet_directory_uri() . '/vendor/slick/slick.min.js',
        array('jquery'),
        CHILD_THEME_VERSION,
        true);

    wp_register_style('slick-main-styles',
        get_stylesheet_directory_uri() . '/vendor/slick/slick.css',
        array(),
        CHILD_THEME_VERSION);

    wp_register_style('slick-main-styles',
        get_stylesheet_directory_uri() . '/vendor/slick/slick-theme.css',
        array(),
        CHILD_THEME_VERSION);

}

/**
 * Gutenberg styles for the backend
 *
 */
// add_action( 'enqueue_block_editor_assets', 'elodin_enqueue_gutenberg_styles' );
// function elodin_enqueue_gutenberg_styles() {

//     wp_enqueue_style(
// 		'elodin-gutenberg-style',
// 		get_stylesheet_directory_uri() . "/css/gutenberg-style.css",
// 		array(),
// 		CHILD_THEME_VERSION
// 	);

// }

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function gutenberg_editor_style_setup() {

    // Add support for editor styles
    add_theme_support('editor-styles');

    // Enqueue editor styles
    add_editor_style("/css/gutenberg-style.css");
}

add_action('after_setup_theme', 'gutenberg_editor_style_setup');