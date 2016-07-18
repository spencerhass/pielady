<?php 

/**
* Tabs Short Code
*/
if ( ! class_exists( 'TabsClass' ) ) {
    class TabsClass {

        protected $_tabs_divs;

        public function __construct($tabs_divs = '') {
            $this->_tabs_divs = $tabs_divs;
            add_shortcode( 'tabs', array( $this, 'wp_arch_add_sc_tabs_wrap') );
            add_shortcode( 'tab', array( $this,'wp_arch_add_sc_tab_block') );
        }

        // Create ShortCode for Wrapping Tabs
        //$args is reserved to pass containing shortcodes
        function wp_arch_add_sc_tabs_wrap ( $args, $content = null ) {
            // do_shortcode() will seach through $content and filter through hooks
            $output = '<div class="tabs"><ul>' . do_shortcode($content) . '</ul>';
            $output .= $this->_tabs_divs . '</div>';
           return $output;
        }

        
        // Create Short Code for Tab
        function wp_arch_add_sc_tab_block( $args, $content = null ) {
            extract(shortcode_atts(array(  
                'id' => '',
                'title' => '', 
            ), $args));

            $output = '
                <li>
                    <a href="#'.$id.'">'.$title.'</a>
                </li>
            ';

            $this->_tabs_divs.= '<div id="'.$id.'">'.wpautop($content).'</div>';

            return $output;
        }

    }
    new TabsClass;
}
