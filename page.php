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
    
        <div class="grid" role="content">
            <?php if ( have_posts() ) : 
                while ( have_posts() ) : the_post(); 
                   get_template_part( 'content', 'page' );
                endwhile;
            endif; ?>
        </div>
        
        
<?php get_footer(); ?>