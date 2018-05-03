<?php

/*
* Creating a function to create our CPT
*/
 
function custom_post_type() {
 
// Set UI labels for Custom Post Type
    $sliderlabels = array(
        'name'                => _x( 'Slider', 'slider', 'gamiphy' ),
        'singular_name'       => _x( 'slider', 'Post Type Singular Name', 'gamiphy' ),
        'menu_name'           => __( 'Slider', 'gamiphy' ),
        'parent_item_colon'   => __( 'Parent slider', 'gamiphy' ),
        'all_items'           => __( 'All slider', 'gamiphy' ),
        'view_item'           => __( 'View slider', 'gamiphy' ),
        'add_new_item'        => __( 'Add New slider', 'gamiphy' ),
        'add_new'             => __( 'Add New', 'gamiphy' ),
        'edit_item'           => __( 'Edit slider', 'gamiphy' ),
        'update_item'         => __( 'Update slider', 'gamiphy' ),
        'search_items'        => __( 'Search slider', 'gamiphy' ),
        'not_found'           => __( 'Not Found', 'gamiphy' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'gamiphy' ),
    );
     
// Set other options for Custom Post Type
     
    $sliderargs = array(
        'label'               => __( 'Slider', 'gamiphy' ),
        'description'         => __( 'Slider Image', 'gamiphy' ),
        'labels'              => $sliderlabels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'thumbnail','excerpt' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
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
    register_post_type( 'slider', $sliderargs );
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
 
add_action( 'init', 'custom_post_type', 0 );