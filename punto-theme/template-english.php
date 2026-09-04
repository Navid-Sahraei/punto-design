<?php
/**
 * Template Name: English Home
 *
 * English homepage (ported from en.html). Assign this template to a page with
 * the slug "en" so it lives at /en/. Markup, classes, copy and order are
 * identical to the static English site. punto_lang() returns 'en' for this
 * template, so the shared header/footer render in English automatically.
 *
 * @package punto
 */

get_header();
?>

	<!-- ============ HERO ============ -->
	<section class="hero" aria-labelledby="hero-title">
		<p class="eyebrow">Design &amp; social media studio</p>
		<h1 class="hero__title" id="hero-title">
			<span class="hero__word">Punto</span><span class="hero__dot" aria-hidden="true"></span>
		</h1>
		<p class="hero__lede">
			Design and social at a fixed price. One package, one number,
			no surprises on the invoice.
		</p>
		<div class="hero__actions">
			<a class="btn btn--cobalt" href="#packages">Choose a package</a>
			<a class="btn btn--ghost" href="#how-it-works">How it works</a>
		</div>
		<p class="hero__foot">
			Two revision rounds included<span class="tick" aria-hidden="true"></span>
			Delivered on time<span class="tick" aria-hidden="true"></span>
			Always invoiced<span class="tick" aria-hidden="true"></span>
		</p>
	</section>

	<!-- ============ MANIFESTO ============ -->
	<section class="manifesto" aria-labelledby="manifesto-title">
		<h2 class="manifesto__title" id="manifesto-title">
			No more quotes that keep changing<span class="dot dot--amber" aria-hidden="true"></span>
		</h2>
		<ul class="manifesto__list">
			<li>No hourly rates<span class="dot" aria-hidden="true"></span></li>
			<li>No &ldquo;it depends&rdquo;<span class="dot" aria-hidden="true"></span></li>
			<li>No surprise revisions<span class="dot" aria-hidden="true"></span></li>
		</ul>
		<p class="manifesto__note">
			The number next to a package is the number you pay. We put it in
			writing before we start, and it stays put.
		</p>
	</section>

	<div class="divider" role="separator" aria-hidden="true"><span></span></div>

	<!-- ============ PACKAGES ============ -->
	<section class="packages" id="packages" aria-labelledby="pkg-title">
		<div class="section-head">
			<p class="eyebrow">The packages</p>
			<h2 class="section-head__title" id="pkg-title">Choose. You already know the price.</h2>
		</div>

		<div class="pkg-grid">
			<!-- Identity -->
			<article class="pkg">
				<header class="pkg__head">
					<h3 class="pkg__name">Identity</h3>
					<p class="pkg__desc">Logo, palette, type, and a ready-to-use mini brand kit.</p>
				</header>
				<p class="pkg__price"><span class="pkg__cur">€</span>490<span class="pkg__unit">/ project</span></p>
				<ul class="pkg__list">
					<li>Logo in primary + secondary versions</li>
					<li>Color palette and font pairing</li>
					<li>File kit for print and web</li>
					<li>Delivered in 10 days</li>
				</ul>
				<?php
				/**
				 * TODO (WooCommerce): point this button at the "Identity/Identità"
				 * product. Replace href="#book" below, e.g.:
				 *   href="<?php echo esc_url( home_url( '/?add-to-cart=IDENTITA_PRODUCT_ID' ) ); ?>"
				 * Keep the class="btn btn--ink pkg__cta" and the button text unchanged.
				 */
				?>
				<a class="btn btn--ink pkg__cta" href="#book">Book Identity</a>
			</article>

			<!-- Social - featured -->
			<article class="pkg pkg--featured">
				<span class="pkg__badge">Most chosen</span>
				<header class="pkg__head">
					<h3 class="pkg__name">Social</h3>
					<p class="pkg__desc">Ready-to-post content, every month, without chasing ideas.</p>
				</header>
				<p class="pkg__price"><span class="pkg__cur">€</span>390<span class="pkg__unit">/ month</span></p>
				<ul class="pkg__list">
					<li>12 posts + 8 stories a month</li>
					<li>Monthly content plan</li>
					<li>Graphics matched to your identity</li>
					<li>No lock-in: cancel anytime</li>
				</ul>
				<?php
				/**
				 * TODO (WooCommerce): point this button at the "Social" product
				 * (a subscription/monthly product). Replace href="#book" below, e.g.:
				 *   href="<?php echo esc_url( home_url( '/?add-to-cart=SOCIAL_PRODUCT_ID' ) ); ?>"
				 * Keep the class="btn btn--paper pkg__cta" and the button text unchanged.
				 */
				?>
				<a class="btn btn--paper pkg__cta" href="#book">Book Social</a>
			</article>

			<!-- Website -->
			<article class="pkg">
				<header class="pkg__head">
					<h3 class="pkg__name">Website</h3>
					<p class="pkg__desc">A one-page showcase site, fast and readable on any screen.</p>
				</header>
				<p class="pkg__price"><span class="pkg__cur">€</span>890<span class="pkg__unit">/ project</span></p>
				<ul class="pkg__list">
					<li>One-page responsive, copy included</li>
					<li>Contact form and map</li>
					<li>Basic Google optimization</li>
					<li>Delivered in 15 days</li>
				</ul>
				<?php
				/**
				 * TODO (WooCommerce): point this button at the "Website/Sito" product.
				 * Replace href="#book" below, e.g.:
				 *   href="<?php echo esc_url( home_url( '/?add-to-cart=SITO_PRODUCT_ID' ) ); ?>"
				 * Keep the class="btn btn--ink pkg__cta" and the button text unchanged.
				 */
				?>
				<a class="btn btn--ink pkg__cta" href="#book">Book Website</a>
			</article>
		</div>

		<p class="packages__fineprint">
			Prices exclude VAT. Need more than one package? They combine.
			Something bigger? <a href="#book">Custom quote — still locked.</a>
		</p>
	</section>

	<div class="divider" role="separator" aria-hidden="true"><span></span></div>

	<!-- ============ HOW IT WORKS ============ -->
	<section class="steps" id="how-it-works" aria-labelledby="steps-title">
		<div class="section-head">
			<p class="eyebrow">How it works</p>
			<h2 class="section-head__title" id="steps-title">Four steps, and it&rsquo;s done.</h2>
		</div>

		<ol class="steps__list">
			<li class="step">
				<span class="step__num">01</span>
				<h3 class="step__title">Choose the package</h3>
				<p class="step__text">Price and timeline are already set. No quote to wait for.</p>
			</li>
			<li class="step">
				<span class="step__num">02</span>
				<h3 class="step__title">Lock the date</h3>
				<p class="step__text">A deposit sets the start. The rest on delivery.</p>
			</li>
			<li class="step">
				<span class="step__num">03</span>
				<h3 class="step__title">Send your materials</h3>
				<p class="step__text">A guided brief asks only for what actually matters.</p>
			</li>
			<li class="step">
				<span class="step__num">04</span>
				<h3 class="step__title">Get the work</h3>
				<p class="step__text">On time, with two revision rounds included. Punto.</p>
			</li>
		</ol>
	</section>

	<!-- ============ FAQ ============ -->
	<section class="faq" id="faq" aria-labelledby="faq-title">
		<div class="section-head">
			<p class="eyebrow">Fair questions</p>
			<h2 class="section-head__title" id="faq-title">The answers, no detours.</h2>
		</div>

		<div class="faq__list">
			<details class="qa">
				<summary>Is the price really fixed?<span class="qa__mark" aria-hidden="true"></span></summary>
				<p>Yes. The number next to the package is what you pay. We put it in writing before we start, and it won&rsquo;t change midway.</p>
			</details>
			<details class="qa">
				<summary>What if I need more changes?<span class="qa__mark" aria-hidden="true"></span></summary>
				<p>Two revision rounds are included in every package. If you need more, they have a fixed rate per round, written in the quote. No surprises.</p>
			</details>
			<details class="qa">
				<summary>How long does it take?<span class="qa__mark" aria-hidden="true"></span></summary>
				<p>Timelines are listed per package and start from the date you lock in. If your materials run late, the date moves with you.</p>
			</details>
			<details class="qa">
				<summary>Do you invoice?<span class="qa__mark" aria-hidden="true"></span></summary>
				<p>Always. A proper invoice for every project and every month of social management.</p>
			</details>
			<details class="qa">
				<summary>My project is bigger. Can you do it?<span class="qa__mark" aria-hidden="true"></span></summary>
				<p>Of course. Combine several packages, or ask for a custom quote — also at a fixed price, agreed before we start.</p>
			</details>
		</div>
	</section>

	<!-- ============ BOOK / CTA ============ -->
	<section class="cta" id="book" aria-labelledby="cta-title">
		<h2 class="cta__title" id="cta-title">
			Choose. Pay. Done<span class="dot dot--paper" aria-hidden="true"></span>
		</h2>
		<p class="cta__lede">
			Tell us about the project in a 20-minute call. You leave with a price
			and a date, not a &ldquo;we&rsquo;ll get back to you&rdquo;.
		</p>
		<div class="cta__actions">
			<a class="btn btn--paper" href="mailto:ciao@puntodesign.it?subject=Book%20a%20call">Book a call</a>
			<a class="btn btn--ghost-paper" href="mailto:ciao@puntodesign.it">ciao@puntodesign.it</a>
		</div>
	</section>

<?php
get_footer();
