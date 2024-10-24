(function ($) {
	('use strict');

	init();

	/**
	 * init functions for WooCommerce only.
	 */
	function init() {
		dynamicQuantityInput();
	}

	/**
	 * detection if an element is added to DOM
	 * @param  {} containerSelector
	 * @param  {} elementSelector
	 * @param  {} callback
	 */
	function onElementInserted(containerSelector, elementSelector, callback) {
		var onMutationsObserved = function (mutations) {
			mutations.forEach(function (mutation) {
				if (mutation.addedNodes.length) {
					var elements = $(mutation.addedNodes).find(elementSelector);
					for (var i = 0, len = elements.length; i < len; i++) {
						callback(elements[i]);
					}
				}
			});
		};

		var target = $(containerSelector)[0];
		var config = { childList: true, subtree: true };
		var MutationObserver =
			window.MutationObserver || window.WebKitMutationObserver;
		var observer = new MutationObserver(onMutationsObserved);
		observer.observe(target, config);
	}

	/**
	 * handling mini cart items overlay scrollbar based on dom insert || update
	 */
	onElementInserted('body', '.borobazar-mini-cart-items', function () {
		var scrollbar = $('.borobazar-mini-cart-items')
			.overlayScrollbars({
				overflowBehavior: {
					x: 'hidden',
					y: 'scroll',
				},
				scrollbars: {
					autoHide: 'leave',
				},
				callbacks: {
					onScroll: function () {
						var container = $('.borobazar-mini-cart-items');
						var scrollHeight = this.scroll().max.y - 20;
						var scrollPosition = this.scroll().position.y;
						if (scrollPosition >= scrollHeight) {
							container.removeClass('bottom-shadow');
						} else if (scrollPosition < 20) {
							container.removeClass('top-shadow');
						} else {
							container.addClass('top-shadow');
							container.addClass('bottom-shadow');
						}
					},
					onUpdated: function () {
						var container = $('.borobazar-mini-cart-items');
						var scrollHeight = this.scroll().max.y;
						var containerHeight = container.prop('scrollHeight');
						if (scrollHeight > containerHeight) {
							container.addClass('bottom-shadow');
						}
					},
				},
			})
			.overlayScrollbars();

		$('.borobazar-mini-cart-total a').on('click', function () {
			$(this).addClass('is-loading');
			$(this).find('.borobazar-loader').addClass('is-active');
		});
	});

	/**
	 * dynamic Quantity input
	 */
	function dynamicQuantityInput() {
		if ($('.borobazar-woo-custom-quantity-field').length) {
			$('.borobazar-woo-custom-quantity-field').each(function () {
				// append custom increment/decrement button
				if ($(this).find('.quantity-btn-wrapper').length === 0) {
					$(this)
						.find('input[type="number"]')
						.after(
							$(
								'<div class="quantity-btn-wrapper"><div class="quantity-btn quantity-btn-down"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="1.5" viewBox="0 0 10 1.25"><path data-name="Path 9" d="M142.157,142.158h-4.375v1.25h10v-1.25h-5.625Z" transform="translate(-137.782 -142.158)" fill="currentColor"></path></svg></div><div class="quantity-btn quantity-btn-up"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10"><path data-name="Path 9" d="M143.407,137.783h-1.25v4.375h-4.375v1.25h4.375v4.375h1.25v-4.375h4.375v-1.25h-4.375Z" transform="translate(-137.782 -137.783)" fill="currentColor"></path></svg></div></div>'
							)
						);
				}

				var counterWrapper = jQuery(this);
				var input = counterWrapper.find('input[type="number"]');
				$(input).attr({
					max: input.attr('max') == '' ? '10000' : input.attr('max'),
					min: 0,
				});
				var onBtnUp = counterWrapper.find('.quantity-btn-up');
				var onBtnDown = counterWrapper.find('.quantity-btn-down');
				var step = parseInt(input.attr('step'));
				var min = input.attr('min');
				var max = input.attr('max') == '' ? '10000' : input.attr('max');

				$(input).on('change', function () {
					max = input.attr('max');
				});

				var inputValue = input.val() === '' ? 0 : input.val();

				input.val(inputValue);

				onBtnUp.off('click').on('click', function () {
					var oldValue = parseFloat(input.val());
					if (oldValue >= max) {
						var newVal = oldValue;
					} else {
						if (step) {
							var newVal = oldValue + step;
						} else {
							var newVal = oldValue + 1;
						}
					}
					counterWrapper.find('input').val(newVal);
					counterWrapper.find('input').trigger('change');
				});

				onBtnDown.off('click').on('click', function () {
					var oldValue = parseFloat(input.val());
					if (oldValue <= min) {
						var newVal = oldValue;
					} else {
						if (step) {
							var newVal = oldValue - step;
						} else {
							var newVal = oldValue - 1;
						}
					}
					counterWrapper.find('input').val(newVal);
					counterWrapper.find('input').trigger('change');
				});
			});
		}
	}

	/**
	 * Woocommerce product gallery thumb carousel
	 */
	function handleProductGallerySlider() {
		var siteWrapper = $('.site-wrapper');
		var productGalleryThumb = $(
			'body .woocommerce-product-gallery--with-images .flex-control-thumbs'
		);

		productGalleryThumb.addClass('swiper');
		$('<div class="swiper-wrapper">').insertBefore(
			'.flex-control-thumbs li:first-child'
		);
		$('.flex-control-thumbs li').appendTo('.swiper-wrapper');
		$('.flex-control-thumbs li').addClass('swiper-slide');
		$(
			'<div class="swiper-button-prev"></div><div class="swiper-button-next"></div>'
		).insertAfter('.flex-control-thumbs .swiper-wrapper');

		if (siteWrapper.hasClass('site-wrapper-with-sidebar')) {
			// run when layout has sidebar
			if (productGalleryThumb.length) {
				new Swiper('.flex-control-thumbs', {
					direction: 'horizontal',
					spaceBetween: 15,
					slidesPerView: 3,
					navigation: {
						nextEl: '.swiper-button-next',
						prevEl: '.swiper-button-prev',
					},
					breakpoints: {
						640: {
							direction: 'horizontal',
							slidesPerView: 4,
						},
						768: {
							direction: 'horizontal',
							slidesPerView: 5,
						},
						1280: {
							direction: 'vertical',
							slidesPerView: 3,
						},
						1536: {
							direction: 'vertical',
							slidesPerView: 4,
						},
					},
				});
			}
		} else {
			// run when layout does not have sidebar
			if (productGalleryThumb.length) {
				new Swiper('.flex-control-thumbs', {
					direction: 'horizontal',
					spaceBetween: 15,
					slidesPerView: 3,
					navigation: {
						nextEl: '.swiper-button-next',
						prevEl: '.swiper-button-prev',
					},
					breakpoints: {
						640: {
							direction: 'vertical',
							slidesPerView: 4,
						},
					},
				});
			}
		}
	}

	/*---------------------------------------------------------
  # Window on load functions
  ---------------------------------------------------------*/
	$(window).on('load', function () {
		// product gallery on php grid
		setTimeout(() => {
			handleProductGallerySlider();
		}, 250);
	});

	/*---------------------------------------------------------
  # AjaxComplete functions
  ---------------------------------------------------------*/
	$(document).ajaxComplete(function () {
		dynamicQuantityInput();
	});
})(jQuery);
