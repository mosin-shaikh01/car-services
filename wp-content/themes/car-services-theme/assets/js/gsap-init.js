/**
 * Car Services Theme — GSAP Global Configuration
 * ================================================
 *
 * This is the SINGLE place to control every animation on the site.
 * Edit the values below to change how animations feel — no other
 * files need to be touched.
 *
 * Loaded before animations.js so the config is available at parse time.
 *
 * @package Car_Services_Theme
 * @since   1.2.4
 */

/* ============================================================
 * HOW TO CONTROL ANIMATION SPEED GLOBALLY
 * ============================================================
 *
 *  1. DURATION — how long each animation takes (seconds):
 *     Snappy   → fast:0.25  base:0.5   slow:0.7   hero:0.9
 *     Premium  → fast:0.45  base:0.85  slow:1.1   hero:1.3  ← current
 *     Cinematic→ fast:0.6   base:1.1   slow:1.5   hero:1.8
 *
 *  2. EASE — acceleration curve (GSAP strings):
 *     'power3.out'     — smooth professional deceleration (default)
 *     'power4.out'     — stronger, more dramatic deceleration
 *     'expo.out'       — very fast in, almost instant stop
 *     'back.out(1.2)'  — slight overshoot (premium feel)
 *     See all: https://gsap.com/docs/v3/Eases/
 *
 *  3. STAGGER — delay between each child in a group (seconds):
 *     Tight   → 0.07–0.09   Relaxed → 0.16–0.22
 *
 *  4. DISTANCE — how far elements travel before landing (px):
 *     Subtle  → y: 24–30    Dramatic → y: 60–90
 *
 *  5. SCROLL TRIGGER — when the animation fires:
 *     'top 95%' — fires as soon as element enters screen
 *     'top 88%' — fires when top of element is near (default)
 *     'top 75%' — waits until element is well into view
 * ============================================================ */

window.CSAnimations = {

	/* ── Duration ─────────────────────────────────────────────────────────
	 * All values in seconds.
	 * fast  → small elements: tags, chips, icons
	 * base  → most scroll-triggered elements
	 * slow  → images, featured sections
	 * hero  → above-fold hero entrance
	 * ──────────────────────────────────────────────────────────────────── */
	duration: {
		fast : 0.45,
		base : 0.88,
		slow : 1.15,
		hero : 1.35,
	},

	/* ── Ease ─────────────────────────────────────────────────────────────
	 * Named presets used throughout animations.js.
	 * Change 'default' to change the feel of most animations globally.
	 * ──────────────────────────────────────────────────────────────────── */
	ease: {
		default : 'power3.out',
		smooth  : 'power4.out',
		back    : 'back.out(1.5)',
		inOut   : 'power2.inOut',
	},

	/* ── Stagger ──────────────────────────────────────────────────────────
	 * Delay between each element in a cascading group.
	 * cards  → service/why/testimonial grids
	 * items  → checklist, FAQ, contact info
	 * cols   → footer columns
	 * ──────────────────────────────────────────────────────────────────── */
	stagger: {
		cards : 0.13,
		items : 0.09,
		cols  : 0.16,
	},

	/* ── Distance ─────────────────────────────────────────────────────────
	 * Translate offset for entrance animations.
	 * y      → standard fade-up distance
	 * yHero  → hero / above-fold entrance
	 * ySmall → subtle elements (tags, labels)
	 * ──────────────────────────────────────────────────────────────────── */
	distance: {
		y      : 52,
		yHero  : 44,
		ySmall : 22,
	},

	/* ── ScrollTrigger ────────────────────────────────────────────────────
	 * 'start' defines the trigger position as: "element edge  viewport %"
	 * ──────────────────────────────────────────────────────────────────── */
	trigger: {
		default  : 'top 89%',
		early    : 'top 96%',   // footer, near-bottom elements
		late     : 'top 76%',   // CTA, high-impact sections
		counter  : 'top 82%',   // stat counters (need to be clearly in view)
	},
};
