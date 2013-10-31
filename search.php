<?php
/**
 * Template Name: Search Page
 */

get_header(); ?>

    <!-- Main Content -->   
    <div class="grid">
    <div class="grid__item one-whole content--primary" role="content">
		<?php if ( have_posts() ) : ?>
                        <h1 class="title"><?php _e( 'Search <strong>results</strong>', 'tools'); echo" : \""; the_search_query(); echo "\""; ?></h1>
			<?php while ( have_posts() ) : the_post(); ?>
                            <article>
                                <header>
                                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'sixtools' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                                    <h2 class="subtitle"><?php the_title(); ?></h2>
                                </a>
                                </header>
                                <?php the_excerpt(); ?>
                                <hr class="separator--double"/>
                            </article>
			<?php endwhile; ?>

		<?php else : ?>

                        <h1 class="title"><?php _e( 'Search <strong>results</strong>', 'tools'); echo" : \""; the_search_query(); echo "\""; ?></h1>
			<p class="lead"><?php _e( 'No result corresponding to this research.', 'tools' ); ?></p>
			
		<?php endif; ?>

		<?php sixtools_pagination(); ?>

    </div>
<?php get_footer(); ?>