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

<?php 
    $args = array(
        "posts_per_page"    => 2,
        "post_type"         => "post"
    );
    $query = new WP_Query($args);
    $articles = $query->get_posts();

    ob_start();
    
?><div class="grid__item desk-one-third one-half">
    <p><a href="<?php echo get_permalink($articles[0]->ID); ?>"><?php echo get_the_time('d/m',$articles[0]->ID); ?> <span>: <?php echo sixtools_readmore($articles[0]->post_content, 70); ?> (...)</span></a></p>
    </div><!--
 --><div class="grid__item desk-one-third hide-on-lap">
        <p><a href="<?php echo get_permalink($articles[1]->ID);?>"><?php echo get_the_time('d/m',$articles[1]->ID); ?> <span>: <?php echo sixtools_readmore($articles[1]->post_content, 70); ?> (...)</span></a></p>
    </div><?php 
    
    wp_reset_postdata();
    
    $content = ob_get_contents();
    ob_clean();
    wp_reset_postdata();
    
?>
 

<article class="grid">
    <div class="grid__item one-whole content--primary">
        <div class="inner-content">
           <?php the_content(); ?>
        </div>
    </div>
</article>