<?php
/**
 * Template Name: Page // Contact
 *
 *
 * @package mOveo
 */

get_header(); ?>
    <!-- Main Content -->
    <div class="grid grid--collapse" role="content">
        <div class="grid__item one-whole">
        <article class="content--primary">
        <?php if ( have_posts() ) :  the_post(); ?>

                <?php the_content(); ?>
			
        <?php endif; ?>
        </article>
    </div>
        
    </div>
        
<?php get_footer(); ?>