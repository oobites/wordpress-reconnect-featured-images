<?php
/**
 * Plugin Name: Reconnect Featured Images
 * Plugin URI: http://github.com/oobites/wordpress-reconnect-featured-images
 * Description: reconnects uploaded images to 'featured image' on posts that contain the image
 * Version: .2
 * Author: Thane Hemish
 * Author URI: http://www.behance.net/oobites
 * License: GPL2
 */
 
  /*  Copyright 2014  Thane Hemish ()

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/** Step 2 (from text above). */
add_action( 'admin_menu', 'my_plugin_menu' );

/** Step 1. */
function my_plugin_menu() {
	add_menu_page( 'Reconnect Featured Images Options', 'Reconnect Featured Images', 'manage_options', 'reconnect-featured-images-identifier', 'my_plugin_options' );
}

/** Step 3. */
function my_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<p>Here is where the form would go if I actually had options.</p>';
	echo '</div>';
}

// Enqueue the needed Javascript and CSS
function admin_enqueues( $hook_suffix ) {
	if ( $hook_suffix != $this->menu_id )
		return;

	wp_enqueue_style( 'jquery-ui-regenthumbs', plugins_url( 'jquery-ui/redmond/jquery-ui-1.7.2.custom.css', __FILE__ ), array(), '1.7.2' );
}

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

/*
 * @TODO:
 *
 * - replace Reconnect_Featured_Images_Admin with the name of the class defined in
 *   `class-reconnect-featured-images-admin.php`
 *
 * If you want to include Ajax within the dashboard, change the following
 * conditional to:
 *
 * if ( is_admin() ) {
 *   ...
 * }
 *
 * The code below is intended to to give the lightest footprint possible.
 */
if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-reconnect-featured-images-admin.php' );
	add_action( 'plugins_loaded', array( 'Reconnect_Featured_Images_Admin', 'get_instance' ) );

}
?>