<?php 

/**
* Grid Short Code
*/
if ( ! class_exists( 'GridClass' ) ) {
	class GridClass {
		
		public function __construct() {
			add_shortcode( 'col-wrap', array( $this, 'wp_arch_add_sc_gridcolwrap' ) );
			add_shortcode( 'col', array( $this, 'wp_arch_add_sc_gridcol' ) );
		}

		// Col Wrap
		function wp_arch_add_sc_gridcolwrap ( $args, $content = null ) {
			// Attributes
				extract( shortcode_atts(
					array(
						'class' => '',
						'width' => ''
					), $args )
				);
			return '<div class="col-wrap ' . $class . '" style="max-width:' . $width . '" >' . do_shortcode($content) . '</div>';
		}

		// Col
		function wp_arch_add_sc_gridcol ( $args, $content = null ) {
			return '<div class="col">' . do_shortcode($content) . '</div>';
		}
	}
	new GridClass;
}