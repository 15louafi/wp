(function ($) {
	'use strict';
	jQuery(document).ready(function () {
		// turn tabs in dropdowns
		Saiph.tabCollapse(jQuery('.tpl-tabs'));
		Saiph.tabCollapse(jQuery('[data-saiph="saiph-tabs"]'));
		// initiate go Top button
		Saiph.goTop(jQuery('.tpl-go-top'));
		// initiate Modal Images
		Saiph.modalImage(jQuery('.magnific-popup'));
		// initiate Slider
		Saiph.slider(jQuery('.owl-carousel'));
		// initiate popovers/tooltips
		jQuery('[data-toggle="popover"]').popover();
		jQuery('[data-toggle="tooltip"]').tooltip();
		// initiate selectize
		if ( jQuery('.select-styled select').length > 0 ) {
			jQuery('.select-styled select').selectize({
				create   : true,
				sortField: 'text'
			});
		}
		// initiate gallery
		Saiph.justifiedGallery(jQuery('[data-saiph="justifiedGallery"]'));
		// initiate transformicons
		transformicons.add('.tcon');
	});
	jQuery(window).load(function () {
		// make Nav sticky
		Saiph.stickyNav(jQuery('.tpl-menu-sticky'));
		// initiate the animated line on the tabs
		Saiph.animateTabs(jQuery('.tpl-animated-tabs'));
		// initiate scroll Reveal - comment it if you dont want it on your website
		Saiph.scrollReveal('true');
	});
})(jQuery);

