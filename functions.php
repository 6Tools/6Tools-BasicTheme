<?php

/**
 * Base de site administrable 
 * @package mOveo 4 6-Design
 * @subpackage 6Tools
 * @since 
 */


remove_action('wp_footer','wp_admin_bar_render',1000);
add_filter('show_admin_bar', '__return_false');


/**
 * Configuration des paramètres du thème de base 6Tools
 *
 * @since 6Tools 0.1
 */
function sixtools_setup() {

        // Ajout du style de l'éditeur de texte editor-style.css
    add_editor_style();

        
        
    // Gestion des Images à la Une par le thème
    add_theme_support( 'post-thumbnails' );

        
        
    // Feed automatique des posts
    add_theme_support( 'automatic-feed-links' );

        
        
    // Domaine de traduction
    load_theme_textdomain( 'tools', TEMPLATEPATH . '/languages' );
        
        
        // Différentes tailles d'images
        add_image_size('thumbs-big', 1024, 768,true);
        add_image_size('thumbs-content', 860, 500, true);

}
add_action( 'after_setup_theme', 'sixtools_setup' );


/*
 * Déclaration des styles CSS et JS chargés
 * 
 * @since 6Tools 0.1
 */

function sixtools_assets() {
    
        wp_deregister_script('admin-bar');
        wp_deregister_style('admin-bar');

    if (!is_admin()) {

        // JavaScripts
        wp_enqueue_script( 'easing', get_template_directory_uri() . '/js/libs/jquery.easing.js', array('jquery'), '1.0' );
        wp_enqueue_script( 'underscore', get_template_directory_uri() . '/js/libs/underscore-min.js', array('jquery'), '1.0' );
        wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0' );

        // CSS
        wp_enqueue_style( 'styles', get_stylesheet_uri(), array(), "0.5" );

        // Google Fonts API
        wp_enqueue_style( 'google-font-1', 'http://fonts.googleapis.com/css?family=Oxygen:400,700,300' );
    
    }

}
add_action( 'wp_enqueue_scripts', 'sixtools_assets' );


/**
 * Ajout des zones de menu
 * 
 * @since 6Tools 0.1
 */
function sixtools_menus() {

        // (Primary)
    register_nav_menus( array('primary' => __( 'Main menu', 'tools' )));
    
}
add_action( 'init', 'sixtools_menus' );



/**
 * Déclaration des zones de widgets
 *
 * @since 6Tools 0.1
 */
function sixtools_widgets_init() {

    register_sidebar( array(
        'name' => 'Zone latérale de widgets',
        'id' => 'primary-widget-area',
        'description' => __( 'The primary widget area', 'tools' ),
        'before_widget' => '<div class="widget-container %1$s %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ) );



}
add_action( 'widgets_init', 'sixtools_widgets_init' );



/*
 * Modifie l'editeur de texte TinyMce
 * Défini les formats de texte, les couleurs de textes propre au theme
 */

 function fb_change_mce_buttons( $initArray ) {

    $style_formats = array(

        array('title' => 'Titre', 'block' => 'h1', 'classes' => 'title'),
        array('title' => 'Sous-titre', 'block' => 'h2', 'classes' => 'subtitle'),
        array('title' => 'Paragraphe', 'block' => 'p'),
        array('title' => 'Paragraphe fond gris', 'block' => 'p', 'classes' => 'island')

    );


    $initArray['theme_advanced_blockformats'] = 'h1,p, h2,h3,h4';
    $initArray['theme_advanced_buttons1'] = 'styleselect,bold,italic,underline,strikethrough,hr,|,forecolor,|,bullist,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,removeformat';
    $initArray['theme_advanced_buttons2'] = '';
    $initArray['theme_advanced_text_colors'] = 'A6A6A6,FF0C23,000000';
    $initArray['theme_advanced_more_colors'] = false;
    $initArray['style_formats']  = json_encode( $style_formats );

    return $initArray;
 }

add_filter('tiny_mce_before_init', 'fb_change_mce_buttons');


// Walker pour ajout de sous-menu auto dans l'admin
class sixtools_navigation extends Walker_Nav_Menu {
    
function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    $class_names = $value = '';
    
    $xfn = empty( $item->xfn ) ? array() : (array) $item->xfn;

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $classes[] = 'menu-item-' . $item->ID;
    
    if(!empty($xfn)) {
        $post_type = get_post_type( $post->ID );
        if($xfn[0] != "post")
            $classes[] = 'has-dropdown';
        if( $xfn[0] == $post_type)
            $classes[] = 'current-menu-ancestor';
    }
    
    if(get_bloginfo('language')=="en-US")
        $classes[] = 'en';

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= $indent . '<li' . $id . $value . $class_names .'>';

    // MODIF 1
    // $balise = a seulement si il y a un lien et que ce n'est pas une ancre
    // $balise = a si current-menu-item n'est pas dans les classes
    $balise = 'a';

    $atts = array();
    $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
    $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
    $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';

    // MODIF 2 : on n'ajout l'URL seulent si c'est un lien
    if( 'a' == $balise )
        $atts['href']   = ! empty( $item->url ) ? $item->url : '';

    $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

    $attributes = '';
    foreach ( $atts as $attr => $value ) {
        if ( ! empty( $value ) ) {
            $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
            $attributes .= ' ' . $attr . '="' . $value . '"';
        }
    }

    // MODIF 3 : on remplace 'a' par $balise
    $item_output = $args->before;
    $item_output .= '<' . $balise . ''. $attributes .'>';
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    $item_output .= '</' . $balise . '>';
    $item_output .= $args->after;

    // MODIF 4
    // si cet élément a une classe menu-taxonomylist...
    // on récupère le XFN (correspondant à la taxonomie souhaité)...
    // on conçoit alors une liste des terms disponibles :-)
    if( in_array( 'specialisation', $xfn ) || in_array( 'concept', $xfn ) ) {
        $args = array(
            'posts_per_page' => -1,
            'post_type' => $xfn[0],
            'post_parent' => 0,
            'suppress_filters' => false
        );
        $active = (is_posttype($xfn[0])) ? " active" : "";
        $item_output .= '<ul class="dropdown '.$active.'">';
        $posts_array = get_posts( $args );
        
        foreach ( $posts_array as $post ):
            $parents = get_post_ancestors( get_the_ID() );
            $classes = (get_the_ID() === $post->ID || in_array($post->ID, $parents)) ? "current-menu-item" : "";
            $item_output .= "<li class=\"".$classes."\">";
            $item_output .= "<a href='".get_permalink($post->ID)."'>".$post->post_title."</a>";
            $item_output .= "</li>";
        endforeach;
        $item_output .= '</ul>';
    } 

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}

function start_lvl(&$output, $depth = 0, $args = array()) {
    $indent = str_repeat("\t", $depth);
    $pages = array(103,111,113,118,131,120,   326,333,337,323,344,340);
    $active = (in_array(get_the_ID(),$pages)) ? "active" : "";
    $output .= "\n$indent<ul class=\"dropdown ".$active."\">\n";
}

function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
    $id_field = $this->db_fields['id'];
    if ( !empty( $children_elements[ $element->$id_field ] ) ) {
        $element->classes[] = 'has-dropdown';
    }
        
        Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
}
}



// Ajoute une taille d'image dans le sélecteur d'image
add_filter('image_size_names_choose', 'sixtools_image_sizes');
function sixtools_image_sizes($sizes) {
        $addsizes = array(
                );
        $newsizes = array_merge($sizes, $addsizes);
        return $newsizes;
}

/**
 * HTML5 POUR IE // A REMPLACER PAR MODERNIZR ?
 * 
 * @since 6-Tools 0.1
 */

function sixtools_modernize_ie () {
    echo '<!--[if lt IE 9]>';
    echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    echo '<![endif]-->';
}

add_action('wp_head', 'sixtools_modernize_ie');



/**
 * Options générales propres à tous les thèmes
 * A migrer vers le plugin dédié 6Tools ?
 * 
 * @since 6Tools 0.1
 */



// Désactivation de la version de WP du site
function remove_generators() {
    return '';
}
add_filter('the_generator','remove_generators');



// Eviter le retour à l'accueil si la recherche est vide
function make_blank_search ($query){
    global $wp_query;
    if (isset($_GET['s']) && $_GET['s']==''){  //if search parameter is blank, do not return false
        $wp_query->set('s',' ');
        $wp_query->is_search=true;
    }
    return $query;
}
add_action('pre_get_posts','make_blank_search');



// Affiche tous les résultats d'une recherche sur la même page
function change_wp_search_size($query) {
    if ( $query->is_search )
        $query->query_vars['posts_per_page'] = -1;

    return $query;
}
add_filter('pre_get_posts', 'change_wp_search_size');


/**
 * Fonction Readmore
 * Renvoi la chaîne de caractère tronquée
 * 
 * @since 6Tools 0.1
 */

function sixtools_readmore($c, $nb = 160){

        // on peut remplacer par une donnée issue d'une base sql (ex: $chaine = $sql['texte'];)
        $chaine = $c;

        $lg_max = $nb; //nombre de caractères autorisés

        //On vérifie si le texte est plus grand que le nombre de caractères spécifiés
        if (strlen($chaine) > $lg_max)

        //Si la réponse est non le script ne fait rien mais si c'est oui on continue...
        {
            $chaine = substr($chaine, 0, $lg_max);
        //on cherche l'espace le plus proche du maximum des caractères autorisés (ici 160)
            $last_space = strrpos($chaine, " ");
        //On ajoute ... à la suite de cet espace
            $chaine = substr($chaine, 0, $last_space);
        }

        return strip_tags($chaine);

}




/**
 * Shortcodes // Affichage des champs personnalisés sous forme de shortcode [field name= **** ]
 *
 */
function field_func($atts) {
   global $post;
   $name = $atts['name'];
   if (empty($name)) return;
   return get_post_meta($post->ID, $name, true);
}
add_shortcode('field', 'field_func');


/**
 * Pagination type foundation
 */

function sixtools_pagination() {

global $wp_query;

$big = 999999999;

$links = paginate_links( array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'prev_next' => true,
    'prev_text' => '&laquo;',
    'next_text' => '&raquo;',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $wp_query->max_num_pages,
    'type' => 'list'
)
);

$pagination = str_replace('page-numbers','pagination',$links);

echo $pagination;

}


/**
 * Retourne les liens vers FB TWITTER MAIL GOGGLE+
 *
 */
if ( ! function_exists( 'sixtools_bookmarks' ) ) :

function sixtools_bookmarks(){
    global $wp_query;

    if(is_tax()) :
        $link =  get_term_link( $wp_query->queried_object->slug, $wp_query->queried_object->taxonomy ) ;
        $title = single_cat_title("", false);
    else :
        $link = esc_url(get_permalink()) ;
    $title = get_the_title();
    endif;

    $tw_link = sprintf("http://twitter.com/share?original_referer=%1\$s&amp;text=%2\$s",
    $link,
    $title);

    $fb_link = sprintf("http://www.facebook.com/sharer.php?u=%1\$s&amp;t=%2\$s",
    $link,
    $title);

    $mail_link = sprintf("https://plus.google.com/share?url=%1\$s",
    $link,
    $title);

    $output = sprintf('<p class="bookmarks">'
    .'<a href="%2$s" title="%4$s Facebook" target="_blank"><span aria-hidden="true" class="icon-facebook icon--text"></span><span class="bm_facebook btn--text">%4$s Facebook</span></a>'
        .'<a href="%1$s" title="%4$s Twitter" target="_blank"><span aria-hidden="true" class="icon-twitter icon--text"></span><span class="bm_twitter btn--text">%4$s Twitter</span></a>'
        .'<a href="%3$s" title="%4$s GooglePlus"><span aria-hidden="true" class="icon-google-plus icon--text"></span><span class="bm_email btn--text">%4$s Google Plus</span></a></p>',
    $tw_link,
    $fb_link,
    $mail_link,__("Share on", 'tools'));


    return $output;
}

endif;


// Verifier si la page a un parent
function is_child($page_id) { 
    global $post; 
    if( is_page() && ($post->post_parent == $page_id) ) {
       return true;
    } else { 
       return false; 
    }
}

// Verifier si la page est un parent
function is_ancestor($post_id) {
    global $wp_query;
    $ancestors = $wp_query->post->ancestors;
    if ( count($ancestors) <= 0 ) {
        return true;
    } else {
        return false;
    }
}


// Ajoute le comteur de posts dans le lien
add_filter('get_archives_link', 'archive_count_span');
function archive_count_span($links) {
    $links = str_replace('</a>&nbsp;(', ' <span>(', $links);
    $links = str_replace(')', ')</span></a>', $links);
    return $links;
}

// Test si la page en cours est du type $type
function is_posttype($type){
    $post_type = get_post_type( $post->ID );
    return $type == $post_type;
}

// Récuperer le contenu d'un post
function get_post_content($id){
    $post = get_post($id);
    $content = strip_tags($post->post_content);
    return $content;
}

// Ajoute is_mobile class in body class
add_filter('body_class','is_mobile_body_class');
function is_mobile_body_class($classes) {
    // add 'class-name' to the $classes array
        if(is_mobile())
            $classes[] = 'is_mobile';
        else
            $classes[] = 'no_mobile';
    // return the $classes array
    return $classes;
}

// Fonction is_mobile() 
// modification de la fonction wp_is_mobile()
function is_mobile() {
    static $is_mobile;

    if ( isset($is_mobile) )
        return $is_mobile;

    if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
        $is_mobile = false;
    } elseif (
        strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false ) {
            $is_mobile = true;
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') == false) {
            $is_mobile = true;
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
        $is_mobile = false;
    } else {
        $is_mobile = false;
    }

    return $is_mobile;
}



// Supprimer le lien auto sur les images du contenu
update_option('image_default_link_type', 'none' );
?>