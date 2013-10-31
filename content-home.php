<?php
/**
 * Content Single
 *
 * Loop content in single post template (single.php)
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
 

<article class="grid overflow--hidden height-100">
<?php if(my_wp_is_mobile()): ?>
    <div class="grid__item one-whole content--secondary">
<?php else: ?>
    <div class="grid__item one-half desk-one-third palm-one-whole content--secondary close height-100">
    <a href="#" class="btn--open-close"><span aria-hidden="true" class="icon-ico-plus icon--text"></span><span class="btn--text"><?php _e("Open/close content", "tools"); ?></span></a>
<?php endif; ?>
        <div class="inner-content">
	<?php the_content(); ?>
        </div>
    </div>
</article>

<div class="grid grid--actus">
    <div class="grid__item desk-one-third one-half">
        <h4 class="title"><?php _e("Latest", "tools"); ?> <strong><?php _e("news", "tools"); ?> : </strong></h4>
    </div><!--
    --><?php echo $content; ?>
</div>
