<?php
/*
Plugin Name: Pearl Plugin
Plugin URI: http://phoenix.sheridanc.on.ca/~ccit3676/
Description: Plugin for assignment 2
Author: Ekaterina Kiseleva
Author URI: http://phoenix.sheridanc.on.ca/~ccit3676/
*/
/*
* This code was taken from "http://www.wpbeginner.com/wp-tutorials/how-to-create-custom-post-types-in-wordpress/""
*/
// Our custom post type function
function ek_posttype() {
    register_post_type( 'editorial',
    // CPT Option
        array(
            'labels' => array(
                'name' => __( 'Editorial' ),
                'singular_name' => __( 'editorial' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'editorial'),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'ek_posttype' );
function ek_custom_posttype() {
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'editorial', 'Post Type General Name', 'blackpearl' ),
        'singular_name'       => _x( 'editorial', 'Post Type Singular Name', 'blackpearl' ),
        'menu_name'           => __( 'Editorial', 'blackpearl' ),
        'parent_item_colon'   => __( 'Parent  editorial', 'blackpearl' ),
        'all_items'           => __( 'All photoshoots', 'blackpearl' ),
        'view_item'           => __( 'View photoshoot', 'blackpearl' ),
        'add_new_item'        => __( 'Add new photoshoot', 'blackpearl' ),
        'add_new'             => __( 'Add New', 'blackpearl' ),
        'edit_item'           => __( 'Edit photoshoot', 'blackpearl' ),
        'update_item'         => __( 'Update Project', 'blackpearl' ),
        'search_items'        => __( 'Search photoshoot', 'blackpearl' ),
        'not_found'           => __( 'Not Found', 'blackpearl' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'blackpearl' ),
    );
// Set other options for Custom Post Type
    $args = array(
        'label'               => __( 'photoshoot', 'blackpearl' ),
        'description'         => __( ' editorial news and media', 'blackpearl' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy.
        'taxonomies'          => array( 'genres' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 7,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'editorial', $args );
}
add_action( 'init', 'ek_custom_posttype', 0 );
add_action( 'pre_get_posts', 'ek_cpt' );
function ek_cpt( $query ) {
    if ( is_home() && $query->is_main_query() )
        $query->set( 'post_type', array( 'post', ' editorial' ) );
    return $query;
}
function intro_video($attr, $url) {
  return '<iframe src="https://www.youtube.com/embed/QOrCQ-v7C3U" frameborder="0" allowfullscreen></iframe>';
}
add_shortcode('video', 'intro_video');
?>
