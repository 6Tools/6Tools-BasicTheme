<?php
/**
 * Content Home
 *
 * Loop content in single post template (front-page.php)
 *
 * @package WordPress
 * @subpackage Foundation, for WordPress
 * @since Foundation, for WordPress 1.0
 */
?>
 

<article class="grid grid--center">
    <div class="grid__item one-whole content--primary">
        <div class="inner-content">
           <?php the_content(); ?>
        </div>
    </div>
</article>