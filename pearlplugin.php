
<?php
/*
  Plugin name: Blackpearl
  Description: Just Another Shortcode Attempt
  Author: Ekaterina Kiseleva
  Version: 1.0
*/
//http://www.wpbeginner.com/wp-tutorials/how-to-create-custom-post-types-in-wordpress/

function ek_posttype() {
    register_post_type( 'editorial',
    // CPT Options
        array(
            'labels' => array(
            'name' => __( 'Editorial' ),
            'singular_name' => __( 'Editorial' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'Editorial'),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'ek_posttype' );


function ek_custom_post_type() {


// Set UI labels for Custom Post Type

    $labels = array(
        'name'                => _x( 'Editorial', 'Post Type General Name', 'blackpearl' ),
        'singular_name'       => _x( 'Editorial', 'Post Type Singular Name', 'blackpearl' ),
        'menu_name'           => __( 'Editorial', 'blackpearl' ),
        'parent_item_colon'   => __( 'Editorial', 'blackpearl' ),
        'all_items'           => __( 'Editorial', 'blackpearl' ),
        'view_item'           => __( 'View Photoshoot', 'blackpearl' ),
        'add_new_item'        => __( 'Add New Photoshoot', 'blackpearl' ),
        'add_new'             => __( 'Add New', 'blackpearl' ),
        'edit_item'           => __( 'Edit Photoshoot', 'blackpearl' ),
        'update_item'         => __( 'Update Photoshoot', 'blackpearl' ),
        'search_items'        => __( 'Search Photoshoot', 'blackpearl' ),
        'not_found'           => __( 'Not Found', 'blackpearl' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'blackpearl' ),
    );

// Set other options for Custom Post Type

    $args = array(
        'label'               => __( 'Editorial', 'blackpearl' ),
        'description'         => __( 'Editorial Photoshoot news and reviews', 'blackpearl' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'taxonomies'          => array( 'names' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );

    // Registering your Custom Post Type
    register_post_type( 'editorial', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'ek_custom_post_type', 0 );




add_action( 'pre_get_posts', 'add_my_post_types_to_query' );
function add_my_post_types_to_query( $query ) {
    if ( is_home() && $query->is_main_query() )
        $query->set( 'post_type', array( 'post', 'editorial' ) );
    return $query;
}

?>
