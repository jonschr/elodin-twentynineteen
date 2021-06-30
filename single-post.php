<?php

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Add the the categories
add_action( 'genesis_entry_header', 'blf_category_header', 5 );

// //* Position post info above post title
// remove_action( 'genesis_entry_header', 'genesis_post_info', 12);
// add_action( 'genesis_entry_header', 'genesis_post_info', 9 );

genesis();

function blf_category_header() {
        
    $cats = get_the_category( get_the_ID() );
    
    if ( $cats ) {
        
        echo '<h4>';
        
            foreach ( $cats as $cat ) {
                
                $link = get_category_link( $cat );
                $name = $cat->name;
                                
                printf( '<span class="categories-list"><a href="%s">%s</a></span>', $link, $name );
                
            }
        
        echo '</h4>';
    }
}