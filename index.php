<?php
/**
 * Index
 *
 * Standard loop for the front-page
 *
 * @package WordPress
 * @subpackage Foundation, for WordPress
 * @since Foundation, for WordPress 1.0
 */

get_header(); ?>

    <!-- Main Content -->
    <div class="grid">
    <div class="grid__item one-whole content--primary" role="content">
		<?php if ( have_posts() ) : ?>
                        <h1 class="title"><?php _e( 'Search <strong>results</strong>', 'tools'); ?></h1>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

		<?php else : ?>

			<h1 class="title"><?php _e( 'Not Found', 'tools'); ?></h1>
			<p class="lead"><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'tools' ); ?></p>
			
		<?php endif; ?>

		<?php sixtools_pagination(); ?>

    </div>
<?php get_footer(); ?>