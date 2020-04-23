<?php

/**
 * Set the theme colors
 */
add_action( 'after_setup_theme', 'elodin_register_colors' );
function elodin_register_colors() {
	add_theme_support(
		'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'White', 'prefix_textdomain' ),
				'slug' => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => esc_html__( 'Light', 'prefix_textdomain' ),
				'slug' => 'light',
				'color' => '#f5f5f5',
            ),
            array(
				'name'  => esc_html__( 'Default', 'prefix_textdomain' ),
				'slug' => 'default',
				'color' => '#666',
            ),
            array(
				'name'  => esc_html__( 'Dark', 'prefix_textdomain' ),
				'slug' => 'dark',
				'color' => '#333',
            ),
		)
	);
}