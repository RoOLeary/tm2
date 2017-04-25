<?php
	/*
	*
	*	Styleswitcher
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
	*
	*/

	if (!function_exists('sf_styleswitcher')) {
		function sf_styleswitcher() {
	
			// Enqueue
			wp_enqueue_script( 'owlcarousel' );
						
			$sf_options = sf_get_theme_opts();
			$enable_styleswitcher = false;
			if ( isset($sf_options['enable_styleswitcher']) ) {
			$enable_styleswitcher = $sf_options['enable_styleswitcher'];
			}
			
			if ($enable_styleswitcher) {
				$styleswitcher_path = get_template_directory_uri() . '/includes/sf-styleswitcher/';

			?>
			<div id="sf-style-switcher">
				<a id="sf-styleswitch-trigger" href="#"><i class="sf-icon-settings"></i><span><?php _e( 'Style Switcher', 'uplift' ); ?></span></a>					
				<div class="switch-cont">
					<div class="divide"></div>
					<div class="option">
						<h5>Colours</h5>
						<ul class="options color-select">
							<li><a href="#" data-color="7eced5" style="background-color: #7eced5;"></a></li>
							<li><a href="#" data-color="00bff3" style="background-color: #00bff3;"></a></li>
							<li><a href="#" data-color="ff7534" style="background-color: #ff7534;"></a></li>
							<li><a href="#" data-color="7c4d9f" style="background-color: #7c4d9f;"></a></li>
							<li><a href="#" data-color="37ba85" style="background-color: #37ba85;"></a></li>
							<li><a href="#" data-color="fe504f" style="background-color: #fe504f;"></a></li>
							<li><a href="#" data-color="ffd56c" style="background-color: #ffd56c;"></a></li>
						</ul>
					</div>
					
					<div class="option">
						<h5>Headers</h5>
						<div class="options">
							<select class="header-select">
								<option value="header-1">Centred Split Nav</option>
								<option value="header-2">Centred Minimal</option>
								<option value="header-3">Left Centred Nav</option>
								<option value="header-4">Left Right Nav</option>
								<option value="header-5">Left Left Nav</option>
								<option value="header-6">Double Centred</option>
								<option value="header-7">Double Left</option>
								<option value="header-8">Left Minimal</option>
								<option value="header-vert">Vertical Left</option>
								<option value="header-vert-right">Vertical Right</option>
							</select>
							<p>NOTE: Vertical headers will not work on pages that have the naked header enabled</p>
						</div>
					</div>
					
					<div class="option spb_content_element carousel-wrap">
						<h5>Demos (6)</h5>
						<a href="#" class="carousel-prev"><i class="sf-icon-left-chevron"></i></a>
						<a href="#" class="carousel-next"><i class="sf-icon-right-chevron"></i></a>
						<div id="styleswitch-carousel" class="owl-carousel carousel-items" data-columns="2">
						  <div class="demo-item"><div class="demo-item-inner main-demo"><a href="http://uplift.swiftideas.com" target="_blank"></a><div class="tag">Main</div></div></div>
						  <div class="demo-item"><div class="demo-item-inner landing-demo"><a href="http://uplift.swiftideas.com/landing-demo/" target="_blank"></a><div class="tag">Landing</div></div></div>
						  <div class="demo-item"><div class="demo-item-inner cafe-demo"><a href="http://uplift.swiftideas.com/cafe-demo/" target="_blank"></a><div class="tag">Cafe</div></div></div>
						  <div class="demo-item"><div class="demo-item-inner agency-demo"><a href="http://uplift.swiftideas.com/agency-demo/" target="_blank"></a><div class="tag">Agency</div></div></div>
						  <div class="demo-item"><div class="demo-item-inner startup-demo"><a href="http://uplift.swiftideas.com/startup-demo/" target="_blank"></a><div class="tag">Startup</div></div></div>
						  <div class="demo-item"><div class="demo-item-inner goods-demo"><a href="http://uplift.swiftideas.com/goods-demo/" target="_blank"></a><div class="tag">Shop</div></div></div>
						  <div class="demo-item"><div class="demo-item-inner corporate-demo"><a href="http://uplift.swiftideas.com/corporate-demo/" target="_blank"></a><div class="tag">Corporate</div></div></div>
						  <div class="demo-item"><div class="demo-item-inner magazine-demo"><a href="http://uplift.swiftideas.com/magazine-demo/" target="_blank"></a><div class="tag">Magazine</div></div></div>
						  <div class="demo-item"><div class="demo-item-inner agency-two-demo"><a href="http://uplift.swiftideas.com/agency-two-demo/" target="_blank"></a><div class="tag">Agency Two</div></div></div>
						</div>
					</div>
					
					<div class="button-wrap">
						<a href="http://uplift.swiftideas.com/purchase" target="_blank" class="sf-button sf-button-has-icon large default accent"><i class="sf-icon-cart"></i><span class="text">Purchase Uplift</span></a>
					</div>
				</div>
			</div>

			<script type="text/javascript">
				var onLoad = {
				    init: function(){

					    "use strict";
					    
					    // Variables
					    var trigger = jQuery('#sf-styleswitch-trigger'),
					    	triggerWidth = trigger.width(),
					    	switcher = jQuery('#sf-style-switcher'),
					    	switchCont = switcher.find('.switch-cont'),
					    	isAnimating = false;
					    
					    // Loaded
					    trigger.css('width', '60px').fadeIn(400).addClass('loaded');
					    
					  	// Hove in/out  
					    trigger.on('mouseover', function() {
					    	if ( switcher.hasClass('open') || switcher.hasClass('animating') ) {
					    		return;
					    	}
					    	switcher.css('width', '');
					    	trigger.transition({
					    		width: triggerWidth
					    	}, 400, 'easeOutCirc');
					    });
					    trigger.on('mouseleave', function() {
					    	if ( switcher.hasClass('open') ) {
					    		return;
					    	}
					    	if ( !switcher.hasClass('open') && switcher.hasClass('animating') ) {
					    		setTimeout(function() {
					    			trigger.transition({
					    				width: '60'
					    			}, 400, 'easeOutCirc');
					    		}, 600);
					    	} else {
						    	trigger.transition({
						    		width: '60'
						    	}, 400, 'easeOutCirc');
					    	}
					    });
					    
					    // Open switcher window
					    trigger.on('click', function(e) {
					    	
					    	e.preventDefault();
					    	
					    	if ( isAnimating ) {
					    		return;
					    	}
					    	
					    	isAnimating = true;
					    	switcher.addClass('animating');
					    	
				    		switcher.toggleClass('open');
				    		setTimeout(function() {
				    			isAnimating = false;
				    			switcher.removeClass('animating');
				    		}, 600);
					    });
					    // Close switcher window
					    
					    
					    // Switcher controls

					    if (jQuery('#header-section').length > 0) {
					    	var currentHeader = jQuery('#header-section').attr('class').split(' ')[0];
					    	jQuery(".header-select option[value="+currentHeader+"]").prop("selected", "selected")
					    }

						jQuery('.header-select').change(function() {
							var baseURL = onLoad.getPathFromUrl(location.href),
								newURLParam = "?header=" + jQuery('.header-select').val();

							location.href = baseURL + newURLParam;
						});

						jQuery('.color-select li').on('click', 'a', function(e) {
							e.preventDefault();
							
							jQuery('.color-select li').removeClass('active');
							jQuery(this).parent().addClass('active');

							var selectedColor = '#' + jQuery(this).data('color');
							var s = "#ff0000";
							var patt = /^#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})$/;
							var matches = patt.exec(selectedColor);
							var top = "rgba("+parseInt(matches[1], 16)+","+parseInt(matches[2], 16)+","+parseInt(matches[3], 16)+",0.60)";
							var bottom = "rgba("+parseInt(matches[1], 16)+","+parseInt(matches[2], 16)+","+parseInt(matches[3], 16)+",1.0)";
							

							// background-color
							jQuery('.sf-accent-bg, .funded-bar .bar, .flickr-widget li, .portfolio-grid li, figcaption .product-added, .woocommerce .widget_layered_nav ul li.chosen small.count, .woocommerce .widget_layered_nav_filters ul li a, span.highlighted, #one-page-nav li .hover-caption, #sidebar-progress-menu ul li.reading .progress, .loading-bar-transition .pace .pace-progress, input[type=submit], button[type=submit], input[type="file"], .wpcf7 input.wpcf7-submit[type=submit], .sf-super-search .search-options .ss-dropdown ul, av ul.menu > li.menu-item.sf-menu-item-btn > a, .shopping-bag-item a > span.num-items, .bag-buttons a.checkout-button, .bag-buttons a.create-account-button, .woocommerce input.button.alt, .woocommerce .alt-button, .woocommerce button.button.alt, #jckqv .cart .add_to_cart_button, #fullscreen-supersearch .sf-super-search .search-go a.sf-button, #respond .form-submit input[type=submit], .sf-button.accent:not(.bordered), .sf-icon-box-animated .back, .spb_icon_box_grid .spb_icon_box .divider-line, .tabs-type-dynamic .nav-tabs li.active a, .progress .bar, .mejs-controls .mejs-time-rail .mejs-time-current, .team-member-divider, .masonry-items li.testimonial .testimonial-text, .spb_tweets_slider_widget .tweet-icon i, .woocommerce .cart button.add_to_cart_button.product-added, .woocommerce .single_add_to_cart_button:disabled[disabled], .woocommerce .order-info, .woocommerce .order-info mark, .woocommerce .button.checkout-button, .woocommerce #review_form #respond .form-submit input, .woocommerce button[type="submit"], .woocommerce input.button, .woocommerce a.button, .woocommerce-cart table.cart input.button, .review-order-wrap #payment #place_order, #buddypress .pagination-links span, #buddypress .load-more.loading a, #bbp-user-navigation ul li.current a, .bbp-pagination-links span.current').css('background-color', selectedColor );
							// color
							jQuery('.sf-accent, .portfolio-item .portfolio-item-permalink, .read-more-link, .blog-item .read-more, .author-link, span.dropcap2, .spb_divider.go_to_top a, #header-translation p a, span.dropcap4, #sidebar-progress-menu ul li.reading a, .read-more-button, .player-controls button.tab-focus, .player-progress-played[value], .sf-super-search .search-options .ss-dropdown > span, .sf-super-search .search-options input, .author-bio a.author-more-link, .comment-meta-actions a, .blog-aux-options li.selected a, .sticky-post-icon, .blog-item .author a.tweet-link, .side-post-info .post-share .share-link, a.sf-button.bordered.accent, .progress-bar-wrap .progress-value, .sf-share-counts .share-text h2, .sf-share-counts .share-text span, .woocommerce div.product .stock, .woocommerce form .form-row .required, .woocommerce .widget_price_filter .price_slider_amount .button, .product-cat-info a.shop-now-link, .woocommerce-cart table.cart input[name="apply_coupon"], .woocommerce .shipping-calculator-form button[type="submit"], .woocommerce .cart input.button[name="update_cart"]').css('color', selectedColor );
							// border-color
							jQuery('.sf-accent-border,span.dropcap4, .super-search-go, .sf-button.accent, .sf-button.accent.bordered .sf-button-border, blockquote.pullquote, .woocommerce form .form-row.woocommerce-invalid .select2-container, .woocommerce form .form-row.woocommerce-invalid input.input-text, .woocommerce form .form-row.woocommerce-invalid select, .woocommerce .woocommerce-info, .woocommerce-page .woocommerce-info, .woocommerce-cart table.cart input[name="apply_coupon"], .woocommerce .shipping-calculator-form button[type="submit"], .woocommerce .cart input.button[name="update_cart"], #buddypress .activity-header a, #buddypress .activity-read-more a, #buddypress .pagination-links span, #buddypress .load-more.loading a, #bbp-user-navigation ul li.current a, .bbp-pagination-links span.current').css('border-color', selectedColor );
							jQuery('.spb_impact_text .spb_call_text, code > pre').css('border-left-color', selectedColor );
							jQuery('#account-modal .nav-tabs li.active span, .sf-super-search .search-options .ss-dropdown > span, .sf-super-search .search-options input').css('border-bottom-color', selectedColor );
							jQuery('#bbpress-forums li.bbp-header').css('border-top-color', selectedColor );
							// stroke
							jQuery('.sf-hover-svg path').css('stroke', selectedColor );
							
							console.log('-webkit-gradient(linear,left top,left bottom,from('+top+') 25%,to('+bottom+') 100%)');
							jQuery('figure.animated-overlay figcaption').css('background', '-webkit-gradient(linear,left top,left bottom,color-stop(25%,'+top+'),to('+bottom+'))' );
							jQuery('figure.animated-overlay figcaption').css('background', '-webkit-linear-gradient(top,'+top+' 25%, '+bottom+' 100%)' );
							jQuery('figure.animated-overlay figcaption').css('background', 'linear-gradient(to bottom,'+top+' 25%, '+bottom+' 100%)' );
										
							jQuery('figcaption .thumb-info-alt > i, .gallery-item figcaption .thumb-info > i, .gallery-hover figcaption .thumb-info > i').css('color', selectedColor );

						});

				    },
				    getURLVars: function() {
				    	var vars = [], hash;
				    	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
				    	for(var i = 0; i < hashes.length; i++)
				    	{
				    	    hash = hashes[i].split('=');
				    	    vars.push(hash[0]);
				    	    vars[hash[0]] = hash[1];
				    	}
				    	return vars;
				    },
				   	getPathFromUrl: function(url) {
				      return url.split("?")[0];
				    }
				};

				jQuery(document).ready(onLoad.init);
			</script>

		<?php
			}
		}
		add_action('wp_footer', 'sf_styleswitcher');
	}
?>