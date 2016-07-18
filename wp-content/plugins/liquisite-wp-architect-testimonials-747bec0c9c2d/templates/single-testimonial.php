<?php
/**
 * The single template file.
 *
 * @package WordPress
 */
get_header(); ?>

<section class="primary" role="main">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		    <header class="entry-header">
		        <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wp_arch' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		    </header>
		    <div class="entry-content">
		        <?php if ( has_post_thumbnail() ) { the_post_thumbnail('testimonial-thumb');} ?>
		        <?php the_content(); ?>
		    </div>

		    <footer class="entry-meta">
		        <?php// wp_arch_footer_meta(); ?>
		    </footer>
		</article>
		<?php endwhile; ?>
		<footer class="testimonial-back-nav">
			<a class="button" href="<?php echo get_post_type_archive_link(get_post_type()); ?>" title="Back to Archive">Back</a>
		</footer>

	<?php else : ?>
	    
	<p><?php _e('Sorry, no testimonials matched your criteria.'); ?></p>
	<?php endif; ?>

</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>