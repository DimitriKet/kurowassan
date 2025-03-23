<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package kurowassan
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function kurowassan_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'kurowassan_body_classes' );

/**
 * Add page-specific background color classes to different pages
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function kurowassan_page_background_classes( $classes ) {
    // Home page - light butterscotch background
    if ( is_front_page() ) {
        $classes[] = 'bg-butterscotch';
    }
    
    // About page
    if ( is_page('about') ) {
        $classes[] = 'bg-light';
    }
    
    // Menu page
    if ( is_page('menu') ) {
        $classes[] = 'bg-butterscotch';
    }
    
    // Recipe page
    if ( is_page('recipe') || is_singular('recipe') ) {
        $classes[] = 'bg-light';
    }
    
    // Contact page
    if ( is_page('contact') ) {
        $classes[] = 'bg-light';
    }
    
    // Blog/News pages
    if ( is_home() || is_category() || is_tag() || is_author() || is_date() ) {
        $classes[] = 'bg-butterscotch';
    }
    
    // Single post
    if ( is_singular('post') ) {
        $classes[] = 'bg-light';
    }
    
    // WooCommerce pages
    if ( class_exists( 'WooCommerce' ) ) {
        if ( is_shop() || is_product_category() ) {
            $classes[] = 'bg-butterscotch';
        }
        
        if ( is_product() ) {
            $classes[] = 'bg-light';
        }
        
        if ( is_cart() || is_checkout() ) {
            $classes[] = 'bg-light';
        }
    }
    
    return $classes;
}
add_filter( 'body_class', 'kurowassan_page_background_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function kurowassan_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'kurowassan_pingback_header' );
