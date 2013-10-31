<?php
/**
 * Footer
 *
 * Displays content shown in the footer section
 *
 * @package WordPress
 * @subpackage Foundation, for WordPress
 * @since Foundation, for WordPress 1.0
 */
?>
</div><!-- #end right content -->
</div><!-- #end main grid -->

<?php if(my_wp_is_mobile()): ?>
    <hr class="separator--double no-margin always-bottom"/>
<?php endif; ?>
 <!--[if lt IE 9]>
   <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/libs/respond.min.js"></script>
   <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/libs/jquery.placeholder.js"></script>
 <![endif]-->
<?php wp_footer(); ?>
</body>
</html>