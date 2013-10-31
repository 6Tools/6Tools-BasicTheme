<?php
/**
 * Content Home
 *
 * Loop content in single post template (front-page.php)
 *
 * @package 6Tools
 * @subpackage 6Tools, for WordPress
 * @since 6Tools, for WordPress 1.0
 */
?>
 

<article class="grid grid--center">
    <div class="grid__item one-whole content--primary">
        <div class="inner-content">
           <?php the_content(); ?>
        </div>
    </div>
</article>