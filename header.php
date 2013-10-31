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
    <div class="grid grid--collapse">
        
        <div class="grid__item grid__item--content one-whole">
    
            
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="logo ">
                    <img src="http://www.6tools.fr/wp-content/themes/6tools-basic/images/logo.png" class="img--full">
                </a>

                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav nav--stacked nav--main', 'fallback_cb' => 'foundation_page_menu', 'container' => 'nav', 'container_class' => 'hide-on-palm', 'walker' => new foundation_navigation() ) ); ?>
        </div>
    </div>
            