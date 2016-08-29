<?php
/**
 * Plugin Name: Advanced Custom Fields: WP-Polls Field Type
 * Plugin URI: https://github.com/digitoimistodude/acf-wp-polls-redux
 * Description: Get WP-Polls poll ID to a post.
 * Version: 1.0.0
 * Author: Digitoimisto Dude Oy
 * Author URI: https://github.com/digitoimistodude
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package acf_plugin_wp_polls_redux
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Check if class already exists
if ( ! class_exists('acf_plugin_wp_polls_redux') ) :

class acf_plugin_wp_polls_redux {

	/*
	*  __construct
	*
	*  This function will setup the class functionality
	*
	*  @type	function
	*  @date	17/02/2016
	*  @since	1.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/

	function __construct() {

		// vars
		$this->settings = array(
			'version'	=> '1.0.0',
			'url'		=> plugin_dir_url( __FILE__ ),
			'path'		=> plugin_dir_path( __FILE__ )
		);


		// set text domain
		// https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
		load_plugin_textdomain( 'acf-wp_polls_redux', false, plugin_basename( dirname( __FILE__ ) ) . '/lang' );


		// include field
		add_action('acf/include_field_types', 	array($this, 'include_field_types')); // v5
		add_action('acf/register_fields', 		array($this, 'include_field_types')); // v4

	}


 /**
	*  include_field_types
	*
	*  This function will include the field type class
	*
	*  @type	function
	*  @date	29/08/2016
	*  @since	1.0.0
	*
	*  @param	$version (int) major ACF version. Defaults to false
	*  @return	n/a
	*/

	function include_field_types( $version = false ) {
		include_once('fields/acf-wp_polls_redux-v5.php');
	}

}


// initialize
new acf_plugin_wp_polls_redux();


// class_exists check
endif;
