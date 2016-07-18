<?php 
/*
Plugin Name: Wp-Architect Testimonials
Description: Custom Testimonials Post Type, Taxonomy and Widget
Plugin URI: http://www.liqui-site.com
Author: Matthew Ell, Liqui-Site Designs
Author URI: http://www.liqui-site.com
Version: 1.0
License: GPL2
Text Domain: wp-arch
Domain Path: wp-arch
*/

/*

    Copyright (C) 2015  Matthew Ell  mell@liqui-site.com

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

// blocking direct access to plugin PHP files 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Initalize Plugin 
add_action( 'init', 'wp_arch_testimonials_cpt_init' );
add_action( 'init', 'wp_arch_testimonials_tax_init' );

// Add New Image Size for Thumbnail
add_image_size( 'testimonial-thumb', 175, 175, true );
add_image_size( 'testimonial-thumb-sm', 90, 90, true );

// Enqueue Styles and Scripts 
add_action('wp_enqueue_scripts', 'wp_arch_testimonials_enqueue');
function wp_arch_testimonials_enqueue() {
    
    // enqueue css
    wp_enqueue_style('wp_arch_testimonials_styles', plugins_url('/styles/styles.css', __FILE__), array(), null, 'all');

    // If jQuery is not loaded, load jQuery
    wp_enqueue_script('jquery');

    // enqueue script | @Dependents: jQuery
    // wp_enqueue_script('redc_slideshow_scripts', plugins_url('jquery.flexslider-min.js', __FILE__), array('jquery'), "1", true);
    
}

// Template Override
// http://www.paulund.co.uk/change-template-custom-post-type-plugin
function change_post_type_single_template($single_template) {
	global $post;

     if ($post->post_type == 'testimonial') {
		$single_template = plugin_dir_path( __FILE__ ) . 'templates/single-testimonial.php';
     }

	return $single_template;
}
add_filter( 'single_template', 'change_post_type_single_template' );

function change_post_type_archive_template($archive_template) {
	global $post;

     if ($post->post_type == 'testimonial') {
		$archive_template  = plugin_dir_path( __FILE__ ) . 'templates/archive-testimonial.php';
     }
     
	return $archive_template;
}
add_filter( 'archive_template', 'change_post_type_archive_template' );



/**
* Register Custom Post Type for Testimonials
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function wp_arch_testimonials_cpt_init() {

	$labels = array(
		'name'                => __( 'Testimonials', 'wp-arch' ),
		'singular_name'       => __( 'Testimonial', 'wp-arch' ),
		'add_new'             => _x( 'Add New', 'wp-arch', 'wp-arch' ),
		'add_new_item'        => __( 'Add New Testimonial', 'wp-arch' ),
		'edit_item'           => __( 'Edit Testimonial', 'wp-arch' ),
		'new_item'            => __( 'New Testimonial', 'wp-arch' ),
		'view_item'           => __( 'View Testimonial', 'wp-arch' ),
		'search_items'        => __( 'Search Testimonials', 'wp-arch' ),
		'not_found'           => __( 'No Testimonials found', 'wp-arch' ),
		'not_found_in_trash'  => __( 'No Testimonials found in Trash', 'wp-arch' ),
		'parent_item_colon'   => __( 'Parent Testimonial:', 'wp-arch' ),
		'menu_name'           => __( 'Testimonials', 'wp-arch' ),
	);

	$rewrite = array(
		'slug'                => 'testimonials',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true, 		// defaults to has_archive
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'taxonomies'          => array('testimonial-category'),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5, // Show below Posts
		'menu_icon'           => 'dashicons-format-quote',		// Can use Dashicons
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => $rewrite,	// defaults to false
		'capability_type'     => 'post', 	// Post or Page
		'supports'            => array(
			'title', 'editor', 'thumbnail',
			'excerpt'
			)
	);

	register_post_type( 'testimonial', $args );
}

/**
 * Register Taxonomy for Testimonials
 *
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 */
function wp_arch_testimonials_tax_init() {

	$labels = array(
		'name'					=> _x( 'Testimonial Categories', 'Taxonomy plural name', 'wp-arch' ),
		'singular_name'			=> _x( 'Testimonial Category', 'Taxonomy singular name', 'wp-arch' ),
		'search_items'			=> __( 'Search Testimonial Categories', 'wp-arch' ),
		'popular_items'			=> __( 'Popular Testimonial Categories', 'wp-arch' ),
		'all_items'				=> __( 'All Testimonial Categories', 'wp-arch' ),
		'parent_item'			=> __( 'Parent Testimonial Category', 'wp-arch' ),
		'parent_item_colon'		=> __( 'Parent Testimonial Category', 'wp-arch' ),
		'edit_item'				=> __( 'Edit Testimonial Category', 'wp-arch' ),
		'update_item'			=> __( 'Update Testimonial Category', 'wp-arch' ),
		'add_new_item'			=> __( 'Add New Testimonial Category', 'wp-arch' ),
		'new_item_name'			=> __( 'New Testimonial Category', 'wp-arch' ),
		'add_or_remove_items'	=> __( 'Add or remove Testimonial Categories', 'wp-arch' ),
		'choose_from_most_used'	=> __( 'Choose from most used Testimonial Categories', 'wp-arch' ),
		'menu_name'				=> __( 'Category', 'wp-arch' ),
	);

	$rewrite = array(
		'slug'                => 'testimonials/category',
		'with_front'          => true,			// allowing permalinks to be prepended with front base
		'hierarchical'        => false, 		// true or false allow hierarchical urls 
		'ep_mask'             => 'EP_NONE',		// Assign an endpoint mask for this taxonomy 		
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => true,
		'hierarchical'      => true,			// hierarchical (categories) or tags.
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => $rewrite,
		'capabilities'      => array(),
	);

	register_taxonomy( 'testimonial-category', array( 'testimonial' ), $args ); // Object-types can be built-in Post Type or any Custom Post Type 
}
/**
 * Custom Field for Byline
 */

// Add Custom Meta Boxes
add_action( 'add_meta_boxes', 'testimonial_add_meta_boxes');
function testimonial_add_meta_boxes() {
    // Caption Meta Box
    add_meta_box( 'testimonial_metabox_options', 'Byline', 'testimonial_metabox_cb', 'testimonial', 'normal', 'default', array() );
}

// Meta box output
function testimonial_metabox_cb( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'testimonial_metabox_action', 'testimonial_metabox_nonce' );
    
    // Use get_post_meta() to retrieve an existing value from the database and use the value for the form.
    $testimonial_stored_meta = get_post_meta( $post->ID );
    
    ?>
    
    <label for="testimonial_metabox_byline_text">
        <?php _e( 'Add a byline: ', 'testimonial_textdomain' ); ?>
    </label>
    <br/> 
    <textarea style="width:100%;" rows="5" id="testimonial_metabox_byline_text" name="testimonial_metabox_byline_text"><?php if ( isset ( $testimonial_stored_meta['testimonial_metabox_byline_text'] ) ) echo $testimonial_stored_meta['testimonial_metabox_byline_text'][0]; ?></textarea>

    <?php 
}

// Save Meta Box Data
add_action( 'save_post', 'testimonial_metabox_save_data' );
function testimonial_metabox_save_data( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks for inputs and sanitizes/saves if needed
    if( isset( $_POST[ 'testimonial_metabox_byline_text' ] ) ) {
        update_post_meta( $post_id, 'testimonial_metabox_byline_text', $_POST[ 'testimonial_metabox_byline_text' ] ) ;
    }
}



/**
 * Testimonial Widget
 */
class Testimonial_Widget extends WP_Widget {

	// Initialize
	// handles actions to take when the widget is first created such as enqueueing specific javascript or stylesheets in the output
	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'testimonial_widget', 

		// Widget name will appear in UI
		__('Testimonials', 'testimonial_widget_domain'), 

		// Widget description
		array( 'description' => __( 'Add a Testimonial Carousel', 'testimonial_widget_domain' ), ));
	}

	// Creating widget front-end
	// Handles the generation of the widget’s HTML output
	public function widget( $args, $instance ) {
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		$testimonialCat = apply_filters( 'testimonial_cat', $instance['testimonialCat'] );
		
		echo $args['before_widget'];
		
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];

		// This is where you run the code and display the output
		wp_enqueue_style('slick_styles', plugins_url('slick/slick.css', __FILE__), array(), null, 'all');
		wp_enqueue_style('slick_styles_theme', plugins_url('slick/slick-theme.css', __FILE__), array(), null, 'all');
		// If jQuery is not loaded, load jQuery
		wp_enqueue_script('jquery');

		// enqueue script | @Dependents: jQuery
		wp_enqueue_script('slick_script', plugins_url('slick/slick.min.js', __FILE__), array('jquery'), "1", true);
		wp_enqueue_script('slick_script_init', plugins_url('slick/slick-init.js', __FILE__), array('jquery'), "1", true);
		
		echo '<div class="testimonials">';
	        $testimonialQuery = new WP_Query( array(
	        	'post_type' => 'testimonial',
	        	'posts_per_page' => (3),
				'tax_query' => array(
					array(
						'taxonomy' => 'testimonial-category',
						'field'    => 'slug',
						'terms'    => $testimonialCat,
					),
				),
	            ));

	            // The Loop
	            if ( $testimonialQuery->have_posts() ) {
	                while ( $testimonialQuery->have_posts() ) {
	                   $testimonialQuery->the_post();
	                   $id = get_the_ID();
	                   $meta_data = get_post_meta($id);
	                   $byline = (isset ($meta_data['testimonial_metabox_byline_text'][0]) ? $meta_data['testimonial_metabox_byline_text'][0] : null);
	            ?>
	                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	                    <?php if ( has_post_thumbnail() ) { the_post_thumbnail('testimonial-thumb-sm'); } ?>
	                    <?php the_excerpt(); ?>
	                    <?php 
	                    if ($byline != null) : echo '<footer class="byline">' . '<p>' . $byline . '</p>' . '</footer>'; endif; ?>
	                    </article>
	            <?php }
	            } else {
	                // no posts found
	                echo "No Posts Found!";
	            }
	            /* Restore original Post Data */
	            wp_reset_postdata();

		echo '</div> <!-- .testimonials -->';
		
		echo $args['after_widget'];
}

	// Widget Backend 
	// Handles the generation of the form controls that make up the widgets edit interface in the Admin interface
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'testimonialCat' => '', 'title' => '') );
		
		$title = esc_attr( $instance['title'] );
		$testimonialCat = esc_attr( $instance['testimonialCat'] );
		
		// Widget admin form
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'testimonialCat' ); ?>"><?php _e( 'Pick a Category to Display:' ); ?></label> 
		<select name="<?php echo $this->get_field_name('testimonialCat'); ?>" id="<?php echo $this->get_field_id('testimonialCat'); ?>" >
		<?php
			$wp_arch_terms = get_terms( 'testimonial-category'); 
			if ( ! empty( $wp_arch_terms ) && ! is_wp_error( $wp_arch_terms ) ){
				foreach ( $wp_arch_terms as $term ) {
					echo '<option value="' . $term->slug .'"' . selected( $instance['testimonialCat'], $term->slug ) . '>' . $term->name . '</option>';
				}
			}
			?>
		</select>
		</p>
<?php 
}
	
	// Updating widget replacing old instances with new
	// handles the form submission from the back-end form, updating stored data as necessary
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['testimonialCat'] = ( ! empty( $new_instance['testimonialCat'] ) ) ? strip_tags( $new_instance['testimonialCat'] ) : '';
		
		return $instance;
	}
} // Class testimonial_widget ends here
// Register and load the widgets
function testimonial_load_widget() {
	register_widget('Testimonial_Widget');
}
add_action( 'widgets_init', 'testimonial_load_widget' );
