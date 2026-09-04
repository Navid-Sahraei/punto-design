<?php
/**
 * Front page — the single bilingual homepage.
 *
 * The server renders Italian (the default language); assets/js/i18n.js swaps
 * every data-i18n node in place when the visitor toggles EN/IT — no navigation,
 * no reload, choice remembered in localStorage. Decorative spans (.dot, .tick,
 * .qa__mark, .hero__dot) sit OUTSIDE the translated spans so they survive the swap.
 *
 * @package punto
 */

get_header();
?>

	<!-- ============ HERO ============ -->
	<section class="hero" aria-labelledby="hero-title">
		<p class="eyebrow" data-i18n="hero.eyebrow">Studio di design &amp; social media</p>
		<h1 class="hero__title" id="hero-title">
			<span class="hero__word">Punto</span><span class="hero__dot" aria-hidden="true"></span>
		</h1>
		<p class="hero__lede" data-i18n="hero.lede">
			Design e social a prezzo fisso. Un pacchetto, un numero,
			nessuna sorpresa in fattura.
		</p>
		<div class="hero__actions">
			<a class="btn btn--cobalt" href="#pacchetti" data-i18n="hero.choose">Scegli un pacchetto</a>
			<a class="btn btn--ghost" href="#come-funziona" data-i18n="hero.how">Come funziona</a>
		</div>
		<p class="hero__foot">
			<span data-i18n="hero.foot1">Due giri di revisioni inclusi</span><span class="tick" aria-hidden="true"></span>
			<span data-i18n="hero.foot2">Consegna nei tempi</span><span class="tick" aria-hidden="true"></span>
			<span data-i18n="hero.foot3">Fattura sempre</span><span class="tick" aria-hidden="true"></span>
		</p>
	</section>

	<!-- ============ MANIFESTO ============ -->
	<section class="manifesto" aria-labelledby="manifesto-title">
		<h2 class="manifesto__title" id="manifesto-title">
			<span data-i18n="manifesto.title">Basta preventivi che cambiano</span><span class="dot dot--amber" aria-hidden="true"></span>
		</h2>
		<ul class="manifesto__list">
			<li><span data-i18n="manifesto.item1">Niente tariffe orarie</span><span class="dot" aria-hidden="true"></span></li>
			<li><span data-i18n="manifesto.item2">Niente &ldquo;dipende&rdquo;</span><span class="dot" aria-hidden="true"></span></li>
			<li><span data-i18n="manifesto.item3">Niente revisioni a sorpresa</span><span class="dot" aria-hidden="true"></span></li>
		</ul>
		<p class="manifesto__note" data-i18n="manifesto.note">
			Il numero che vedi accanto al pacchetto è il numero che paghi.
			Lo scriviamo prima di iniziare, e resta quello.
		</p>
	</section>

	<div class="divider" role="separator" aria-hidden="true"><span></span></div>

	<!-- ============ PACCHETTI ============ -->
	<section class="packages" id="pacchetti" aria-labelledby="pkg-title">
		<div class="section-head">
			<p class="eyebrow" data-i18n="pkg.eyebrow">I pacchetti</p>
			<h2 class="section-head__title" id="pkg-title" data-i18n="pkg.title">Scegli. Sai già quanto costa.</h2>
		</div>

		<div class="pkg-grid">
			<!-- Identità -->
			<article class="pkg">
				<header class="pkg__head">
					<h3 class="pkg__name" data-i18n="pkg.id.name">Identità</h3>
					<p class="pkg__desc" data-i18n="pkg.id.desc">Logo, palette, tipografia e un mini brand kit pronto all&rsquo;uso.</p>
				</header>
				<p class="pkg__price"><span class="pkg__cur">€</span>490<span class="pkg__unit" data-i18n="pkg.id.unit">/ progetto</span></p>
				<ul class="pkg__list">
					<li data-i18n="pkg.id.li1">Logo in versione principale + secondaria</li>
					<li data-i18n="pkg.id.li2">Palette colori e coppia di font</li>
					<li data-i18n="pkg.id.li3">Kit file per stampa e web</li>
					<li data-i18n="pkg.id.li4">Consegna in 10 giorni</li>
				</ul>
				<?php
				/**
				 * TODO (WooCommerce): point this button at the "Identità" product.
				 * Once WooCommerce is installed and the product created, replace the
				 * href="#prenota" below with the add-to-cart or product URL, e.g.:
				 *   href="<?php echo esc_url( home_url( '/?add-to-cart=IDENTITA_PRODUCT_ID' ) ); ?>"
				 * Keep the class="btn btn--ink pkg__cta", the data-i18n key, and the text.
				 */
				?>
				<a class="btn btn--ink pkg__cta" href="#prenota" data-i18n="pkg.id.cta">Prenota Identità</a>
			</article>

			<!-- Social - featured -->
			<article class="pkg pkg--featured">
				<span class="pkg__badge" data-i18n="pkg.social.badge">Il più scelto</span>
				<header class="pkg__head">
					<h3 class="pkg__name" data-i18n="pkg.social.name">Social</h3>
					<p class="pkg__desc" data-i18n="pkg.social.desc">Contenuti pronti da pubblicare, ogni mese, senza rincorrere le idee.</p>
				</header>
				<p class="pkg__price"><span class="pkg__cur">€</span>390<span class="pkg__unit" data-i18n="pkg.social.unit">/ mese</span></p>
				<ul class="pkg__list">
					<li data-i18n="pkg.social.li1">12 post + 8 storie al mese</li>
					<li data-i18n="pkg.social.li2">Piano editoriale mensile</li>
					<li data-i18n="pkg.social.li3">Grafiche coordinate con la tua identità</li>
					<li data-i18n="pkg.social.li4">Nessun vincolo: disdici quando vuoi</li>
				</ul>
				<?php
				/**
				 * TODO (WooCommerce): point this button at the "Social" product
				 * (a subscription/monthly product). Replace href="#prenota" below, e.g.:
				 *   href="<?php echo esc_url( home_url( '/?add-to-cart=SOCIAL_PRODUCT_ID' ) ); ?>"
				 * Keep the class="btn btn--paper pkg__cta", the data-i18n key, and the text.
				 */
				?>
				<a class="btn btn--paper pkg__cta" href="#prenota" data-i18n="pkg.social.cta">Prenota Social</a>
			</article>

			<!-- Sito -->
			<article class="pkg">
				<header class="pkg__head">
					<h3 class="pkg__name" data-i18n="pkg.sito.name">Sito</h3>
					<p class="pkg__desc" data-i18n="pkg.sito.desc">Un sito vetrina one-page, veloce e leggibile su ogni schermo.</p>
				</header>
				<p class="pkg__price"><span class="pkg__cur">€</span>890<span class="pkg__unit" data-i18n="pkg.sito.unit">/ progetto</span></p>
				<ul class="pkg__list">
					<li data-i18n="pkg.sito.li1">One-page responsive, testi inclusi</li>
					<li data-i18n="pkg.sito.li2">Modulo contatti e mappa</li>
					<li data-i18n="pkg.sito.li3">Ottimizzazione base per Google</li>
					<li data-i18n="pkg.sito.li4">Consegna in 15 giorni</li>
				</ul>
				<?php
				/**
				 * TODO (WooCommerce): point this button at the "Sito" product.
				 * Replace href="#prenota" below, e.g.:
				 *   href="<?php echo esc_url( home_url( '/?add-to-cart=SITO_PRODUCT_ID' ) ); ?>"
				 * Keep the class="btn btn--ink pkg__cta", the data-i18n key, and the text.
				 */
				?>
				<a class="btn btn--ink pkg__cta" href="#prenota" data-i18n="pkg.sito.cta">Prenota Sito</a>
			</article>
		</div>

		<p class="packages__fineprint" data-i18n="pkg.fineprint">
			Prezzi IVA esclusa. Serve più di un pacchetto? Si combinano.
			Progetto fuori misura? <a href="#prenota">Preventivo custom, comunque bloccato.</a>
		</p>
	</section>

	<div class="divider" role="separator" aria-hidden="true"><span></span></div>

	<!-- ============ COME FUNZIONA ============ -->
	<section class="steps" id="come-funziona" aria-labelledby="steps-title">
		<div class="section-head">
			<p class="eyebrow" data-i18n="steps.eyebrow">Come funziona</p>
			<h2 class="section-head__title" id="steps-title" data-i18n="steps.title">Quattro passi, e finisce lì.</h2>
		</div>

		<ol class="steps__list">
			<li class="step">
				<span class="step__num">01</span>
				<h3 class="step__title" data-i18n="steps.s1t">Scegli il pacchetto</h3>
				<p class="step__text" data-i18n="steps.s1x">Prezzo e tempi sono già scritti. Nessun preventivo da aspettare.</p>
			</li>
			<li class="step">
				<span class="step__num">02</span>
				<h3 class="step__title" data-i18n="steps.s2t">Blocchi la data</h3>
				<p class="step__text" data-i18n="steps.s2x">Un acconto fissa l&rsquo;inizio del lavoro. Il resto alla consegna.</p>
			</li>
			<li class="step">
				<span class="step__num">03</span>
				<h3 class="step__title" data-i18n="steps.s3t">Mandi i materiali</h3>
				<p class="step__text" data-i18n="steps.s3x">Un brief guidato ti chiede solo quello che serve davvero.</p>
			</li>
			<li class="step">
				<span class="step__num">04</span>
				<h3 class="step__title" data-i18n="steps.s4t">Ricevi il lavoro</h3>
				<p class="step__text" data-i18n="steps.s4x">Nei tempi previsti, con due giri di revisioni inclusi. Punto.</p>
			</li>
		</ol>
	</section>

	<!-- ============ FAQ ============ -->
	<section class="faq" id="faq" aria-labelledby="faq-title">
		<div class="section-head">
			<p class="eyebrow" data-i18n="faq.eyebrow">Domande giuste</p>
			<h2 class="section-head__title" id="faq-title" data-i18n="faq.title">Le risposte, senza giri.</h2>
		</div>

		<div class="faq__list">
			<details class="qa">
				<summary><span data-i18n="faq.q1">Il prezzo è davvero fisso?</span><span class="qa__mark" aria-hidden="true"></span></summary>
				<p data-i18n="faq.a1">Sì. Il numero accanto al pacchetto è quello che paghi. Lo mettiamo per iscritto prima di partire e non cambia in corsa.</p>
			</details>
			<details class="qa">
				<summary><span data-i18n="faq.q2">E se servono altre modifiche?</span><span class="qa__mark" aria-hidden="true"></span></summary>
				<p data-i18n="faq.a2">Due giri di revisioni sono inclusi in ogni pacchetto. Se ne servono altri, hanno una tariffa fissa a giro, scritta nel preventivo. Nessuna sorpresa.</p>
			</details>
			<details class="qa">
				<summary><span data-i18n="faq.q3">Quanto tempo ci vuole?</span><span class="qa__mark" aria-hidden="true"></span></summary>
				<p data-i18n="faq.a3">I tempi sono indicati per ogni pacchetto e partono dalla data di start che blocchi tu. Se sei in ritardo con i materiali, la data slitta con te.</p>
			</details>
			<details class="qa">
				<summary><span data-i18n="faq.q4">Emettete fattura?</span><span class="qa__mark" aria-hidden="true"></span></summary>
				<p data-i18n="faq.a4">Sempre. Fattura regolare per ogni progetto e per ogni mese di gestione social.</p>
			</details>
			<details class="qa">
				<summary><span data-i18n="faq.q5">Il mio progetto è più grande. Si può?</span><span class="qa__mark" aria-hidden="true"></span></summary>
				<p data-i18n="faq.a5">Certo. Componi più pacchetti insieme, oppure chiedi un preventivo custom: anche quello a prezzo bloccato, deciso prima di iniziare.</p>
			</details>
		</div>
	</section>

	<!-- ============ PRENOTA / CTA ============ -->
	<section class="cta" id="prenota" aria-labelledby="cta-title">
		<h2 class="cta__title" id="cta-title">
			<span data-i18n="cta.title">Scegli. Paghi. Fatto</span><span class="dot dot--paper" aria-hidden="true"></span>
		</h2>
		<p class="cta__lede" data-i18n="cta.lede">
			Raccontaci il progetto in una call di 20 minuti. Esci con un prezzo
			e una data, non con un &ldquo;ti facciamo sapere&rdquo;.
		</p>
		<div class="cta__actions">
			<a class="btn btn--paper" href="mailto:r.sahraei88@gmail.com?subject=Prenoto%20una%20call" data-i18n="cta.book">Prenota una call</a>
			<a class="btn btn--ghost-paper" href="mailto:r.sahraei88@gmail.com">r.sahraei88@gmail.com</a>
		</div>
	</section>

<?php
get_footer();
