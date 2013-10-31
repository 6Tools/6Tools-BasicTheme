<?php
/**
 * Searchform
 *
 * Custom template for search form
 *
 * @package WordPress
 * @subpackage Foundation, for WordPress
 * @since Foundation, for WordPress 1.0
 */
?>

<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="close">
    <div class="inputs-group">
        <input type="search" name="s" class="input-text" id="s" placeholder="<?php _e('Search the entire site...', 'tools'); ?>" />
        <span class="inputs-group__btn">
            <button type="submit" class="input-submit btn" name="submit" id="searchsubmit"><span aria-hidden="true" class="icon-magnifying-glass icon--text"></span><span class="btn--text">Ok</span></button>
        </span>
    </div>
</form>
