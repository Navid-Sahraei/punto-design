<?php
/**
 * Front page — the full Punto homepage.
 *
 * Ported verbatim from the static index.html. Language is handled client-side
 * by the EN/IT toggle (js/i18n.js), exactly as on the static site; the default
 * language is English. Dynamic sections (design packages, pricing table,
 * process steps, portfolio) are injected by js/main.js from the JSON in
 * assets/data/, so their containers are intentionally left empty here.
 *
 * @package Punto
 */

get_header();
?>

	<main id="main">
		<!-- ===================== HERO ===================== -->
		<section class="hero" id="home">
			<div class="container hero-inner">
				<p class="hero-eyebrow mono" data-i18n="hero.eyebrow">Design &amp; Social Media Studio</p>
				<h1 class="hero-heading">
					<span data-i18n="hero.heading">Fixed Price. Fixed Scope.</span>
				</h1>
				<p class="hero-sub" data-i18n="hero.subheading">No negotiation, no surprises.</p>
				<p class="hero-tagline mono" data-i18n="hero.tagline">Fixed price. Fixed scope. No surprises.</p>
				<div class="hero-cta">
					<a href="#pricing" class="btn btn-primary" data-i18n="hero.cta">View Pricing</a>
					<a href="#design" class="btn btn-ghost" data-i18n="hero.cta2">Explore Services</a>
				</div>
			</div>
		</section>

		<!-- ===================== VALUE PROPS ===================== -->
		<section class="values section" id="values" aria-label="Why Punto">
			<div class="container">
				<div class="value-grid">
					<article class="value-card">
						<span class="value-num mono">01</span>
						<h3 data-i18n="values.transparency.title">Transparent Pricing</h3>
						<p data-i18n="values.transparency.desc">Every price is public. No hidden fees, no negotiation games.</p>
					</article>
					<article class="value-card">
						<span class="value-num mono">02</span>
						<h3 data-i18n="values.scope.title">Fixed Scope</h3>
						<p data-i18n="values.scope.desc">You know exactly what you get before you commit.</p>
					</article>
					<article class="value-card">
						<span class="value-num mono">03</span>
						<h3 data-i18n="values.value.title">30% Below Market</h3>
						<p data-i18n="values.value.desc">Professional results at prices well under the Italy market rate.</p>
					</article>
				</div>
			</div>
		</section>

		<!-- ===================== DESIGN SERVICES ===================== -->
		<section class="section" id="design">
			<div class="container">
				<header class="section-head">
					<p class="section-kicker mono" data-i18n="design.kicker">Design Services — One-Time</p>
					<h2 data-i18n="design.title">Design Packages</h2>
					<p class="section-lead" data-i18n="design.lead">Three tiers. Pick the scope that fits, pay once.</p>
				</header>

				<?php
				/**
				 * WOOCOMMERCE TODO — Design package "Book" buttons.
				 * ---------------------------------------------------------------
				 * The three package cards (Spark / Amplify / Dominate) and their
				 * CTA buttons are rendered by assets/js/main.js (function
				 * renderDesignPackages()). Each button is currently:
				 *
				 *     <a href="#contact" class="btn btn-primary">…</a>
				 *
				 * To wire them to WooCommerce later, edit that function in
				 * assets/js/main.js and swap the href for a real add-to-cart /
				 * product URL, e.g.:
				 *
				 *     Spark    → /?add-to-cart=<SPARK_PRODUCT_ID>
				 *     Amplify  → /?add-to-cart=<AMPLIFY_PRODUCT_ID>
				 *     Dominate → /?add-to-cart=<DOMINATE_PRODUCT_ID>
				 *
				 * (See assets/js/main.js — search for "WOOCOMMERCE TODO".)
				 * Do NOT create products or checkout logic here yet.
				 */
				?>
				<div class="package-grid" id="design-packages">
					<!-- Cards injected by main.js from assets/data/*.json -->
				</div>

				<p class="section-note mono" data-i18n="design.payment">Payment: Full or 3 instalments (same price). Annual prepay: +10–15% discount.</p>
			</div>
		</section>

		<!-- ===================== SOCIAL SERVICES ===================== -->
		<section class="section section-alt" id="social">
			<div class="container">
				<header class="section-head">
					<p class="section-kicker mono" data-i18n="social.kicker">Social Media — Monthly, Scalable</p>
					<h2 data-i18n="social.title">Social Media Services</h2>
					<p class="section-lead" data-i18n="social.lead">Choose your volume. The price updates in real time.</p>
				</header>

				<!-- Social Media Kit -->
				<article class="kit-card">
					<div class="kit-head">
						<h3 data-i18n="social.kit.title">Social Media Kit</h3>
						<span class="price mono" data-i18n="social.kit.price">€140–210</span>
					</div>
					<p class="kit-sub mono" data-i18n="social.kit.type">One-time setup</p>
					<ul class="kit-list" data-i18n-list="social.kit.items"></ul>
				</article>

				<!-- Interactive calculators -->
				<div class="calc-grid">
					<!-- Graphics -->
					<article class="calc-card">
						<header class="calc-head">
							<h3 data-i18n="social.graphics.title">Social Graphics Posts</h3>
							<p class="calc-sub mono" data-i18n="social.graphics.sub">Posts per month</p>
						</header>

						<div class="calc-display">
							<span class="calc-qty mono" data-qty-display="graphics">4</span>
							<span class="calc-qty-label" data-i18n="social.graphics.unit">posts / month</span>
						</div>

						<input
							type="range"
							class="calc-slider"
							id="graphics-slider"
							data-pricing-input
							data-service="graphics"
							min="4" max="20" step="1" value="4"
							aria-label="Number of posts per month"
							aria-valuemin="4" aria-valuemax="20" aria-valuenow="4"
						/>

						<div class="calc-ticks mono" aria-hidden="true">
							<span>4</span><span>8</span><span>12</span><span>16</span><span>20</span>
						</div>

						<div class="calc-result">
							<span class="price price-lg mono" data-price-display="graphics">€80–100/month</span>
							<span class="calc-per mono" data-price-per="graphics"></span>
						</div>
						<p class="calc-addon mono" data-i18n="social.graphics.addon">Extra posts: €22 per post</p>
						<a href="#contact" class="btn btn-primary btn-block" data-i18n="social.cta">Calculate my cost</a>
					</article>

					<!-- Reels -->
					<article class="calc-card">
						<header class="calc-head">
							<h3 data-i18n="social.reels.title">Reels &amp; Video Loops</h3>
							<p class="calc-sub mono" data-i18n="social.reels.sub">Reels per month</p>
						</header>

						<div class="calc-display">
							<span class="calc-qty mono" data-qty-display="reels">1</span>
							<span class="calc-qty-label" data-i18n="social.reels.unit">reels / month</span>
						</div>

						<input
							type="range"
							class="calc-slider"
							id="reels-slider"
							data-pricing-input
							data-service="reels"
							min="1" max="8" step="1" value="1"
							aria-label="Number of reels per month"
							aria-valuemin="1" aria-valuemax="8" aria-valuenow="1"
						/>

						<div class="calc-ticks mono" aria-hidden="true">
							<span>1</span><span>2</span><span>4</span><span>6</span><span>8</span>
						</div>

						<div class="calc-result">
							<span class="price price-lg mono" data-price-display="reels">€120–150/month</span>
							<span class="calc-per mono" data-price-per="reels"></span>
						</div>
						<p class="calc-addon mono" data-i18n="social.reels.addon">Extra reels: €95 per reel</p>
						<a href="#contact" class="btn btn-primary btn-block" data-i18n="social.cta">Calculate my cost</a>
					</article>
				</div>

				<p class="section-note mono" data-i18n="social.annual">Annual Prepay Discount: 10 months paid = 12 months delivered (~17% off).</p>
			</div>
		</section>

		<!-- ===================== PRICING (COMBINED) ===================== -->
		<section class="section" id="pricing">
			<div class="container">
				<header class="section-head">
					<p class="section-kicker mono" data-i18n="pricing.kicker">All Packages</p>
					<h2 data-i18n="pricing.title">Pricing Overview</h2>
					<p class="section-lead" data-i18n="pricing.lead">Everything in one place. What you see is what you pay.</p>
				</header>

				<div class="table-scroll">
					<table class="pricing-table">
						<thead>
							<tr>
								<th data-i18n="pricing.table.package">Package</th>
								<th data-i18n="pricing.table.price">Price</th>
								<th data-i18n="pricing.table.delivery">Delivery</th>
								<th data-i18n="pricing.table.revisions">Revisions</th>
							</tr>
						</thead>
						<tbody id="pricing-table-body">
							<!-- Rows injected by main.js -->
						</tbody>
					</table>
				</div>
			</div>
		</section>

		<!-- ===================== PROCESS ===================== -->
		<section class="section section-alt" id="process">
			<div class="container">
				<header class="section-head">
					<p class="section-kicker mono" data-i18n="process.kicker">How It Works</p>
					<h2 data-i18n="process.title">Four Steps</h2>
					<p class="section-lead" data-i18n="process.lead">A clear path from brief to delivery.</p>
				</header>

				<ol class="process-grid" id="process-steps">
					<!-- Steps injected by main.js -->
				</ol>
			</div>
		</section>

		<!-- ===================== PORTFOLIO ===================== -->
		<section class="section" id="portfolio">
			<div class="container">
				<header class="section-head">
					<p class="section-kicker mono" data-i18n="portfolio.kicker">Selected Work</p>
					<h2 data-i18n="portfolio.title">Portfolio</h2>
					<p class="section-lead" data-i18n="portfolio.lead">Real results. Credibility through work, not names.</p>
				</header>

				<div class="portfolio-grid" id="portfolio-grid">
					<!-- Cases injected by main.js -->
				</div>
			</div>
		</section>

		<!-- ===================== CONTACT ===================== -->
		<section class="section section-alt" id="contact">
			<div class="container contact-inner">
				<header class="section-head">
					<p class="section-kicker mono" data-i18n="contact.kicker">Get Started</p>
					<h2 data-i18n="contact.title">Contact</h2>
					<p class="section-lead" data-i18n="contact.lead">Tell us the scope. We'll confirm the fixed price.</p>
				</header>

				<form class="contact-form" id="contact-form" novalidate>
					<div class="form-row">
						<label>
							<span data-i18n="contact.form.name">Name</span>
							<input type="text" name="name" autocomplete="name" required />
						</label>
						<label>
							<span data-i18n="contact.form.email">Email</span>
							<input type="email" name="email" autocomplete="email" required />
						</label>
					</div>
					<label>
						<span data-i18n="contact.form.service">Interested in</span>
						<select name="service">
							<option value="design" data-i18n="contact.form.opt_design">Design Package</option>
							<option value="graphics" data-i18n="contact.form.opt_graphics">Social Graphics</option>
							<option value="reels" data-i18n="contact.form.opt_reels">Reels &amp; Video</option>
							<option value="other" data-i18n="contact.form.opt_other">Something else</option>
						</select>
					</label>
					<label>
						<span data-i18n="contact.form.message">Message</span>
						<textarea name="message" rows="4" required></textarea>
					</label>
					<button type="submit" class="btn btn-primary" data-i18n="contact.form.submit">Send message</button>
					<p class="form-status" id="form-status" role="status" aria-live="polite"></p>
				</form>
			</div>
		</section>
	</main>

<?php
get_footer();
