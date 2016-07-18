<?php 

/**
* Accordion Short Code
*/
if ( ! class_exists( 'AccordionClass' ) ) {
    class AccordionClass {
        
        public function __construct() {
            add_shortcode( 'accordions', array( $this, 'wp_arch_add_sc_accord_wrap') );
            add_shortcode( 'accordion-title', array( $this, 'wp_arch_add_sc_accord_title') );
            add_shortcode( 'accordion-block', array( $this,'wp_arch_add_sc_accord_block') );
        }

        // Create ShortCode for Wrapping Accordian
        //$args is reserved to pass containing shortcodes
        function wp_arch_add_sc_accord_wrap ( $args, $content = null ) {
            // do_shortcode() will seach through $content and filter through hooks
           return '<div class="accordion">' . do_shortcode($content) . '</div>';
        }

        // Create Shortcode for Title of Accordion
        function wp_arch_add_sc_accord_title ( $args, $content = null )  {
            return '<h3>' . $content . '</h3>';
        }
        
        // Create Short Code for Content area of Accordion
        function wp_arch_add_sc_accord_block( $args, $content = null ) {
            return '<div>' . wpautop($content) . '</div>';
        }

    }
    new AccordionClass;
}
