<?php

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'rb_do_custom_loop' );

genesis();


function rb_do_custom_loop() {
    
    echo '<div class="entry-wrap">';

    if ( have_posts() ) : while ( have_posts() ) : the_post();

            $post_id = get_the_ID();
            $title = get_the_title();
            $permalink = get_the_permalink();
            $excerpt = apply_filters( 'the_content', get_the_excerpt() );
            $imageurl = get_the_post_thumbnail_url( $post_id, 'large' );
            
    		do_action( 'genesis_before_entry' );

    		printf( '<article %s>', genesis_attr( 'entry' ) );
            
                echo '<div class="featured-image-wrap">';

                    if ( has_post_thumbnail() ) 
                        printf( '<a href="%s" class="featured-image" style="background-image:url( %s )"></a>', $permalink, $imageurl );
                    
                echo '</div>';
                    
                echo '<div class="archive-content">';

                    // printf( '<h2 class="entry-title"><a href="%s">%s</a></h2>', $permalink, $title );
                    
                    do_action( 'genesis_entry_header' );
                    
                    if ( $excerpt ) 
                        printf( '<div class="excerpt">%s</div>', $excerpt );
                        
                    if ( $permalink )
                    printf( '<a href="%s" class="readmore">Read More</a>', $permalink );
                    
                    edit_post_link();
                                    
                echo '</div>';

    		echo '</article>';

    		do_action( 'genesis_after_entry' );

    	endwhile; //* end of one post
    	do_action( 'genesis_after_endwhile' );

    else : //* if no posts exist
    	do_action( 'genesis_loop_else' );
    endif; //* end loop
    
    echo '</div>';
    
    wp_reset_postdata();
}