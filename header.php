<?php
/**
 * Header
 *
 * Setup the header for our theme
 *
 * @package WordPress
 * @subpackage Foundation, for WordPress
 * @since Foundation, for WordPress 1.0
 */
if ( !is_user_logged_in() )
    die("Vous devez être connecté pour accéder à ce site !");
?><!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class=""> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!-- Set the viewport width to device width for mobile -->
<meta name="viewport" content="width=device-width" />

<title><?php wp_title(); ?></title>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php if(my_wp_is_mobile()): ?>
    <div class="mobile-slide-menu">
        <a href="#" class="btn--close">&#10005</a>
        <h4 class="title">Menu principal</h4>
        <?php echo get_search_form(); ?>
        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav nav--stacked nav--mobile', 'fallback_cb' => 'foundation_page_menu', 'container' => 'nav', 'walker' => new foundation_navigation() ) ); ?>
    </div>
    <?php endif ?>
    <div class="grid grid--collapse grid__wrapper grid__wrapper--main height-100">
        
        <div class="grid__item grid__item--content two-eighths desk-one-sixth palm-one-whole height-100">
    
            
            <?php if(!my_wp_is_mobile()): ?>   
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="logo "><img src="<?php echo get_bloginfo('template_url'); ?>/images/logo.png" class="img--full"></a>
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav nav--stacked nav--main', 'fallback_cb' => 'foundation_page_menu', 'container' => 'nav', 'container_class' => 'hide-on-palm', 'walker' => new foundation_navigation() ) ); ?>
            <?php else: ?>
                <div class="grid grid--collapse relative">
                    <div class="grid__item palm-two-thirds">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="logo "><img src="<?php echo get_bloginfo('template_url'); ?>/images/logo.png" class="img--full"></a>
                    </div><!--
                    --><div class="grid__item palm-one-third">
                        <a href="#" class="btn_open-menu"><span aria-hidden="true" class="icon-menu icon--text"></span><span class="btn--text">Ok</span></a>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if(!my_wp_is_mobile()): ?>
                
            <footer class="hide-on-palm">
                <p>2013 © <?php _e("Copyright", "tools"); ?></p>
                <ul class="nav nav--stacked nav--footer">
                    <li><a href="<?php echo icl_link_to_element(239, 'page'); ?>"><?php _e("Legal Notice", "tools"); ?></a></li>
                    <li><a href="#" class="btn__sitemap"><?php _e("Sitemap", "tools"); ?></a></li>
                </ul>
                
                <?php echo sixtools_bookmarks(); ?>
            </footer>
            <?php endif; ?>
    
         </div><!--
        
        --><div class="grid__item grid__item--content grid__item--content-main height-100 six-eighths desk-five-sixths palm-one-whole">
            
            <div class="grid grid--collapse line-height-none">
                <div class="grid__item one-third relative">
                    <div class="searchform--compact hide-on-palm">
                        <?php echo get_search_form(); ?>
                    </div>
                </div>
            </div>
            
            <div class="grid relative hide-on-palm">
                <?php global $sitepress; ?>
                <a href="<?php echo $sitepress->language_url("fr"); ?>" class="lang-selector <?php if(ICL_LANGUAGE_CODE == "fr") echo "current"; ?> primary-lang">FR</a>
                <a href="<?php echo $sitepress->language_url("en"); ?>" class="lang-selector <?php if(ICL_LANGUAGE_CODE == "en") echo "current"; ?> second-lang">EN</a>
            </div>
            