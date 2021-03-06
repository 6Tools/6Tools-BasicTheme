<?php
/**
 * Page
 *
 * Loop container for page content
 *
 * @package 6Tools
 * @subpackage 6Tools, for WordPress
 * @since 6Tools, for WordPress 1.0
 */

get_header(); ?>



    <!-- Main Content -->
    <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content', 'home' ); ?>
            <?php endwhile; ?>
			
    <?php endif; ?>
        
        
<?php get_footer(); ?>