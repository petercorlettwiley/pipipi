<?php
/*
Plugin Name: PiPiPi Custom Post Types
Plugin URI: http://www.pcwiley.net
Description: Plugin to set up custom post types for the PiPiPi website
Version: 1.0
Author: PC Wiley
Author http://www.pcwiley.net
*/


/**
 * Call to Actions
 *
 */
function pipipi_mixes_init() {
  $labels = array(
    'name'                  => _x( 'Mixes', 'Post type general name', 'textdomain' ),
    'singular_name'         => _x( 'Mix', 'Post type singular name', 'textdomain' ),
    'menu_name'             => _x( 'Mixes', 'Admin Menu text', 'textdomain' ),
    'name_admin_bar'        => _x( 'Mix', 'Add New on Toolbar', 'textdomain' ),
    'add_new'               => __( 'Add New', 'textdomain' ),
    'add_new_item'          => __( 'Add New Mix', 'textdomain' ),
    'new_item'              => __( 'New Mix', 'textdomain' ),
    'edit_item'             => __( 'Edit Mix', 'textdomain' ),
    'view_item'             => __( 'View Mix', 'textdomain' ),
    'all_items'             => __( 'All Mixes', 'textdomain' ),
    'search_items'          => __( 'Search Mixes', 'textdomain' ),
    'parent_item_colon'     => __( 'Parent Mixes:', 'textdomain' ),
    'not_found'             => __( 'No Mixes found.', 'textdomain' ),
    'not_found_in_trash'    => __( 'No Mixes found in Trash.', 'textdomain' ),
    'featured_image'        => _x( 'Mix art', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
    'set_featured_image'    => _x( 'Set mix art', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
    'remove_featured_image' => _x( 'Remove mix art', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
    'use_featured_image'    => _x( 'Use as mix art', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
    'archives'              => _x( 'Mix archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
    'insert_into_item'      => _x( 'Insert into Mix', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
    'uploaded_to_this_item' => _x( 'Uploaded to this Mix', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
    'filter_items_list'     => _x( 'Filter mixes list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
    'items_list_navigation' => _x( 'Mixes list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
    'items_list'            => _x( 'Mixes list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
  );
 
  $args = array(
    'description'         => __( 'Mixes', 'textdomain' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'author', 'revisions', 'custom-fields', ),
    'hierarchical'        => false,
    'public'              => true,
    'rewrite'             => array( 'slug' => 'mix' ),
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 3,
    'menu_icon'           => 'dashicons-album',
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
    'show_in_rest'        => true,
     
    // This is where we add taxonomies to our CPT
    //'taxonomies'          => array( 'artist' ), 

  );
 
  register_post_type( 'mix', $args );
  flush_rewrite_rules();
}
add_action( 'init', 'pipipi_mixes_init' );

/**
 * Register 'artist' taxonomy for mixes
 *
 */
function pipipi_register_taxonomy_artist() {
  $labels = array(
    'name'              => _x( 'Artists', 'taxonomy general name' ),
    'singular_name'     => _x( 'Artist', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Artists' ),
    'all_items'         => __( 'All Artists' ),
    'parent_item'       => __( 'Parent Artist' ),
    'parent_item_colon' => __( 'Parent Artist:' ),
    'not_found'         => __( 'No artists found.', 'textdomain' ),
    'not_found_in_trash'=> __( 'No artists found in Trash.', 'textdomain' ),
    'edit_item'         => __( 'Edit Artist' ),
    'update_item'       => __( 'Update Artist' ),
    'add_new_item'      => __( 'Add New Artist' ),
    'new_item_name'     => __( 'New Artist Name' ),
    'menu_name'         => __( 'Artists' ),
  );
  $args   = array(
    'hierarchical'      => true, // make it hierarchical (like categories)
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'show_in_rest'      => true,
    'rewrite'           => [ 'slug' => 'artist' ],
  );

  register_taxonomy( 'artist', [ 'mix' ], $args );
}
add_action( 'init', 'pipipi_register_taxonomy_artist' );