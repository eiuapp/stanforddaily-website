<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package The_Stanford_Daily
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main archive-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				if ( is_author() ) {
					tsd_author_box( get_the_author_meta( 'ID' ) );
				} else {
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				}
				?>
			</header><!-- .page-header -->

			<?php
			if ( is_category( "magazine" ) ) {
				include "inc/magazine-slider.php";
			}
			?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the excerpt template for the content.
				 */
				get_template_part( 'template-parts/excerpt', get_post_type() );

			endwhile;

			tsd_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
