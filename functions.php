<?php

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Defines the child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Lisa Marcucci' );
define( 'CHILD_THEME_URL', 'https://elod.in' );
define( 'CHILD_THEME_VERSION', '0.1' );

// Sets up the Theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function genesis_sample_localization_setup() {

	load_child_theme_textdomain( 'genesis-sample', get_stylesheet_directory() . '/languages' );

}

// Adds helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds image upload and color select to Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

// Adds WooCommerce support.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Adds the required WooCommerce styles and Customizer CSS.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Adds the Genesis Connect WooCommerce notice.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

add_action( 'after_setup_theme', 'genesis_child_gutenberg_support' );
/**
 * Adds Gutenberg opt-in features and styling.
 *
 * @since 2.7.0
 */
function genesis_child_gutenberg_support() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.
	require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';
}

add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function genesis_sample_enqueue_scripts_styles() {

	wp_enqueue_style(
		'genesis-sample-fonts',
		'//fonts.googleapis.com/css?family=Playfair+Display:400,400i|Source+Sans+Pro:400,400i,600,600i&display=swap',
		array(),
		CHILD_THEME_VERSION
	);

	// Add the main stylesheet
	wp_enqueue_style(
		'theme-style',
		get_stylesheet_directory_uri() . "/css/theme-style.css",
		array(),
		CHILD_THEME_VERSION
	);

	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script(
		'genesis-sample-responsive-menu',
		get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js",
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);

	wp_localize_script(
		'genesis-sample-responsive-menu',
		'genesis_responsive_menu',
		genesis_sample_responsive_menu_settings()
	);

	// wp_enqueue_script(
	// 	'genesis-sample',
	// 	get_stylesheet_directory_uri() . '/js/genesis-sample.js',
	// 	array( 'jquery' ),
	// 	CHILD_THEME_VERSION,
	// 	true
	// );

	wp_enqueue_script(
		'nav-scroll-detection',
		get_stylesheet_directory_uri() . '/js/nav-scroll-detection.js',
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);

	// wp_enqueue_script(
	// 	'smoothscroll',
	// 	get_stylesheet_directory_uri() . '/js/smoothscroll.js',
	// 	array( 'jquery' ),
	// 	CHILD_THEME_VERSION,
	// 	true
	// );

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
	  add_theme_support( 'editor-styles' );
  
	// Enqueue editor styles
	add_editor_style( "/css/gutenberg-style.css" );
}
add_action( 'after_setup_theme', 'gutenberg_editor_style_setup' );

/**
 * Defines responsive menu settings.
 *
 * @since 2.3.0
 */
function genesis_sample_responsive_menu_settings() {

	$settings = array(
		'mainMenu'         => __( 'Menu', 'genesis-sample' ),
		'menuIconClass'    => 'dashicons-before dashicons-menu',
		'subMenu'          => __( 'Submenu', 'genesis-sample' ),
		'subMenuIconClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'      => array(
			'combine' => array(
				'.nav-primary',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Adds support for HTML5 markup structure.
add_theme_support( 'html5', genesis_get_config( 'html5' ) );

// Adds support for accessibility.
add_theme_support( 'genesis-accessibility', genesis_get_config( 'accessibility' ) );

// Adds viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Adds custom logo in Customizer > Site Identity.
add_theme_support( 'custom-logo', genesis_get_config( 'custom-logo' ) );

// Renames primary and secondary navigation menus.
add_theme_support( 'genesis-menus', genesis_get_config( 'menus' ) );

// Adds image sizes.
add_image_size( 'sidebar-featured', 75, 75, true );

// Adds support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Adds support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Removes header right widget area.
unregister_sidebar( 'header-right' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Removes output of primary navigation right extras.
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

add_action( 'genesis_theme_settings_metaboxes', 'genesis_sample_remove_metaboxes' );
/**
 * Removes output of unused admin settings metaboxes.
 *
 * @since 2.6.0
 *
 * @param string $_genesis_admin_settings The admin screen to remove meta boxes from.
 */
function genesis_sample_remove_metaboxes( $_genesis_admin_settings ) {

	remove_meta_box( 'genesis-theme-settings-header', $_genesis_admin_settings, 'main' );
	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_admin_settings, 'main' );

}

add_filter( 'genesis_customizer_theme_settings_config', 'genesis_sample_remove_customizer_settings' );
/**
 * Removes output of header and front page breadcrumb settings in the Customizer.
 *
 * @since 2.6.0
 *
 * @param array $config Original Customizer items.
 * @return array Filtered Customizer items.
 */
function genesis_sample_remove_customizer_settings( $config ) {

	unset( $config['genesis']['sections']['genesis_header'] );
	unset( $config['genesis']['sections']['genesis_breadcrumbs']['controls']['breadcrumb_front_page'] );
	return $config;

}

// Displays custom logo.
add_action( 'genesis_site_title', 'the_custom_logo', 0 );

// Repositions primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Repositions the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 10 );

add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 2.2.3
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' !== $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;
	return $args;

}

add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 2.2.3
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function genesis_sample_author_box_gravatar( $size ) {

	return 90;

}

add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since 2.2.3
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;
	return $args;

}


/**
 * Set the theme colors
 */
add_action( 'after_setup_theme', 'elodin_register_colors' );
function elodin_register_colors() {
	add_theme_support(
		'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'White', 'marcucci' ),
				'slug' => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => esc_html__( 'Light', 'marcucci' ),
				'slug' => 'light',
				'color' => '#eeeae5',
            ),
            array(
				'name'  => esc_html__( 'Default', 'marcucci' ),
				'slug' => 'default',
				'color' => '#666',
            ),
            array(
				'name'  => esc_html__( 'Tan', 'marcucci' ),
				'slug' => 'tan',
				'color' => '#DAD2C6',
			),
			array(
				'name'  => esc_html__( 'Navy', 'marcucci' ),
				'slug' => 'navy',
				'color' => '#023057',
			),
			array(
				'name'  => esc_html__( 'Blue', 'marcucci' ),
				'slug' => 'blue',
				'color' => '#4EA1CF',
			),
		)
	);
}

///////////////////////
// PREHEADER WIDGETS //
///////////////////////

/**
 * Header customization
 */
//* Register the widget area
genesis_register_sidebar( array(
	'id'		=> 'preheader',
	'name'		=> __( 'Preheader', 'elodin-twentynineteen' ),
	'description'	=> __( 'Displays before anything else.', 'elodin-twentynineteen' ),
) );

//* Add the widget area before the opening wrap
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
add_action( 'genesis_header', 'elodin_header_markup_open', 5 );

/**
 * This is a modified version of the core genesis function, instead inserting the preheader area
 */
function elodin_header_markup_open() {

	genesis_markup( array(
		'open'    => '<header %s>',
		'context' => 'site-header',
	) );

	if ( is_active_sidebar( 'preheader' ) ) {
		genesis_widget_area ('preheader', array(
			'before' => '<div class="preheader"><div class="wrap">',
			'after' => '</div></div>',
		) );
	}

	genesis_structural_wrap( 'header' );

}


///////////////
// PREFOOTER //
///////////////

// //* Register the widget area
// genesis_register_sidebar( array(
// 	'id'		=> 'above-footer',
// 	'name'		=> __( 'Above footer', 'nabm' ),
// ) );

// //* Display the widget area
// add_action( 'genesis_before_footer', 'nabm_add_page_content' );
// function nabm_add_page_content() {
	
// 	//* Bail if we're on the contact page
// 	if ( is_page('schedule') )
// 		return;

// 	genesis_widget_area ('above-footer', array(
//         'before' => '<div class="above-footer"><div class="wrap">',
//         'after' => '</div></div>',
// 	) );
// }


//* Output books before
// add_action( 'before_loop_layout_books', 'rb_books_before' );
function rb_books_before( $args ) {
	// wp_enqueue_script( 'SCRIPTHANDLE' );
}

//* Output each books
add_action( 'add_loop_layout_books', 'rb_books_each' );
function rb_books_each() {

	//* Global vars
	global $post;
	$id = get_the_ID();

	//* Vars
	$title = get_the_title();
	$permalink = get_the_permalink();
	$author = get_post_meta( $id, 'author', true );
	$publisher = get_post_meta( $id, 'publisher', true );
	$purchase_url = get_post_meta( $id, 'purchase_url', true );
	$year = get_post_meta( $id, 'year', true );

	//* Markup
	if ( has_post_thumbnail() ) {
		printf( '<div class="featured-image" style="background-image:url( %s )">', get_the_post_thumbnail_url( $id, 'large' ) );

			if ( $purchase_url )
				printf( '<div class="purchase-container"><a href="%s" target="_blank" class="button">Purchase</a></div>', $purchase_url );

		echo '</div>';

	}



	if ( $title )
		printf( '<h3>%s</h3>', $title );

	if ( $author )
		printf( '<div class="author">By %s</div>', $author );

	if ( $publisher )
		printf( '<div class="publisher">%s</div>', $publisher );

	if ( $year )
		printf( '<div class="year">%s</div>', $year );


}



//* Output websites before
// add_action( 'before_loop_layout_websites', 'rb_websites_before' );
function rb_websites_before( $args ) {
	// wp_enqueue_script( 'SCRIPTHANDLE' );
}

//* Output each websites
add_action( 'add_loop_layout_websites', 'rb_websites_each' );
function rb_websites_each() {

	//* Global vars
	global $post;
	$id = get_the_ID();

	//* Vars
	$title = get_the_title();
	$url = get_post_meta( $id, 'url', true );

	//* Markup
	if ( has_post_thumbnail() )
		printf( '<div class="featured-wrap"><a class="featured-image" target="_blank" href="%s" style="background-image:url( %s )"></a></div>', $url, get_the_post_thumbnail_url( $id, 'large' ) );

	if ( $title )
		printf( '<h3>%s</h3>', $title );

	the_excerpt();
}


