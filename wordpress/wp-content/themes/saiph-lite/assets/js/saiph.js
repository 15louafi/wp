// Object used to initialize javascripts
var Saiph = {
	/**
	 * Function to create a justified gallery
	 * @param selector
	 */
	justifiedGallery: function (selector) {
		if ( selector.length ) {
			selector.each(function () {
				var captions = false;

				if ( jQuery(this).attr('data-image-captions') == '1' ) {
					captions = true;
				}
				var options = {
					rowHeight: parseInt(jQuery(this).attr('data-row-height')),
					lastRow  : jQuery(this).attr('data-nojustify'),
					captions : captions,
					margins  : parseInt(jQuery(this).attr('data-image-margins')),
				};

				jQuery(this).justifiedGallery(options);
			});
		}
	},

	/**
	 * Enables sticky navigation
	 * @param selector
	 */
	stickyNav: function (selector) {
		if ( selector.length && jQuery(window).width() >= 980 ) {
			selector.stick_in_parent({ parent: 'body' });
		}
	},

	/**
	 * Initiates the image popups
	 * @param selector
	 */
	modalImage: function (selector) {
		if ( selector.length ) {

			selector.magnificPopup({ type: 'image' });
		}
	},

	/**
	 * Initiate the animate tabs functionality
	 * @param selector
	 */
	animateTabs: function (selector) {
		if ( jQuery(window).width() >= 768 && selector.length ) {
			selector.each(function () {
				var $this = jQuery(this),
						$active,
						$direction = $this.data('direction'),
						$class = 'indicator-' + $direction,
						$links = $this.find('li'),
						$tabs_size_func = $direction == 'horizontal' ? 'width' : 'height',
						$tab_size_func = $direction == 'horizontal' ? 'outerWidth' : 'outerHeight',
						$tabs_size = $this[ $tabs_size_func ](),
						$tab_size = $this.find('li').first()[ $tab_size_func ](),
						$measure1 = $direction == 'horizontal' ? 'right' : 'bottom',
						$measure2 = $direction == 'horizontal' ? 'left' : 'top',
						$index = 0;
				// If the location.hash matches one of the links, use that as the active tab.
				$active = jQuery($links.filter('[href="' + location.hash + '"]'));
				// If no match is found, use the first link or any with class 'active' as the initial active tab.
				if ( $active.length === 0 ) {
					$active = jQuery(this).find('li.active').first() || jQuery(this).find('li').first();
				}
				$index = $links.index($active);
				if ( $index < 0 ) {
					$index = 0;
				}
				$this.append('<div class="' + $class + '"></div>');
				var $indicator = $this.find('.' + $class);
				if ( $this.is(":visible") ) {
					var options = {};
					options[ $measure1 ] = ($tabs_size - (($index + 1) * $tab_size)) + ($tab_size / 3);
					options[ $measure2 ] = $index * $tab_size + ($tab_size / 3);
					$indicator.css(options);
				}
				jQuery(window).resize(function () {
					$tabs_size = $this[ $tabs_size_func ]();
					$tab_size = $this.find('li').first()[ $tab_size_func ]();
					if ( $index < 0 ) {
						$index = 0;
					}
					if ( $tab_size !== 0 && $tabs_size !== 0 ) {
						var options = {};
						options[ $measure1 ] = ($tabs_size - (($index + 1) * $tab_size)) + ($tab_size / 3);

						$indicator.velocity(options, {
							duration: 300,
							queue   : false,
							easing  : 'easeOutQuad'
						});

						options = {};
						options[ $measure2 ] = $index * $tab_size + ($tab_size / 3);

						$indicator.velocity(options, {
							duration: 300,
							queue   : false,
							easing  : 'easeOutQuad',
							delay   : 90
						});
					} else {
						var options = {};
						options[ $measure2 ] = $index * $tab_size + ($tab_size / 3);

						$indicator.velocity(options, {
							duration: 300,
							queue   : false,
							easing  : 'easeOutQuad'
						});

						options = {};
						options[ $measure1 ] = ($tabs_size - (($index + 1) * $tab_size)) + ($tab_size / 3);

						$indicator.velocity(options, {
							duration: 300,
							queue   : false,
							easing  : 'easeOutQuad',
							delay   : 90
						});
					}
				});
				// Bind the click event handler
				$this.on('click', 'li', function () {

					$active = jQuery(this);
					$links = $this.find('li');

					var $prev_index = $index;
					$index = $links.index(jQuery(this));
					if ( $index < 0 ) {
						$index = 0;
					}
					// Change url to current tab
					// window.location.hash = $active.attr('href');
					// Update indicator
					if ( ($index - $prev_index) >= 0 ) {
						var options = {};
						options[ $measure1 ] = ($tabs_size - (($index + 1) * $tab_size)) + ($tab_size / 3);

						$indicator.velocity(options, {
							duration: 300,
							queue   : false,
							easing  : 'easeOutQuad'
						});

						options = {};
						options[ $measure2 ] = $index * $tab_size + ($tab_size / 3);

						$indicator.velocity(options, {
							duration: 300,
							queue   : false,
							easing  : 'easeOutQuad',
							delay   : 90
						});
					} else {
						var options = {};
						options[ $measure2 ] = $index * $tab_size + ($tab_size / 3);

						$indicator.velocity(options, {
							duration: 300,
							queue   : false,
							easing  : 'easeOutQuad'
						});

						options = {};
						options[ $measure1 ] = ($tabs_size - (($index + 1) * $tab_size)) + ($tab_size / 3);

						$indicator.velocity(options, {
							duration: 300,
							queue   : false,
							easing  : 'easeOutQuad',
							delay   : 90
						});
					}
				});
			});
		}
	},

	/**
	 * Change tabs to accordions
	 * @param selector
	 */
	tabCollapse: function (selector) {
		if ( selector.length ) {
			selector.each(function () {
				jQuery(this).find('.nav-tabs').tabCollapse();
			});
		}
	},

	/**
	 * Initiates the go top button
	 * @param selector
	 */
	goTop: function (selector) {
		var offset = 300,
				offset_opacity = 1200,
				scroll_top_duration = 700,
				$back_to_top = selector;
		jQuery(window).scroll(function () {
			( jQuery(this).scrollTop() > offset ) ? $back_to_top.addClass('tpl-go-top-is-visible') : $back_to_top.removeClass('tpl-go-top-is-visible tpl-go-top-fade-out');
			if ( jQuery(this).scrollTop() > offset_opacity ) {
				$back_to_top.addClass('tpl-go-top-fade-out');
			}
		});
		$back_to_top.on('click', function (event) {
			event.preventDefault();
			jQuery('body,html').animate({
						scrollTop: 0,
					}, scroll_top_duration
			);
		});
	},

	/**
	 * Initiates the fade in content functionality
	 * @param trigger
	 */
	scrollReveal: function (trigger) {
		if ( trigger ) {
			var config = {
				vFactor: 0.70,
				move   : '50px',
				opacity: 0,
				over   : '0.8s',
			};
			window.sr = new scrollReveal(config);
		}
	},
	/**
	 * Initiate a page gallery
	 * @param selector
	 */
	pageGallery : function (selector) {
		if ( selector.length ) {
			selector.each(function () {
				var config = {
					itemSelector: '.tpl-portfolio-tile',
					masonry     : {
						isAnimated: true,
						isFitWidth: false,
						gutter    : 0
					}
				};

				selector.masonry(config);
			})
		}
	},
	/**
	 * Initiate the masonry plugins
	 * @param selector
	 */
	masonry     : function (selector) {
		if ( selector.length ) {
			selector.each(function () {
				var $masonryType = selector.attr('data-saiph');
				switch ( $masonryType ) {
					case 'masonryBlog':
						var config = {
							itemSelector: '.tpl-masonry-tile',
							isAnimated: true,
							isFitWidth: false,
							gutter    : 30,

						};
						break;
					case 'masonryTestimonial':
						var config = {
							isAnimated: true,
							isFitWidth: false,
							gutter    : 0,
						};
						break;
					case 'masonryPortfolio':
						var config = {
							itemSelector: '.tpl-portfolio-tile',
							isAnimated: true,
							isFitWidth: false,
							gutter    : 30,
						};
						break;
					default :
						console.log('none loaded');
						break;
				}
				selector.masonry(config);
			});
		}
	}
};
