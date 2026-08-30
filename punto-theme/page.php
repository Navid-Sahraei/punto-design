<?php
/**
 * Template for standard interior pages (e.g. Privacy, Terms, Cookies).
 *
 * @package Punto
 */

get_header();
?>

	<main id="main">
		<section class="section">
			<div class="container contact-inner">
				<?php
				while ( have_posts() ) {
					the_post();
					?>
					<article <?php post_class(); ?>>
						<header class="section-head">
							<h1><?php the_title(); ?></h1>
						</header>
						<div class="entry-content">
							<?php
							the_content();

							wp_link_pages(
								array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'punto' ),
									'after'  => '</div>',
								)
							);
							?>
						</div>
					</article>
					<?php
				}
				?>
			</div>
		</section>
	</main>

<?php
get_footer();
