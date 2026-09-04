<?php
/**
 * Template for standard interior pages.
 *
 * The homepage uses front-page.php; this handles ordinary pages (About,
 * Privacy, etc.) inside the Punto shell.
 *
 * @package punto
 */

get_header();
?>

	<section class="section-head" style="padding-top: clamp(3rem, 6vw, 5rem); padding-bottom: clamp(3rem, 6vw, 5rem);">
		<div style="max-width: 820px;">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class(); ?>>
					<h1 class="section-head__title" style="margin-bottom: 1.5rem;"><?php the_title(); ?></h1>
					<div class="entry-content" style="line-height: 1.6;">
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
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			endwhile;
			?>
		</div>
	</section>

<?php
get_footer();
