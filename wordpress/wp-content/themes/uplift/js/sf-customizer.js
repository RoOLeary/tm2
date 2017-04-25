/*
*
*	Live Customiser Script
*	------------------------------------------------
*	Swift Framework
* 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
*
*/
( function( $ ){

	$('html, body').css('height', 'auto');

	/////////////////////////////////////////////
	// GENERAL
	/////////////////////////////////////////////
	wp.customize('sf_customizer[page_bg_color]',function( value ) {
		value.bind(function(to) {
			$('body, .layout-fullwidth #container').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[inner_page_bg_color]',function( value ) {
		value.bind(function(to) {
			$('#sf-home-preloader, #site-loading, .inner-container-wrap, .tm-toggle-button-wrap a, .single-product.page-heading-fancy .product-main, .team-member-item-wrap').css('background-color', to ? to : '' );
			$('ul.bar-styling li > a, ul.bar-styling li > span, ul.bar-styling li > div, ul.bar-styling li > form input').css('background-color', to ? to : '' );
			$('ul.page-numbers li > span.current, .pagination-wrap ul li span').css('background-color', to ? to : '' );
			$('.modal-content').css('background-color', to ? to : '' );
			$('#contact-slideout').css('background-color', to ? to : '' );
			$('.widget.widget_lip_most_loved_widget li').css('background-color', to ? to : '' );
			$('.portfolio-item.masonry-item .portfolio-item-details').css('background-color', to ? to : '' );
			$('.timeline-item-content-wrap .blog-details-wrap, .timeline-item-format-icon-bg').css('background-color', to ? to : '' );
			$('.masonry-items .blog-item .details-wrap').css('background-color', to ? to : '' );
			$('.spb_divider.go_to_top_icon1 a, .spb_divider.go_to_top_icon2 a').css('background-color', to ? to : '' );
			$('.spb_tabs .ui-tabs .ui-tabs-panel, .ui-tabs .ui-tabs-nav li.ui-tabs-active a').css('background-color', to ? to : '' );
			$('.spb_tabs .nav-tabs li.active a, .spb_tour .nav-tabs li.active a').css('background-color', to ? to : '' );
			$('.spb_accordion .spb_accordion_section > h4.ui-state-active, .spb_accordion .spb_accordion_section > h4.ui-state-hover').css('background-color', to ? to : '' );
			$('.toggle-wrap .spb_toggle_title_active').css('background-color', to ? to : '' );
			$('.inner-page-wrap.full-width-shop .sidebar[class*="col-sm"]').css('background-color', to ? to : '' );
			$('.woocommerce div.product .woocommerce-tabs ul.tabs li.active').css('background-color', to ? to : '' );
			$('.tribe-events-list-separator-month span').css('background-color', to ? to : '' );
			$('figure.animated-overlay.thumb-media-audio').css('background-color', to ? to : '' );
			
			$('.spb_tabs .nav-tabs li.active a').css('border-bottom-color', to ? to : '' );
			$('.spb_tour .nav-tabs li.active a').css('border-right-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[section_divide_color]',function( value ) {
		value.bind(function(to) {
			// border-color
			$('.sf-elem-bf, .sf-elem-bt, .sf-elem-br, .sf-elem-bb, .sf-elem-bl').css('border-color', to ? to : '' );
			$('#sidebar-progress-menu ul li').css('border-color', to ? to : '' );
			$('table').css('border-bottom-color', to ? to : '' );
			$('table td').css('border-top-color', to ? to : '' );
			$('.player-video .player-controls').css('border-color', to ? to : '' );
			$('.page-heading').css('border-bottom-color', to ? to : '' );
			$('ul.bar-styling li > a, ul.bar-styling li > div, ul.page-numbers li > a, ul.page-numbers li > span, .curved-bar-styling, ul.bar-styling li > form input, .spb_directory_filter_below, .pagination-wrap ul li a,ul.page-numbers li > span.current, .pagination-wrap ul li span, .single .pagination-wrap, ul.post-filter-tabs li a').css('border-color', to ? to : '' );
			$('input[type="text"], input[type="email"], input[type="password"], textarea, select, .wpcf7 input[type="text"], .wpcf7 input[type="email"], .wpcf7 textarea, .wpcf7 select, .ginput_container input[type="text"], .ginput_container input[type="email"], .ginput_container textarea, .ginput_container select, .mymail-form input[type="text"], .mymail-form input[type="email"], .mymail-form textarea, .mymail-form select, input[type="date"], input[type="tel"], input.input-text, input[type="number"], .select2-container .select2-choice,.select2-drop, .select2-drop-active').css('border-color', to ? to : '' );
			$('figure.animated-overlay.thumb-media-audio').css('border-color', to ? to : '' );
			$('.article-extras, .post-info .post-details-wrap').css('border-color', to ? to : '' );
			$('.widget ul li, .widget.widget_lip_most_loved_widget li, .widget.widget_lip_most_loved_widget li, .widget_calendar #calendar_wrap, .widget_calendar th, .widget_calendar tbody tr > td, .widget_calendar tbody tr > td.pad, .sidebar .widget hr').css('border-color', to ? to : '' );
			$('.fw-row .spb_portfolio_widget .title-wrap').css('border-bottom-color', to ? to : '' );
			$('.portfolio-categories, .portfolio-categories li a, .item-details time, .item-details .client, .client, .item-details .project').css('border-color', to ? to : '' );
			$('.blog-aux-options, .blog-aux-options li a').css('border-color', to ? to : '' );
			$('.mini-items .blog-details-wrap, .blog-item .blog-item-aux, .mini-items .mini-alt-wrap, .mini-items .mini-alt-wrap .quote-excerpt, .mini-items .mini-alt-wrap .link-excerpt, .masonry-items .blog-item .quote-excerpt, .masonry-items .blog-item .link-excerpt, .timeline-items .standard-post-content .quote-excerpt, .timeline-items .standard-post-content .link-excerpt, .post-info, .author-info-wrap, .body-text .link-pages, .page-content .link-pages, .posts-type-list .recent-post, .standard-items .blog-item .standard-post-content').css('border-color', to ? to : '' );
			$('.timeline-item-content-wrap .blog-details-wrap').css('border-color', to ? to : '' );
			$('.search-item-img .img-holder').css('border-color', to ? to : '' );
			$('.masonry-items .blog-item .details-wrap').css('border-color', to ? to : '' );
			$('.blog-grid-items .blog-item.tweet-item .grid-no-image').css('border-color', to ? to : '' );
			$('.blog-item .side-details .comments-wrapper, .post-details-wrap .tags-wrap, .post-details-wrap .comments-likes, .blog-filter-wrap .aux-list li a').css('border-color', to ? to : '' );
			$('timeline-item-format-icon').css('border-color', to ? to : '' );
			$('#comments-list li .comment-wrap').css('border-color', to ? to : '' );
			$('.carousel-wrap a.carousel-prev, .carousel-wrap a.carousel-next').css('border-color', to ? to : '' );
			$('.sf-icon-box-animated-alt.animated-stroke-style').css('border-color', to ? to : '' );
			$('.borderframe img').css('border-color', to ? to : '' );
			$('.spb_divider, .spb_divider.go_to_top_icon1, .spb_divider.go_to_top_icon2, .testimonials > li, .tm-toggle-button-wrap, .tm-toggle-button-wrap a, .portfolio-details-wrap, .spb_divider.go_to_top a, .widget_search form input').css('border-color', to ? to : '' );
			$('.spb_tabs .ui-tabs .ui-tabs-panel, .spb_content_element .ui-tabs .ui-tabs-nav, .ui-tabs .ui-tabs-nav li, .spb_tabs .tab-content, .spb_tabs .nav-tabs li a, .spb_tour .nav-tabs li a, .spb_tabs .nav-tabs li.active a, .spb_tour .nav-tabs li.active a, .spb_tour .tab-content, .spb_accordion .spb_accordion_section, .spb_accordion .ui-accordion .ui-accordion-content, .toggle-wrap .spb_toggle, .spb_toggle_content, .toggle-wrap .spb_toggle_title_active').css('border-color', to ? to : '' );
			$('.spb_box_content .spb-bg-color-wrap.whitestroke').css('border-color', to ? to : '' );
			$('.testimonials.carousel-items li .testimonial-text').css('border-color', to ? to : '' );
			$('.sf-share-counts, .sf-share-counts > a').css('border-color', to ? to : '' );
			$('.team-member-details-wrap').css('border-color', to ? to : '' );
			$('.spb_testimonial_carousel_widget .carousel-wrap > a').css('border-color', to ? to : '' );
			$('.woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce .help-bar, .woo-aux-options, .woocommerce nav.woocommerce-pagination ul li span.current, .modal-body .comment-form-rating, ul.checkout-process, #billing .proceed, ul.my-account-nav > li, .woocommerce #payment, .woocommerce-checkout p.thank-you, .woocommerce .order_details, .woocommerce-page .order_details, #product-accordion .panel, .woocommerce form .form-row input.input-text, .woocommerce .coupon input.input-text, .woocommerce table.shop_table, .woocommerce-page table.shop_table, .mini-list li, .woocommerce div.product .woocommerce-tabs .panel, .woocommerce a.button.wc-backward, #yith-wcwl-form .product-add-to-cart > .button, .woocommerce .coupon input.input-text, .woocommerce-cart table.cart td.actions .coupon .input-text, .woocommerce table.shop_table tbody th, .woocommerce table.shop_table tfoot td, .woocommerce table.shop_table tfoot th').css('border-color', to ? to : '' );
			$('.bag-buttons a.sf-button.bag-button, .bag-buttons a.sf-button.wishlist-button').css('border-color', to ? to : '' );
			$('.fw-summary-extras, .summary-top').css('border-color', to ? to : '' );
			$('.woocommerce-account p.myaccount_address, .woocommerce-account .page-content h2, p.no-items, #order_review table.shop_table, #payment_heading, .returning-customer a, .woocommerce #payment ul.payment_methods, .woocommerce-page #payment ul.payment_methods, .woocommerce .coupon').css('border-bottom-color', to ? to : '' );
			$('p.no-items, .woocommerce-page .cart-collaterals, .woocommerce .cart_totals table tr.cart-subtotal, .woocommerce .cart_totals table tr.order-total, .woocommerce table.shop_table td, .woocommerce-page table.shop_table td, .woocommerce #payment div.form-row, .woocommerce-page #payment div.form-row').css('border-top-color', to ? to : '' );
			$('ul.products li.product a.quick-view-button, .woocommerce .quantity, .woocommerce-page .quantity, .woocommerce .cart .yith-wcwl-add-to-wishlist a, .my-account-login-wrap .login-wrap form.login p.form-row input[type=submit], .products .product.buy-btn-visible > .product-actions .add-to-cart-wrap > a').css('border-color', to ? to : '' );
			$('.woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce div.product .woocommerce-tabs ul.tabs li.active').css('border-color', to ? to : '' );
			$('.woocommerce .quantity .minus, .woocommerce .quantity input.qty, .woocommerce .quantity .plus, .woocommerce div.product .cart .variations select, .woocommerce .quantity .qty-plus, .woocommerce .quantity .qty-minus').css('border-color', to ? to : '' );
			$('.woocommerce table.shop_attributes th, .woocommerce table.shop_attributes td').css('border-color', to ? to : '' );
			$('.summary .product_meta').css('border-color', to ? to : '' );
			$('.woocommerce .checkout #ship-to-different-address').css('border-color', to ? to : '' );
			$('#jckqv_summary > h1').css('border-bottom-color', to ? to : '' );
			$('#jckqv .quantity .qty').css('border-color', to ? to : '' );
			$('.woo-thankyou-details .payment-wrap, .woo-thankyou-main .order_details').css('border-color', to ? to : '' );
			$('.woocommerce table.my_account_orders thead th, .my-address-wrap > h4, .customer-orders-wrap > h4, .myaccount_user h4, .product-fw-split div.product div.summary, .product-fw-split .fw-summary-extras, .woocommerce #customer_login.col2-set .col-1').css('border-color', to ? to : '' );
			$('.preview-slider-item-wrapper').css('border-color', to ? to : '' );
			$('#buddypress .activity-meta a, #buddypress .acomment-options a, #buddypress #member-group-links li a, .widget_bp_groups_widget #groups-list li, .activity-list li.bbp_topic_create .activity-content .activity-inner, .activity-list li.bbp_reply_create .activity-content .activity-inner').css('border-color', to ? to : '' );
			$('.bbp-topic-action #favorite-toggle a, .bbp-topic-action #subscription-toggle a, .bbp-single-topic-meta a, .bbp-topic-tags a, #bbpress-forums li.bbp-body ul.forum, #bbpress-forums li.bbp-body ul.topic, #bbpress-forums li.bbp-header, #bbpress-forums li.bbp-footer, #bbp-user-navigation ul li a, .bbp-pagination-links a, #bbp-your-profile fieldset input, #bbp-your-profile fieldset textarea, #bbp-your-profile, #bbp-your-profile fieldset').css('border-color', to ? to : '' );
			$('.tribe-events-loop .tribe-events-event-meta, .tribe-events-list .tribe-events-venue-details').css('border-color', to ? to : '' );
			
			// background-color			
			$('.article-divider').css('background-color', to ? to : '' );
			$('.loved-item .loved-count > i').css('background-color', to ? to : '' );
			$('#infscr-loading .spinner > div').css('background-color', to ? to : '' );
			$('.standard-post-date, .timeline').css('background-color', to ? to : '' );
			$('.horizontal-break').css('background-color', to ? to : '' );
			$('.woocommerce div.product .woocommerce-tabs ul.tabs li').css('background-color', to ? to : '' );
			$('.woocommerce .cart .yith-wcwl-divide').css('background-color', to ? to : '' );
			$('.woocommerce #payment div.payment_box').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[accent_color]',function( value ) {
		value.bind(function(to) {
			// background-color
			$('.sf-accent-bg, .funded-bar .bar, .flickr-widget li, .portfolio-grid li, figcaption .product-added, .woocommerce .widget_layered_nav ul li.chosen small.count, .woocommerce .widget_layered_nav_filters ul li a, span.highlighted, #one-page-nav li .hover-caption, #sidebar-progress-menu ul li.reading .progress, .loading-bar-transition .pace .pace-progress, input[type=submit], button[type=submit], input[type="file"], .wpcf7 input.wpcf7-submit[type=submit], .sf-super-search .search-options .ss-dropdown ul, av ul.menu > li.menu-item.sf-menu-item-btn > a, .shopping-bag-item a > span.num-items, .bag-buttons a.checkout-button, .bag-buttons a.create-account-button, .woocommerce input.button.alt, .woocommerce .alt-button, .woocommerce button.button.alt, #jckqv .cart .add_to_cart_button, #fullscreen-supersearch .sf-super-search .search-go a.sf-button, #respond .form-submit input[type=submit], .sf-button.accent:not(.bordered), .sf-icon-box-animated .back, .spb_icon_box_grid .spb_icon_box .divider-line, .tabs-type-dynamic .nav-tabs li.active a, .progress .bar, .mejs-controls .mejs-time-rail .mejs-time-current, .team-member-divider, .masonry-items li.testimonial .testimonial-text, .spb_tweets_slider_widget .tweet-icon i, .woocommerce .cart button.add_to_cart_button.product-added, .woocommerce .single_add_to_cart_button:disabled[disabled], .woocommerce .order-info, .woocommerce .order-info mark, .woocommerce .button.checkout-button, .woocommerce #review_form #respond .form-submit input, .woocommerce button[type="submit"], .woocommerce input.button, .woocommerce a.button, .woocommerce-cart table.cart input.button, .review-order-wrap #payment #place_order, #buddypress .pagination-links span, #buddypress .load-more.loading a, #bbp-user-navigation ul li.current a, .bbp-pagination-links span.current').css('background-color', to ? to : '' );
			// color
			$('.sf-accent, .portfolio-item .portfolio-item-permalink, .read-more-link, .blog-item .read-more, .author-link, span.dropcap2, .spb_divider.go_to_top a, #header-translation p a, span.dropcap4, #sidebar-progress-menu ul li.reading a, .read-more-button, .player-controls button.tab-focus, .player-progress-played[value], .sf-super-search .search-options .ss-dropdown > span, .sf-super-search .search-options input, .author-bio a.author-more-link, .comment-meta-actions a, .blog-aux-options li.selected a, .sticky-post-icon, .blog-item .author a.tweet-link, .side-post-info .post-share .share-link, a.sf-button.bordered.accent, .progress-bar-wrap .progress-value, .sf-share-counts .share-text h2, .sf-share-counts .share-text span, .woocommerce div.product .stock, .woocommerce form .form-row .required, .woocommerce .widget_price_filter .price_slider_amount .button, .product-cat-info a.shop-now-link, .woocommerce-cart table.cart input[name="apply_coupon"], .woocommerce .shipping-calculator-form button[type="submit"], .woocommerce .cart input.button[name="update_cart"]').css('color', to ? to : '' );
			// border-color
			$('.sf-accent-border,span.dropcap4, .super-search-go, .sf-button.accent, .sf-button.accent.bordered .sf-button-border, blockquote.pullquote, .woocommerce form .form-row.woocommerce-invalid .select2-container, .woocommerce form .form-row.woocommerce-invalid input.input-text, .woocommerce form .form-row.woocommerce-invalid select, .woocommerce .woocommerce-info, .woocommerce-page .woocommerce-info, .woocommerce-cart table.cart input[name="apply_coupon"], .woocommerce .shipping-calculator-form button[type="submit"], .woocommerce .cart input.button[name="update_cart"], #buddypress .activity-header a, #buddypress .activity-read-more a, #buddypress .pagination-links span, #buddypress .load-more.loading a, #bbp-user-navigation ul li.current a, .bbp-pagination-links span.current').css('border-color', to ? to : '' );
			$('.spb_impact_text .spb_call_text, code > pre').css('border-left-color', to ? to : '' );
			$('#account-modal .nav-tabs li.active span, .sf-super-search .search-options .ss-dropdown > span, .sf-super-search .search-options input').css('border-bottom-color', to ? to : '' );
			$('#bbpress-forums li.bbp-header').css('border-top-color', to ? to : '' );
			// stroke
			$('.sf-hover-svg path').css('stroke', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[body_color]',function( value ) {
		value.bind(function(to) {
			$('body, #sidebar-progress-menu ul li a, .loved-item .loved-count > i, .post-item-details .comments-likes a i, .post-item-details .comments-likes a span, a.sf-button.transparent-dark, .sf-icon-box-animated .front h3, .spb_tabs .nav-tabs li:hover a, .spb_tour .nav-tabs li:hover a, .spb_tabs .nav-tabs li.active a, .spb_tour .nav-tabs li.active a, .spb_accordion .spb_accordion_section > h4.ui-state-active a, .toggle-wrap .spb_toggle.spb_toggle_title_active, .ui-accordion h4.ui-accordion-header .ui-icon, .sf-mobile-shop-filters-link, woocommerce .woocommerce-info, .woocommerce-page .woocommerce-info, .woocommerce .woocommerce-message, .woocommerce-page .woocommerce-message, .woocommerce .woocommerce-error, .woocommerce-page .woocommerce-error, .woocommerce ul.products li.product .price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce div.product .cart .variations td.label label, .woocommerce table.shop_table tr td.product-remove .remove, .woocommerce #payment div.payment_box, .blog-aux-options li a, .portfolio-categories li a, .recent-posts-list li .recent-post-title').css('color', to ? to : '' );
			$('.owl-pagination .owl-page span, .standard-items.alt-styling .blog-item.quote .standard-post-content, .mini-items .blog-item.quote .mini-alt-wrap, .horizontal-break.bold').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[body_alt_color]',function( value ) {
		value.bind(function(to) {
			$('.pagination-wrap ul li a, ul.page-numbers li > span.current, .pagination-wrap ul li span, .recent-post .post-details, .portfolio-item h5.portfolio-subtitle, .search-item-content time, .search-item-content span, .portfolio-details-wrap .date, .comment-meta .comment-date, .widget_lip_most_loved_widget .loved-item > span, .directory-item-details .item-meta, ul.wp-tag-cloud li > a, .directory-item-details .item-meta, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a, #buddypress #members-list .item-meta .activity, #buddypress .activity-header p, span.bbp-admin-links a, li.bbp-forum-info .bbp-forum-content').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[link_color]',function( value ) {
		value.bind(function(to) {
			$('a, .ui-widget-content a, #sidebar-progress-menu ul li.read a, .sidebar .widget_categories ul > li a, .sidebar .widget_archive ul > li a, .sidebar .widget_nav_menu ul > li a, .sidebar .widget_meta ul > li a, .sidebar .widget_recent_entries ul > li, .widget_product_categories ul > li a, .widget_layered_nav ul > li a, .widget_display_replies ul > li a, .widget_display_forums ul > li a, .widget_display_topics ul > li a, .mini-item-details, .blog-item-details, .blog-item-details a, a.sf-button.stroke-to-fill, .woocommerce .woocommerce-message a.button, .woocommerce #reviews #comments ol.commentlist li .comment-details .date, .blog-filter-wrap ul.wp-tag-cloud li > a').css('color', to ? to : '' );
			$('a[rel="tooltip"], ul.member-contact li a, a.text-link, .tags-wrap .tags a, .logged-in-as a, .comment-meta-actions .edit-link, .comment-meta-actions .comment-reply').css('border-color', to ? to : '' );
			$('#sidebar-progress-menu ul li.read .progress').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[h1_color]',function( value ) {
		value.bind(function(to) {
			$('h1, h1 a, h3.countdown-subject').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[h2_color]',function( value ) {
		value.bind(function(to) {
			$('h2, h2 a').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[h3_color]',function( value ) {
		value.bind(function(to) {
			$('h3, h3 a').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[h4_color]',function( value ) {
		value.bind(function(to) {
			$('h4, h4 a, .carousel-wrap > a').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[h5_color]',function( value ) {
		value.bind(function(to) {
			$('h5, h5 a').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[h6_color]',function( value ) {
		value.bind(function(to) {
			$('h6, h6 a').css('color', to ? to : '' );
		});
	});

	
	/////////////////////////////////////////////
	// TOP BAR STYLING
	/////////////////////////////////////////////
	wp.customize('sf_customizer[topbar_bg_color]',function( value ) {
		value.bind(function(to) {
			$('#top-bar').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[topbar_text_color]',function( value ) {
		value.bind(function(to) {
			$('#top-bar .tb-text').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[topbar_link_color]',function( value ) {
		value.bind(function(to) {
			$('#top-bar .tb-text > a, #top-bar nav .menu > li > a, #top-bar .menu > li > a').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[topbar_divider_color]',function( value ) {
		value.bind(function(to) {
			$('#top-bar .menu li').css('border-left-color', to ? to : '' );
			$('#top-bar .menu li').css('border-right-color', to ? to : '' );
		});
	});
	
	
	/////////////////////////////////////////////
	// HEADER STYLING
	/////////////////////////////////////////////
	wp.customize('sf_customizer[header_bg_color]',function( value ) {
		value.bind(function(to) {
			$('.header-wrap #header, .header-standard-overlay #header, .vertical-header .header-wrap #header-section, #header-section .is-sticky #header.sticky-header, #mobile-top-text, #mobile-header, .overlay-menu-open .header-wrap').css('background-color', to ? to : '' );
			$('.page-header-naked-light .sticky-wrapper:not(.is-sticky) .shopping-bag-item:hover a > span.num-items, .page-header-naked-dark .sticky-wrapper:not(.is-sticky) .shopping-bag-item:hover a > span.num-items').css('background-color', to ? to : '' );
			$('li.mega-menu-item > a.mega-menu-link sup.new-badge').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[header_border_color]',function( value ) {
		value.bind(function(to) {
			$('.header-left .aux-item, .header-right .aux-item').css('border-color', to ? to : '' );
			$('#mobile-top-text, #mobile-header, #header-section header, .header-wrap #header-section .is-sticky #header.sticky-header, #main-nav').css('border-bottom-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[header_text_color]',function( value ) {
		value.bind(function(to) {
			$('.header-left, .header-right, .vertical-menu-bottom .copyright, #mobile-top-text, #mobile-logo h1').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[header_link_color]',function( value ) {
		value.bind(function(to) {
			$('.header-left a, .header-right a, .vertical-menu-bottom .copyright a, .header-left ul.menu > li > a.header-search-link-alt, .header-left ul.menu > li > a.header-search-link, .header-right ul.menu > li > a.header-search-link, .header-right ul.menu > li > a.header-search-link-alt, .aux-item nav .menu > li.menu-item > a, .aux-item nav.std-menu .menu > li > a, .aux-item nav.std-menu .menu > li > span, #mobile-top-text a, #mobile-header a, #mobile-header a').css('color', to ? to : '' );
		});
	});


	/////////////////////////////////////////////
	// NAVIGATION STYLING
	/////////////////////////////////////////////
	wp.customize('sf_customizer[nav_bg_color]',function( value ) {
		value.bind(function(to) {
			$('#main-nav, .header-wrap[class*="page-header-naked"] #header-section .is-sticky #main-nav, .ajax-search-wrap').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[nav_text_color]',function( value ) {
		value.bind(function(to) {
			$('nav .menu > li.menu-item > a, nav.std-menu .menu > li > a, nav .mega-menu li.mega-menu-item > a, nav.std-menu .menu > li > span, .ajax-search-wrap input[type="text"], .search-result-pt h6, .no-search-results h6, .search-result h5 a, .no-search-results p, nav > .mega-menu-wrap ul.mega-menu > li.mega-menu-item > a.mega-menu-link').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[nav_selected_text_color]',function( value ) {
		value.bind(function(to) {
			$('nav .menu > li.current-menu-ancestor > a, nav .menu > li.current-menu-item > a, nav .menu > li.current-scroll-item > a, #mobile-menu .menu ul li.current-menu-item > a, .aux-currency .wcml_currency_switcher.sub-menu li.wcml-active-currency').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[nav_sm_bg_color]',function( value ) {
		value.bind(function(to) {
			$('nav .menu ul.sub-menu, nav .menu ul.mega-sub-menu, li.menu-item.sf-mega-menu > ul.sub-menu > div, nav > .mega-menu-wrap ul.mega-menu > li.mega-menu-megamenu > ul.mega-sub-menu, nav > .mega-menu-wrap ul.mega-menu > li.mega-menu-flyout ul.mega-sub-menu, nav > .mega-menu-wrap ul.mega-menu > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[nav_sm_text_color]',function( value ) {
		value.bind(function(to) {
			$('nav .menu ul.sub-menu li.menu-item > a, nav .menu ul.sub-menu li > span, nav.std-menu ul.sub-menu, .bag-buttons a.bag-button, .bag-buttons a.wishlist-button, .bag-product a.remove, .woocommerce .bag-product a.remove, nav > .mega-menu-wrap ul.mega-menu > li.mega-menu-flyout ul.mega-sub-menu li.mega-menu-item a.mega-menu-link, nav > .mega-menu-wrap ul.mega-menu a, nav .mega-menu ul.mega-sub-menu li.mega-menu-item > a, nav .mega-menu ul.mega-sub-menu li > span, nav.std-menu ul.mega-sub-menu, li.mega-menu-megamenu > ul.mega-sub-menu li.mega-menu-item li.mega-menu-item > a.mega-menu-link, nav.std-menu .mega-menu-wrap li.mega-menu-megamenu ul.mega-sub-menu li.mega-menu-item-has-children > ul.mega-sub-menu').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[nav_sm_selected_text_color]',function( value ) {
		value.bind(function(to) {
			$('nav .menu ul.sub-menu li.current-menu-ancestor > a, nav .menu ul.sub-menu li.current-menu-item > a, .header-languages .current-language').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[nav_divider_color]',function( value ) {
		value.bind(function(to) {
			$('nav.std-menu ul.sub-menu > li, nav.std-menu ul.mega-sub-menu li.mega-menu-item, #main-nav ul.menu > li, #main-nav ul.menu > li:first-child, #main-nav ul.menu > li:first-child, .full-center nav#main-navigation ul.menu > li, .full-center nav#main-navigation ul.menu > li:first-child, .full-center #header nav.float-alt-menu ul.menu > li, .bag-header, .bag-product, .bag-empty, .wishlist-empty').css('border-color', to ? to : '' );
			$('nav .menu ul.sub-menu li.menu-item, nav .menu ul.mega-sub-menu li.mega-menu-item a.mega-menu-link').css('border-top-color', to ? to : '' );
			$('#main-nav .header-right ul.menu > li, .wishlist-item').css('border-left-color', to ? to : '' );
			$('.header-divide').css('background-color', to ? to : '' );
		});
	});


	/////////////////////////////////////////////
	// OVERLAY MENU STYLING
	/////////////////////////////////////////////
	wp.customize('sf_customizer[overlay_menu_bg_color]',function( value ) {
		value.bind(function(to) {
			$('#overlay-menu, .sf-pushnav, .fs-search-open .header-wrap #header, .fs-search-open .header-standard-overlay #header, .fs-search-open .vertical-header .header-wrap #header-section, .fs-search-open #header-section .is-sticky #header.sticky-header, .fs-supersearch-open .header-wrap #header, .fs-supersearch-open .header-standard-overlay #header, .fs-supersearch-open .vertical-header .header-wrap #header-section, .fs-supersearch-open #header-section .is-sticky #header.sticky-header, .overlay-menu-open .header-wrap #header, .overlay-menu-open .header-standard-overlay #header, .overlay-menu-open .vertical-header .header-wrap #header-section, .overlay-menu-open #header-section .is-sticky #header.sticky-header').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[overlay_menu_text_color]',function( value ) {
		value.bind(function(to) {
			$('#fullscreen-supersearch .sf-super-search, #fullscreen-search .fs-overlay-close, #fullscreen-search .search-wrap .title, .fs-search-bar, .fs-search-bar input#fs-search-input, #fullscreen-search .search-result-pt h3').css('color', to ? to : '' );
			$('#fullscreen-search .container1 > div, #fullscreen-search .container2 > div, #fullscreen-search .container3 > div').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[overlay_menu_link_color]',function( value ) {
		value.bind(function(to) {
			$('.overlay-menu-open #logo h1, .overlay-menu-open .header-left, .overlay-menu-open .header-right, .overlay-menu-open .header-left a, .overlay-menu-open .header-right a, #overlay-menu nav li.menu-item > a, .overlay-menu-open a.menu-bars-link, #overlay-menu .fs-overlay-close, .sf-pushnav-menu nav li.menu-item > a, .sf-pushnav-menu nav ul.sub-menu li.menu-item > a, .sf-pushnav a, .fs-supersearch-open .fs-supersearch-link, .fs-search-open .fs-header-search-link, #fullscreen-supersearch .sf-super-search .search-options .ss-dropdown > span, #fullscreen-supersearch .sf-super-search .search-options input').css('color', to ? to : '' );
			$('#sf-pushnav-close path').css('stroke', to ? to : '' );
		});
	});


	/////////////////////////////////////////////
	// SLIDEOUT MENU STYLING
	/////////////////////////////////////////////
	wp.customize('sf_customizer[slideout_menu_bg_color]',function( value ) {
		value.bind(function(to) {
			$('.sf-side-slideout').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[slideout_menu_bg_image]',function( value ) {
		value.bind(function(to) {
			$('.sf-side-slideout').css('background-image', to ? 'url(' + to + ')' : '' );
		});
	});
	wp.customize('sf_customizer[slideout_menu_link_color]',function( value ) {
		value.bind(function(to) {
			$('.sf-side-slideout .vertical-menu nav .menu li > a, .sf-side-slideout .vertical-menu nav .menu li.parent > a:after, .sf-side-slideout .vertical-menu nav .menu > li ul.sub-menu > li > a').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[slideout_menu_divider_color]',function( value ) {
		value.bind(function(to) {
			$('.sf-side-slideout .vertical-menu nav .menu li ').css('border-color', to ? to : '' );
		});
	});


	/////////////////////////////////////////////
	// MOBILE MENU STYLING
	/////////////////////////////////////////////
	wp.customize('sf_customizer[mobile_menu_bg_color]',function( value ) {
		value.bind(function(to) {
			$('#mobile-menu-wrap, #mobile-cart-wrap, .mobile-menu-aux').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[mobile_menu_text_color]',function( value ) {
		value.bind(function(to) {
			$('#mobile-menu-wrap, #mobile-cart-wrap, .mobile-search-form input[type="text"]').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[mobile_menu_link_color]',function( value ) {
		value.bind(function(to) {
			$('#mobile-menu-wrap a').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[mobile_menu_divider_color]',function( value ) {
		value.bind(function(to) {
			$('#mobile-cart-wrap .shopping-bag-item > a.cart-contents, #mobile-cart-wrap .bag-product, ').css('border-bottom-color', to ? to : '' );
			$('.mobile-cart-menu li').css('border-color', to ? to : '' );
			$('.mobile-search-form input[type="text"]').css('background-color', to ? to : '' );
		});
	});


	/////////////////////////////////////////////
	// PAGE HEADING STYLING
	/////////////////////////////////////////////
	wp.customize('sf_customizer[page_heading_bg_color]',function( value ) {
		value.bind(function(to) {
			$('.page-heading').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[page_heading_text_color]',function( value ) {
		value.bind(function(to) {
			$('.page-heading h1, .page-heading h3').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[page_heading_text_align]',function( value ) {
		value.bind(function(to) {
			$('.page-heading .heading-text, .fancy-heading .heading-text').css('text-align', to ? to : '' );
		});
	});
	
	
	/////////////////////////////////////////////
	// BREADCRUMB STYLING
	/////////////////////////////////////////////
	wp.customize('sf_customizer[breadcrumb_text_color]',function( value ) {
		value.bind(function(to) {
			$('#breadcrumbs, #breadcrumbs i').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[breadcrumb_link_color]',function( value ) {
		value.bind(function(to) {
			$('#breadcrumbs a').css('color', to ? to : '' );
		});
	});
	
	
	/////////////////////////////////////////////
	// NEWSLETTER BAR STYLING
	/////////////////////////////////////////////
	wp.customize('sf_customizer[newsletter_bar_bg_color]',function( value ) {
		value.bind(function(to) {
			$('#sf-newsletter-bar').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[newsletter_bar_text_color]',function( value ) {
		value.bind(function(to) {
			$('#sf-newsletter-bar h3.sub-text, #sf-newsletter-bar .sub-close, #sf-newsletter-bar .sub-code > form input[type="submit"], #sf-newsletter-bar .sub-code > form input[type="text"], #sf-newsletter-bar .sub-code > form input[type="email"]').css('color', to ? to : '' );
			$('#sf-newsletter-bar .sub-code > form input[type="submit"], #sf-newsletter-bar .sub-code > form input[type="text"], #sf-newsletter-bar .sub-code > form input[type="email"]').css('border-color', to ? to : '' );
		});
	});
	
	
	/////////////////////////////////////////////
	// FOOTER STYLING
	/////////////////////////////////////////////
	wp.customize('sf_customizer[footer_bg_color]',function( value ) {
		value.bind(function(to) {
			$('#footer').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[footer_text_color]',function( value ) {
		value.bind(function(to) {
			$('#footer, #footer p, #footer h6').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[footer_link_color]',function( value ) {
		value.bind(function(to) {
			$('#footer a').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[footer_border_color]',function( value ) {
		value.bind(function(to) {
			$('#footer .widget ul li, #footer .widget_categories ul, #footer .widget_archive ul, #footer .widget_nav_menu ul, #footer .widget_recent_comments ul, #footer .widget_meta ul, #footer .widget_recent_entries ul, #footer .widget_product_categories ul, #copyright, #copyright nav .menu li, #footer .widget_calendar #calendar_wrap, #footer .widget_calendar th, #footer .widget_calendar tbody tr > td, #footer .widget_calendar tbody tr > td.pad, #footer .widget hr, #footer ul.wp-tag-cloud li > a').css('border-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[copyright_bg_color]',function( value ) {
		value.bind(function(to) {
			$('#copyright').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[copyright_text_color]',function( value ) {
		value.bind(function(to) {
			$('#copyright p').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[copyright_link_color]',function( value ) {
		value.bind(function(to) {
			$('#copyright a').css('color', to ? to : '' );
		});
	});


	/////////////////////////////////////////////
	// UI ELEMENTS STYLING
	/////////////////////////////////////////////
	wp.customize('sf_customizer[input_bg_color]',function( value ) {
		value.bind(function(to) {
			$('input[type="text"], input[type="email"], input[type="password"], textarea, select, .wpcf7 input[type="text"], .wpcf7 input[type="email"], .wpcf7 textarea, .wpcf7 select, .ginput_container input[type="text"], .ginput_container input[type="email"], .ginput_container textarea, .ginput_container select, .mymail-form input[type="text"], .mymail-form input[type="email"], .mymail-form textarea, .mymail-form select, input[type="date"], input[type="tel"], input.input-text, input[type="number"], .select2-container .select2-choice').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[input_text_color]',function( value ) {
		value.bind(function(to) {
			$('input[type="text"], input[type="email"], input[type="password"], textarea, select, .wpcf7 input[type="text"], .wpcf7 input[type="email"], .wpcf7 textarea, .wpcf7 select, .ginput_container input[type="text"], .ginput_container input[type="email"], .ginput_container textarea, .ginput_container select, .mymail-form input[type="text"], .mymail-form input[type="email"], .mymail-form textarea, .mymail-form select, input[type="date"], input[type="tel"], input.input-text, input[type="number"], .select2-container .select2-choice, .select2-container .select2-choice>.select2-chosen').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[overlay_bg_color]',function( value ) {
		value.bind(function(to) {
			$('figure.animated-overlay figcaption').css('background-color', to ? to : '' );
			$('figcaption .thumb-info-alt > i, .gallery-item figcaption .thumb-info > i, .gallery-hover figcaption .thumb-info > i').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[overlay_text_color]',function( value ) {
		value.bind(function(to) {
			$('figure.animated-overlay figcaption *').css('color', to ? to : '' );
			$('figcaption .thumb-info .name-divide, figcaption .thumb-info-alt > i, .gallery-item figcaption .thumb-info > i, .gallery-hover figcaption .thumb-info > i').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[preview_slider_bg_color]',function( value ) {
		value.bind(function(to) {
			$('.woocommerce .products .preview-slider-item-wrapper > figure').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[sale_tag_color]',function( value ) {
		value.bind(function(to) {
			$('.woocommerce .free-badge, .woocommerce span.onsale, .price ins').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[new_tag_color]',function( value ) {
		value.bind(function(to) {
			$('.woocommerce .wc-new-badge, li.mega-menu-item > a.mega-menu-link sup.new-badge').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[oos_tag_color]',function( value ) {
		value.bind(function(to) {
			$('.woocommerce .out-of-stock-badge, .woocommerce div.product p.stock.out-of-stock').css('background-color', to ? to : '' );
		});
	});


	/////////////////////////////////////////////
	// CONTENT SLIDERS STYLING
	/////////////////////////////////////////////
	wp.customize('sf_customizer[tweet_slider_bg]',function( value ) {
		value.bind(function(to) {
			$('.spb_tweets_slider_widget').css('background-color', to ? to : '' );
		});
	});
		wp.customize('sf_customizer[tweet_slider_text]',function( value ) {
		value.bind(function(to) {
			$('.spb_tweets_slider_widget .tweet-text, .spb_tweets_slider_widget .tweet-icon').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[tweet_slider_link]',function( value ) {
		value.bind(function(to) {
			$('.spb_tweets_slider_widget .tweet-text a').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[testimonial_slider_bg]',function( value ) {
		value.bind(function(to) {
			$('.spb_testimonial_slider_widget').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[testimonial_slider_text]',function( value ) {
		value.bind(function(to) {
			$('.spb_testimonial_slider_widget .testimonial-text, .spb_testimonial_slider_widget cite, .spb_testimonial_slider_widget .testimonial-icon').css('color', to ? to : '' );
		});
	});


	/////////////////////////////////////////////
	// SHORTCODES STYLING
	/////////////////////////////////////////////
	wp.customize('sf_customizer[promo_bar_bg_color]',function( value ) {
		value.bind(function(to) {
			$('#base-promo, .sf-promo-bar').css('background-color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[promo_bar_text_color]',function( value ) {
		value.bind(function(to) {
			$('#base-promo > p, #base-promo.footer-promo-text > a, #base-promo.footer-promo-arrow > a, .sf-promo-bar > p, .sf-promo-bar.promo-text > a, .sf-promo-bar.promo-arrow > a').css('color', to ? to : '' );
		});
	});
	wp.customize('sf_customizer[icon_container_border_color]',function( value ) {
		value.bind(function(to) {
			$('.sf-icon-cont').css('border-color', to ? to : '' );
		});
	});
		

	/////////////////////////////////////////////
	// PAGE META
	/////////////////////////////////////////////
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '#logo h1' ).html( to );
		} );
	} );
//	wp.customize( 'blogdescription', function( value ) {
//		value.bind( function( to ) {
//			$( '#site-description' ).html( to );
//		} );
//	} );

} )( jQuery );