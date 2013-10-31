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

<div class="article-blog" id="article_<?php echo get_the_ID(); ?>">
                    <?php   if(has_post_thumbnail()): ?>
                    <?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbs-blog');
                            //$thumb = $thumb[0];
                            $thumb = $thumb[0];
                            $thumb_nb = str_replace(".jpg", "-bw.jpg",$thumb);
                    ?>
                    <?php endif; ?> 
                    <div class="img__container img__container--no-border">
                        <?php if(has_post_thumbnail()): ?>
                            <?php if(!is_single()): ?>
                            <a href="<?php echo get_permalink(get_the_ID()) ?>">
                                <img src="<?php echo $thumb_nb; ?>" alt="image <?php echo get_the_title(); ?>" class="img--full img--bw"/>
                                <img src="<?php echo $thumb; ?>" alt="image <?php echo get_the_title(); ?>" class="img--full img--color"/>
                            </a>
                            <?php else: ?>
                                <img src="<?php echo $thumb; ?>" alt="image <?php echo get_the_title(); ?>" class="img--full"/>
                            <?php  endif; ?>
                        <?php endif; ?>   
                        
                        <div class="justify-blocks">
                        <p class="date--blog justify-blocks__item">
                            <span><?php echo get_the_date("d") ?></span>
                            <?php echo get_the_date("F Y") ?>
                        </p>
                        
                        <?php if(!my_wp_is_mobile()): ?>
                        <div class="btn-share--blog justify-blocks__item">
                            <?php get_Btn_Twitter(); ?>
                            <?php get_Btn_FB() ?>
                        </div>
                        <?php endif; ?>
                        </div>
                    </div>
                    <?php if(is_single()): ?>
                    <h2 class="subtitle subtitle--article"><?php echo get_the_title(); ?></h2>
                    <?php else: ?>
                    <h1 class="subtitle subtitle--article"><a href="<?php echo get_permalink(get_the_ID()) ?>"><?php echo get_the_title(); ?></a></h1>
                    <?php endif; ?>
                    <?php 
                    
                        $lgt = 250;
                        $content = get_the_content();
                        
                        if(!is_single()){
                        if($lgt < strlen($content)):
                            $before =  substr($content, 0, $lgt);
                            $after =   substr($content, $lgt, strlen($content));
                            $content = "<p class='readmore__excerpt'>";
                            $content .= $before;
                            $content .= " <a href='".get_permalink(get_the_ID())."' class=''>[...] ".__("read more", 'tools')."</a></p>";
                        endif;
                        }else{ $content = apply_filters('the_content', get_the_content());}
                    
                        //$content = apply_filters('the_content', $content); 
                        echo $content;
                    ?>
                    <?php if(is_single()): ?>
                    <a class="btn--back" href="<?php echo icl_link_to_element(188, 'page'); ?>"><span>&lt;&lt;</span> <?php _e('Back','tools'); ?></a>
                    <?php endif; ?>
                    <hr class="separator--double"/>
</div>