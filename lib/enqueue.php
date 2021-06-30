<?php

/**
 * Editor styles
 */
add_action( 'after_setup_theme', 'gutenberg_editor_style_setup' );
function gutenberg_editor_style_setup() {

    // Add support for editor styles
    add_theme_support( 'editor-styles' );

    // Enqueue editor styles
    add_editor_style( "/css/gutenberg-style.css" );
    
    // Google fonts
    add_editor_style( 'https://fonts.googleapis.com/css?family=Source+Sans+Pro' );
}

/**
 * Frontend styles
 */
add_action( 'wp_enqueue_scripts', 'elodin_twentynineteen_enqueue_scripts_styles' );
function elodin_twentynineteen_enqueue_scripts_styles() {

    wp_enqueue_style( 'gfont-source-sans',
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro',
        array(),
        CHILD_THEME_VERSION
    );

    // Add the main stylesheet
    wp_enqueue_style('theme-style',
        get_stylesheet_directory_uri() . "/css/theme-style.css",
        array(),
        CHILD_THEME_VERSION
    );

    wp_enqueue_style( 'dashicons' );

    $suffix=(defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '': '.min';
    wp_enqueue_script( 'genesis-sample-responsive-menu',
        get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js",
        array('jquery'),
        CHILD_THEME_VERSION,
        true
    );

    wp_localize_script( 'genesis-sample-responsive-menu',
        'genesis_responsive_menu',
        genesis_sample_responsive_menu_settings()
    );

    wp_enqueue_script('nav-scroll-detection',
        get_stylesheet_directory_uri() . '/js/nav-scroll-detection.js',
        array('jquery'),
        CHILD_THEME_VERSION,
        true
    );

    wp_register_script( 'slick-main-script',
        get_stylesheet_directory_uri() . '/vendor/slick/slick.min.js',
        array('jquery'),
        CHILD_THEME_VERSION,
        true
    );

    wp_register_style( 'slick-main-styles',
        get_stylesheet_directory_uri() . '/vendor/slick/slick.css',
        array(),
        CHILD_THEME_VERSION
    );

    wp_register_style( 'slick-main-theme',
        get_stylesheet_directory_uri() . '/vendor/slick/slick-theme.css',
        array(),
        CHILD_THEME_VERSION
    );
    
    wp_enqueue_script( 'reverse-columns-mobile',
        get_stylesheet_directory_uri() . '/js/reverse-columns-mobile.js',
        array('jquery'),
        CHILD_THEME_VERSION,
        true
    );

}

