<?php
/**
 * Generic fallback template.
 *
 * Used by WordPress when no more specific template matches. The homepage is
 * rendered by front-page.php; interior pages by page.php. This template keeps
 * the theme valid and renders the standard loop inside the Punto shell.
 *
 * @package Punto
 */

get_header();
?>

	<main id="main">
		<section class="section">
			<div class="container">
				<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						?>
						<article <?php post_class(); ?>>
							<header class="section-head">
								<h1><?php the_title(); ?></h1>
							</header>
							<div class="entry-content">
								<?php the_content(); ?>
							</div>
						</article>
						<?php
					}
					the_posts_pagination();
				} else {
					?>
					<header class="section-head">
						<h1><?php esc_html_e( 'Nothing found', 'punto' ); ?></h1>
						<p class="section-lead"><?php esc_html_e( 'No content is available here yet.', 'punto' ); ?></p>
					</header>
					<?php
				}
				?>
			</div>
		</section>
	</main>

<?php
get_footer();
