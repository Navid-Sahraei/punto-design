<?php
/**
 * Generic fallback template.
 *
 * Used for any view without a more specific template (archives, search,
 * blog index, 404 fallback). Keeps the Punto shell (header/footer) around a
 * simple, readable content column.
 *
 * @package punto
 */

get_header();
?>

	<section class="section-head" style="padding-top: clamp(3rem, 6vw, 5rem); padding-bottom: clamp(2rem, 5vw, 4rem);">
		<div style="max-width: 820px;">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article <?php post_class(); ?> style="margin-bottom: 2.5rem;">
						<h2 class="section-head__title" style="margin-bottom: 1rem;">
							<a href="<?php the_permalink(); ?>" style="text-decoration: none; color: inherit;"><?php the_title(); ?></a>
						</h2>
						<div class="entry-content">
							<?php the_excerpt(); ?>
						</div>
					</article>
				<?php endwhile; ?>

				<?php the_posts_navigation(); ?>
			<?php else : ?>
				<h2 class="section-head__title"><?php esc_html_e( 'Nothing found', 'punto' ); ?></h2>
				<p style="color: var(--muted);"><?php esc_html_e( 'No content is available here yet.', 'punto' ); ?></p>
			<?php endif; ?>
		</div>
	</section>

<?php
get_footer();
