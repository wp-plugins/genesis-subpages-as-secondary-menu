<?php
/*
Plugin Name: Genesis Subpages as Secondary Menu
Plugin URI: http://www.billerickson.net
Description: Replaces the manually managed Secondary Menu with one that automatically lists the current section's subpages. You must be using the Genesis Framework and have the Secondary Menu enabled (Genesis > Theme Settings > Navigation Settings).
Version: 1.1
Author: Bill Erickson
Author URI: http://www.billerickson.net
License: GPLv2 
*/

add_filter('genesis_do_subnav', 'be_subnav');
function be_subnav( $subnav_output ){

	// Find top level parent
	global $post;
	while( $post->post_parent ) $post = get_post( $post->post_parent );
		
	// Build a menu listing top level parent's children
	$args = array(
		'child_of' => $post->ID,
		'title_li' => '',
		'echo' => false,
	);
	$subnav = wp_list_pages( apply_filters( 'be_genesis_subpages_args', $args ) );
	
	// Output the menu (from genesis/lib/structure/menu.php)
	$subnav_output = sprintf( '<div id="subnav">%2$s%1$s%3$s</div>', $subnav, genesis_structural_wrap( 'subnav', '<div class="wrap">', 0 ), genesis_structural_wrap( 'subnav', '</div><!-- end .wrap -->', 0 ) );
	
	return $subnav_output;
		
}



?>