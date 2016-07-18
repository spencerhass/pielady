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
                <?php the_excerpt(); ?>
            </div>

            <footer class="entry-meta">
                <?php//wp_arch_footer_meta(); ?>
            </footer>
        </article>
        <?php endwhile; ?>

        <nav role="navigation" class="site-navigation paging-navigation">
            <h1 class="screen-reader-text"><?php _e( 'Post navigation', 'wp_arch' ); ?></h1>'
            <?php if ( get_next_posts_link() ) : ?>
            <div class="nav-previous "><?php next_posts_link( 'Previous Testimonials' ); ?></div>
            <?php endif; ?>
            <?php if ( get_previous_posts_link() ) : ?>
            <div class="nav-next"><?php previous_posts_link( 'Newer Testimonials' ); ?></div>
            <?php endif; ?>
        </nav>

        <?php else : ?>

        <p><?php _e('Sorry, no testimonials matched your criteria.'); ?></p>

    <?php endif; ?>

</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>