<?php
/**
 * Single
 *
 * Loop container for single post content
 *
 * @package 6Tools
 * @subpackage 6Tools, for WordPress
 * @since 6Tools, for WordPress 1.0
 */

get_header(); ?>
    <!-- Main Content -->
    <div class="grid grid--collapse" role="content">
        <div class="grid__item four-sixths desk-six-eighths">
            <article class="content--primary content--no-top">
		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'single' ); ?>
			<?php endwhile; ?>
			
		<?php endif; ?>
            </article>
        </div><!--
        --><?php get_sidebar('blog'); ?>
    </div>
    
    <!-- End Main Content -->

<?php get_footer(); ?>