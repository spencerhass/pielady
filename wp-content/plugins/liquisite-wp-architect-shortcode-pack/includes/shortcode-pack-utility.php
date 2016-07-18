<?php

if ( ! class_exists( 'UtilityClass' ) ) {
	class UtilityClass {

		public function __construct() {
			add_shortcode( 'email', array( $this, 'wpcodex_hide_email_shortcode' ) );
			add_shortcode( 'lightbox', array( $this, 'wp_arch_lightbox_img_shortcode' ) );

			/**
			 * Move wpautop filter to AFTER shortcode is processed to stop empty
			 * P tags from within short codes
			 * http://stackoverflow.com/questions/5940854/disable-automatic-formatting-inside-wordpress-shortcodes
			 */
			remove_filter( 'the_content', 'wpautop' );
			add_filter( 'the_content', 'wpautop' , 99 );
			add_filter( 'the_content', 'shortcode_unautop', 100 );
		}

		/**
		 * Hide email from Spam Bots using a shortcode.
		 */
		function wpcodex_hide_email_shortcode( $atts , $content = null ) {
			if ( ! is_email( $content ) ) {
				return;
			}

			return '<a href="mailto:' . antispambot( $content ) . '">' . antispambot( $content ) . '</a>';
		}

		/**
		 * Open image in a lightbox
		 */

		function wp_arch_lightbox_img_shortcode( $atts, $content = null ) {
			extract( shortcode_atts(
				array(
					'url' => ''
				), $atts )
			);
			return '<a href="#" data-featherlight="' . $url .'">' . do_shortcode( $content ) . '</a>';
		}
	}
	new UtilityClass;
}

