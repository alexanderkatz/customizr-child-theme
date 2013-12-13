<?php
/**
* Customizr functions
* 
* The best way to add your own functions to Customizr is to create a child theme
* http://codex.wordpress.org/Child_Themes
*
* This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
* General Public License as published by the Free Software Foundation; either version 2 of the License, 
* or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
* even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*
* You should have received a copy of the GNU General Public License along with this program; if not, write 
* to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*
* @package   	Customizr
* @subpackage 	functions
* @since     	3.0
* @author    	Nicolas GUILLAUME <nicolas@themesandco.com>
* @copyright 	Copyright (c) 2013, Nicolas GUILLAUME
* @link      	http://themesandco.com/customizr
* @license   	http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */


/**
* Singleton factory : on demand class single instanciation
* Thanks to Ben Doherty (https://github.com/bendoh) for the great programming approach
* 
*
* @since     Customizr 3.0
*/
/*Custom Post Type: Events*/


/*-------------------------------------------------------------- */
/*Center Header Block Items*/

add_filter('tc_logo_title_display', 'custom_center_brand');
function custom_center_brand($output) {
return preg_replace('/brand span3/', 'brand span10 offset1', $output);
}

// prevent the output of tc_social_in_header: 
add_filter('tc_social_in_header', 'prevent_social_in_header');
function prevent_social_in_header($output) {
return;
}

// remove span9 from navbar-wrapper: 
add_filter('tc_navbar_display', 'remove_span9_navbar_display');
function remove_span9_navbar_display($output) {
return preg_replace('/navbar-wrapper clearfix span9/', 'navbar-wrapper clearfix', $output);
}

/*-------------------------------------------------------------- */

/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {

	register_sidebar( array(
		'name' => 'My Sidebar',
		'id' => 'my_sidebar',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );
/*-------------------------------------------------------------- */

/**
 * Move the the slider to the top of the page
 */

//we hook the code on the wp_head hook, this way it will be executed before any html rendering.
add_action ( 'wp_head' , 'move_my_slider');
function move_my_slider() {
	//we unhook the slider
	remove_action( '__after_header' , array( TC_slider::$instance , 'tc_slider_display' ));

	//we re-hook the slider. Check the priority here : set to 0 to be the first in the list of different actions hooked to this hook 
	add_action( '__header' , array( TC_slider::$instance , 'tc_slider_display' ), 0);
}

/*-------------------------------------------------------------- */

/**
 * Move the featured pages below the main content
 */

//we hook the code on the wp_head hook, this way it will be executed before any html rendering.
add_action ( 'wp_head' , 'move_my_fp');
function move_my_fp() {
	//we unhook the featured pages
	remove_action  ( '__before_main_container', array( TC_featured_pages::$instance , 'tc_fp_block_display'), 10 );

	//we re-hook the block. Check out the priority here : set to 0 to be the first in the list of different actions hooked to this hook 
	add_action  ( '__after_main_container', array( TC_featured_pages::$instance , 'tc_fp_block_display'), 0 );
}

/*-------------------------------------------------------------- */

/**
 * Remove Tagline Section
 */

function remove_tagline() {
	//we unhook the featured pages
	remove_action  ( '__navbar', 'tc_tagline_display');
}

/* Move Admin Bar
-------------------------------------------------------------- */