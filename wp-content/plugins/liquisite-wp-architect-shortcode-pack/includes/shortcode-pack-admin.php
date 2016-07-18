<?php


if ( ! class_exists( 'AdminClass' ) ) {
	class AdminClass {
		
		public function __construct() { 
			add_action( 'admin_menu' , array ($this , 'wp_arch_sc_add_submenu_page') );
		}
		
		function wp_arch_sc_add_submenu_page() {
		    add_submenu_page( 'options-general.php' , 'Shortcode Documentation', 'Shortcode Docs', 'manage_options', 'wp_arch_sc_pack', array ($this, 'wp_arch_sc_doc_page') );
		}

		function wp_arch_sc_doc_page() {
		    ?>
		    <div class="wrap">
		        <h2>Shortcode Documentation</h2>
		        <h3 class="title">Columns and Grids</h3>
		        <p>Used to create layouts</p>
		        <p><strong>Six-Column Grid</strong></p>
<pre>[col-wrap class="six-col" width="100%"]
 [col]Images,Content Here...[/col] 
 [col]Images,Content Here...[/col]
 [col]Images,Content Here...[/col]
 [col]Images,Content Here...[/col]
 [col]Images,Content Here...[/col]
 [col]Images,Content Here...[/col]
[/col-wrap]	
</pre>
				<p><strong>Four-Column Grid</strong></p>
<pre>[col-wrap class="four-col" width="100%"]
 [col]Images,Content Here...[/col] 
 [col]Images,Content Here...[/col]
 [col]Images,Content Here...[/col]
 [col]Images,Content Here...[/col]
[/col-wrap]	
</pre>
				<p><strong>Three-Column Grid</strong></p>
<pre>[col-wrap class="three-col" width="100%"]
 [col]Images,Content Here...[/col] 
 [col]Images,Content Here...[/col]
 [col]Images,Content Here...[/col]
[/col-wrap]	
</pre>
				<p><strong>Two-Column Grid</strong></p>
<pre>[col-wrap class="two-col" width="100%"]
 [col]Images,Content Here...[/col] 
 [col]Images,Content Here...[/col]
[/col-wrap]	
</pre>
		    <h3 class="title">Misc.</h3>
				<p><strong>Email Anti-Spam MailTo Link</strong></p>
				<p>Converts email addresses characters to HTML entities to block spam bots.</p>
<pre>[email]info@abc.com[/email]</pre>
<hr>
<p><strong>Accordion</strong></p>
<p>Creates an accordion</p>
<pre>
[accordions]
	[accordion-title]Test 1[/accordion-title]
	[accordion-block]Test 1[/accordion-block]
	[accordion-title]Test 2[/accordion-title]
	[accordion-block]Test 2[/accordion-block]
	[accordion-title]Test 3[/accordion-title]
	[accordion-block]Test 3[/accordion-block]
[/accordions]
</pre>
<hr>
<p><strong>Lightbox</strong></p>
<p>Creates a lightbox overlay</p>
<pre>
[lightbox url="/path/to/local/file.jpg"]Text or Image[/lightbox]
</pre>

		    </div>
		    <?php 
		}
	}
	new AdminClass;
}
