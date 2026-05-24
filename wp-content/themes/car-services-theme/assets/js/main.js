/**
 * Car Services Theme - Main JavaScript
 */

(function () {
	'use strict';

	// Mark the current nav link as active (URL-based fallback)
	function initActiveNavLink() {
		const navLinks = document.querySelectorAll('.main-navigation a');
		if (!navLinks.length) return;

		const normalize = (url) => {
			try {
				const u = new URL(url, window.location.origin);
				let path = u.pathname.replace(/\/+$/, '');
				return path === '' ? '/' : path.toLowerCase();
			} catch (e) {
				return '';
			}
		};

		const currentPath = normalize(window.location.href);
		let bestMatch = null;
		let bestLength = -1;

		navLinks.forEach(function (link) {
			const linkPath = normalize(link.href);
			if (!linkPath) return;

			// Exact match wins immediately
			if (linkPath === currentPath) {
				bestMatch = link;
				bestLength = Infinity;
				return;
			}

			// Otherwise prefer the longest path prefix match (but skip "/")
			if (linkPath !== '/' && currentPath.indexOf(linkPath) === 0 && linkPath.length > bestLength) {
				bestMatch = link;
				bestLength = linkPath.length;
			}
		});

		// Homepage: explicitly match Home link
		if (!bestMatch && currentPath === '/') {
			navLinks.forEach(function (link) {
				if (normalize(link.href) === '/') bestMatch = link;
			});
		}

		if (bestMatch) {
			bestMatch.classList.add('is-active-nav');
			const parentLi = bestMatch.closest('li');
			if (parentLi) parentLi.classList.add('is-active-nav-item');
		}
	}

	// Mobile menu toggle
	function initMobileMenu() {
		const menuToggle = document.querySelector('.menu-toggle');
		const primaryMenu = document.getElementById('primary-menu');
		const navWrapper = document.querySelector('.nav-wrapper');
		const mainNavigation = document.querySelector('.main-navigation');

		if (!menuToggle) {
			return;
		}

		menuToggle.addEventListener('click', function () {
			this.classList.toggle('active');
			if (navWrapper) {
				navWrapper.classList.toggle('active');
			}
		});

		// Close menu when a link is clicked
		if (primaryMenu) {
			const menuLinks = primaryMenu.querySelectorAll('a');
			menuLinks.forEach(function (link) {
				link.addEventListener('click', function () {
					menuToggle.classList.remove('active');
					if (navWrapper) {
						navWrapper.classList.remove('active');
					}
				});
			});
		}

		// Close menu when clicking outside
		document.addEventListener('click', function (event) {
			const isClickInsideNav = mainNavigation.contains(event.target);
			const isClickOnToggle = menuToggle.contains(event.target);

			if (!isClickInsideNav && !isClickOnToggle) {
				menuToggle.classList.remove('active');
				if (navWrapper) {
					navWrapper.classList.remove('active');
				}
			}
		});
	}

	// Smooth scroll for anchor links
	function initSmoothScroll() {
		const links = document.querySelectorAll('a[href^="#"]');

		links.forEach(function (link) {
			link.addEventListener('click', function (e) {
				const href = this.getAttribute('href');
				const target = document.querySelector(href);

				if (target) {
					e.preventDefault();
					target.scrollIntoView({
						behavior: 'smooth',
						block: 'start',
					});
				}
			});
		});
	}

	// Add current class to current menu item
	function initCurrentMenuHighlight() {
		const currentUrl = window.location.pathname;
		const menuLinks = document.querySelectorAll('.main-navigation a');

		menuLinks.forEach(function (link) {
			const href = link.getAttribute('href');

			if (href && href === currentUrl) {
				link.closest('li').classList.add('current-menu-item');
			}
		});
	}

	// Lazy load images
	function initLazyLoad() {
		if ('IntersectionObserver' in window) {
			const images = document.querySelectorAll('img[data-src]');

			const imageObserver = new IntersectionObserver(function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						const img = entry.target;
						img.src = img.dataset.src;
						img.classList.add('loaded');
						imageObserver.unobserve(img);
					}
				});
			});

			images.forEach(function (img) {
				imageObserver.observe(img);
			});
		} else {
			// Fallback for browsers that don't support IntersectionObserver
			const images = document.querySelectorAll('img[data-src]');
			images.forEach(function (img) {
				img.src = img.dataset.src;
			});
		}
	}

	// Form validation
	function initFormValidation() {
		const forms = document.querySelectorAll('form');

		forms.forEach(function (form) {
			form.addEventListener('submit', function (e) {
				const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
				let isValid = true;

				inputs.forEach(function (input) {
					if (!input.value.trim()) {
						input.classList.add('error');
						isValid = false;
					} else {
						input.classList.remove('error');
					}

					if (input.type === 'email') {
						const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
						if (!emailRegex.test(input.value)) {
							input.classList.add('error');
							isValid = false;
						}
					}
				});

				if (!isValid) {
					e.preventDefault();
				}
			});
		});
	}

	// Back to top button
	function initBackToTop() {
		const backToTopBtn = document.createElement('button');
		backToTopBtn.id = 'back-to-top';
		backToTopBtn.setAttribute('aria-label', 'Back to top');
		backToTopBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="18 15 12 9 6 15"></polyline></svg>';
		document.body.appendChild(backToTopBtn);

		window.addEventListener('scroll', function () {
			if (window.scrollY > 300) {
				backToTopBtn.classList.add('visible');
			} else {
				backToTopBtn.classList.remove('visible');
			}
		});

		backToTopBtn.addEventListener('click', function () {
			window.scrollTo({
				top: 0,
				behavior: 'smooth',
			});
		});
	}

	// Add styles for back to top button
	function initBackToTopStyles() {
		const style = document.createElement('style');
		style.textContent = `
			#back-to-top {
				position: fixed;
				bottom: -60px;
				right: 24px;
				width: 44px;
				height: 44px;
				background-color: #00bcd4;
				color: #ffffff;
				border: none;
				border-radius: 50%;
				cursor: pointer;
				font-size: 1.1rem;
				line-height: 1;
				transition: all 0.3s ease;
				z-index: 999;
				display: flex;
				align-items: center;
				justify-content: center;
				padding: 0;
				box-shadow: 0 4px 12px rgba(0, 188, 212, 0.4);
			}

			#back-to-top.visible {
				bottom: 24px;
			}

			#back-to-top:hover {
				background-color: #0097a7;
				transform: translateY(-2px);
				box-shadow: 0 6px 16px rgba(0, 188, 212, 0.5);
			}

			#back-to-top svg {
				display: block;
				margin: 0;
			}
		`;
		document.head.appendChild(style);
	}

	// Scroll-triggered animations via IntersectionObserver.
	// See assets/css/animations.css for visual controls (duration/easing/distance).
	function initScrollAnimations() {
		// Skip entirely for users who prefer reduced motion, or old browsers
		if (
			window.matchMedia('(prefers-reduced-motion: reduce)').matches ||
			!('IntersectionObserver' in window)
		) {
			return;
		}

		// Max stagger index — caps long lists so the last item isn't sluggish.
		// Final delay = MAX_STAGGER × --cs-anim-stagger (e.g. 5 × 0.12s = 0.6s).
		var MAX_STAGGER = 5;

		/*
		 * SOLO — element animates as one unit (no stagger).
		 * The variant class controls *how* it animates:
		 *   default object → 'cs-anim'         (fade + slide up)
		 *   { sel, type:'fade'  }              (pure fade)
		 *   { sel, type:'scale' }              (fade + zoom)
		 */
		var SOLO = [
			{ sel: '.section-header' },
			{ sel: '.brands-heading' },
			{ sel: '.contact-map' },
			{ sel: '.about-story-content' },
			{ sel: '.about-story-image',         type: 'scale' },
			{ sel: '.inspection-intro-content' },
			{ sel: '.inspection-intro-image',    type: 'scale' },
			{ sel: '.contact-form-wrap' },
		];

		/*
		 * STAGGER — children of these containers cascade in sequentially.
		 * Index is reset per selector so each grid staggers from 0.
		 * Use 'type' to change animation flavour for that group.
		 */
		var STAGGER = [
			// Page banner / hero copy — above fold, animates IN on load
			{ sel: '.page-banner-content > h1, .page-banner-content > p' },

			// CTA blocks (homepage + all page templates)
			{ sel: '.cta-content > h2, .cta-content > p, .cta-content > .btn, .cta-content > a.btn' },

			// Homepage card grids
			{ sel: '.services-grid > .service-card' },
			{ sel: '.why-choose-grid > .why-card' },
			{ sel: '.testimonials-masonry > .testimonial-card' },

			// Services page
			{ sel: '.services-page-grid > .service-page-card' },
			{ sel: '.steps-grid > .step-item' },
			{ sel: '.faq-list > .faq-item' },

			// About page
			{ sel: '.stats-grid > .stat-item' },
			{ sel: '.values-grid > .value-card' },
			{ sel: '.team-grid > .team-card' },

			// Inspection page
			{ sel: '.checklist-grid > .checklist-item' },
			{ sel: '.packages-grid > .package-card' },

			// Contact page
			{ sel: '.contact-info-items > .contact-info-item' },

			// Footer columns + bottom bar
			{ sel: '.footer-grid > .footer-brand, .footer-grid > .footer-col' },
			{ sel: '.footer-bottom-inner > p, .footer-bottom-inner > .footer-social-icons' },
		];

		// ── Observer: triggers when element enters viewport, fires once ─────
		var observer = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('cs-visible');
					observer.unobserve(entry.target);
				}
			});
		}, {
			threshold: 0.01,
			/*
			 * Positive bottom margin EXPANDS the trigger zone below the viewport
			 * by 80px. This guarantees elements pinned to the very bottom of
			 * the page (footer copyright, social icons) always fire — previously
			 * a negative bottom margin caused them to remain stuck invisible.
			 */
			rootMargin: '0px 0px 80px 0px',
		});

		// Map type → CSS class
		function classFor(type) {
			if (type === 'fade')  return 'cs-anim-fade';
			if (type === 'scale') return 'cs-anim-scale';
			return 'cs-anim';
		}

		// Above-fold elements: trigger reveal via double-rAF so the browser
		// has painted the hidden state before we flip to visible.
		// This guarantees the transition actually plays rather than skipping.
		function triggerOnLoad(el) {
			requestAnimationFrame(function () {
				requestAnimationFrame(function () {
					el.classList.add('cs-visible');
				});
			});
		}

		function prepare(el, type, staggerIndex) {
			// Skip elements already inside marquee — they have their own motion
			if (el.closest('.brands-track')) return;

			// Don't double-initialize the same element
			if (
				el.classList.contains('cs-anim') ||
				el.classList.contains('cs-anim-fade') ||
				el.classList.contains('cs-anim-scale')
			) return;

			el.classList.add(classFor(type));

			if (typeof staggerIndex === 'number') {
				el.style.setProperty('--cs-i', Math.min(staggerIndex, MAX_STAGGER));
			}

			var rect = el.getBoundingClientRect();
			var inViewport = rect.top < window.innerHeight && rect.bottom > 0;

			if (inViewport) {
				// Already visible on page load → animate IN cinematically
				triggerOnLoad(el);
			} else {
				// Below fold → wait for scroll
				observer.observe(el);
			}
		}

		// Register solo elements
		SOLO.forEach(function (item) {
			document.querySelectorAll(item.sel).forEach(function (el) {
				prepare(el, item.type);
			});
		});

		// Register stagger groups — index resets per selector
		STAGGER.forEach(function (group) {
			document.querySelectorAll(group.sel).forEach(function (el, index) {
				prepare(el, group.type, index);
			});
		});
	}

	// Book Now Modal — auto-binds to any link/button containing "Book Now"
	function initBookNowModal() {
		var modal = document.getElementById('book-now-modal');
		if (!modal) return;

		var dialog       = modal.querySelector('.cs-modal-dialog');
		var lastFocused  = null;

		function open(e) {
			if (e) e.preventDefault();
			lastFocused = document.activeElement;
			modal.classList.add('is-open');
			modal.setAttribute('aria-hidden', 'false');
			document.body.classList.add('cs-modal-open');

			// Move focus into the dialog for accessibility
			setTimeout(function () {
				var firstField = dialog.querySelector(
					'input:not([type="hidden"]):not([disabled]), textarea, select, button:not(.cs-modal-close)'
				);
				if (firstField) {
					firstField.focus();
				} else {
					dialog.querySelector('.cs-modal-close').focus();
				}
			}, 80);
		}

		function close() {
			modal.classList.remove('is-open');
			modal.setAttribute('aria-hidden', 'true');
			document.body.classList.remove('cs-modal-open');
			if (lastFocused && typeof lastFocused.focus === 'function') {
				lastFocused.focus();
			}
		}

		// Auto-bind every link / button whose visible text contains "book now".
		// Opt-out: add class .no-book-modal or attribute data-no-book-modal.
		var nodes = document.querySelectorAll('a, button');
		nodes.forEach(function (el) {
			if (el.closest('#book-now-modal')) return; // never bind inside the modal itself
			if (el.classList.contains('no-book-modal')) return;
			if (el.hasAttribute('data-no-book-modal')) return;

			var text = (el.textContent || '').trim().toLowerCase().replace(/\s+/g, ' ');
			if (text.indexOf('book now') === -1) return;

			el.addEventListener('click', open);
		});

		// Close handlers — backdrop, close button, anything with data-cs-modal-close
		modal.querySelectorAll('[data-cs-modal-close]').forEach(function (el) {
			el.addEventListener('click', function (e) {
				e.preventDefault();
				close();
			});
		});

		// ESC key closes the modal
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && modal.classList.contains('is-open')) {
				close();
			}
		});
	}

	// Initialize all functions when DOM is ready
	function init() {
		initActiveNavLink();
		initMobileMenu();
		initSmoothScroll();
		initCurrentMenuHighlight();
		initLazyLoad();
		initFormValidation();
		initBackToTopStyles();
		initBackToTop();
		// Only run CSS/IntersectionObserver animations when GSAP is not loaded.
		// animations.js sets window.csGSAPEnabled = true at parse time (before this runs).
		if (!window.csGSAPEnabled) {
			initScrollAnimations();
		}
		initBookNowModal();
	}

	// Wait for DOM to be ready
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
