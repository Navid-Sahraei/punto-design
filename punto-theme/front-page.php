<?php
/**
 * Front page — Italian homepage (ported from index.html).
 *
 * Shown when Settings → Reading → "Your homepage displays" is set to a static
 * page. Markup, classes, copy and order are identical to the static site.
 *
 * @package punto
 */

get_header();
?>

	<!-- ============ HERO ============ -->
	<section class="hero" aria-labelledby="hero-title">
		<p class="eyebrow">Studio di design &amp; social media</p>
		<h1 class="hero__title" id="hero-title">
			<span class="hero__word">Punto</span><span class="hero__dot" aria-hidden="true"></span>
		</h1>
		<p class="hero__lede">
			Design e social a prezzo fisso. Un pacchetto, un numero,
			nessuna sorpresa in fattura.
		</p>
		<div class="hero__actions">
			<a class="btn btn--cobalt" href="#pacchetti">Scegli un pacchetto</a>
			<a class="btn btn--ghost" href="#come-funziona">Come funziona</a>
		</div>
		<p class="hero__foot">
			Due giri di revisioni inclusi<span class="tick" aria-hidden="true"></span>
			Consegna nei tempi<span class="tick" aria-hidden="true"></span>
			Fattura sempre<span class="tick" aria-hidden="true"></span>
		</p>
	</section>

	<!-- ============ MANIFESTO ============ -->
	<section class="manifesto" aria-labelledby="manifesto-title">
		<h2 class="manifesto__title" id="manifesto-title">
			Basta preventivi che cambiano<span class="dot dot--amber" aria-hidden="true"></span>
		</h2>
		<ul class="manifesto__list">
			<li>Niente tariffe orarie<span class="dot" aria-hidden="true"></span></li>
			<li>Niente &ldquo;dipende&rdquo;<span class="dot" aria-hidden="true"></span></li>
			<li>Niente revisioni a sorpresa<span class="dot" aria-hidden="true"></span></li>
		</ul>
		<p class="manifesto__note">
			Il numero che vedi accanto al pacchetto è il numero che paghi.
			Lo scriviamo prima di iniziare, e resta quello.
		</p>
	</section>

	<div class="divider" role="separator" aria-hidden="true"><span></span></div>

	<!-- ============ PACCHETTI ============ -->
	<section class="packages" id="pacchetti" aria-labelledby="pkg-title">
		<div class="section-head">
			<p class="eyebrow">I pacchetti</p>
			<h2 class="section-head__title" id="pkg-title">Scegli. Sai già quanto costa.</h2>
		</div>

		<div class="pkg-grid">
			<!-- Identità -->
			<article class="pkg">
				<header class="pkg__head">
					<h3 class="pkg__name">Identità</h3>
					<p class="pkg__desc">Logo, palette, tipografia e un mini brand kit pronto all&rsquo;uso.</p>
				</header>
				<p class="pkg__price"><span class="pkg__cur">€</span>490<span class="pkg__unit">/ progetto</span></p>
				<ul class="pkg__list">
					<li>Logo in versione principale + secondaria</li>
					<li>Palette colori e coppia di font</li>
					<li>Kit file per stampa e web</li>
					<li>Consegna in 10 giorni</li>
				</ul>
				<?php
				/**
				 * TODO (WooCommerce): point this button at the "Identità" product.
				 * Once WooCommerce is installed and the product created, replace the
				 * href="#prenota" below with the add-to-cart or product URL, e.g.:
				 *   href="<?php echo esc_url( home_url( '/?add-to-cart=IDENTITA_PRODUCT_ID' ) ); ?>"
				 * or the product permalink from get_permalink( IDENTITA_PRODUCT_ID ).
				 * Keep the class="btn btn--ink pkg__cta" and the button text unchanged.
				 */
				?>
				<a class="btn btn--ink pkg__cta" href="#prenota">Prenota Identità</a>
			</article>

			<!-- Social - featured -->
			<article class="pkg pkg--featured">
				<span class="pkg__badge">Il più scelto</span>
				<header class="pkg__head">
					<h3 class="pkg__name">Social</h3>
					<p class="pkg__desc">Contenuti pronti da pubblicare, ogni mese, senza rincorrere le idee.</p>
				</header>
				<p class="pkg__price"><span class="pkg__cur">€</span>390<span class="pkg__unit">/ mese</span></p>
				<ul class="pkg__list">
					<li>12 post + 8 storie al mese</li>
					<li>Piano editoriale mensile</li>
					<li>Grafiche coordinate con la tua identità</li>
					<li>Nessun vincolo: disdici quando vuoi</li>
				</ul>
				<?php
				/**
				 * TODO (WooCommerce): point this button at the "Social" product
				 * (a subscription/monthly product). Replace href="#prenota" below, e.g.:
				 *   href="<?php echo esc_url( home_url( '/?add-to-cart=SOCIAL_PRODUCT_ID' ) ); ?>"
				 * Keep the class="btn btn--paper pkg__cta" and the button text unchanged.
				 */
				?>
				<a class="btn btn--paper pkg__cta" href="#prenota">Prenota Social</a>
			</article>

			<!-- Sito -->
			<article class="pkg">
				<header class="pkg__head">
					<h3 class="pkg__name">Sito</h3>
					<p class="pkg__desc">Un sito vetrina one-page, veloce e leggibile su ogni schermo.</p>
				</header>
				<p class="pkg__price"><span class="pkg__cur">€</span>890<span class="pkg__unit">/ progetto</span></p>
				<ul class="pkg__list">
					<li>One-page responsive, testi inclusi</li>
					<li>Modulo contatti e mappa</li>
					<li>Ottimizzazione base per Google</li>
					<li>Consegna in 15 giorni</li>
				</ul>
				<?php
				/**
				 * TODO (WooCommerce): point this button at the "Sito" product.
				 * Replace href="#prenota" below, e.g.:
				 *   href="<?php echo esc_url( home_url( '/?add-to-cart=SITO_PRODUCT_ID' ) ); ?>"
				 * Keep the class="btn btn--ink pkg__cta" and the button text unchanged.
				 */
				?>
				<a class="btn btn--ink pkg__cta" href="#prenota">Prenota Sito</a>
			</article>
		</div>

		<p class="packages__fineprint">
			Prezzi IVA esclusa. Serve più di un pacchetto? Si combinano.
			Progetto fuori misura? <a href="#prenota">Preventivo custom, comunque bloccato.</a>
		</p>
	</section>

	<div class="divider" role="separator" aria-hidden="true"><span></span></div>

	<!-- ============ COME FUNZIONA ============ -->
	<section class="steps" id="come-funziona" aria-labelledby="steps-title">
		<div class="section-head">
			<p class="eyebrow">Come funziona</p>
			<h2 class="section-head__title" id="steps-title">Quattro passi, e finisce lì.</h2>
		</div>

		<ol class="steps__list">
			<li class="step">
				<span class="step__num">01</span>
				<h3 class="step__title">Scegli il pacchetto</h3>
				<p class="step__text">Prezzo e tempi sono già scritti. Nessun preventivo da aspettare.</p>
			</li>
			<li class="step">
				<span class="step__num">02</span>
				<h3 class="step__title">Blocchi la data</h3>
				<p class="step__text">Un acconto fissa l&rsquo;inizio del lavoro. Il resto alla consegna.</p>
			</li>
			<li class="step">
				<span class="step__num">03</span>
				<h3 class="step__title">Mandi i materiali</h3>
				<p class="step__text">Un brief guidato ti chiede solo quello che serve davvero.</p>
			</li>
			<li class="step">
				<span class="step__num">04</span>
				<h3 class="step__title">Ricevi il lavoro</h3>
				<p class="step__text">Nei tempi previsti, con due giri di revisioni inclusi. Punto.</p>
			</li>
		</ol>
	</section>

	<!-- ============ FAQ ============ -->
	<section class="faq" id="faq" aria-labelledby="faq-title">
		<div class="section-head">
			<p class="eyebrow">Domande giuste</p>
			<h2 class="section-head__title" id="faq-title">Le risposte, senza giri.</h2>
		</div>

		<div class="faq__list">
			<details class="qa">
				<summary>Il prezzo è davvero fisso?<span class="qa__mark" aria-hidden="true"></span></summary>
				<p>Sì. Il numero accanto al pacchetto è quello che paghi. Lo mettiamo per iscritto prima di partire e non cambia in corsa.</p>
			</details>
			<details class="qa">
				<summary>E se servono altre modifiche?<span class="qa__mark" aria-hidden="true"></span></summary>
				<p>Due giri di revisioni sono inclusi in ogni pacchetto. Se ne servono altri, hanno una tariffa fissa a giro, scritta nel preventivo. Nessuna sorpresa.</p>
			</details>
			<details class="qa">
				<summary>Quanto tempo ci vuole?<span class="qa__mark" aria-hidden="true"></span></summary>
				<p>I tempi sono indicati per ogni pacchetto e partono dalla data di start che blocchi tu. Se sei in ritardo con i materiali, la data slitta con te.</p>
			</details>
			<details class="qa">
				<summary>Emettete fattura?<span class="qa__mark" aria-hidden="true"></span></summary>
				<p>Sempre. Fattura regolare per ogni progetto e per ogni mese di gestione social.</p>
			</details>
			<details class="qa">
				<summary>Il mio progetto è più grande. Si può?<span class="qa__mark" aria-hidden="true"></span></summary>
				<p>Certo. Componi più pacchetti insieme, oppure chiedi un preventivo custom: anche quello a prezzo bloccato, deciso prima di iniziare.</p>
			</details>
		</div>
	</section>

	<!-- ============ PRENOTA / CTA ============ -->
	<section class="cta" id="prenota" aria-labelledby="cta-title">
		<h2 class="cta__title" id="cta-title">
			Scegli. Paghi. Fatto<span class="dot dot--paper" aria-hidden="true"></span>
		</h2>
		<p class="cta__lede">
			Raccontaci il progetto in una call di 20 minuti. Esci con un prezzo
			e una data, non con un &ldquo;ti facciamo sapere&rdquo;.
		</p>
		<div class="cta__actions">
			<a class="btn btn--paper" href="mailto:ciao@puntodesign.it?subject=Prenoto%20una%20call">Prenota una call</a>
			<a class="btn btn--ghost-paper" href="mailto:ciao@puntodesign.it">ciao@puntodesign.it</a>
		</div>
	</section>

<?php
get_footer();
