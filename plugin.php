<?php
/*
Plugin Name: Pearl Plugin
Plugin URI: http://phoenix.sheridanc.on.ca/~ccit3676/
Description: Plugin for assignment 2
Author: Ekaterina Kiseleva
Author URI: http://phoenix.sheridanc.on.ca/~ccit3676/
*/

// Source of the widget code - http://michaelsoriano.com/wordpress-widget-custom-post-types/

class CustomWidget extends WP_Widget {
    public function __construct() {
    $widget_ops    = array(
    'classname'    => 'widget_postblock',
    'description'  => __( 'This custom widget will show 2 posts from the cpt') );
    parent::__construct('show_custompost', __('Sidebar Posts', 'editorial'), $widget_ops);
               }
         public function widget ( $args, $instance ) {

    ?>
<div id="widgetstyle" role="main">
    <?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$wp_query = new WP_Query();
$wp_query->query('post_type=editorial&posts_per_page=2' . '&paged=' . $paged);
?>

<?php if ($wp_query->have_posts()) : ?>

               <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

                              <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                              <div id="sidebar">
                                <?php the_title();?>
                                <?php the_post_thumbnail('small');?>
                              </div>
                  </article>

               <?php endwhile; ?>
<?php endif; ?>
    </div>
    <?php

               }

}

add_action( 'widgets_init', function(){
     register_widget( 'CustomWidget' );
});

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

// Source of the widget code - https://premium.wpmudev.org/blog/10-awesome-shortcodes-for-your-wordpress-blog/?ench=b&utm_expid=3606929-78.ZpdulKKETQ6NTaUGxBaTgQ.1&utm_referrer=https%3A%2F%2Fwww.facebook.com%2Fl.php%3Fu%3Dhttps%253A%252F%252Fpremium.wpmudev.org%252Fblog%252F10-awesome-shortcodes-for-your-wordpress-blog%252F%26h%3DUAQE5LozT
function intro_video($attr, $url) {
  return '<iframe src="https://www.youtube.com/embed/QOrCQ-v7C3U" frameborder="0" allowfullscreen></iframe>';
}
add_shortcode('video', 'intro_video');
?>
