<?php 
/*
Plugin Name: WP-Architect Shortcodes
Description: Various Shortcodes Package
Plugin URI: http://www.wp-architect.com
Author: Matthew Ell
Author URI: http://www.matthewell.com
Version: 1.0.0
License: GPL2
Text Domain: wp-arch
Domain Path: wp-arch
*/

/*

    Copyright (C) 2015  Matthew Ell  ell.matthew@gmail.com

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

defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

if ( ! class_exists( 'ShortCodePackClass' ) ) {
	class ShortCodePackClass {
		//  Initialize data that is going to be used throughout the class
		public function __construct() {
			if ( !is_admin() ) :
				add_action( 'wp_enqueue_scripts', array( $this, 'wp_arch_sc_scripts_and_styles_init' ) );
			endif;
			$this->wp_arch_sc_load_includes();
		}

		function wp_arch_sc_scripts_and_styles_init() {
			wp_enqueue_style( 'wp_arch_short_styles', plugin_dir_url( __FILE__ ) . 'styles/styles.min.css', array(), null, 'all' );
			wp_enqueue_style('wp_arch_accord_styles', '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.min.css', array(), null, 'screen');
			wp_enqueue_script( 'wp_arch_short_scripts', plugin_dir_url( __FILE__ ) . 'scripts/scripts.min.js', array('jquery','jquery-ui-accordion','jquery-ui-tabs'), null, true );
		}

		private function wp_arch_sc_load_includes() {
			require_once plugin_dir_path( __FILE__ ) . 'includes/shortcode-pack-utility.php';
			require_once plugin_dir_path( __FILE__ ) . 'includes/shortcode-pack-admin.php';
			require_once plugin_dir_path( __FILE__ ) . 'includes/shortcode-pack-accordion.php';
			require_once plugin_dir_path( __FILE__ ) . 'includes/shortcode-pack-grids.php';
			require_once plugin_dir_path( __FILE__ ) . 'includes/shortcode-pack-tabs.php';
		}
	}
	new ShortCodePackClass;
}
