/**
 * Car Services Theme — GSAP Premium Animation System
 * ====================================================
 *
 * Requires: gsap.min.js + ScrollTrigger.min.js (loaded before this file)
 * Config:   window.CSAnimations (set by gsap-init.js)
 *
 * Sets window.csGSAPEnabled = true at parse-time so main.js skips the
 * legacy IntersectionObserver animation system — no double-animation.
 *
 * @package Car_Services_Theme
 * @since   1.2.4
 */

/* ─── Signal to main.js at parse time ─────────────────────────────────────── */
if ( typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined' ) {
	window.csGSAPEnabled = true;
	gsap.registerPlugin( ScrollTrigger );
}

/* ─── Main animation module ────────────────────────────────────────────────── */
(function () {
	'use strict';

	/* Bail early if GSAP is not available */
	if ( typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined' ) {
		return;
	}

	/* ─── Honour prefers-reduced-motion ──────────────────────────────────── */
	if ( window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
		/* Mark as enabled so main.js still skips the CSS fallback,
		   but no GSAP motion is added — elements remain fully visible. */
		document.documentElement.classList.add( 'gsap-active' );
		return;
	}

	/* ─── Pull global config (defined in gsap-init.js) ───────────────────── */
	const CS = window.CSAnimations || {};

	const DUR  = CS.duration || { fast: 0.45, base: 0.88, slow: 1.15, hero: 1.35 };
	const EASE = CS.ease     || { default: 'power3.out', smooth: 'power4.out', back: 'back.out(1.5)' };
	const STAG = CS.stagger  || { cards: 0.13, items: 0.09, cols: 0.16 };
	const DIST = CS.distance || { y: 52, yHero: 44, ySmall: 22 };
	const TRIG = CS.trigger  || { default: 'top 89%', early: 'top 96%', late: 'top 76%', counter: 'top 82%' };

	/* ─── Responsive distance via matchMedia ─────────────────────────────── */
	const isMobile = window.innerWidth < 768;
	const yBase    = isMobile ? Math.round( DIST.y     * 0.60 ) : DIST.y;
	const yHero    = isMobile ? Math.round( DIST.yHero * 0.60 ) : DIST.yHero;
	const ySmall   = isMobile ? Math.round( DIST.ySmall * 0.70 ) : DIST.ySmall;
	const durMult  = isMobile ? 0.80 : 1;                  // 20% faster on mobile

	/* ─── Shared ScrollTrigger base ──────────────────────────────────────── */
	const ST = {
		once         : true,
		toggleActions: 'play none none none',
	};

	/* ══════════════════════════════════════════════════════════════════════
	 * HELPERS
	 * ══════════════════════════════════════════════════════════════════════ */

	/**
	 * Scroll-triggered fade + slide-up for a single element.
	 *
	 * @param {Element|string} el       Target element or CSS selector.
	 * @param {Object}         [opts]   Overrides for any GSAP / ST property.
	 */
	function scrollFadeUp( el, opts = {} ) {
		const target = typeof el === 'string' ? document.querySelector( el ) : el;
		if ( ! target ) return;

		gsap.from( target, {
			autoAlpha : 0,
			y         : opts.y        ?? yBase,
			duration  : ( opts.duration ?? DUR.base ) * durMult,
			ease      : opts.ease     ?? EASE.default,
			delay     : opts.delay    ?? 0,
			scrollTrigger: {
				...ST,
				trigger : target,
				start   : opts.start ?? TRIG.default,
			},
		} );
	}

	/**
	 * Scale + fade reveal — premium feel for images and featured containers.
	 *
	 * @param {Element|string} el
	 * @param {Object}         [opts]
	 */
	function scrollScaleReveal( el, opts = {} ) {
		const target = typeof el === 'string' ? document.querySelector( el ) : el;
		if ( ! target ) return;

		gsap.from( target, {
			autoAlpha : 0,
			scale     : opts.scale    ?? 0.93,
			y         : opts.y        ?? ySmall,
			duration  : ( opts.duration ?? DUR.slow ) * durMult,
			ease      : opts.ease     ?? EASE.smooth,
			delay     : opts.delay    ?? 0,
			scrollTrigger: {
				...ST,
				trigger : target,
				start   : opts.start ?? 'top 84%',
			},
		} );
	}

	/**
	 * Batch fade-up for a CSS selector (all matching elements share one
	 * ScrollTrigger batch — much more performant than individual triggers).
	 *
	 * @param {string} selector  CSS selector for the group.
	 * @param {Object} [opts]
	 */
	function batchFadeUp( selector, opts = {} ) {
		const els = gsap.utils.toArray( selector );
		if ( ! els.length ) return;

		// Pre-hide immediately so elements are never visible → invisible → visible.
		// gsap.from() inside onEnter causes a flash because it records the current
		// (visible) state as the TO target then instantly jumps to invisible (FROM).
		gsap.set( els, { autoAlpha: 0, y: opts.y ?? yBase } );

		ScrollTrigger.batch( els, {
			start : opts.start ?? TRIG.default,
			once  : true,
			onEnter: ( batch ) => {
				gsap.to( batch, {
					autoAlpha : 1,
					y         : 0,
					duration  : ( opts.duration ?? DUR.base ) * durMult,
					ease      : opts.ease     ?? EASE.default,
					stagger   : opts.stagger  ?? STAG.cards,
				} );
			},
		} );
	}

	/* ══════════════════════════════════════════════════════════════════════
	 * 1 — HERO SECTION (above-fold, load-triggered, no scroll needed)
	 * ══════════════════════════════════════════════════════════════════════ */
	function initHero() {
		const hero = document.querySelector( '.hero-section' );
		if ( ! hero ) return;

		const logo     = hero.querySelector( '.hero-logo' );
		const title    = hero.querySelector( '.hero-title' );
		const subtitle = hero.querySelector( '.hero-subtitle' );
		const btn      = hero.querySelector( '.btn' );

		const tl = gsap.timeline( { delay: 0.18 } );

		if ( logo ) {
			tl.from( logo, {
				autoAlpha : 0,
				scale     : 0.82,
				duration  : DUR.hero * durMult,
				ease      : EASE.smooth,
			} );
		}

		if ( title ) {
			tl.from( title, {
				autoAlpha : 0,
				y         : yHero,
				duration  : DUR.hero * durMult,
				ease      : EASE.smooth,
			}, logo ? '-=0.72' : '0' );
		}

		if ( subtitle ) {
			tl.from( subtitle, {
				autoAlpha : 0,
				y         : ySmall * 1.5,
				duration  : DUR.base * durMult,
				ease      : EASE.default,
			}, '-=0.68' );
		}

		if ( btn ) {
			tl.from( btn, {
				autoAlpha : 0,
				y         : ySmall,
				duration  : DUR.base * durMult,
				ease      : EASE.default,
			}, '-=0.58' );
		}
	}

	/* ══════════════════════════════════════════════════════════════════════
	 * 2 — PAGE BANNERS (above-fold entrance on inner pages)
	 * ══════════════════════════════════════════════════════════════════════ */
	function initPageBanner() {
		const els = gsap.utils.toArray( '.page-banner-content > h1, .page-banner-content > p' );
		if ( ! els.length ) return;

		gsap.from( els, {
			autoAlpha : 0,
			y         : yHero,
			duration  : DUR.hero * durMult,
			ease      : EASE.smooth,
			stagger   : 0.22,
			delay     : 0.25,
		} );
	}

	/* ══════════════════════════════════════════════════════════════════════
	 * 3 — SECTION HEADERS (tag chip + heading + subtext cascade)
	 * ══════════════════════════════════════════════════════════════════════ */
	function initSectionHeaders() {
		/* Section tag chips (small, fast) */
		batchFadeUp( '.section-tag, .brands-heading', {
			y        : ySmall,
			duration : DUR.fast,
			stagger  : 0,
		} );

		/* Full .section-header containers — children cascade */
		gsap.utils.toArray( '.section-header' ).forEach( header => {
			const children = Array.from( header.children );
			if ( ! children.length ) return;

			gsap.from( children, {
				autoAlpha : 0,
				y         : yBase,
				duration  : DUR.base * durMult,
				ease      : EASE.default,
				stagger   : 0.16,
				scrollTrigger: {
					...ST,
					trigger : header,
					start   : TRIG.default,
				},
			} );
		} );

		/* Standalone intro headings on page templates */
		batchFadeUp(
			'.services-page-intro .section-header, ' +
			'.inspection-intro-content > span, ' +
			'.inspection-intro-content > h2, ' +
			'.inspection-intro-content > p',
			{ y: yBase, duration: DUR.base, stagger: 0.14 }
		);
	}

	/* ══════════════════════════════════════════════════════════════════════
	 * 4 — CARD GRIDS (batched stagger — one ScrollTrigger per type)
	 * ══════════════════════════════════════════════════════════════════════ */
	function initCards() {
		/* ── Homepage ──────────────────────────────────────────────────── */
		batchFadeUp( '.service-card',     { y: yBase, stagger: STAG.cards } );
		batchFadeUp( '.why-card',         { y: yBase, stagger: STAG.cards } );
		batchFadeUp( '.testimonial-card', { y: yBase, stagger: STAG.cards } );

		/* ── Services page ─────────────────────────────────────────────── */
		batchFadeUp( '.service-page-card', { y: yBase, stagger: STAG.cards } );

		/* ── About page ────────────────────────────────────────────────── */
		batchFadeUp( '.value-card', { y: yBase, stagger: STAG.cards } );
		batchFadeUp( '.team-card',  { y: yBase, stagger: STAG.cards } );
		batchFadeUp( '.stat-item',  {
			y        : Math.round( ySmall * 1.4 ),
			duration : DUR.base,
			stagger  : 0.11,
		} );

		/* ── Inspection page ───────────────────────────────────────────── */
		batchFadeUp( '.checklist-item', {
			y        : ySmall,
			duration : DUR.fast,
			stagger  : STAG.items,
		} );
		batchFadeUp( '.package-card', { y: yBase, stagger: STAG.cards } );

		/* ── Steps (How It Works) — both Services + Inspection pages ──── */
		batchFadeUp( '.step-item', { y: yBase, stagger: STAG.cards } );

		/* ── FAQ ────────────────────────────────────────────────────────── */
		batchFadeUp( '.faq-item', {
			y        : Math.round( ySmall * 1.2 ),
			duration : DUR.base,
			stagger  : STAG.items,
		} );

		/* ── Contact info items ─────────────────────────────────────────── */
		batchFadeUp( '.contact-info-item', {
			y       : yBase,
			stagger : STAG.items,
		} );
	}

	/* ══════════════════════════════════════════════════════════════════════
	 * 5 — IMAGES & MEDIA (scale + fade reveal)
	 * ══════════════════════════════════════════════════════════════════════ */
	function initImages() {
		/* About story image */
		gsap.utils.toArray( '.about-story-image' ).forEach( el => {
			scrollScaleReveal( el, { scale: 0.92, y: Math.round( yBase * 0.6 ) } );
		} );

		/* Inspection intro image */
		gsap.utils.toArray( '.inspection-intro-image' ).forEach( el => {
			scrollScaleReveal( el, { scale: 0.92, y: Math.round( yBase * 0.6 ) } );
		} );

		/* Contact map */
		gsap.utils.toArray( '.contact-map' ).forEach( el => {
			scrollScaleReveal( el, { scale: 0.97, y: ySmall, duration: DUR.base } );
		} );

		/* Brand logos carousel wrapper */
		scrollFadeUp( '.brands-carousel-wrapper', {
			y        : ySmall,
			duration : DUR.base,
		} );

		/* Inlined post/page featured images */
		gsap.utils.toArray( '.featured-image, .post-item img' ).forEach( el => {
			scrollScaleReveal( el, { scale: 0.96, y: ySmall } );
		} );
	}

	/* ══════════════════════════════════════════════════════════════════════
	 * 6 — STORY / INTRO CONTENT BLOCKS (large text + copy blocks)
	 * ══════════════════════════════════════════════════════════════════════ */
	function initContentBlocks() {
		scrollFadeUp( '.about-story-content', {
			y        : yBase,
			duration : DUR.slow,
		} );

		scrollFadeUp( '.inspection-intro-content', {
			y        : yBase,
			duration : DUR.slow,
		} );
	}

	/* ══════════════════════════════════════════════════════════════════════
	 * 7 — CTA SECTIONS (heading → paragraph → button cascade)
	 * ══════════════════════════════════════════════════════════════════════ */
	function initCTA() {
		gsap.utils.toArray( '.cta-content' ).forEach( cta => {
			const children = gsap.utils.toArray(
				cta.querySelectorAll( 'h2, p, a.btn, button.btn, .btn' )
			);
			if ( ! children.length ) return;

			gsap.from( children, {
				autoAlpha : 0,
				y         : yBase,
				duration  : DUR.slow * durMult,
				ease      : EASE.smooth,
				stagger   : 0.20,
				scrollTrigger: {
					...ST,
					trigger : cta,
					start   : TRIG.late,
				},
			} );
		} );
	}

	/* ══════════════════════════════════════════════════════════════════════
	 * 8 — CONTACT FORM WRAPPER
	 * ══════════════════════════════════════════════════════════════════════ */
	function initContact() {
		scrollFadeUp( '.contact-form-wrap', {
			y        : yBase,
			duration : DUR.slow,
		} );
	}

	/* ══════════════════════════════════════════════════════════════════════
	 * 9 — FOOTER (staggered columns + bottom bar)
	 * ══════════════════════════════════════════════════════════════════════ */
	function initFooter() {
		batchFadeUp( '.footer-brand, .footer-col', {
			y       : Math.round( yBase * 0.75 ),
			stagger : STAG.cols,
			start   : TRIG.early,
		} );

		/* Footer bottom bar — each child fades in individually */
		const bottomChildren = gsap.utils.toArray( '.footer-bottom-inner > *' );
		bottomChildren.forEach( ( el, i ) => {
			scrollFadeUp( el, {
				y        : ySmall,
				duration : DUR.fast,
				delay    : i * 0.14,
				start    : TRIG.early,
			} );
		} );
	}

	/* ══════════════════════════════════════════════════════════════════════
	 * 10 — BUTTON HOVER INTERACTIONS (GSAP spring physics)
	 * ══════════════════════════════════════════════════════════════════════ */
	function initButtonHover() {
		const buttons = gsap.utils.toArray( '.btn' );

		buttons.forEach( btn => {
			/* Skip buttons inside the brand marquee (they're decorative) */
			if ( btn.closest( '.brands-track' ) ) return;

			const onEnter = () =>
				gsap.to( btn, {
					scale     : 1.045,
					y         : -2,
					duration  : 0.30,
					ease      : EASE.back,
					overwrite : 'auto',
				} );

			const onLeave = () =>
				gsap.to( btn, {
					scale     : 1,
					y         : 0,
					duration  : 0.38,
					ease      : EASE.default,
					overwrite : 'auto',
				} );

			btn.addEventListener( 'mouseenter', onEnter );
			btn.addEventListener( 'mouseleave', onLeave );

			/* Press feedback */
			btn.addEventListener( 'mousedown', () =>
				gsap.to( btn, { scale: 0.97, duration: 0.12, ease: 'power1.in', overwrite: 'auto' } )
			);
			btn.addEventListener( 'mouseup', onLeave );
		} );
	}

	/* ══════════════════════════════════════════════════════════════════════
	 * 11 — STAT COUNTER ANIMATION
	 * ══════════════════════════════════════════════════════════════════════ */
	function initStatCounters() {
		gsap.utils.toArray( '.stat-number' ).forEach( el => {
			const raw = el.textContent.trim();

			/* Match patterns like: "8,500+" / "99%" / "15+" / "12" */
			const m = raw.match( /^([^0-9]*)([0-9,]+)([^0-9]*)$/ );
			if ( ! m ) return;

			const prefix = m[1] || '';
			const num    = parseInt( m[2].replace( /,/g, '' ), 10 );
			const suffix = m[3] || '';

			if ( isNaN( num ) || num === 0 ) return;

			const obj = { val: 0 };

			gsap.to( obj, {
				val      : num,
				duration : 1.9,
				ease     : 'power2.out',
				delay    : 0.25,
				onUpdate: () => {
					const v   = Math.round( obj.val );
					/* Restore comma formatting for large numbers */
					const fmt = v >= 1000 ? v.toLocaleString() : String( v );
					el.textContent = prefix + fmt + suffix;
				},
				scrollTrigger: {
					trigger : el,
					start   : TRIG.counter,
					once    : true,
				},
			} );
		} );
	}

	/* ══════════════════════════════════════════════════════════════════════
	 * 12 — NAVIGATION HEADER (subtle entrance on page load)
	 * ══════════════════════════════════════════════════════════════════════ */
	function initHeader() {
		const header = document.querySelector( '.site-header' );
		if ( ! header ) return;

		gsap.from( header, {
			autoAlpha : 0,
			y         : -16,
			duration  : DUR.base,
			ease      : EASE.smooth,
			delay     : 0.05,
		} );
	}

	/* ══════════════════════════════════════════════════════════════════════
	 * INITIALISE
	 * ══════════════════════════════════════════════════════════════════════ */
	function init() {
		/* Mark GSAP as active — CSS adds .gsap-active to <html> so the
		   legacy .cs-anim rules never apply (no double-animation risk). */
		document.documentElement.classList.add( 'gsap-active' );

		initHeader();
		initHero();
		initPageBanner();
		initSectionHeaders();
		initCards();
		initImages();
		initContentBlocks();
		initCTA();
		initContact();
		initFooter();
		initButtonHover();
		initStatCounters();

		/* After all media loads, recalculate trigger positions.
		   Image heights can shift layout before load completes. */
		window.addEventListener( 'load', () => {
			ScrollTrigger.refresh();
		} );
	}

	/* ── Boot ──────────────────────────────────────────────────────────── */
	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', init );
	} else {
		init();
	}

})();
