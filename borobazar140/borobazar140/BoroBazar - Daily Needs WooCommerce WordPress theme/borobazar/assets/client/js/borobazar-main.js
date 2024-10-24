(function ($) {
	('use strict');

	init();

	/**
	 * init functions.
	 */
	function init() {
		handleMenuDrawer();
		handlePostGallery();
		handleSkipLinkFocus();
		handleMiniCartDrawer();
		handleKeyboardNavigation();
		handleBoroBazarStoreNotice();
		handleAuthForm();
	}

	/**
	 * handling keyboard tab index focus.
	 */
	function handleSkipLinkFocus() {
		var isIe = /(trident|msie)/i.test(navigator.userAgent);
		if (isIe && document.getElementById && window.addEventListener) {
			window.addEventListener(
				'hashchange',
				function () {
					var id = location.hash.substring(1),
						element;
					if (!/^[A-z0-9_-]+$/.test(id)) {
						return;
					}
					element = document.getElementById(id);
					if (element) {
						if (
							!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)
						) {
							element.tabIndex = -1;
						}
						element.focus();
					}
				},
				false
			);
		}
	}

	/**
	 * handling borobazar store notice
	 */
	function handleBoroBazarStoreNotice() {
		if ($('.borobazar-store-notice').length) {
			// init store notice to session
			if (!sessionStorage.getItem('borobazar_store_notice')) {
				sessionStorage.setItem('borobazar_store_notice', 'on');
			}

			if (sessionStorage.getItem('borobazar_store_notice') === 'on') {
				$('.borobazar-store-notice').removeClass('hidden');
				$('.borobazar-store-notice').addClass('flex');
			} else {
				$('.borobazar-store-notice').addClass('hidden');
				$('.borobazar-store-notice').removeClass('flex');
			}

			$('.borobazar-store-notice-close').on('click', function () {
				if (sessionStorage.getItem('borobazar_store_notice') === 'off') {
					sessionStorage.setItem('borobazar_store_notice', 'on');
					$('.borobazar-store-notice').removeClass('hidden');
					$('.borobazar-store-notice').addClass('flex');
				} else {
					sessionStorage.setItem('borobazar_store_notice', 'off');
					$('.borobazar-store-notice').addClass('hidden');
					$('.borobazar-store-notice').removeClass('flex');
				}
			});
		}
	}

	/**
	 * handling menu keyboard access for theme unit test
	 */
	function handleKeyboardNavigation() {
		var menuLinks = $('.borobazar-main-menu a');
		var lastMenuLink = $('.borobazar-main-menu>li:last-child>a');

		// each time a menu link is focused.
		menuLinks.focus(function () {
			var menuItem = $(this).parent();
			//sets or removes the .focus class on an element.
			if (!menuItem.hasClass('focus')) {
				menuItem.parent().children().removeClass('focus');
				menuItem.addClass('focus');
			} else {
				menuItem.removeClass('focus');
			}
		});

		// remove last li focus state
		lastMenuLink.blur(function () {
			lastMenuLink.parent().removeClass('focus');
		});

		// hide dropdown and remove focus state
		$(document).mouseup((e) => {
			if (!$('.borobazar-main-menu, .borobazar-main-menu *').is(e.target)) {
				menuLinks.parent().removeClass('focus');
			}
		});
	}

	/**
	 * handling sticky header scroll state.
	 */
	function handlingStickyHeaderScroll() {
		var body = $('body');
		var header = $('.site-header.sticky');
		var stickyElHeight = 0;
		if (header.length) {
			var headerOffsetTop = header[0].getBoundingClientRect().top;
			var scrollPosition = $(window).scrollTop();
			stickyElHeight = header.children('div').outerHeight();

			// set offset value for mobile device
			if (body.has('admin-bar') && window.innerWidth < 769) {
				headerOffsetTop = 0;
			}

			//Sticky elements total height(on top)
			$('body').css('--sticky-top-height', stickyElHeight + 'px');

			// add & remove class based on scroll position
			if (scrollPosition > headerOffsetTop) {
				body.addClass('borobazar-on-scroll');
				addHeaderStickyClass();
			} else {
				body.removeClass('borobazar-on-scroll');
				removeHeaderStickyClass();
			}

			// add sticky class
			function addHeaderStickyClass() {
				if (header.length !== 1) {
					return false;
				}
				header.addClass('header-on-float shadow-sticky-nav');
				header.removeClass('shadow-border-lighter');
			}

			// remove sticky class
			function removeHeaderStickyClass() {
				if (header.length !== 1) {
					return false;
				}
				header.addClass('shadow-border-lighter');
				header.removeClass('header-on-float shadow-sticky-nav');
			}
		}
	}

	/**
	 * Reusable drawer function
	 * @param  {} drawerRoot
	 * @param  {} drawerHandler
	 * @param  {} identifierClass
	 */
	function useDrawer(drawerRoot, drawerHandler, identifierClass = '') {
		if (drawerRoot.length) {
			var body = $('body');
			var thisDrawer = drawerRoot;
			var drawerFromRight = thisDrawer.hasClass('borobazar-drawer-from-right');
			var drawerContent = thisDrawer.find('.borobazar-drawer-content');
			var drawerOverlay = thisDrawer.find('.borobazar-drawer-overlay');
			var drawerClose = thisDrawer.find('.borobazar-drawer-close');

			// show drawer on drawer handler click
			drawerHandler.click(function () {
				showDrawer();
			});

			// hide drawer on overlay click
			drawerOverlay.click(function () {
				hideDrawer();
			});

			// hide drawer on close button click
			if (drawerClose.length) {
				drawerClose.click(function () {
					hideDrawer();
				});
			}

			// hide drawer on esc key press
			$(document).on('keydown', function (e) {
				if (e.which === 27) {
					hideDrawer();
				}
			});

			// open drawer & adding root class with overlay
			function showDrawer() {
				body.addClass(identifierClass);
				thisDrawer.addClass('drawer-open');
				drawerOverlay.removeClass('opacity-0 invisible pointer-events-none');
				useFreezeBodyScroll(true);
				if (drawerFromRight) {
					drawerContent.removeClass('translate-x-full');
				} else {
					drawerContent.removeClass('-translate-x-full');
				}
			}

			// hide drawer & removing root class with overlay
			function hideDrawer() {
				body.removeClass(identifierClass);
				thisDrawer.removeClass('drawer-open');
				drawerOverlay.addClass('opacity-0 invisible pointer-events-none');
				useFreezeBodyScroll(false);
				if (drawerFromRight) {
					drawerContent.addClass('translate-x-full');
				} else {
					drawerContent.addClass('-translate-x-full');
				}
			}
		}
	}

	/**
	 * handle menu drawer
	 */
	function handleMenuDrawer() {
		var menuDrawerRoot = $('.borobazar-drawer-navigation');
		var menuDrawerHandler = $('.borobazar-navigation-drawer-handler');
		useDrawer(
			menuDrawerRoot,
			menuDrawerHandler,
			'borobazar-drawer-navigation-open'
		);
	}

	/**
	 * handle mini cart drawer
	 */
	function handleMiniCartDrawer() {
		var miniCartDrawerRoot = $('.borobazar-mini-cart-drawer');
		var miniCartDrawerHandler = $('.borobazar-mini-cart-drawer-handler');
		useDrawer(
			miniCartDrawerRoot,
			miniCartDrawerHandler,
			'borobazar-mini-cart-drawer-open'
		);
	}

	/**
	 * run for only the drawer menu DOM exists
	 */
	if ($('.borobazar-drawer-menu').length) {
		$('.borobazar-drawer-menu li>.menu-drop-down-selector').on(
			'click',
			function (e) {
				e.preventDefault();
				$(this).toggleClass('children-active');
				$(this).siblings('ul').slideToggle();
				$(this).attr('title') == 'open'
					? $(this).attr('title', 'close')
					: $(this).attr('title', 'open');
			}
		);
	}

	/**
	 * handling post gallery.
	 */
	function handlePostGallery() {
		if ($('.borobazar-post-gallery').length) {
			$('.borobazar-post-gallery').each(function () {
				var gallerySlider = $(this).children('.swiper');
				var prevEl = $(this).children('.borobazar-post-gallery-prev');
				var nextEl = $(this).children('.borobazar-post-gallery-next');

				new Swiper('#' + gallerySlider.attr('id'), {
					loop: true,
					autoHeight: true,
					slidesPerView: 1,
					spaceBetween: 0,
					speed: 500,
					autoHeight: true,
					keyboard: {
						enabled: true,
						onlyInViewport: false,
					},
					pagination: {
						el: '.swiper-pagination',
						type: 'bullets',
						clickable: true,
						dynamicBullets: true,
						dynamicMainBullets: 1,
					},
					navigation: {
						prevEl: '#' + prevEl.attr('id'),
						nextEl: '#' + nextEl.attr('id'),
					},
				});
			});
		}
	}

	/**
	 * handling auth form
	 */
	function handleAuthForm() {
		if ($('.borobazar-handle-register-auth ').length) {
			var loginHandler = $('.borobazar-handle-login-auth');
			var registerHandler = $('.borobazar-handle-register-auth');

			registerHandler.on('click', function () {
				$('.borobazar-register-el').removeClass('hidden');
				$('.borobazar-login-el').addClass('hidden');
			});

			loginHandler.on('click', function () {
				$('.borobazar-login-el').removeClass('hidden');
				$('.borobazar-register-el').addClass('hidden');
			});
		}
	}

	/**
	 * function for handling body scrollbar
	 * based on freezeSate param
	 * @param  {} freezeState: boolean
	 */
	function useFreezeBodyScroll(freezeState) {
		if (typeof freezeState !== 'boolean') {
			console.error(
				'useFreezeBodyScroll param should be a boolean type value.'
			);
			return false;
		}
		var body = $('body');
		if (freezeState) {
			body.addClass('overflow-hidden');
			body.removeClass('overflow-x-hidden');
		} else {
			body.removeClass('overflow-hidden');
			body.addClass('overflow-x-hidden');
		}
	}

	/**
	 * iOS device detection
	 */
	function iOS() {
		return (
			[
				'iPad Simulator',
				'iPhone Simulator',
				'iPod Simulator',
				'iPad',
				'iPhone',
				'iPod',
			].includes(navigator.platform) ||
			// iPad on iOS 13 detection
			(navigator.userAgent.includes('Mac') && 'ontouchend' in document)
		);
	}

	/**
	 * fade effect on image load
	 */
	function handleImageLoad() {
		if ($('.borobazar-image-fade-in img').length) {
			const fadeInImages = document.querySelectorAll(
				'.borobazar-image-fade-in img'
			);
			const config = {
				threshold: 0.1,
			};
			observer = new IntersectionObserver((entries) => {
				entries.forEach((entry) => {
					if (entry.intersectionRatio > 0) {
						entry.target.classList.remove('opacity-0');
						entry.target.offsetParent?.classList.remove(
							'borobazar-image-fade-in'
						);
					}
				});
			}, config);

			fadeInImages.forEach((image) => {
				observer.observe(image);
			});
		}
	}

	//Mutation Observer
	function onElementInserted(containerSelector, elementSelector, callback) {
		const onMutationsObserved = function (mutations) {
			mutations.forEach(function (mutation) {
				if (mutation.addedNodes.length) {
					const elements = $(mutation.addedNodes).find(elementSelector);
					for (let i = 0, len = elements.length; i < len; i++) {
						callback(elements[i]);
					}
				}
			});
		};

		const target = $(containerSelector)[0];
		const config = { childList: true, subtree: true };
		const MutationObserver =
			window.MutationObserver || window.WebKitMutationObserver;
		const observer = new MutationObserver(onMutationsObserved);
		observer.observe(target, config);
	}

	// Remove image loading effect in admin
	function removeImageFadeIn() {
		if ($('.borobazar-image-fade-in').length) {
			$('.borobazar-image-fade-in img').removeClass('opacity-0');
			$('.borobazar-image-fade-in').removeClass('borobazar-image-fade-in');
		}
	}
	onElementInserted('body', '.borobazar-image-fade-in', function () {
		removeImageFadeIn();
	});

	/*---------------------------------------------------------
  # Window on load functions
  ---------------------------------------------------------*/
	$(window).on('load', function () {
		//site preloader
		if ($('.borobazar-site-loader').length) {
			$('.borobazar-site-loader').fadeOut(600);
		}

		// run image load func
		handleImageLoad();
		// sticky header scroll
		handlingStickyHeaderScroll();

		// on load fade in effect
		if ($('.on-load-fade-in').length) {
			$('.on-load-fade-in').each(function () {
				$(this).fadeIn(600);
			});
		}

		// drawer menu custom scrollbar
		var drawerMenuScrollbar = $('.borobazar-drawer-menu-wrapper')
			.overlayScrollbars({
				overflowBehavior: {
					x: 'hidden',
					y: 'scroll',
				},
				autoUpdate: true,
				scrollbars: {
					autoHide: 'leave',
				},
			})
			.overlayScrollbars();

		// global search custom scrollbar
		var globalSearchScrollbar = $('.borobazar-global-search-results')
			.overlayScrollbars({
				autoUpdate: true,
				scrollbars: {
					autoHide: 'leave',
				},
			})
			.overlayScrollbars();

		//Quick search sidebar scrollbar
		var quickSearchSidebarScroll = $('.quick-search-scrollbar')
			.overlayScrollbars({
				overflowBehavior: {
					x: 'hidden',
					y: 'scroll',
				},
				autoUpdate: true,
				scrollbars: {
					autoHide: 'leave',
				},
			})
			.overlayScrollbars();

		// destroy scrollbar on ios device
		if (iOS()) {
			if ($('.borobazar-drawer-menu-wrapper').length) {
				drawerMenuScrollbar.destroy();
				$('.borobazar-drawer-menu-wrapper').addClass('overflow-y-auto');
			}

			if ($('.quick-search-scrollbar').length) {
				quickSearchSidebarScroll.destroy();
			}

			if ($('.borobazar-global-search-results').length) {
				if (globalSearchScrollbar.length > 1) {
					globalSearchScrollbar.forEach(function (el) {
						el.destroy();
					});
				} else {
					globalSearchScrollbar.destroy();
				}
				$('.borobazar-global-search-results').addClass('overflow-y-auto');
			}
		}

		// handle mobile back navigation
		if ($('.borobazar-mobile-back-navigator').length) {
			$('.borobazar-mobile-back-navigator').on('click', function () {
				window.history.back();
			});
		}

		// language switcher dropdown
		if ($('.borobazar-language-switcher').length) {
			$('.borobazar-active-lang').on('click', function () {
				var SVGPath = $('.borobazar-active-lang svg path');
				$('.borobazar-language-switcher-list').toggleClass(
					'opacity-0 invisible'
				);
				if (SVGPath.attr('d') === 'M19 9l-7 7-7-7') {
					SVGPath.attr('d', 'M5 15l7-7 7 7');
				} else {
					SVGPath.attr('d', 'M19 9l-7 7-7-7');
				}
			});
		}
	});

	/*---------------------------------------------------------
  # Window on scroll functions
  ---------------------------------------------------------*/
	$(window).on('scroll', function () {
		handlingStickyHeaderScroll();
	});

	/*---------------------------------------------------------
  # AjaxComplete functions
  ---------------------------------------------------------*/
	$(document).ajaxComplete(function () {
		handleImageLoad();
		removeImageFadeIn();
	});
})(jQuery);
