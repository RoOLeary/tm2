/*global jQuery,google,alert,console,plyr */

// USE STRICT
"use strict";

(function(){

	var SWIFT = SWIFT || {};

	/////////////////////////////////////////////
	// PAGE FUNCTIONS
	/////////////////////////////////////////////

 	SWIFT.page = {
		init: function () {

			// BROWSER CHECK
			SWIFT.page.browserCheck();

			// FITTEXT
			//SWIFT.page.resizeHeadings();

			// HEADER SLIDER
			if (body.hasClass('header-below-slider') && jQuery('.home-slider-wrap').length > 0) {
				SWIFT.page.headerSlider();
			}

			// ONE PAGE NAV
			if (jQuery('#one-page-nav').length > 0) {
				SWIFT.page.onePageNav();
			}
			
			// SIDEBAR PROGRESS MENU
			if (jQuery('#sidebar-progress-menu').length > 0) {
				SWIFT.page.sidebarProgressMenu();
			}

			// BACK TO TOP
			if (jQuery('#back-to-top').length > 0) {
				$window.scroll(function() {
					SWIFT.page.backToTop();
				});
			}
			
			// HERO/CONTENT SPLIT STYLE
			if (body.hasClass('hero-content-split')) {
				SWIFT.page.heroContentSplit();
			}

			// FOOTER NEWSLETTER SUB BAR
			if (jQuery('#sf-newsletter-bar').length > 0) {
				SWIFT.page.newsletterSubBar();
			}

			// ADMIN BAR CHECK
			if (jQuery('#wpadminbar').length > 0) {
				body.addClass('has-wpadminbar');
			}

			// RECENT POSTS
			if (jQuery('.recent-posts').length > 0) {
				SWIFT.recentPosts.init();
			}

			// SHARE
			if (jQuery('.sf-share-counts').length > 0) {
				SWIFT.page.shareCounts();
			}
			
			// WP LOGIN FORM FIX
			SWIFT.page.wooFormFix();
			
			// TRACK ORDER FORM FIX
			if (jQuery('.track_order').length > 0) {
				SWIFT.page.trackOrderFormFix();
			}

			// MOVE MODALS TO BOTTOM OF PAGE
			SWIFT.page.moveModals();

			// LOAD MAP ASSET ON MODAL CLICK
			jQuery('a[data-toggle="modal"]').on('click', function() {
				setTimeout(function() {
					SWIFT.map.init();
				}, 300);

				return true;
			});

			// REFRESH MODAL IFRAME ON CLOSE (FOR VIDEOS)
			SWIFT.page.modalClose();

			// REPLACE COMMENTS REPLY TITLE HTML
			if (body.hasClass('single-post')) {
				var replyTitle = jQuery('#respond').find('h3');
				var originalText = jQuery('#respond').find('h3').html();

				replyTitle.addClass('spb-heading');
				replyTitle.html('<span>'+originalText+'</span>');
			}

			// SMOOTH SCROLL LINKS
			SWIFT.page.smoothScrollLinks();

			// EXPANDING ASSETS
			SWIFT.page.expandingAssets();

			// BUDDYPRESS ACTIVITY LINK CLICK
			jQuery('.activity-time-since,.bp-secondary-action').on('click', function(e) {
				e.preventDefault();
				jQuery('.viewer').css('display', 'none');
				window.location = jQuery(this).attr('href');
			});

			// LOVE IT CLICK
			jQuery('.love-it').on('click', function() {
				SWIFT.page.loveIt(jQuery(this));
				return false;
			});

			// ARTICLE WITH FULL WIDTH MEDIA TITLE
			if (jQuery('article').hasClass('single-post-fw-media-title')) {
				SWIFT.page.postMediaTitle();
			}
			
			// PORT WITH FULL WIDTH MEDIA TITLE
			if (jQuery('article').hasClass('single-portfolio-poster')) {
				SWIFT.page.portMediaTitle();
			}

			// RELATED POSTS
			if (jQuery('.related-items').length > 0) {
				SWIFT.relatedPosts.init();
			}

			// LIGHTBOX
			SWIFT.page.lightbox();

			// MOBILE 2 CLICK IMAGES
			if (isMobileAlt && body.hasClass('mobile-two-click')) {
				SWIFT.page.mobileThumbLinkClick();
			}

			// PAGE FADE OUT
			if (body.hasClass('page-transitions')) {
				SWIFT.page.pageTransitions();
			}

			// DIRECTORY SUBMIT
			SWIFT.page.directorySubmit();
			
			// MEDIA PLAYER
			SWIFT.page.mediaPlayer();
		},
		homePreloader: function() {
			// Site loaded, fade out preloader
			body.addClass('sf-preloader-done');
			setTimeout(function() {
				jQuery('#sf-home-preloader').fadeOut(300);
			}, 300);
		},
		load: function() {
			
			// OFFSET CALC
			SWIFT.page.offsetCalc();
			$window.smartresize( function() {
				SWIFT.page.offsetCalc();
			});

			// Hero HEADING
			if (jQuery('.fancy-heading').length > 0) {
				SWIFT.page.fancyHeading();
			}
			
			// RECENT POSTS RESIZE
			if (jQuery('.recent-posts').length > 0) {
				SWIFT.recentPosts.load();
			}
			
			// HERO/CONTENT SPLIT STYLE
			if (body.hasClass('hero-content-split')) {
				SWIFT.page.heroContentSplitResize();
			}
			
			// HASH CHECK
			var windowWidth = $window.width();
			setTimeout(function() {
				if ( ( windowWidth >= 1024 && body.hasClass('mhs-tablet-land') ) ||
					 ( windowWidth >= 991 && body.hasClass('mhs-tablet-port') ) ||
					 ( windowWidth >= 767 && body.hasClass('mhs-mobile') ) ) { 
					var urlHash = document.location.toString();
					if (urlHash.match('#')) {
					    var hash = urlHash.split('#')[1];
					    if ( jQuery('#' + hash).length > 0 ) {
					        SWIFT.page.onePageNavGoTo('#' + hash);
					    }
					}	
				}
		   }, 1000);
		},
		browserCheck: function() {
			jQuery.browser = {};
			jQuery.browser.mozilla = /mozilla/.test(navigator.userAgent.toLowerCase()) && !/webkit/.test(navigator.userAgent.toLowerCase());
			jQuery.browser.webkit = /webkit/.test(navigator.userAgent.toLowerCase());
			jQuery.browser.opera = /opera/.test(navigator.userAgent.toLowerCase());
			jQuery.browser.msie = /msie/.test(navigator.userAgent.toLowerCase());
			jQuery.browser.msieMobile10 = /iemobile\/10\.0/.test(navigator.userAgent.toLowerCase());

			// BODY CLASSES
			if (isMobileAlt) {
				body.addClass("mobile-browser");
			} else {
				body.addClass("standard-browser");
			}
			if (isIEMobile) {
				body.addClass("ie-mobile");
			}
			if (isAppleDevice) {
				body.addClass("apple-mobile-browser");
			}
			if (body.hasClass("woocommerce-page") && !body.hasClass("woocommerce")) {
				body.addClass("woocommerce");
			}

			// ADD IE CLASS
			if (IEVersion && IEVersion < 9) {
				body.addClass('browser-ie');
			}

			// ADD IE10 CLASS
			var pattern = /MSIE\s([\d]+)/,
				ua = navigator.userAgent,
				matched = ua.match(pattern);
			if (matched) {
				body.addClass('browser-ie10');
			}

			// ADD MOZILLA CLASS
			if (jQuery.browser.mozilla) {
				body.addClass('browser-ff');
			}

			// ADD SAFARI CLASS
			if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
				body.addClass('browser-safari');
			}
		},
		offsetCalc: function() {
			var adjustment = 0;
			
			if (jQuery('#wpadminbar').length > 0) {
				adjustment = jQuery('#wpadminbar').height();
				SWIFT.wpadminbarheight = jQuery('#wpadminbar').height();
			}
			
			if (body.hasClass('sticky-header-enabled') && !body.hasClass('sticky-header-transparent') && jQuery('.sticky-header').is(':visible') ) {
				adjustment += jQuery('.sticky-header').height() > 0 ? jQuery('.sticky-header').height() : jQuery('#header-section').height();
			} else if ( body.hasClass('mh-sticky') && jQuery('#mobile-header').is(':visible') ) {
				adjustment += jQuery('#mobile-header').height(); 
			}

			if (jQuery('.sticky-top-bar').length > 0) {
				adjustment += jQuery('.sticky-top-bar').height() > 0 ? jQuery('.sticky-top-bar').height() : jQuery('#top-bar').height();
			}
			
			SWIFT.offset = adjustment;
		},
		resizeHeadings: function() {
			var h1FontSize = jQuery('h1:not(.logo-h1)').css('font-size'),
				h2FontSize = jQuery('h2:not(.caption-title)').css('font-size');

			SWIFT.page.resizeHeadingsResize(h1FontSize, h2FontSize);
			$window.smartresize( function() {
				SWIFT.page.resizeHeadingsResize(h1FontSize, h2FontSize);
			});
		},
		resizeHeadingsResize: function(h1FontSize, h2FontSize) {
			if ($window.width() <= 768) {
				if (h1FontSize) {
					h1FontSize = h1FontSize.replace("px", "");
					var h1FontSizeMin = Math.floor(h1FontSize * 0.6);
					jQuery('h1:not(.logo-h1)').fitText(1, { minFontSize: h1FontSizeMin + 'px', maxFontSize: h1FontSize +'px' }).css('line-height', '120%');
				}

				if (h2FontSize) {
					h2FontSize = h2FontSize.replace("px", "");
					var h2FontSizeMin = Math.floor(h2FontSize * 0.6);
					jQuery('h2:not(.caption-title)').fitText(1, { minFontSize: h2FontSizeMin + 'px', maxFontSize: h2FontSize +'px' }).css('line-height', '120%');
				}
			} else {
				jQuery('h1:not(.logo-h1)').css('font-size', '').css('line-height', '');
				jQuery('h2:not(.caption-title)').css('font-size', '').css('line-height', '');
			}
		},
		loveIt: function($this) {
			var locale = jQuery('#loveit-locale'),
				post_id = $this.data('post-id'),
				user_id = $this.data('user-id'),
				action = 'love_it';

			if ($this.hasClass('loved')) {
				action = 'unlove_it';
			}
			if (locale.data('loggedin') == 'false' && jQuery.cookie('loved-' + post_id)) {
				action = 'unlove_it';
			}

			var data = {
				action: action,
				item_id: post_id,
				user_id: user_id,
				love_it_nonce: locale.data('nonce')
			};

			jQuery.post(locale.data('ajaxurl'), data, function(response) {
				var ajaxResponse = jQuery.trim(response),
					count_wrap,
					count;

				if (ajaxResponse == 'loved') {
					$this.addClass('loved');
					count_wrap = $this.find('data.count');
					count = count_wrap.text();
					count_wrap.text(parseInt(count) + 1);
					if(locale.data('loggedin') == 'false') {
						jQuery.cookie('loved-' + post_id, 'yes', { expires: 1 });
					}
				} else if (ajaxResponse == 'unloved') {
					$this.removeClass('loved');
					count_wrap = $this.find('data.count');
					count = count_wrap.text();
					count_wrap.text(parseInt(count) - 1);
					if (locale.data('loggedin') == 'false') {
						jQuery.cookie('loved-' + post_id, 'no', { expires: 1 });
					}
				} else {
					alert(locale.data('error'));
				}
			});
		},
		stickyWidget: function() {

			var stickyWidget = jQuery('.sticky-widget'),
				sidebar = stickyWidget.parent(),
				offset = 24 + SWIFT.offset;

			SWIFT.page.initStickyWidget(stickyWidget, sidebar, offset);

			$window.smartresize( function() {
				jQuery('.inner-page-wrap').stickem().destroy();
				SWIFT.page.resizeStickyWidget(stickyWidget, sidebar);
				SWIFT.page.initStickyWidget(stickyWidget, sidebar, offset);
			});

		},
		initStickyWidget: function(stickyWidget, sidebar, offset) {
			
			var parent = ".page-content";
			
			if ( body.hasClass('page') || body.hasClass('archive') || body.hasClass('home') || body.hasClass('search-results') ) {
				parent = ".inner-page-wrap";
			}	
			
			jQuery('.inner-page-wrap').stickem({
				item: '.sticky-widget',
				container: parent,
				offset: offset + 24,
				onStick: function() {
					SWIFT.page.resizeStickyWidget(stickyWidget, sidebar);
				}
			});
			
			if ( stickyWidget.find('.mega-menu-accordion').length > 0 ) {
				stickyWidget.find('.mega-menu-accordion').on('click', 'a.mega-menu-link', function(e) {
					setTimeout(function() {
						SWIFT.page.resizeStickyWidget(stickyWidget, sidebar);
					}, 500);
				});
			}
		},
		resizeStickyWidget: function(stickyWidget, sidebar) {
			var headerHeight = SWIFT.offset,
				content = jQuery('.content-wrap'),
				sidebarHeight = sidebar.find('.sidebar-widget-wrap').height();
									
			if ( body.hasClass('page') || body.hasClass('search-results') ) {
				content = jQuery('.page-content');
			}	

			stickyWidget.css('width', sidebar.width()).css('top', headerHeight + 30);
			
			var contentHeight = content.height();
			if (contentHeight > sidebarHeight) {
				sidebar.css('height', contentHeight);
			} else {
				sidebar.css('height', sidebarHeight);
			}
		},
		expandingAssets: function() {
			jQuery('.spb-row-expand-text').on('click', '', function(e) {
				e.preventDefault();
				var expand = jQuery(this),
					expandRow = expand.next();

				if (expandRow.hasClass('spb-row-expanding-open') && !expandRow.hasClass('spb-row-expanding-active')) {
					expandRow.addClass('spb-row-expanding-open').addClass('spb-row-expanding-active').slideUp(800);
					setTimeout(function() {
						expand.removeClass('row-open').find('span').text(expand.data('closed-text'));
						expandRow.css('display', 'block').removeClass('spb-row-expanding-open').removeClass('spb-row-expanding-active');
					}, 800);
				} else if (!expandRow.hasClass('spb-row-expanding-active')) {
					expand.addClass('row-open').find('span').text(expand.data('open-text'));
					expandRow.css('display', 'none').addClass('spb-row-expanding-open').addClass('spb-row-expanding-active').slideDown(800);
					setTimeout(function() {
						expandRow.removeClass('spb-row-expanding-active');
					}, 800);
				}

			});
		},
		headerSlider: function() {

			// SET LOADING INDICATOR
			jQuery('#site-loading').css('display', 'block');

			// SET SLIDER POSITION & HEIGHT
			jQuery('.home-slider-wrap').css('position', 'fixed');
			jQuery('#main-container').css('position', 'relative');
			jQuery('#container').css('top', jQuery('.home-slider-wrap').height());
			setTimeout(function() {
				jQuery('#site-loading').fadeOut(1000);
			}, 250);

			// RESIZE SLIDER HEIGHT
			$window.smartresize( function() {
				jQuery('#container').css('top', jQuery('.home-slider-wrap').height());
			});

			// CONTINUE LINK
			jQuery('a#slider-continue').on('click', function(e) {

				// Prevent default anchor action
				e.preventDefault();

				// Animate scroll to main content
				jQuery('html, body').stop().animate({
					scrollTop: jQuery('#container').css('top')
				}, 1500, 'easeInOutExpo');

			});
		},
		fancyHeading: function() {
			var fancyHeading = jQuery('.fancy-heading'),
				fancyHeadingText = fancyHeading.find('.heading-text'),
				fancyHeadingTextHeight = fancyHeadingText.height(),
				fancyHeadingHeight = parseInt(fancyHeading.data('height'), 10),
				header = jQuery('.header-wrap'),
				headerHeight = 0,
				spacerHeight = 0;

			if (body.hasClass('header-naked-light') || body.hasClass('header-naked-dark')) {
				headerHeight = header.height();
			}

			if (!fancyHeadingHeight) {
				fancyHeadingHeight = 400;
			}

			if (fancyHeadingTextHeight > fancyHeadingHeight) {
				fancyHeadingHeight = fancyHeadingTextHeight + 120;
			}
			
			fancyHeadingHeight = fancyHeadingHeight + headerHeight;
			
			// Vertically center the heading text
			fancyHeadingText.vCenterTop();

			if (fancyHeading.hasClass('page-heading-breadcrumbs')) {
				fancyHeading.find('#breadcrumbs').vCenter();
			}

			var fancyHeadingAnimDelay = 400;
			
			if (jQuery('#wpadminbar').length > 0) {
				spacerHeight = fancyHeadingHeight - jQuery('#wpadminbar').height();
			}
			
			// Animate in the heading text and title
			if ( !fancyHeading.hasClass('fixed-height') ) {
				fancyHeading.css('height', fancyHeadingHeight);
			}
			
			// Animate the container-wrap on app header
			if ( body.hasClass('app-header') && jQuery('.page-heading-wrap-hidden').length === 0 ) {
				jQuery('#header').transition({
					opacity: 1
				}, 600, 'easeOutCirc');
				jQuery('.inner-container-wrap').transition({
					marginTop: spacerHeight
				}, 800, 'easeOutCirc');
				
				SWIFT.page.fancyHeadingResize();
				$window.smartresize( function() {
					SWIFT.page.fancyHeadingResize();
				});
			}

			setTimeout(function() {
				fancyHeadingText.css('opacity', 1);
			}, fancyHeadingAnimDelay + 600);
			setTimeout(function() {
				fancyHeading.addClass('animated');
			}, fancyHeadingAnimDelay + 1000);

			// Check if parallax scroll is possible
			if ( parallaxScroll && !isMobileAlt && !body.hasClass('hero-content-split') ) {
				$window.scroll(function(){

					var scrollTop = $window.scrollTop(),
						realScrollTop = scrollTop,
						headingOffset = SWIFT.offset,
						opacityScale = 400;
					
					if ( !body.hasClass('app-header') ) {
						scrollTop = scrollTop - headingOffset;
					}

					// Only scroll if the heading is makes sense to do so
					if (scrollTop < jQuery(document).height() - $window.height()) {

						if (scrollTop < 0) {
							scrollTop = 0;
						}
						
						var blur =  scrollTop / headingOffset * 4;

						fancyHeadingText.stop(true,true).css({
							opacity: 1 - realScrollTop / opacityScale,
							'-webkit-filter': 'blur(' + (blur) + 'px)',
						    '-moz-filter': 'blur(' + (blur) + 'px)',
						    '-ms-filter': 'blur(' + (blur) + 'px)',
						    '-o-filter': 'blur(' + (blur) + 'px)',
						    'filter': 'blur(' + (blur) + 'px)'
						}, 0);
					}

				});
			}
		},
		fancyHeadingResize: function() {
			var fancyHeading = jQuery('.fancy-heading'),
				fancyHeadingHeight = parseInt(fancyHeading.data('height'), 10),
				fhHeight = parseInt(fancyHeading.data('img-height'), 10),
				fhWidth = parseInt(fancyHeading.data('img-width'), 10),
				innerContainer = jQuery('.inner-container-wrap');
				
			if ( fhWidth === 0 || fhHeight === 0 || $window.width() <= 1024 ) {
				return;
			}
			
			var fhRatio = fhHeight / fhWidth;
			var currentHeight = fancyHeading.width() * fhRatio;
			if ( currentHeight < fancyHeadingHeight ) {
				fancyHeading.css('height', currentHeight);
				innerContainer.css('margin-top', currentHeight - SWIFT.wpadminbarheight);
			} else {
				fancyHeading.css('height', fancyHeadingHeight);
				innerContainer.css('margin-top', fancyHeadingHeight - SWIFT.wpadminbarheight);
			}
		},
		moveModals: function() {
			jQuery(".modal").each(function(){
				jQuery(this).appendTo("body");
			});
		},
		modalClose: function() {
			jQuery(".modal-backdrop, .modal .close, .modal .btn").on("click", function() {
				jQuery(".modal iframe").each(function() {
					var thisModal = jQuery(this);
					thisModal.attr("src", thisModal.attr("src"));
				});
			});
		},
		smoothScrollLinks: function() {
			jQuery('a.smooth-scroll-link').on('click', function(e) {

				var linkHref = jQuery(this).attr('href'),
					linkOffset = jQuery(this).data('offset') ? jQuery(this).data('offset') : 0;

				if (linkHref && linkHref.indexOf('#') === 0) {
					var headerHeight = SWIFT.offset;

					SWIFT.isScrolling = true;
					
					
					jQuery('html, body').stop().animate({
						scrollTop: jQuery(linkHref).offset().top - headerHeight + linkOffset
					}, 1000, 'easeInOutExpo', function() {
						SWIFT.isScrolling = false;
					});

					e.preventDefault();

				} else {
					return e;
				}

			});
		},
		onePageNav: function() {

			var onePageNav = jQuery('#one-page-nav'),
				onePageNavType = onePageNav.hasClass('opn-arrows') ? "arrows" : "standard",
				onePageNavItems = "",
				pageSectionCount = 0,
				mainContent = jQuery('.page-content');

			mainContent.find('section.row').each(function() {
				var linkID = jQuery(this).attr('id'),
					linkName = jQuery(this).data('rowname');

				if (linkID && linkName.length > 0 && jQuery(this).height() > 0) {
					onePageNavItems += '<li><a href="#'+linkID+'" data-title="'+linkName+'"><i></i></a><div class="hover-caption">'+linkName+'</div></li>';
					pageSectionCount++;
				}
			});

			if (pageSectionCount > 0) {
				if (onePageNav.find('ul').length === 0) {
					onePageNav.append('<ul>'+onePageNavItems+'</ul>');

					if (onePageNavType === "arrows") {
						onePageNav.find('ul').css('display', 'none');
						onePageNav.append('<a href="#" class="opn-up"><i class="sf-icon-up-chevron"></i></a>');
						onePageNav.append('<div class="opn-status"><span class="current">1</span>/<span class="total">'+pageSectionCount+'</span></div>');
						onePageNav.append('<a href="#" class="opn-down"><i class="sf-icon-down-chevron"></i></a>');
					}
				}

				onePageNav.vCenter();
				setTimeout(function() {

					SWIFT.page.onePageNavScroll(onePageNav);

					onePageNav.css('display', 'block').stop().animate({
						'right': '0',
						'opacity': 1
					}, 1000, "easeOutQuart");

					// Nav Dots
					jQuery('#one-page-nav ul li a').bind('click', function(e) {
						SWIFT.page.onePageNavGoTo(jQuery(this).attr('href'));
						e.preventDefault();
					});

					// Up Arrow
					jQuery('#one-page-nav a.opn-up').bind('click', function(e) {
						var currentSection = parseInt(jQuery('.opn-status .current').text(), 10),
							prevSection = currentSection - 1,
							prevSectionHref = jQuery('#one-page-nav ul li:nth-child('+ prevSection +') > a').attr('href');

						if (prevSection > 0) {
							SWIFT.page.onePageNavGoTo(prevSectionHref);
						}
						e.preventDefault();
					});

					// Down Arrow
					jQuery('#one-page-nav a.opn-down').bind('click', function(e) {
						var currentSection = parseInt(jQuery('.opn-status .current').text(), 10),
							nextSection = currentSection + 1,
							nextSectionHref = jQuery('#one-page-nav ul li:nth-child('+ nextSection +') > a').attr('href');

						if (nextSection <= pageSectionCount) {
							SWIFT.page.onePageNavGoTo(nextSectionHref);
						}
						e.preventDefault();
					});

					// Assign current on init and scroll
					SWIFT.page.onePageNavScroll(onePageNav);
					$window.on('scroll', function() {
						SWIFT.page.onePageNavScroll(onePageNav);
					});

				}, 1000);
			}
		},
		onePageNavGoTo: function(anchor) {

			var adjustment = SWIFT.offset;

			SWIFT.isScrolling = true;

			jQuery('html, body').stop().animate({
				scrollTop: jQuery(anchor).offset().top - adjustment + 1
			}, 1000, 'easeInOutExpo', function() {
				SWIFT.isScrolling = false;
			});
		},
		onePageNavScroll: function(onePageNav) {

			var adjustment = SWIFT.offset;

			var currentSection = jQuery('section.row:in-viewport('+adjustment+')').data('rowname'),
				currentSectionIndex = 0;

			if (!currentSection) {
				onePageNav.find('li').removeClass('selected');
			}

			if (onePageNav.is(':visible') && currentSection) {
				onePageNav.find('li').removeClass('selected');
				onePageNav.find('li a[data-title="'+currentSection+'"]').parent().addClass('selected');
				currentSectionIndex = onePageNav.find('li a[data-title="'+currentSection+'"]').parent().index() + 1;
			}

			if (currentSectionIndex > 0) {
				jQuery('.opn-status .current').text(currentSectionIndex);
			}

			if (onePageNav.hasClass('opn-arrows')) {
				var current = onePageNav.find('.current').text(),
					total = onePageNav.find('.total').text();

				if (current === "1") {
					onePageNav.find('.opn-up').addClass('disabled');
				} else {
					onePageNav.find('.opn-up').removeClass('disabled');
				}

				if (current === total) {
					onePageNav.find('.opn-down').addClass('disabled');
				} else {
					onePageNav.find('.opn-down').removeClass('disabled');
				}
			}
		},
		sidebarProgressMenu: function() {
			var progressMenu = jQuery('#sidebar-progress-menu'),
				progressMenuItems = "",
				pageSectionCount = 0,
				mainContent = jQuery('.page-content');

			mainContent.find('section.row-has-id').each(function() {
				var linkID = jQuery(this).attr('id'),
					linkName = jQuery(this).data('rowname');

				if (linkID && linkName.length > 0 && jQuery(this).height() > 0) {
					progressMenuItems += '<li><a href="#'+linkID+'" data-title="'+linkName+'"><span class="name">'+linkName+'</span><span class="progress"></span></li>';
					pageSectionCount++;
				}
			});

			if (pageSectionCount > 0) {
				if (progressMenu.find('ul').length === 0) {
					progressMenu.append('<ul>'+progressMenuItems+'</ul>');
				}
													
				// bind corresponding events
				$window.on('scroll', SWIFT.page.spmCheckRead);
				$window.on('scroll', SWIFT.page.spmCheckSidebar);
				$window.on('resize', SWIFT.page.spmResetScroll);
		
				SWIFT.page.spmUpdateSection();
				SWIFT.page.spmUpdateSidebarPosition();
		
				progressMenu.on('click', 'a', function(event){
					event.preventDefault();
					var selectedArticle = jQuery( jQuery(this).attr('href') ),
						selectedArticleTop = selectedArticle.offset().top,
						adjustment = SWIFT.offset;
					
					selectedArticleTop -= adjustment + 20;
		
					$window.off('scroll', SWIFT.page.spmCheckRead);
		
					jQuery('body,html').animate(
						{'scrollTop': selectedArticleTop + 2}, 
						300, function(){
							SWIFT.page.spmCheckRead();
							$window.on('scroll', SWIFT.page.spmCheckRead);
						}
					); 
			    });
			}
		},
		spmUpdateSection: function() {
			var mainContent = jQuery('.page-content'),
				sections = mainContent.find('section.row-has-id'),
				sectionsCount = sections.length,
				adjustment = 20 + SWIFT.offset,
				scrollTop = $window.scrollTop() + adjustment,
				progressMenu = jQuery('#sidebar-progress-menu'),
				progressMenuSections = progressMenu.find('li');
				
				sections.each(function(index) {
					var article = jQuery(this),
						articleID = article.attr('id'),
						articleTop = article.offset().top,
						articleHeight = article.outerHeight(),
						articleSidebarLink = progressMenuSections.find('a[href="#' + articleID + '"]').parent();
					
					if ( index == sectionsCount - 1 ) {
						articleHeight = articleHeight - $window.height() + adjustment;
					}
					
					if ( articleTop > scrollTop ) {
						articleSidebarLink.removeClass('read reading');
						articleSidebarLink.find('.progress').css('width', 0);
					} else if ( scrollTop >= articleTop && articleTop + articleHeight > scrollTop) {
						var progressValue = 100 *( (scrollTop - articleTop)/articleHeight);
						articleSidebarLink.addClass('reading').removeClass('read').find('.progress').css('width', progressValue + '%');
						//SWIFT.page.spmChangeURL(articleSidebarLink.find('a').attr('href'));
					} else {
						articleSidebarLink.removeClass('reading').addClass('read');
					}
				});
				SWIFT.isScrolling = false;
		},
		spmChangeURL: function(link) {
			var pageArray = location.pathname.split('/'),
			    actualPage = pageArray[pageArray.length - 1];
			if ( actualPage != link && history.pushState ) window.history.pushState({path: link},'',link);
		},
		spmCheckRead: function() {
			if ( !SWIFT.isScrolling ) {
				SWIFT.isScrolling = true;
				if (!window.requestAnimationFrame) {
					setTimeout(SWIFT.page.spmUpdateSection, 300);
				} else {
					window.requestAnimationFrame(SWIFT.page.spmUpdateSection);
				}
			}
		},
		spmCheckSidebar: function() {
			if ( !SWIFT.sidebarAnimation ) {
				SWIFT.sidebarAnimation = true;
				if (!window.requestAnimationFrame) {
					setTimeout(SWIFT.page.spmUpdateSidebarPosition, 300);
				} else {
					window.requestAnimationFrame(SWIFT.page.spmUpdateSidebarPosition);
				}
			}
		},
		spmUpdateSidebarPosition: function() {
			var progressMenu = jQuery('#sidebar-progress-menu'),
				pageWrapper = jQuery('.page-content'),
				pageWrapperTop = pageWrapper.offset().top,
				pageWrapperHeight = pageWrapper.outerHeight(),
				pageWrapperBottom = pageWrapperTop + pageWrapperHeight,
				scrollTop = $window.scrollTop(),
				sidebarOffset = progressMenu.parent().offset().left,
				sidebarWidth = jQuery('aside.sidebar').outerWidth(),
				offset = 40 + SWIFT.offset,
				windowHeight = $window.height();
				
			scrollTop += offset;
			
			if ( scrollTop < pageWrapperTop ) {
				progressMenu.removeClass('fixed').attr('style', '');
			} else if ( scrollTop >= pageWrapperTop && scrollTop < pageWrapperBottom - windowHeight + offset ) {
				progressMenu.addClass('fixed').attr('style', 'left: '+sidebarOffset+'px;top: '+offset+'px;width: '+sidebarWidth+'px;');
			} else {
				if ( progressMenu.hasClass('fixed') ) progressMenu.removeClass('fixed').css( 'top', pageWrapperHeight - windowHeight + offset + 'px' ).css( 'left', '' );
			}
			SWIFT.sidebarAnimation =  false;
		},
		spmResetScroll: function() {
			if ( !SWIFT.isResizing ) {
				SWIFT.isResizing = true;
				if (!window.requestAnimationFrame) {
					setTimeout( function() {
						SWIFT.isResizing = false;
					}, 300);
				} else {
					window.requestAnimationFrame( function() {
						SWIFT.isResizing = false;
					});
				}
			}
		},
		heroContentSplit: function() {

			var mainContainer = jQuery('#main-container');

			// RESIZE
			SWIFT.page.heroContentSplitResize();
			$window.smartresize( function() {
				SWIFT.page.heroContentSplitResize();
			});

			// ANIMATE IN
			mainContainer.animate({
				'opacity': 1
			}, 600, "easeOutExpo");

		},
		heroContentSplitResize: function() {
			var mainContainer = jQuery('#main-container'),
				windowHeight = $window.height(),
				headerHeight = SWIFT.offset;

			if ($window.width() > 991) {
				mainContainer.css('height', windowHeight - headerHeight);
				jQuery('.inner-container-wrap').css('min-height', windowHeight - headerHeight);
			}
		},
		shareCounts: function() {

			var shareCounts = jQuery('.sf-share-counts'),
				shareURL = shareCounts.data('url'),
				facebookCount = shareCounts.find('a.sf-share-fb'),
				pinterestCount = shareCounts.find('a.sf-share-pinterest'),
				linkedInCount = shareCounts.find('a.sf-share-linkedin'),
				googlePlusCount = shareCounts.find('a.sf-share-googleplus'),
				totalShareCount = 0;
			
			// Check share count total is visible
			var totalVisible = shareCounts.find('.share-text').is(":visible") ? true : false;
				
			// G+
			var gPlusCount = parseInt( googlePlusCount.find('.count').text(), 10);
			if ( jQuery.isNumeric(gPlusCount) ) {
				totalShareCount += gPlusCount;
			}
			if ( totalVisible ) {
				SWIFT.page.shareCountUpdateTotal(totalShareCount);
			}
			
			// Facebook
			if (facebookCount.length > 0) {
				jQuery.getJSON('https://graph.facebook.com/?id='+ shareURL +'&callback=?', function(data) {
					if (data.share !== undefined && data.share.share_count !== undefined && data.share.share_count !== null) {
						var fbCount = parseInt( data.share.share_count, 10 );
						facebookCount.find('.count').html(fbCount);
						totalShareCount += fbCount;
						if ( totalVisible ) {
							SWIFT.page.shareCountUpdateTotal(totalShareCount);
						}
					}
					facebookCount.find('.count').addClass('animate');
				});
			}

			// LinkedIn
			if (linkedInCount.length > 0) {
				jQuery.getJSON('https://www.linkedin.com/countserv/count/share?url='+shareURL+'&callback=?', function(data) {
					if (data.count !== undefined && data.count !== null) {
						var liCount = parseInt( data.count, 10 );
						linkedInCount.find('.count').html(liCount);
						totalShareCount += liCount;
						if ( totalVisible ) {
							SWIFT.page.shareCountUpdateTotal(totalShareCount);
						}
					}
					linkedInCount.find('.count').addClass('animate');
				});
			}

			// Pinterest
			if (pinterestCount.length > 0) {
				jQuery.getJSON('https://api.pinterest.com/v1/urls/count.json?url='+shareURL+'&callback=?', function(data) {
					if (data.count !== undefined && data.count !== null) {
						var pCount = parseInt( data.count, 10 );
						pinterestCount.find('.count').html(pCount);
						totalShareCount += pCount;
						if ( totalVisible ) {
							SWIFT.page.shareCountUpdateTotal(totalShareCount);
						}
					}
					pinterestCount.find('.count').addClass('animate');
				});
			}
			
			body.on('click', '.sf-share-link', function() {
				window.open(jQuery(this).attr('href'));
				return false;
			});
		},
		shareCountUpdateTotal: function(count) {
			var shareCounts = jQuery('.sf-share-counts'),
				totalDisplay = shareCounts.find('.total-count'),
				currentCount = parseInt(totalDisplay.text(), 10);
			
			if ( jQuery.isNumeric(count) && jQuery.isNumeric(currentCount) ) {
				totalDisplay.text(count);
			}
			
			if ( jQuery('.post-details .share-count').length > 0 ) {
				jQuery('.post-details .share-count').text(count);
			}
			
		},
		wooFormFix: function() {
			var username = sfOptionParams.data('username-placeholder'),
				usernameOrEmail = sfOptionParams.data('username-or-email-placeholder'),
				email = sfOptionParams.data('email-placeholder'),
				password = sfOptionParams.data('password-placeholder');
				
			jQuery('#user_login').attr('placeholder', username);
		    jQuery('#user_email').attr('placeholder', email);
		    jQuery('#user_pass').attr('placeholder', password);
		    jQuery('#username').attr('placeholder', usernameOrEmail);
		    jQuery('#password').attr('placeholder', password);
			
			jQuery('form.register #reg_email').attr('placeholder', usernameOrEmail);
			jQuery('form.register #reg_password').attr('placeholder', password);
			
		},
		trackOrderFormFix: function() {
			var orderID = sfOptionParams.data('order-id-placeholder'),
				billingEmail = sfOptionParams.data('billing-email-placeholder');
				
			jQuery('#orderid').attr('placeholder', orderID);
		    jQuery('#order_email').attr('placeholder', billingEmail);
		},
		postMediaTitle: function() {
			var detailsOverlay = jQuery('.details-overlay'),
				detailFeature = jQuery('.detail-feature'),
				featureHeight = detailsOverlay.height() + 80;

			if (body.hasClass('header-naked-light') || body.hasClass('header-naked-dark')) {
				detailFeature.css('padding-top', jQuery('.header-wrap').height() * 2);
			}

			detailFeature.css('height', featureHeight);
			setTimeout(function() {
				jQuery('.details-overlay').vCenter().stop().animate({
					'bottom': '50%',
					'opacity': 1
				}, 1500, "easeOutExpo");
			}, 500);

			$window.smartresize( function() {
				detailFeature.css('height', detailsOverlay.height() + 80);
				jQuery('.details-overlay').vCenter();
			});

		},
		portMediaTitle: function() {
			var detailsOverlay = jQuery('.details-overlay'),
				detailFeature = jQuery('.detail-feature');
			
			if (body.hasClass('header-naked-light') || body.hasClass('header-naked-dark')) {
				detailFeature.css('padding-top', jQuery('.header-wrap').height() * 2);
			}
			
			detailFeature.imagesLoaded(function() {			
				if ( detailsOverlay.height() + 80 > detailFeature.height() ) {
					detailFeature.css('height', detailsOverlay.height() + 80);
				}
			});

			$window.smartresize( function() {
				detailFeature.css( 'height', '' );
				if ( detailsOverlay.height() + 80 > detailFeature.height() ) {
					detailFeature.css('height', detailsOverlay.height() + 80);
				}
				jQuery('.details-overlay').vCenter();
			});

		},
		lightbox: function() {

			// Lightbox Social
			var lightboxSocial = {};
			if (lightboxSharing) {
				lightboxSocial = {
					facebook: {
						source: 'https://www.facebook.com/sharer/sharer.php?u={URL}',
						text: 'Share on Facebook'
					},
					twitter: true,
					googleplus: true,
					pinterest: {
						source: "https://pinterest.com/pin/create/button/?url={URL}&media={URL}",
						text: "Share on Pinterest"
					}
				};
			}

			// Lightbox Galleries
			var galleryArr = [];
			jQuery('[data-rel^="ilightbox["]').each(function () {
				var attr = this.getAttribute("data-rel");
				if ( jQuery(this).hasClass( 'ilightbox-enabled' ) ) {
					return;
				}
				if (jQuery.inArray(attr, galleryArr) == -1 ) {
					galleryArr.push(attr);
				}
			});
			jQuery.each(galleryArr, function (b, c) {
				jQuery('[data-rel="' + c + '"]').iLightBox({
					skin: lightboxSkin,
					social: {
						buttons: lightboxSocial
					},
					minScale: 0.1,
					maxScale: 0.8,
					path: 'horizontal',
					thumbnails: {
						maxWidth: 120,
						maxHeight: 120
					},
					controls: {
						arrows: lightboxControlArrows,
						thumbnail: lightboxThumbs
					}
				});
				jQuery('[data-rel="' + c + '"]').addClass( 'ilightbox-enabled' );
			});
		},
		backToTop: function() {
			var scrollPosition = $window.scrollTop();

			if (scrollPosition > 300) {
				jQuery('#back-to-top').stop().animate({
					'bottom': '20px'
				}, 300, "easeOutQuart");
			} else if (scrollPosition < 300) {
				jQuery('#back-to-top').stop().animate({
					'bottom': '-80px'
				}, 300, "easeInQuart");
			}
		},
		newsletterSubBar: function() {
			var subBar = jQuery('#sf-newsletter-bar'),
				closedCookieName = 'newsletter-sub-bar-hidden';

			setTimeout(function() {
				if (jQuery.cookie(closedCookieName) != '1') {
					subBar.fadeIn(600);
				}
			}, 3000);

			jQuery('a.sub-close').on('click', '', function(e) {
				e.preventDefault();
				jQuery.cookie(closedCookieName, '1', { expires: 7 });
				subBar.fadeOut(600);
			});
		},
		getViewportHeight: function() {
			var height = "innerHeight" in window ? window.innerHeight: document.documentElement.offsetHeight;
			return height;
		},
		checkIE: function() {
			var undef,
				v = 3,
				div = document.createElement('div'),
				all = div.getElementsByTagName('i');

			while (
				div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
				all[0]
			);

			return v > 4 ? v : undef;
		},
		pageTransitions: function() {
			jQuery('a').on('click', function(e) {
				var linkElement = jQuery(this),
					link = linkElement.attr('href'),
					linkTarget = linkElement.attr('target');

				// Return if is tab click
				if (linkElement.data('toggle') === "tab" || linkElement.parent().parent().hasClass('tabs') || linkElement.parent('.ui-accordion-header').length > 0) {
					return e;
				}

				if (link.indexOf('#') === 0 && link.length > 1) {
					SWIFT.isScrolling = true;
					SWIFT.page.onePageNavGoTo(link);
					setTimeout(function() {
						SWIFT.isScrolling = false;
					}, 1000);
					e.preventDefault();
				} else if (link.indexOf('#') === 0 && link.length === 1) {
					return;
				} else if (linkTarget === '_blank' || link.indexOf('?') >= 0 || link.indexOf('.jpg') >= 0 || link.indexOf('.png') >= 0 || link.indexOf('mailto') >= 0 || e.ctrlKey || e.metaKey || link.indexOf('javascript') === 0 || link.indexOf('tel:') === 0) {
					return e;
				} else {
					if (body.hasClass('mobile-menu-open') || body.hasClass('mh-overlay-show') || body.hasClass('side-slideout-open') || linkElement.hasClass('cart-contents') ) {
						return;
					} else {
						SWIFT.page.fadePageOut(link);
						e.preventDefault();
					}
				}
			});
		},
		fadePageIn: function() {
			var preloadTime = 1000;

			if (jQuery('.parallax-window-height').length > 0) {
				preloadTime = 1200;
			}

			body.addClass('page-fading-in');
			jQuery('#site-loading').css('opacity', '0');

			setTimeout(function() {
				jQuery('#site-loading').css('display', 'none');
				body.removeClass('page-fading-in');
			}, preloadTime);
		},
		fadePageOut: function(link) {
			jQuery('#site-loading').css('display', 'block').transition({
				opacity: 1,
				delay: 200
			}, 600, "ease" );
			setTimeout(function() {
				window.location = link;
			}, 600);
		},
		mobileThumbLinkClick: function() {
			jQuery(document).on('click', '.animated-overlay > a', function(e) {
				var thisLink = jQuery(this);

				if ( thisLink.parent().hasClass('product-transition-fade') || thisLink.parent().hasClass('product-transition-zoom') ) {
					return e;
				}
				if (thisLink.hasClass('hovered')) {
					return e;
				} else {
					e.preventDefault();
					thisLink.addClass('hovered');
				}
			});
		},
		directorySubmit: function() {
			jQuery(document).on("click", '#sf_directory_calculate_coordinates', function(e) {
				e.preventDefault();
				var geocoder = new google.maps.Geocoder();

				geocoder.geocode( { 'address': jQuery('#sf_directory_address').val()}, function(results) {
					jQuery('#sf_directory_lat_coord').val(results[0].geometry.location.lat());
					jQuery('#sf_directory_lng_coord').val(results[0].geometry.location.lng());
				});

			});

			jQuery('#directory-submit').click(function(e) {

			if (jQuery('#sf_directory_address').val() === '' || jQuery('#sf_directory_lat_coord').val() === '' || jQuery('sf_directory_lng_coord').val() === '' || jQuery('#directory_title').val() === '' || jQuery('#directory_description').val() === '' || jQuery('#directory-cat').val() <= 0 || jQuery('#directory-loc').val() <= 0) {
					e.preventDefault();
					jQuery('.directory-error').show();
					jQuery('html, body').animate({ scrollTop: jQuery('.directory-error').offset().top-100}, 700);
					return false;
				}
				jQuery('#add-directory-entry').submit();
			});
		},
		mediaPlayer: function() {
			plyr.setup({
				html: ["<div class='player-controls'>",
				    "<span class='player-controls-left'>",
				        "<button type='button' data-player='play'>",
				            "<i class='sf-icon-play'></i>",
				            "<span class='sr-only'>Play</span>",
				        "</button>",
				        "<button type='button' data-player='pause'>",
				            "<i class='sf-icon-pause'></i>",
				            "<span class='sr-only'>Pause</span>",
				        "</button>",
				        "<div class='player-progress'>",
				            "<label for='seek{id}' class='sr-only'>Seek</label>",
				            "<input id='seek{id}' class='player-progress-seek' type='range' min='0' max='100' step='0.5' value='0' data-player='seek'>",
				            "<progress class='player-progress-played' max='100' value='0'>",
				                "<span>0</span>% played",
				            "</progress>",
				            "<progress class='player-progress-buffer' max='100' value='0'>",
				                "<span>0</span>% buffered",
				            "</progress>",
				        "</div>",
				    "</span>",
				    "<span class='player-controls-right'>",
				    	"<span class='player-time'>",
				    	    "<span class='sr-only'>Current time</span>",
				    	    "<span class='player-current-time'>00:00</span>",
				    	"</span>",
				    	"<span class='player-time'>",
				    	    "<span class='sr-only'>Duration</span>",
				    	    "<span class='player-duration'>00:00</span>",
				    	"</span>",
				    	"<div class='volume-wrap'>",
					    	"<div class='volume-float-wrap'><input id='volume{id}' class='player-volume' type='range' min='0' max='10' value='5' data-player='volume'></div>",   
					        "<button type='button' data-player='mute'>",				        	
					            "<div class='icon-muted'><i class='sf-icon-volume'></i></div>",
					            "<div><i class='sf-icon-volume'></i></div>",
					            "<span class='sr-only'>Toggle Mute</span>",
					        "</button>",
					    "</div>",
				        "<label for='volume{id}' class='sr-only'>Volume</label>",
				        "<button type='button' data-player='fullscreen'>",
				            "<div class='icon-exit-fullscreen'><i class='sf-icon-enlarge'></i></div>",
				            "<div><i class='sf-icon-enlarge'></i></div>",
				            "<span class='sr-only'>Toggle Fullscreen</span>",
				        "</button>",
				    "</span>",
				"</div>"].join("\n"),
				onSetup: function() {
				
					if(!("media" in this)) {
						return;
					}
							
//					var player 	= this,
//						duration = player.media.duration,
//						id		= player.media.parentNode.getAttribute('id'),
//						secs 	= 0,
//						mins	= 0,
//						hours	= 0;
//					
//					console.log(player.media);
//					
//					secs = parseInt(duration % 60);
//		            mins = parseInt((duration / 60) % 60);
//		            hours = parseInt(((duration / 60) / 60) % 60);
//		
//		            // Do we need to display hours?
//		            var displayHours = (parseInt(((duration / 60) / 60) % 60) > 0);
//		            
//		            // Ensure it's two digits. For example, 03 rather than 3.
//		            secs = ('0' + secs).slice(-2);
//		            mins = ('0' + mins).slice(-2);
//		
//		            // Render
//		            var displayTime = (displayHours ? hours + ':' : '') + mins + ':' + secs;
//											
//					// Update audio duration display
//					jQuery('#'+id).parents('figure').find('.audio-duration').text(displayTime);
				}
			});
		}
	};


	/////////////////////////////////////////////
	// SUPER SEARCH
	/////////////////////////////////////////////

	SWIFT.superSearch = {
		init: function() {

			jQuery('.search-options .ss-dropdown').on('click', function(e) {
				e.preventDefault();

				var option = jQuery(this),
					dropdown = option.find( 'ul' );

				if (isMobileAlt) {
					if (dropdown.hasClass('show-dropdown')) {
						setTimeout(function() {
							dropdown.removeClass('show-dropdown');
						}, 100);
					} else {
						dropdown.addClass('show-dropdown');
					}
				} else {
					if (dropdown.hasClass('show-dropdown')) {
						setTimeout(function() {
							dropdown.removeClass('show-dropdown');
						}, 100);
					} else {
						dropdown.addClass('show-dropdown');
					}
				}
			});

			jQuery('.ss-option').on('click', function(e) {
				e.preventDefault();

				var thisOption = jQuery(this),
					selectedOption = thisOption.attr('data-attr_value'),
					parentOption = thisOption.parent().parent().parent();

				parentOption.find('li').removeClass('selected');
				thisOption.parent().addClass('selected');

				parentOption.attr('data-attr_value', selectedOption);
				parentOption.find('span').text(thisOption.text());

				setTimeout(function() {
					thisOption.parents('ul').first().removeClass('show-dropdown');
				}, 100);
			});

			jQuery('.super-search-go').on('click', function(e) {
				e.preventDefault();
				var parentSearch = jQuery(this).parents('.sf-super-search'),
					filterURL = SWIFT.superSearch.urlBuilder(parentSearch),
					homeURL = jQuery(this).attr('data-home_url'),
					shopURL = jQuery(this).attr('data-shop_url');

				if (filterURL.indexOf("product_cat") >= 0) {
				location.href = homeURL + filterURL;
				} else {
				location.href = shopURL + filterURL;
				}

			});
		},
		urlBuilder: function(searchInstance) {

			var queryString = "";

			jQuery(searchInstance).find('.search-options .ss-dropdown').each(function() {

				var attr = jQuery(this).attr('id');
				var attrValue = jQuery(this).attr('data-attr_value');
				if (attrValue !== "") {
					if (attr === "product_cat") {
						if (queryString === "") {
							queryString += "?product_cat=" + attrValue;
						} else {
							queryString += "&product_cat=" + attrValue;
						}
					} else {
						if (queryString === "") {
						queryString += "?filter_" + attr + "=" + attrValue;
						} else {
						queryString += "&filter_" + attr + "=" + attrValue;
						}
					}
				}
			});

			jQuery('.search-options input').each(function() {
				var attr = jQuery(this).attr('name');
				var attrValue = jQuery(this).attr('value');
				if (queryString === "") {
					queryString += "?"+ attr + "=" + attrValue;
				} else {
					queryString += "&" + attr + "=" + attrValue;
				}
			});

			return queryString;
		}
	};


	/////////////////////////////////////////////
	// HEADER
	/////////////////////////////////////////////

	SWIFT.header = {
		init: function() {
		
			// LOGO HOVER
			SWIFT.header.logoHoverInit();

			// STICKY HEADER
			if (body.hasClass('sticky-header-enabled') && !body.hasClass('vertical-header')) {
				SWIFT.header.stickyHeaderInit();
			}

			// STICKY TOP BAR
			if ( jQuery('.sticky-top-bar').length > 0 ) {
				SWIFT.header.stickyTopBarInit();
			}
			
			jQuery('.aux-item .wcml_currency_switcher').on('click', 'li', function() {
				jQuery(this).parents('.currency-switch-item').find('.current-currency').transition({
					opacity: 0
				}, 400);
				jQuery(this).parents('.currency-switch-item').find('.sf-svg-loader').transition({
					opacity: 1
				}, 400);
			});

			// FS OVERLAY CLOSE
			jQuery('a.fs-overlay-close').on('click', function(e) {
				e.preventDefault();

				if (body.hasClass('overlay-menu-open')) {
					SWIFT.header.overlayMenuToggle();
				}
				if (body.hasClass('fs-supersearch-open')) {
					SWIFT.header.fsSuperSearchToggle();
				}
			});

			// FULLSCREEN SUPERSEARCH
			jQuery('a.fs-supersearch-link').on('click', function(e) {
				e.preventDefault();

				if (body.hasClass('overlay-menu-open')) {
					SWIFT.header.overlayMenuToggle();
				}

				SWIFT.header.fsSuperSearchToggle();
			});


			// OVERLAY MENU
			jQuery('a.overlay-menu-link').on('click', function(e) {
				e.preventDefault();
				SWIFT.header.overlayMenuToggle();

				if (body.hasClass('fs-supersearch-open')) {
					SWIFT.header.fsSuperSearchToggle();
				}
			});
			
			// Overlay Menu parent click
			jQuery('#overlay-menu li.menu-item > a').on('click', function(e) {
				var parentMenuItem = jQuery(this).parent(),
					linkHref = jQuery(this).attr('href'),
					subMenu = parentMenuItem.find('ul.sub-menu').first();

				if (!parentMenuItem.hasClass('parent')) {
					SWIFT.header.overlayMenuToggle();

					if (linkHref.indexOf('#') === 0 && linkHref.length > 1) {
						SWIFT.isScrolling = true;
						SWIFT.page.onePageNavGoTo(linkHref);
						setTimeout(function() {
							SWIFT.isScrolling = false;
						}, 1000);
						e.preventDefault();
					} else if (body.hasClass('page-transitions')) {
						SWIFT.page.fadePageOut(linkHref);
					}

					return e;
				}

				if (parentMenuItem.hasClass('sub-menu-open')) {
					if (linkHref.indexOf('http') === 0 || linkHref.indexOf('/') === 0) {
						return e;
					} else {
						parentMenuItem.removeClass('sub-menu-open');
						subMenu.slideUp();
						e.preventDefault();
					}
				} else {
					parentMenuItem.addClass('sub-menu-open');
					subMenu.slideDown();
					e.preventDefault();
				}
			});

			// SIDE SLIDEOUT MENU
			jQuery('a.side-slideout-link').on('click', function(e) {
				e.preventDefault();
				SWIFT.nav.showSideSlideout(jQuery(this).data('side'));
			});
			$window.smartresize( function() {
				var windowWidth = $window.width();

				if (windowWidth < 1024 && body.hasClass('mhs-tablet-land') && body.hasClass('side-slideout-open')) {
					SWIFT.nav.sideSlideoutHideTrigger();
				} else if (windowWidth < 991 && body.hasClass('mhs-tablet-port') && body.hasClass('side-slideout-open')) {
					SWIFT.nav.sideSlideoutHideTrigger();
				} else if (windowWidth < 767 && body.hasClass('mhs-mobile') && body.hasClass('side-slideout-open')) {
					SWIFT.nav.sideSlideoutHideTrigger();
				}

			});


			// STANDARD SEARCH
			jQuery('.header-search-link-alt').on('click', function(e) {
				e.preventDefault();

				var searchLink = jQuery(this),
					headerSearchWrap = searchLink.parent().find('.header-search-wrap');

				if (headerSearchWrap.is(':visible')) {
					headerSearchWrap.fadeOut(300);
					searchLink.removeClass('search-open');
				} else {
					headerSearchWrap.fadeIn(300);
					searchLink.addClass('search-open');
				}

			});
			
			// FULL HEADER SEARCH
			jQuery('.fs-header-search-link').on('click', function(e) {
				e.preventDefault();
				body.toggleClass('sf-header-search-is-open');
				if ( body.hasClass('sf-header-search-is-open') ) {
					setTimeout(function() {
						jQuery('#sf-full-header-search').find('input').focus();
						jQuery('#sf-full-header-search-backdrop').on('click touchstart', function() {
							jQuery('#sf-full-header-search').find('input').blur();
							body.removeClass('sf-header-search-is-open');
							jQuery('#sf-full-header-search-backdrop').off('click touchstart');
						});
					}, 500);
				} else {
					jQuery('#container').off('click touchstart');
				}
			});
			jQuery('.sf-fhs-close').on('click', function(e) {
				e.preventDefault();
				body.removeClass('sf-header-search-is-open');
				jQuery('#sf-full-header-search-backdrop').off('click touchstart');
			});
			

			// CONTACT SLIDEOUT
			jQuery('a.contact-menu-link').on('click', function(e) {
				e.preventDefault();
				var contactSlideout = jQuery('#contact-slideout'),
					thisLink = jQuery(this);
				
				if ( body.scrollTop() > 0 ) {
					jQuery('body,html').animate({scrollTop: 0}, 600, 'easeOutCubic');
					setTimeout(function() {
						contactSlideout.slideToggle(800, 'easeInOutExpo');
						if (thisLink.hasClass('slide-open')) {
							thisLink.removeClass('slide-open');
						} else {
							SWIFT.map.init();
							thisLink.addClass('slide-open');
						}
					}, 800);
				} else {
					contactSlideout.slideToggle(800, 'easeInOutExpo');
					if (thisLink.hasClass('slide-open')) {
						thisLink.removeClass('slide-open');
					} else {
						SWIFT.map.init();
						thisLink.addClass('slide-open');
					}
				}
			});

			// MOBILE STICKY HEADER
			if (body.hasClass('mh-sticky')) {

				if (isMobileAlt) {
					jQuery('html').addClass('has-mh-sticky');
				}

				var mobileHeader = jQuery('#mobile-header'),
					spacing = 0;

				mobileHeader.sticky({
					topSpacing: spacing,
					isMobile: true
				});

				jQuery('#mobile-header-sticky-wrapper').css('height', mobileHeader.outerHeight(true));

				$window.smartresize( function() {
					mobileHeader.sticky('update');
					jQuery('#mobile-header-sticky-wrapper').css('height', mobileHeader.outerHeight(true));
				});
			}


			// VERTICAL HEADER RIGHT POSITIONING
			if (body.hasClass('layout-boxed') && body.hasClass('vertical-header-right')) {

				var rightOffset = ($window.width() - jQuery('#container').width()) / 2;
				jQuery('.header-wrap').css('right', rightOffset);

				$window.smartresize( function() {
					var rightOffset = ($window.width() - jQuery('#container').width()) / 2;
					jQuery('.header-wrap').css('right', rightOffset);
				});
			}
		},
		logoHoverInit: function() {
			var logo = jQuery('#logo'),
				animation = logo.data('anim');
				
			if ( animation === "" ) {
				return;
			}

			jQuery(document).on("mouseenter", "#logo", function() {
				logo.addClass('sf-animate ' + animation);
			}).on("mouseleave", "#logo", function() {
				logo.removeClass('sf-animate ' + animation);
			});
		},
		stickyHeaderInit: function() {
			var spacing = 0,
				offset = 0,
				stickyHeader = jQuery('.sticky-header'),
				headerWrap = jQuery('.header-wrap');

			if (jQuery('#wpadminbar').length > 0) {
				spacing = jQuery('#wpadminbar').outerHeight();
				offset = jQuery('#wpadminbar').outerHeight();
			}

			if ( jQuery('.sticky-top-bar').length > 0 ) {
				offset += jQuery('.sticky-top-bar').outerHeight();
			}
			
			if ( jQuery('#top-bar').length > 0 ) {
				spacing += jQuery('#top-bar').outerHeight();
			}
			
			if ( body.hasClass('app-header') ) {
				jQuery('.sticky-header').css('position', 'fixed').css('top', spacing);
				jQuery('.sticky-header').wrap('<div class="sticky-wrapper"></div>');
			} else {
				
				if ( headerWrap.hasClass('full-header-stick') && !body.hasClass('header-below-slider') && jQuery('#top-bar').length <= 0 ) {
					stickyHeader.css('position', 'fixed').css('top', spacing);
				}
				
				stickyHeader.sticky({
					topSpacing: offset
				});
				
				stickyHeader.on('sticky-start', function() {
					if ( !body.hasClass('app-header') && !body.hasClass('sticky-header-transparent') ) {
						stickyHeader.parent().addClass('default-state');
					}
				});
				stickyHeader.on('sticky-end', function() {
					stickyHeader.parent().removeClass('default-state');
				});
	
				$window.smartresize( function() {
					stickyHeader.sticky('update');
				});
			
			}

			if ( body.hasClass('layout-boxed') ) {
				jQuery('.sticky-header').css('max-width', headerWrap.width());
				$window.smartresize( function() {
					jQuery('.sticky-header').css('max-width', headerWrap.width());
				});
			}
			

			// Sticky Header Resizing
			if (body.hasClass('sh-dynamic')) {
				var defaultHeaderPos = headerWrap.offset().top;
				$window.scroll(function () {
					defaultHeaderPos = headerWrap.offset().top - $window.scrollTop();
					if (jQuery('.sticky-wrapper').hasClass('is-sticky') && defaultHeaderPos < -160) {
						headerWrap.addClass('resized-header');
					} else if (headerWrap.hasClass('resized-header')) {
						headerWrap.removeClass('resized-header');
					}

				});
			}

			// Sticky Header Hiding
			if (body.hasClass('sh-show-hide')) {
				var lastTop = 0;

				$window.scroll( function() {
					var currentTop = jQuery(this).scrollTop();
					var headerHide = 800;
					var sliderHeight = 0;
				   
					if ( jQuery('#container > .swift-slider-outer').length > 0 ) {
						var slider = jQuery('#container > .swift-slider-outer'),
							sliderTop = slider.offset().top;
						sliderHeight = slider.height();
						headerHide = sliderTop + sliderHeight + 100;
					} else if ( jQuery('#container > .home-slider-wrap').length > 0 ) {
						var contentTop = jQuery('#main-container').offset().top;
						sliderHeight = jQuery('#container > .home-slider-wrap').height();
						headerHide = contentTop + sliderHeight + 100;
					}
										
					if (currentTop > lastTop && currentTop > headerHide) {
						
						if ( body.hasClass('fs-supersearch-open') || body.hasClass('overlay-menu-open') || body.hasClass('fs-search-open') ) {
							return;
						}
						
						jQuery('.sticky-header').addClass('sticky-header-hide');
					} else if (jQuery('.sticky-header').hasClass('sticky-header-hide')) {
					   jQuery('.sticky-header').removeClass('sticky-header-hide');
					}
					lastTop = currentTop;
				});
			}
		},
		stickyTopBarInit: function() {
			var spacing = 0,
				stickyTB = jQuery('.sticky-top-bar'),
				headerWrap = jQuery('.header-wrap');

			if (jQuery('#wpadminbar').length > 0) {
				spacing = 32;
			}

			stickyTB.sticky({
				topSpacing: spacing
			});

			$window.smartresize( function() {
				stickyTB.sticky('update');
			});

			if (body.hasClass('layout-boxed')) {
				stickyTB.css('max-width', headerWrap.width());
				$window.smartresize( function() {
					stickyTB.css('max-width', headerWrap.width());
				});
			}
		},
		fsSuperSearchToggle: function() {
			if (body.hasClass('fs-supersearch-open')) {
				body.removeClass('fs-supersearch-open');
				body.removeClass('fs-aux-open');
				body.addClass('fs-supersearch-closing');
				setTimeout(function() {
					jQuery('#main-nav,#main-navigation').fadeIn(400);
				}, 200);
			} else {
				setTimeout(function() {
					body.removeClass('fs-supersearch-closing');
					body.addClass('fs-supersearch-open');
					body.addClass('fs-aux-open');
					jQuery('#main-nav,#main-navigation').fadeOut(300);
				}, 30);
			}
		},
		overlayMenuToggle: function() {
			var overlayMenu = jQuery('#overlay-menu'),
				overlayMenuItemHeight = Math.floor(overlayMenu.find('nav ul.menu').height() / overlayMenu.find('ul.menu > li.menu-item').length) - 5,
				overlayMenuItemFS = Math.floor(overlayMenuItemHeight * 0.5);

			// Set limits
			if ( overlayMenuItemFS > 60 ) {
				overlayMenuItemFS = 60;
			}
			if ( overlayMenuItemHeight > 120 ) {
				overlayMenuItemHeight = 120;
			}
	
			// Apply styles
			overlayMenu.find('ul.menu > li.menu-item > a').css('font-size', overlayMenuItemFS + 'px').css('line-height', overlayMenuItemHeight - 20 + 'px');

			if (body.hasClass('overlay-menu-open')) {
				body.removeClass('overlay-menu-open');
				body.removeClass('fs-aux-open');
				body.addClass('overlay-menu-closing');
				setTimeout(function() {
					if (!body.hasClass('fs-search-open')) {
						jQuery('#main-nav,#main-navigation').fadeIn(400);
						if ( jQuery('.split-menu').length > 0 ) {
							jQuery('.split-menu').css('pointer-events', '');
							jQuery('.split-menu').transition({
								opacity: 1
							}, 400);
						}
					}
					body.removeClass('overlay-menu-closing');
				}, 200);
			} else {
				setTimeout(function() {
					body.removeClass('overlay-menu-closing');
					body.addClass('overlay-menu-open');
					body.addClass('fs-aux-open');
					jQuery('#main-nav,#main-navigation').fadeOut(300);
					if ( jQuery('.split-menu').length > 0 ) {
						jQuery('.split-menu').css('pointer-events', 'none');
						jQuery('.split-menu').transition({
							opacity: 0
						}, 400);
					}
				}, 30);
			}
		}
	};


	/////////////////////////////////////////////
	// NAVIGATION
	/////////////////////////////////////////////

	SWIFT.nav = {
		init: function() {

			// Set up Main Menu
			if (!isMobile || $window.width() > 768) {
				SWIFT.nav.mainMenu();
			}
					
			// Set up Mega Menu
			if ( jQuery('.mega-menu-wrap').length > 0 && body.hasClass('mm-default-theme') ) {
				SWIFT.nav.megaMenu();
			}
			
			// Set up Mobile Menu
			SWIFT.nav.mobileMenuInit();

			// Add main menu actions
			SWIFT.nav.mainMenuActions();

			// Side Slidout
			if ( jQuery('.sf-side-slideout').length > 0 ) {
				SWIFT.nav.sideSlideoutInit();
			}
			
			// Push Nav
			if ( jQuery('.sf-pushnav').length > 0 ) {
				SWIFT.nav.pushNavInit();
			}
			
			// Mega Menu plugin modifications
			if ( body.hasClass('mm-default-theme') ) {
				jQuery('li.mega-menu-megamenu > ul.mega-sub-menu').each( function() {
					jQuery(this).wrapInner('<section class="container"></section>');
				});
			}
		},
		mainMenu: function() {

			var mainNav = jQuery("#main-navigation");

			if (jQuery('.header-wrap').hasClass('full-center')) {
				mainNav.find('li.sf-mega-menu > ul.sub-menu').each(function() {
					var thisSubMenu = jQuery(this);

					if (!thisSubMenu.children().first().hasClass('container')) {
						jQuery(this).wrapInner('<div class="container"></div>');
					}
				});
			}

			mainNav.find(".menu li.menu-item").hoverIntent({
				over: function() {
					if (jQuery('#container').width() > 767 || body.hasClass('responsive-fixed')) {
						jQuery(this).find('ul.sub-menu,.mega-menu-sub').first().fadeIn(200);
					}
				},
				out:function() {
					if (jQuery('#container').width() > 767 || body.hasClass('responsive-fixed')) {
						jQuery(this).find('ul.sub-menu,.mega-menu-sub').first().fadeOut(150);
					}
				},
				timeout: 0
			});

			// Set sub-menu position based on menu height
			var mainNavHeight = mainNav.height(),
				subMenu = mainNav.find('.sub-menu');

			subMenu.each(function() {
				jQuery(this).css('top', mainNavHeight);
			});
		},
		megaMenu: function() {
			var megaMenuWrap = jQuery('.mega-menu-wrap'),
				megaMenu = megaMenuWrap.find('.mega-menu');
				//megaMenuEvent = megaMenu.data('event'),
				//megaMenuEffect = megaMenu.data('effect'),
				//megaMenuSecondClick = megaMenu.data('second-click'),
				//megaMenuDocumentClick = megaMenu.data('document-click');
			
			// Remove no-js class
			megaMenu.removeClass('mega-no-js');
			
			// Hover/Click event handling
			//if ( megaMenuEvent === "hover" ) {
				// Enable hover dropdowns for window size above tablet width
				jQuery("nav.std-menu ul.mega-menu").find("li.mega-menu-item-has-children").hoverIntent({
					over: function() {
						var isSideSlideout = jQuery(this).parents('.sf-side-slideout').length > 0;
						if ((jQuery('#container').width() > 767 || body.hasClass('responsive-fixed')) && !isSideSlideout) {
							jQuery(this).find('ul.mega-sub-menu').first().stop( true, true ).fadeIn(200);
						}
					},
					out:function() {
						var isSideSlideout = jQuery(this).parents('.sf-side-slideout').length > 0;
						if ((jQuery('#container').width() > 767 || body.hasClass('responsive-fixed')) && !isSideSlideout) {
							jQuery(this).find('ul.mega-sub-menu').first().stop( true, true ).fadeOut(150);
						}
					},
					timeout: 100
				});
			//}
		},
		megaMenuShowSub: function(anchor) {
			var isSideSlideout = anchor.parents('.sf-side-slideout').length > 0;
			if ((jQuery('#container').width() > 767 || body.hasClass('responsive-fixed')) && !isSideSlideout) {
				anchor.find('ul.mega-sub-menu').first().stop( true, true ).fadeIn(200);
			}
		},
		megaMenuHideSub: function(anchor, immediate) {
			anchor.siblings('.mega-sub-menu').children('.mega-toggle-on').removeClass('mega-toggle-on');

            if (immediate) {
                anchor.siblings('.mega-sub-menu').removeClass('mega-toggle-on').css('display', '');
                anchor.parent().removeClass('mega-toggle-on').triggerHandler("close_panel");
                return;
            }
		},
		mainMenuActions: function() {
		
			SWIFT.nav.menuItemClickHandler(false);
			
			jQuery(".mega-menu").on("after_mega_menu_init", function() {
			    SWIFT.nav.menuItemClickHandler(true);
			});
			
			// Add parent class to items with sub-menus
			jQuery("ul.sub-menu").parents('li').addClass('parent');

			// Menu parent click function
			jQuery('.menu li.parent > a').on('click', function(e) {

				if (jQuery('#container').width() < 1024 || body.hasClass('standard-browser')) {
					return e;
				}

				var directDropdown = jQuery(this).parent().find('ul.sub-menu').first();

				if (directDropdown.css('opacity') === '1' || directDropdown.css('opacity') === 1) {
					return e;
				} else {
					e.preventDefault();
				}
			});

			// Set Standard Sub Menu Top Position
			jQuery("nav.std-menu").find(".menu li").each(function() {
				var top = jQuery(this).outerHeight();
				jQuery(this).find('ul.sub-menu').first().css('top', top);
			});

			// Enable hover dropdowns for window size above tablet width
			jQuery("nav.std-menu").find(".menu li.parent").hoverIntent({
				over: function() {
					var isSideSlideout = jQuery(this).parents('.sf-side-slideout').length > 0;
					if ((jQuery('#container').width() > 767 || body.hasClass('responsive-fixed')) && !isSideSlideout) {
						jQuery(this).find('ul.sub-menu').first().stop( true, true ).fadeIn(200);
					}
				},
				out:function() {
					var isSideSlideout = jQuery(this).parents('.sf-side-slideout').length > 0;
					if ((jQuery('#container').width() > 767 || body.hasClass('responsive-fixed')) && !isSideSlideout) {
						jQuery(this).find('.sub-menu').first().stop( true, true ).fadeOut(150);
					}
				},
				timeout: 100
			});


			// Shopping bag hover function
			jQuery(document).on("mouseenter", "li.shopping-bag-item", function() {

				if ( jQuery(this).parents('#mobile-menu-wrap').length > 0 || jQuery(this).parents('#mobile-cart-wrap').length > 0 ) {
					return;
				}

				if (jQuery('#container').width() > 767 || body.hasClass('responsive-fixed')) {
					jQuery(this).find('ul.sub-menu').first().stop( true, true ).fadeIn(200);
					shopBagHovered = true;
				}
			}).on("mouseleave", "li.shopping-bag-item", function() {

				if ( jQuery(this).parents('#mobile-menu-wrap').length > 0 || jQuery(this).parents('#mobile-cart-wrap').length > 0 ) {
					return;
				}

				if (jQuery('#container').width() > 767 || body.hasClass('responsive-fixed')) {
					jQuery(this).find('ul.sub-menu').first().stop( true, true ).fadeOut(150);
					shopBagHovered = false;
				}
			});


			// Set current language to top bar item
			var currentLanguage = jQuery('.aux-language').find('.current-language').html();
			if (currentLanguage !== "") {
				jQuery('.aux-language .language-item > a').html(currentLanguage);
			}
			jQuery('.aux-language .language-item > a').animate({
				'opacity': 1
			}, 400, 'easeOutQuart');
			var currentLanguageText = jQuery('.aux-language-text').find('.current-language').html();
			if (currentLanguageText !== "") {
				jQuery('.aux-language-text .language-item > a').html(currentLanguageText);
			}
			jQuery('.aux-language-text .language-item > a').animate({
				'opacity': 1
			}, 400, 'easeOutQuart');		
	
			// Set menu state on resize
			$window.smartresize( function() {
				if (jQuery('#container').width() > 767 || body.hasClass('responsive-fixed')) {
					var menus = jQuery('nav').find('ul.menu');
					menus.each(function() {
						jQuery(this).css("display", "");
					});
				}
			});

			// Change menu active when scroll through sections
			SWIFT.nav.currentScrollIndication();
			$window.scroll(function () {
				SWIFT.nav.currentScrollIndication();
			});
		},
		menuItemClickHandler: function(megamenu) {
		
			var menuItemClass = '.menu-item';
			
			if ( megamenu ) {
				menuItemClass = '.mega-menu-item';
			}
			// Menu item click function
			jQuery(menuItemClass).on('click', 'a', function(e) {

				var menuItem = jQuery(this),
					linkHref = menuItem.attr('href'),
					isMobileMenuItem = false,
					isSlideoutItem = false,
					youtubeURL = linkHref.match(/watch\?v=([a-zA-Z0-9\-_]+)/),
					vimeoURL = linkHref.match(/^http:\/\/(www\.)?vimeo\.com\/(clip\:)?(\d+).*$/);


				if (jQuery(this).parents('nav').attr('id') === "mobile-menu") {
					isMobileMenuItem = true;
				}

				if ( jQuery(this).parents('.sf-side-slideout').length > 0 ) {
					isSlideoutItem = true;
				}

				// Link to full width video overlay if link is YouTube/Vimeo
				if (youtubeURL || vimeoURL) {

					var videoURL = "";

					if (youtubeURL) {
						videoURL = 'https://www.youtube.com/embed/'+ youtubeURL[1] +'?autoplay=1&amp;wmode=transparent';
					} else if (vimeoURL) {
						videoURL = 'https://player.vimeo.com/video/'+ vimeoURL[3] +'?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;wmode=transparent';
					}

					if (videoURL !== "") {
						jQuery(this).data('video', videoURL);
						SWIFT.widgets.openFullWidthVideo(jQuery(this));
					}
					e.preventDefault();
				// Smooth Scroll
				} else if (linkHref.indexOf('#') === 0 && linkHref.length > 1) {
					var headerHeight = 0;

					if (isMobileMenuItem) {
						SWIFT.nav.mobileMenuHideTrigger();
						setTimeout(function() {
							if (body.hasClass('mh-sticky')) {
								headerHeight = jQuery('#mobile-header').height();
							}
							if (jQuery('#wpadminbar').length > 0) {
								headerHeight = headerHeight + jQuery('#wpadminbar').height();
							}

							if (jQuery(linkHref).length > 0) {
								jQuery('html, body').stop().animate({
									scrollTop: jQuery(linkHref).offset().top - headerHeight + 2
								}, 1000, 'easeInOutExpo');
							}
						}, 400);
					} else {
						SWIFT.page.onePageNavGoTo(linkHref);
					}
					e.preventDefault();
				} else {
					if (isMobileMenuItem) {
						return;
					} else {
						return e;
					}
				}

			});
		},
		currentScrollIndication: function() {
			var adjustment = 0;

			if (body.hasClass('sticky-header-enabled')) {
				adjustment = jQuery('.header-wrap').height();
			}

			if ( jQuery('.sticky-top-bar').length > 0 ) {
				adjustment += jQuery('.sticky-top-bar').outerHeight();
			}

			var inview = jQuery('section.row:in-viewport('+adjustment+')').attr('id'),
				menuItems = jQuery('#main-navigation .menu li a, #main-navigation .mega-menu li a'),
				link;
				
			if ( inview !== "" && typeof inview !== 'undefined' ) {
				link = menuItems.filter('[href="#' + inview + '"]');
			}
			
			menuItems.parent().removeClass('current-scroll-item');
	
			if (typeof inview != 'undefined' && link.length > 0 && !link.hasClass('.current-scroll-item')) {
				menuItems.parent().removeClass('current-scroll-item');
				link.parent().addClass('current-scroll-item');
			}
		},
		mobileMenuInit: function() {

			// Mobile Logo click
			jQuery('#mobile-logo > a').on('click touchstart', function(e) {
				if (body.hasClass('mobile-menu-open') || body.hasClass('mobile-cart-open') || body.hasClass('mobile-menu-closing')) {
					return false;
				} else {
					return e;
				}
			});
			
			SWIFT.nav.setMobileCartPadding();

			// Mobile Nav show
			jQuery('.mobile-menu-link').on('click', function(e) {
				e.preventDefault();
				
				SWIFT.nav.setMobileCartPadding();
				
				if ( body.hasClass('mobile-cart-open') ) {
					SWIFT.nav.mobileMenuHideTrigger();
				}
				
				jQuery('.mobile-menu-link').toggleClass('is-active');
				
				if ( body.hasClass('mobile-menu-open') ) {
					SWIFT.nav.mobileMenuHideTrigger();
				} else if ( body.hasClass('mh-overlay') ) {
					SWIFT.nav.mobileHeaderOverlay('menu');
				} else {
					SWIFT.nav.showMobileMenu();
				}
			});

			// Mobile Cart show
			jQuery(document).on('click', '.cart-contents', function(e) {

				if ( jQuery(this).parents('.mobile-header-opts').length > 0 ) {
					e.preventDefault();
					
					SWIFT.nav.setMobileCartPadding();
					
					if ( body.hasClass('mobile-menu-open') ) {
						SWIFT.nav.mobileMenuHideTrigger();
					}
						
					if (body.hasClass('mobile-cart-open')) {
						SWIFT.nav.mobileMenuHideTrigger();
					} else if (body.hasClass('mh-overlay')) {
						SWIFT.nav.mobileHeaderOverlay('cart');
					} else {
						SWIFT.nav.showMobileCart();
					}
					
				} else {
					return e;
				}
			});

			// Mobile Menu parent click
			jQuery(document).on('click', '#mobile-menu li > a', function(e) {
				var parentMenuItem = jQuery(this).parent(),
					linkHref = jQuery(this).attr('href'),
					subMenu = parentMenuItem.find('ul.sub-menu').first();

				if (!parentMenuItem.hasClass('parent')) {
					SWIFT.nav.mobileMenuHideTrigger();

					if (linkHref.indexOf('#') === 0 && linkHref.length > 1) {
						SWIFT.isScrolling = true;
						SWIFT.page.onePageNavGoTo(linkHref);
						setTimeout(function() {
							SWIFT.isScrolling = false;
						}, 1000);
						e.preventDefault();
					} else if (body.hasClass('page-transitions')) {
						SWIFT.page.fadePageOut(linkHref);
					}

					return e;
				}

				if (parentMenuItem.hasClass('sub-menu-open')) {
					if (linkHref.indexOf('http') === 0 || linkHref.indexOf('/') === 0) {
						return e;
					} else {
						parentMenuItem.removeClass('sub-menu-open');
						subMenu.slideUp();
						e.preventDefault();
					}
				} else {
					parentMenuItem.addClass('sub-menu-open');
					subMenu.slideDown();
					e.preventDefault();
				}
			});


			// Swipe to hide mobile menu
			jQuery("#mobile-menu-wrap").swipe({
				swipeLeft:function() {
					if (!body.hasClass('mobile-header-center-logo-alt') && !body.hasClass('mobile-header-left-logo')) {
						SWIFT.nav.mobileMenuHideTrigger();
					}
				},
				swipeRight:function() {
					if (body.hasClass('mobile-header-center-logo-alt') || body.hasClass('mobile-header-left-logo')) {
						SWIFT.nav.mobileMenuHideTrigger();
					}
				},
			});

			// Swipe to hide mobile cart
			jQuery("#mobile-cart-wrap").swipe( {
				swipeLeft:function() {
					if (body.hasClass('mobile-header-center-logo-alt') || body.hasClass('mobile-header-right-logo') || body.hasClass('mobile-header-center-logo')) {
						SWIFT.nav.mobileMenuHideTrigger();
					}
				},
				swipeRight:function() {
					if (!body.hasClass('mobile-header-center-logo-alt') && !body.hasClass('mobile-header-right-logo')) {
						SWIFT.nav.mobileMenuHideTrigger();
					}
				},
			});

			// Hide on resize
			$window.smartresize( function() {

				var windowWidth = $window.width();

				if (windowWidth > 1024 && body.hasClass('mhs-tablet-land')) {
					SWIFT.nav.mobileMenuHideTrigger();
				} else if (windowWidth > 991 && body.hasClass('mhs-tablet-port')) {
					SWIFT.nav.mobileMenuHideTrigger();
				} else if (windowWidth > 767 && body.hasClass('mhs-mobile')) {
					SWIFT.nav.mobileMenuHideTrigger();
				}

			});

		},
		setMobileCartPadding: function() {
			var mHeaderHeight = jQuery('#mobile-header').outerHeight();
			if ( jQuery('#mobile-top-text').length > 0 ) {
				mHeaderHeight += jQuery('#mobile-top-text').outerHeight();
			}
			if ( jQuery('#wpadminbar').length > 0 ) {
				mHeaderHeight += jQuery('#wpadminbar').outerHeight();
			}
			if ( jQuery('#mobile-header').parent().hasClass('is-sticky') ) {
				mHeaderHeight = jQuery('#mobile-header').offset().top + jQuery('#mobile-header').outerHeight() - $window.scrollTop();
			}
 			jQuery('#mobile-menu-wrap').css('padding-top', mHeaderHeight);
			jQuery('#mobile-cart-wrap').css('padding-top', mHeaderHeight);
		},
		showMobileMenu: function() {
			SWIFT.nav.setMobileCartPadding();
			body.addClass('mobile-menu-open');
			setTimeout(function() {
				jQuery('#sf-mobile-slideout-backdrop').on('click touchstart', SWIFT.nav.mobileMenuHideTrigger);
			}, 400);
		},
		hideMobileMenu: function() {
			body.removeClass('mobile-menu-open');
			body.removeClass('mh-menu-show');
			jQuery('.mobile-menu-link').removeClass('is-active');
			if ( body.hasClass('mh-overlay-show') ) {
				body.removeClass('mh-overlay-show');
			}
			setTimeout(function() {
				jQuery('#sf-mobile-slideout-backdrop').off('click touchstart', SWIFT.nav.mobileMenuHideTrigger);
			}, 300);
			setTimeout(function() {
				body.removeClass('mobile-menu-closing');
			}, 1000);
		},
		showMobileCart: function() {
			SWIFT.nav.setMobileCartPadding();
			body.addClass('mobile-cart-open');
			setTimeout(function() {
				jQuery('#sf-mobile-slideout-backdrop').on('click touchstart', SWIFT.nav.mobileMenuHideTrigger);
			}, 400);
		},
		hideMobileCart: function() {
			body.removeClass('mobile-cart-open');
			if ( body.hasClass('mh-overlay-show') ) {
				body.removeClass('mh-overlay-show');
			}
			body.removeClass('mh-cart-show');
			setTimeout(function() {
				jQuery('#sf-mobile-slideout-backdrop').off('click touchstart', SWIFT.nav.mobileMenuHideTrigger);
			}, 400);
			setTimeout(function() {
				body.removeClass('mobile-menu-closing');
			}, 1000);
		},
		mobileMenuHideTrigger: function(e) {
			if (e) {
			    e.preventDefault();
			}
			body.addClass('mobile-menu-closing');
			SWIFT.nav.hideMobileMenu();
			SWIFT.nav.hideMobileCart();
		},
		mobileHeaderOverlay: function(type) {
			SWIFT.nav.setMobileCartPadding();
			if (type === "menu") {
				body.addClass('mh-overlay-show mh-menu-show mobile-menu-open');
			} else if (type === "cart") {
				body.addClass('mh-overlay-show mh-cart-show mobile-cart-open');
			}
		},
		showSideSlideout: function(side) {

			var windowTop = $window.scrollTop();

			if (side === "left") {
				jQuery('#side-slideout-left-wrap').css('display', 'block');
				body.addClass('side-slideout-open');
				body.addClass('side-slideout-left-open');
			} else {
				jQuery('#side-slideout-right-wrap').css('display', 'block');
				body.addClass('side-slideout-open');
				body.addClass('side-slideout-right-open');
			}

			if (windowTop > 0 && body.hasClass('sticky-header-enabled') && jQuery('.sticky-wrapper').hasClass('is-sticky')) {
				stickyHeaderTop = jQuery('.sticky-header').css('top');
				jQuery('.sticky-header').css('position', 'absolute').css('top', windowTop);
				if ( jQuery('.sticky-top-bar').length > 0 ) {
				jQuery('.sticky-top-bar').css('position', 'absolute').css('top', windowTop);
				}
			}

			setTimeout(function() {
				jQuery('#container').on('click touchstart', SWIFT.nav.sideSlideoutHideTrigger);
			}, 400);
		},
		hideSideSlideout: function() {
			body.removeClass('side-slideout-open side-slideout-left-open side-slideout-right-open');
			setTimeout(function() {
				jQuery('#container').off('click touchstart', SWIFT.nav.sideSlideoutHideTrigger);
			}, 400);
			setTimeout(function() {
				body.removeClass('side-slideout-closing');
				if (body.hasClass('sticky-header-enabled') && jQuery('.sticky-wrapper').hasClass('is-sticky')) {
					jQuery('.sticky-header').css('position', 'fixed').css('top', stickyHeaderTop);
					jQuery('.sticky-top-bar').css('position', 'fixed').css('top', stickyHeaderTop);
				}
			}, 1000);
		},
		sideSlideoutHideTrigger: function() {
			body.addClass('side-slideout-closing');
			SWIFT.nav.hideSideSlideout();
		},
		sideSlideoutInit: function() {
			// Slideout Menu parent click
			jQuery('.sf-side-slideout li.menu-item > a').on('click', function(e) {
				var parentMenuItem = jQuery(this).parent(),
					linkHref = jQuery(this).attr('href'),
					subMenu = parentMenuItem.find('ul.sub-menu').first(),
					subParent = subMenu.parent();

				if (!parentMenuItem.hasClass('parent')) {
					SWIFT.nav.sideSlideoutHideTrigger();

					if (body.hasClass('page-transitions')) {
						SWIFT.page.fadePageOut(linkHref);
					}

					return e;
				}

				if (subParent.hasClass('sub-menu-open')) {
					if (linkHref.indexOf('http') === 0 || linkHref.indexOf('/') === 0) {
						return e;
					} else {
						subParent.removeClass('sub-menu-open');
						subMenu.slideUp();
						e.preventDefault();
					}
				} else {
					subParent.addClass('sub-menu-open');
					subMenu.slideDown();
					e.preventDefault();
				}
			});
		},
		pushNavInit: function() {
			var isLateralNavAnimating = false;
			
			if ( jQuery( '.sf-pushnav' ).hasClass( 'full-size' ) ) {
				body.addClass( 'sf-pushnav-full' );
			}
			
			//open/close lateral navigation
			jQuery('.sf-pushnav-trigger').on('click', function(event) {
				event.preventDefault();
				
				var windowTop = $window.scrollTop();
				
				//stop if nav animation is running 
				if( !isLateralNavAnimating ) {
				
					if ( jQuery('html').hasClass('csstransitions') ) isLateralNavAnimating = true; 
					
					if ( body.hasClass('sf-pushnav-is-open') ) {
						if (body.hasClass('sticky-header-enabled') && jQuery('.sticky-wrapper').hasClass('is-sticky')) {
							jQuery('.sticky-header').css('position', 'fixed').css('top', stickyHeaderTop);
							jQuery('.sticky-top-bar').css('position', 'fixed').css('top', stickyHeaderTop);
						}
					} else {
						if (windowTop > 0 && body.hasClass('sticky-header-enabled') && jQuery('.sticky-wrapper').hasClass('is-sticky')) {
							stickyHeaderTop = jQuery('.sticky-header').css('top');
							jQuery('.sticky-header').css('position', 'absolute').css('top', windowTop);
							if ( jQuery('.sticky-top-bar').length > 0 ) {
								jQuery('.sticky-top-bar').css('position', 'absolute').css('top', windowTop);
							}
						}
					}

					body.toggleClass('sf-pushnav-is-open');

					jQuery('.sf-pushnav-wrapper').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function() {
						//animation is over
						isLateralNavAnimating = false;
					});
				}
			});
			
			// PushNav Menu parent click
			jQuery('.sf-pushnav li.menu-item > a').on('click', function(e) {
				var parentMenuItem = jQuery(this).parent(),
					linkHref = jQuery(this).attr('href'),
					subMenu = parentMenuItem.find('ul.sub-menu').first();

				if (!parentMenuItem.hasClass('parent')) {
					body.removeClass('sf-pushnav-is-open');

					if (linkHref.indexOf('#') === 0 && linkHref.length > 1) {
						SWIFT.isScrolling = true;
						SWIFT.page.onePageNavGoTo(linkHref);
						setTimeout(function() {
							SWIFT.isScrolling = false;
						}, 1000);
						e.preventDefault();
					} else if (body.hasClass('page-transitions')) {
						SWIFT.page.fadePageOut(linkHref);
					}

					return e;
				}

				if (parentMenuItem.hasClass('sub-menu-open')) {
					if (linkHref.indexOf('http') === 0 || linkHref.indexOf('/') === 0) {
						return e;
					} else {
						parentMenuItem.removeClass('sub-menu-open');
						subMenu.slideUp();
						e.preventDefault();
					}
				} else {
					parentMenuItem.addClass('sub-menu-open');
					subMenu.slideDown();
					e.preventDefault();
				}
			});						
		}
	};


	/////////////////////////////////////////////
	// WOOCOMMERCE FUNCTIONS
	/////////////////////////////////////////////

	SWIFT.woocommerce = {
		init: function() {
		
			// Cart Wishlist
			SWIFT.woocommerce.cartWishlist();

			// SHOP LAYOUT SWITCH
			SWIFT.woocommerce.shopLayoutSwitch();
			
			// SHOP PAGINATION
			if ( body.hasClass('archive') && body.hasClass('woocommerce') ) {
				SWIFT.woocommerce.infiniteScroll();
			}
			
			// MOBILE SHOP FILTERS
			SWIFT.woocommerce.mobileShopFilters();

			// QUANTITY FUNCTIONS
			SWIFT.woocommerce.productQuantityAdjust();

			// SMALL PRODUCT CHECK
			SWIFT.woocommerce.smallProductCheck();
			$window.smartresize( function() {
				SWIFT.woocommerce.smallProductCheck();
			});
			
			// PREVIEW SLIDER LAYOUT
			if ( jQuery('.product-type-preview-slider').length > 0 ) {
				SWIFT.woocommerce.previewSliderLayout();
			}

			// QUICKVIEW TOOLTIP
			jQuery('.jckqvBtn').attr('data-toggle', 'tooltip').attr('data-original-title', sfOptionParams.data('quickview-text'));

			// UPDATE QUANTITY DATA VALUE
			jQuery(document).on("change", "form.cart input.qty", function() {
			    jQuery(this.form).find("button[data-quantity]").attr("data-quantity", this.value);
			});

			// ADD TO CART LOADING
			jQuery(document).on('click', '.add_to_cart_button, .single_add_to_cart_button', function(e) {
				var button = jQuery(this),
					buttonWrap = button.parent(),
					loadingText = button.attr("data-loading_text"),
					addedTitle = buttonWrap.data('tooltip-added-text');
				
				if ( button.hasClass('disabled') ) {
					return e;
				}
				
				if ( jQuery( this ).parent().parent().parent().attr('id') == 'jckqv' ) {
					e.preventDefault();
					jQuery(this).removeClass( 'ajax_add_to_cart' );
					jQuery( '#jckqv form.cart' ).submit();
				}

				button.addClass("added-spinner");
				button.find('span').text(loadingText);
				button.find('i').attr('class', 'sf-icon-loader-gap');

				if ( !buttonWrap.hasClass('cart') && !buttonWrap.hasClass('add-to-cart-shortcode') ) {
					setTimeout(function() {
						buttonWrap.tooltip('hide').attr('title', addedTitle).tooltip('fixTitle');
					}, 500);
					setTimeout(function() {
						buttonWrap.tooltip('show');
					}, 700);
				}
			});

			// ADD TO CART NOTIFICATION
			jQuery("body").bind("added_to_cart", function() {
				var navBag = jQuery('.shopping-bag-item'),
					bagIcon = navBag.find('.cart-contents'),
					currentProduct = jQuery('.added-spinner'),
					addToCartBtn,
					addedText;

				currentProduct.addClass('product-added');

				if (body.hasClass('single-product') || currentProduct.parents('#jckqv').length > 0) {
					addToCartBtn = jQuery('.add_to_cart_button, .single_add_to_cart_button');
					addedText = addToCartBtn.data('added_text');
					addToCartBtn.find('span').text(addedText);
				}
				
				if ( currentProduct.parents('li.product').length > 0 ) {
				 	addToCartBtn = currentProduct;
					addedText = addToCartBtn.data('added_short');						
					addToCartBtn.find('span').text(addedText);
				}
				
				if ( currentProduct.parents('.add-to-cart-shortcode').length > 0 ) {
					addToCartBtn = currentProduct;
					addedText = addToCartBtn.data('added_text');
					addToCartBtn.find('span').text(addedText);
				}

				navBag.addClass('added-notification');
				bagIcon.addClass('sf-animate ' + cartNotification);
				currentProduct.find('i').attr('class', 'sf-icon-tick');
				currentProduct.removeClass('added-spinner');

				// Show cart dropdown
				setTimeout(function() {
					navBag.find('ul.sub-menu').fadeIn(200);
				}, 800);

				// Reset button on single product
				setTimeout(function() {
					var defaultText, defaultIcon;
					if (body.hasClass('single-product') || currentProduct.parents('#jckqv').length > 0) {
						var addToCartBtn = jQuery('.add_to_cart_button, .single_add_to_cart_button');
						defaultText = addToCartBtn.data('default_text');
						defaultIcon = addToCartBtn.data('default_icon');

						currentProduct.find('i').attr('class', defaultIcon);
						addToCartBtn.find('span').text(defaultText);
						addToCartBtn.removeClass('added product-added');
					}
					
					if ( currentProduct.parents('.add-to-cart-shortcode').length > 0 ) {
						var addToCartShortcodeBtn = currentProduct;
						defaultText = addToCartShortcodeBtn.data('default_text');
						defaultIcon = addToCartShortcodeBtn.data('default_icon');

						currentProduct.find('i').attr('class', defaultIcon);
						addToCartShortcodeBtn.find('span').text(defaultText);
						addToCartShortcodeBtn.removeClass('added product-added');
					}
					
				}, 3000);

				// Hide cart dropdown
				setTimeout(function() {
					navBag.removeClass('added-notification');
					bagIcon.removeClass('sf-animate ' + cartNotification);
					if (!shopBagHovered) {
						navBag.find('ul.sub-menu').fadeOut(150);
					}
				}, 4000);
			});

			// WISHLIST UPDATE
			jQuery(document).on('click', '.add_to_wishlist', function(){

				jQuery(this).parent().parent().find('.yith-wcwl-wishlistaddedbrowse').show().removeClass("hide").addClass("show");
				jQuery(this).hide().addClass("hide").removeClass("show");

				var data = {action: 'sf_add_to_wishlist', product_id: jQuery(this).attr('data-product-id')};
				var ajaxURL = jQuery(this).attr('data-ajaxurl');

				jQuery.post(ajaxURL, data, function(response) {
					var json = jQuery.parseJSON(response);
					jQuery('.cart-wishlist .wishlist-item .bag-contents').prepend(json.wishlist_output);
					jQuery('.wishlist-empty').remove();
					jQuery('.bag-buttons').removeClass('no-items');
					var navWishlist = jQuery('.wishlist-item'),
						wishlistIcon = navWishlist.find('.wishlist-link');

					navWishlist.addClass('added-notification');
					wishlistIcon.addClass('sf-animate ' + cartNotification);
					setTimeout(function() {
						navWishlist.find('ul.sub-menu').fadeIn(200);
					}, 800);
					setTimeout(function() {
						navWishlist.removeClass('added-notification');
						wishlistIcon.removeClass('sf-animate ' + cartNotification);
						if (!wishlistHovered) {
							navWishlist.find('ul.sub-menu').fadeOut(150);
						}
					}, 4000);
				});

        	});

			// SHOW PRODUCTS
			jQuery('.show-products-link').on('click', function(e) {
				e.preventDefault();
				var linkHref = jQuery(this).attr('href').replace('?', ''),
					currentURL = document.location.href.replace(/\/page\/\d+/, ''),
					currentQuery = document.location.search;

				if (currentQuery.indexOf('?show') >= 0) {
					window.location = jQuery(this).attr('href');
				} else if (currentQuery.indexOf('?') >= 0) {
					window.location = currentURL + '&' + linkHref;
				} else {
					window.location = currentURL + '?' + linkHref;
				}
			});


			// SHOPPING CALCULATOR
			jQuery('.shipping-calculator-form input').keypress(function(e) {
				if(e.which == 10 || e.which == 13) {
					jQuery(".update-totals-button button").click();
				}
			});

			// PRODUCT GRID
			if (jQuery('.product-grid').length > 0) {

				if (!jQuery('.inner-page-wrap').hasClass('full-width-shop')) {
					var productGrid = jQuery('.product-grid');
					productGrid.each(function() {
						if ( productGrid.parent('.upsells').length > 0 ) {
							return;
						}
						SWIFT.woocommerce.productGridSetup(jQuery(this));
					});
				}
			}

			// Multi-Masonry Product
			if (jQuery('.products.multi-masonry-items').length > 0) {

				jQuery('.products.multi-masonry-items').each(function() {
					SWIFT.woocommerce.multiMasonrySetup(jQuery(this));
				});

				$window.smartresize( function() {
					SWIFT.woocommerce.windowResized();
				});

			}

			// EDIT PRODUCT CATEGORY COUNT DISPLAY
			jQuery('.product-categories li span.count, .widget_layered_nav li span.count').each(function() {
				var thisCategory = jQuery(this),
					thisText = thisCategory.text();
				thisCategory.text(thisText.replace('(', '').replace(')', ''));
				thisCategory.addClass('show-count');
			});

			jQuery('.upsell-heading-link').on('click', '', function(e) {

				var upsellToggle = jQuery(this);

				jQuery('.upsells > .products').slideToggle();

				if (upsellToggle.hasClass('upsell-open')) {
					upsellToggle.find('i').removeClass('sf-icon-minus').addClass('sf-icon-plus');
					upsellToggle.removeClass('upsell-open');
				} else {
					upsellToggle.find('i').removeClass('sf-icon-plus').addClass('sf-icon-minus');
					upsellToggle.addClass('upsell-open');
				}

				e.preventDefault();

			});
			
			// Product FW Init
			if ( body.hasClass('product-fw-split') ) {
				SWIFT.woocommerce.productFWSplit();
			}
			
			// Currency Switcher
			if ( jQuery('ul.wcml_currency_switcher').length > 0 ) {
				jQuery('ul.wcml_currency_switcher').addClass('sub-menu');
			}
			
			if ( jQuery('#track-order-modal').length > 0 ) {
				var trackingURL = jQuery('#track-order-modal').data('tracking-url');
				jQuery('#track-order-modal').find('form').attr('action', trackingURL);
			}
			
			// Mobile Zoom
			jQuery('.mobile-product-zoom').on('click', function(e) {
				e.preventDefault();
				var zoomObject = jQuery(this).parents('li.active').find('.product-slider-image');
				if ( body.hasClass('mobile-zoom-enabled') ) {
					jQuery(this).find('i').attr('class', 'sf-icon-add');
					body.removeClass('mobile-zoom-enabled');
					zoomObject.panzoom('option', 'startTransform', 'scale(1.0)');
					zoomObject.panzoom("destroy");
				} else {
					jQuery(this).find('i').attr('class', 'sf-icon-remove');
					zoomObject.panzoom({
					    minScale: 1,
					    contain: 'invert',
					    startTransform: 'scale(1.2)',
					});
					body.addClass('mobile-zoom-enabled');
				}
			});		
			
		},
		load: function() {

			if (jQuery('.woocommerce-shop-page').hasClass('full-width-shop') && !(IEVersion && IEVersion < 9) && !jQuery('#products').hasClass('multi-masonry-items')) {
				SWIFT.woocommerce.fullWidthShop();
			}
			
			if ( body.hasClass('product-fw-split') ) {
				SWIFT.woocommerce.productFWSplit();
				$window.smartresize( function() {
					SWIFT.woocommerce.productFWSplit();
				});
			}
			
			SWIFT.woocommerce.variations();
			SWIFT.woocommerce.swatches();

		},
		productFWSplit: function() {
		
			if ( $window.width() <= 1024 ) {
				return;
			}
			
			var windowHeight = $window.height() - SWIFT.offset,
				productMain = jQuery('.product-main'),
				slider = productMain.find('.images'),
				sliderHeight = slider.outerHeight(),
				//details = productMain.find('.summary'),
				//detailsHeight = details.height(),
				lSPager = productMain.find('.lSPager');
			
			if ( sliderHeight > windowHeight ) {
				productMain.css('height', sliderHeight);
			} else {
				productMain.css('height', windowHeight);
			}
			
			lSPager.css('margin-top', -(lSPager.height() / 2));
		},
		cartWishlist: function() {
			// Cart remove product
			jQuery(document).on('click', '.shopping-bag .remove-product', function(e) {

				e.preventDefault();
				e.stopPropagation();
												
				var prod_id = jQuery(this).attr('data-product-id'),
				    variation_id = jQuery(this).attr('data-variation-id'),
					prod_quantity = jQuery(this).attr('data-product-qty'),
					empty_bag_txt = jQuery('.shopping-bag').attr('data-empty-bag-txt'),
					singular_item_txt = jQuery('.shopping-bag').attr('data-singular-item-txt'),
					multiple_item_txt = jQuery('.shopping-bag').attr('data-multiple-item-txt'),
					data = {action: 'sf_cart_product_remove', product_id: prod_id, variation_id: variation_id},
					ajaxURL = jQuery(this).attr('data-ajaxurl');

					jQuery('.shopping-bag .loading-overlay').fadeIn(200);

					jQuery.post(ajaxURL, data, function(response) {

						var cartTotal = response;
						var cartcounter = 0;
						
						if ( body.hasClass('woocommerce-checkout') ) {
							jQuery('.shopping-bag').find(".bag-button")[0].click();
						}
						
						if ( body.hasClass('woocommerce-cart') ) {
							location.reload();
						}

						jQuery('.shopping-bag .loading-overlay').fadeOut(100);

						cartcounter = parseInt(jQuery('.cart-contents .num-items').first().text()) - prod_quantity;
						jQuery('.cart-contents .amount').replaceWith(cartTotal);
						jQuery('.bag-total .amount').replaceWith(cartTotal);
						jQuery('.cart-contents .num-items').text(cartcounter);

						jQuery('.cart-contents .num-items').each(function() {
							jQuery(this).text(cartcounter);
						});
						
						if ( variation_id > 0 ){
							jQuery('.product-var-id-'+variation_id).remove();
						}else{
							jQuery('.product-id-'+prod_id).remove();	
						}
						

						if ( cartcounter <= 0 ) {
							jQuery('.sub-menu .shopping-bag').prepend('<div class="bag-empty">' + empty_bag_txt + '</div>');
							jQuery('.sub-menu .shopping-bag .bag-buttons').remove();
							jQuery('.sub-menu .shopping-bag .bag-header').remove();
							jQuery('.sub-menu .shopping-bag .bag-total').remove();
							jQuery('.sub-menu .shopping-bag .bag-contents').remove();
						} else {
							if ( cartcounter == 1 ) {
								jQuery('.sub-menu .shopping-bag .bag-header').text('1 ' + singular_item_txt);
							} else {
								jQuery('.sub-menu .shopping-bag .bag-header').text(cartcounter + ' ' + multiple_item_txt);
							}
						}

					});
				
				return false;

			});

			// WISHLIST REMOVE PRODUCT
			jQuery(document).on('click', '.wishlist_table .remove', function(){
				jQuery(".prod-"+jQuery(this).attr('data-product-id')).remove();
				if (jQuery('.wishlist-bag').find('.bag-product').length === 0) {
					jQuery('.bag-buttons').addClass('no-items');
				}
			});
		},
		variations: function() {
			jQuery('.single_variation_wrap').on("show_variation", function() {
				if (hasProductZoom) {
					jQuery('.zoomContainer').remove();
					setTimeout(function() {
						if (SWIFT.productSlider) {
							jQuery('.product-slider-image').each(function() {
								jQuery(this).data('zoom-image', jQuery(this).parent().find('a.zoom').attr('href'));
							});
							var firstImage = jQuery('#product-img-slider li:first').find('.product-slider-image');
							SWIFT.woocommerce.productZoom(firstImage);
							SWIFT.productSlider.goToSlide(0);
						}
					}, 500);
				} else {
					setTimeout(function() {
						if (SWIFT.productSlider) {
							SWIFT.productSlider.goToSlide(0);
						}
					}, 500);
				}
				setTimeout(function() {

					// Update lightbox image
					jQuery('.product-slider-image').each(function() {
						var zoomImage = jQuery(this).attr('src');
						jQuery(this).parent().find('a.zoom').attr('href', zoomImage).attr('data-o_href', '').attr('data-o_href', zoomImage);
						jQuery('[data-rel="ilightbox[product]"]').removeClass('ilightbox-enabled').iLightBox().destroy();
						SWIFT.page.lightbox();
					});
				}, 600);
			});
			
			// Support for additional variations images plugin
			jQuery( 'form.variations_form' ).on( 'wc_additional_variation_images_frontend_image_swap_callback wc_additional_variation_images_frontend_ajax_default_image_swap_callback wc_additional_variation_images_frontend_on_reset', function( e, response, gallery_images_class, main_images_class, o_gallery_images ) {
			
				switch( e.type ) {
					case 'wc_additional_variation_images_frontend_image_swap_callback':
						jQuery('#product-img-slider .slides').html( response.gallery_images );
									
						jQuery( '#product-img-nav ul.slides a.zoom.lightbox' ).each( function() {
							var link = jQuery( this ).parent().find( 'img' ).attr('data-zoom-image');
							jQuery( this ).attr('href', link);
						});
			
						break;						
					case 'wc_additional_variation_images_frontend_ajax_default_image_swap_callback':
						jQuery('#product-img-slider .slides').html( o_gallery_images );
									
						break;	
					case 'wc_additional_variation_images_frontend_on_reset':
						jQuery('#product-img-slider .slides').html( o_gallery_images );
						break;	
				}
				
				SWIFT.productSlider.destroy();
				SWIFT.sliders.productSlider();
				
				setTimeout(function() {
					jQuery('[data-rel="ilightbox[product]"]').removeClass('ilightbox-enabled').iLightBox().destroy();
					SWIFT.page.lightbox();
				}, 500);
								
			});
			jQuery( 'form.variations_form' ).on( 'wc_additional_variation_images_frontend_lightbox_done', function() {
				setTimeout(function() {
					jQuery('[data-rel="ilightbox[product]"]').removeClass('ilightbox-enabled').iLightBox().destroy();
					SWIFT.page.lightbox();
				}, 500);
			});
			
			// Reset on variation reset
			jQuery(document).on( 'reset_image', function() {
								
				setTimeout(function() {
					if (hasProductZoom) {
						jQuery('.zoomContainer').remove();
						if (SWIFT.productSlider) {
							SWIFT.productSlider.goToSlide(0);			
							var firstImage = jQuery('#product-img-slider li:first').find('.product-slider-image');
							firstImage.attr('data-zoom-image', firstImage.parent().attr('data-thumb'));
							firstImage.data('zoom-image', firstImage.parent().attr('data-thumb'));
							setTimeout(function() {
								SWIFT.woocommerce.productZoom(firstImage);
							}, 200);
						}
					} else {
						if (SWIFT.productSlider) {
							SWIFT.productSlider.goToSlide(0);
						}
					}
				}, 500);
								
			});
		},
		swatches: function() {
			jQuery(document).on("change", "div.select", function(){
				if (hasProductZoom) {
					jQuery('.zoomContainer').remove();
					setTimeout(function() {
						if (SWIFT.productSlider) {
							jQuery('.product-slider-image').each(function() {
								jQuery(this).data('zoom-image', jQuery(this).parent().find('a.zoom').attr('href'));
							});
							var firstImage = jQuery('#product-img-slider li:first').find('.product-slider-image');
							SWIFT.woocommerce.productZoom(firstImage);
							SWIFT.productSlider.goToSlide(0);
						}
					}, 500);
				} else {
					setTimeout(function() {
						if (SWIFT.productSlider) {
							SWIFT.productSlider.goToSlide(0);
						}
					}, 500);
				}
			});
		},
		productZoom: function(zoomObject) {
			if ( isMobileAlt && hasProductZoomMobile ) {
				jQuery('#product-img-slider li a.mobile-product-zoom').addClass('is-mobile');
			} else if ( hasProductZoom ) {
				jQuery('#product-img-slider li a.zoom').css('display', 'none');
				jQuery('.zoomContainer').remove();
				zoomObject.elevateZoom({
					zoomType: productZoomType,
					cursor: "crosshair",
					zoomParent: '#product-img-slider .lSSlideWrapper',
					responsive: true,
					zoomWindowFadeIn: 400,
					zoomWindowFadeOut: 500,
					lensSize: 350
				});
	
				$window.smartresize( function() {
					jQuery('.zoomContainer').remove();
					zoomObject.elevateZoom({
						zoomType: productZoomType,
						cursor: "crosshair",
						zoomParent: '#product-img-slider .lSSlideWrapper',
						responsive: true,
						zoomWindowFadeIn: 400,
						zoomWindowFadeOut: 500,
						lensSize: 350
					});
				});
			}
		},
		shopLayoutSwitch: function() {
			var isSwitchingLayout = false;

			jQuery(document).on('click', 'a.layout-opt', function(e) {

				var products = jQuery('#products'),
					selectedLayout = jQuery(this).data('layout'),
					defaultWidth = products.find('.product').first().data('width'),
					gridWidth = jQuery('.inner-page-wrap').hasClass('has-no-sidebar') ? 'col-sm-sf-5' : 'col-sm-3';

				if ( jQuery(this).parent().data('display-type') == "gallery" || jQuery(this).parent().data('display-type') == "gallery-bordered" ) {
					gridWidth = "col-sm-2";
				}

				if (isSwitchingLayout) {
					return;
				}

				isSwitchingLayout = true;

				products.animate({
					'opacity': 0
				}, 400);
				setTimeout(function() {

					products.find('.product').removeClass('product-layout-standard product-layout-list product-layout-grid product-layout-solo');
					products.find('.product').addClass('product-layout-' + selectedLayout);

					if ( jQuery('.product-grid').length > 0 ) {
						jQuery('.product-grid').children().css('min-height','0');

						if (selectedLayout === "grid") {
							products.find('.product').removeClass(defaultWidth).addClass(gridWidth);
						}

						if (selectedLayout === "standard" || selectedLayout === "solo") {
							products.find('.product').removeClass(gridWidth).addClass(defaultWidth);
						}

						if (selectedLayout !== "list" && selectedLayout !== "solo") {
							jQuery('.product-grid').equalHeights();
						}
					}

					products.isotope('layout');

					products.animate({
						'opacity': 1
					}, 400);

					isSwitchingLayout = false;

				}, 500);

				e.preventDefault();

			});
		},
		mobileShopFilters: function() {

			jQuery(document).on('click', '.sf-mobile-shop-filters-link', function(e) {

				e.preventDefault();

				var thisLink = jQuery(this);

				if ( thisLink.hasClass('filters-open') ) {

					jQuery('.sf-mobile-shop-filters').slideUp();
					thisLink.removeClass('filters-open');

				} else {

					jQuery('.sf-mobile-shop-filters').slideDown();
					thisLink.addClass('filters-open');

				}


			});
		},
		fullWidthShop: function() {
			var shopItems = jQuery('.full-width-shop').find('.products'),
				itemWidth = shopItems.find('.product').first().data('width'),
				shopSidebar = shopItems.find('.sidebar');

			if (shopSidebar.length > 0) {

				// Full Width Shop Sidebar
				SWIFT.woocommerce.fullWidthShopSetSidebarHeight();
				$window.smartresize( function() {
					SWIFT.woocommerce.fullWidthShopSetSidebarHeight();
				});

				shopItems.isotope({
					itemSelector: '.product',
					layoutMode: 'masonry',
					masonry: {
						columnWidth: '.'+itemWidth
					},
					isOriginLeft: !isRTL
				});

				SWIFT.woocommerce.animateItems(shopItems);

				shopSidebar.stop().animate({
					'opacity': 1
				}, 500);
				shopItems.isotope( 'stamp', shopSidebar );
				shopItems.isotope('layout');

				setTimeout(function() {
					shopItems.isotope('layout');
				}, 500);

			} else {

				shopItems.isotope({
					itemSelector: '.product',
					layoutMode: 'fitRows',
					isOriginLeft: !isRTL
				});

				setTimeout(function() {
					shopItems.isotope('layout');
				}, 500);

				SWIFT.woocommerce.animateItems(shopItems);

			}
		},
		fullWidthShopSetSidebarHeight: function() {
			var shopItems = jQuery('.full-width-shop').find('.products'),
				shopSidebar = shopItems.find('div.sidebar'),
				defaultSidebarHeight = shopSidebar.css('height', '').outerHeight(),
				newSidebarHeight = 0,
				sidebarHeightMultiply = 2,
				firstProductHeight = shopItems.find('div.product').first().outerHeight(true);

			sidebarHeightMultiply = Math.ceil(defaultSidebarHeight / firstProductHeight);
			newSidebarHeight = firstProductHeight * sidebarHeightMultiply;
			shopSidebar.css('height', newSidebarHeight);
		},
		productGridSetup: function(productsInstance) {
			productsInstance.imagesLoaded(function () {
				productsInstance.isotope({
					resizable: false,
					itemSelector : '.product',
					layoutMode: 'fitRows',
					isOriginLeft: !isRTL
				});
			});
			productsInstance.appear(function() {
				if (isMobile) {
					setTimeout(function() {
						productsInstance.isotope('layout');
						SWIFT.woocommerce.animateItems(productsInstance);
					}, 500);
				} else {
					SWIFT.woocommerce.animateItems(productsInstance);
				}
			});
		},
		multiMasonrySetup: function(productsInstance) {
			productsInstance.imagesLoaded(function () {
				SWIFT.woocommerce.multiMasonrySizeFix(productsInstance, false);
				productsInstance.isotope({
					resizable: false,
					itemSelector : '.product',
					layoutMode: 'packery',
					packery: {
						columnWidth: '.grid-sizer'
					},
					isOriginLeft: !isRTL
				});
				if (isMobile) {
					setTimeout(function() {
						productsInstance.isotope('layout');
					}, 500);
				}
			});
			productsInstance.appear(function() {
				SWIFT.woocommerce.animateItems(productsInstance);
			});
		},
		multiMasonrySizeFix: function(productsInstance, $init) {
			var baseItem = productsInstance.find('.product.size-standard').first(),
				standardHeight = baseItem.height(),
				largeHeight = 0;
			
			if ( standardHeight > 0 ) {
				largeHeight = (standardHeight * 2) + parseInt(baseItem.css('margin-bottom'), 10);
			} else {
				var firstProduct = productsInstance.find('.product.size-large,.product.size-tall').first();
				largeHeight = firstProduct.height();				
			}
			
			if (largeHeight > 0) {
				productsInstance.find('.product.size-large .multi-masonry-img-wrap').css('height', largeHeight);
				productsInstance.find('.product.size-tall .multi-masonry-img-wrap').css('height', largeHeight);
			}
			if ($init) {
				productsInstance.isotope('layout');
			}
		},
		windowResized: function() {
			jQuery('.products.multi-masonry-items').each(function() {
				SWIFT.woocommerce.multiMasonrySizeFix(jQuery(this), true);
			});			
		},
		animateItems: function(shopItems) {
			shopItems.find('.product').each(function(i) {
				jQuery(this).delay(i*200).animate({
					'opacity' : 1
				}, 800, 'easeOutExpo', function() {
					jQuery(this).addClass('item-animated');
				});
			});
		},
		productQuantityAdjust: function() {
			// Increase
			jQuery(document).on('click', '.qty-plus', function(e) {
				e.preventDefault();
				var quantityInput = jQuery(this).parents('.quantity').find('input.qty'),
					step = parseInt(quantityInput.attr('step'), 10),
					newValue = parseInt(quantityInput.val(), 10) + step,
					maxValue = parseInt(quantityInput.attr('max'), 10);

				if (!maxValue) {
					maxValue = 9999999999;
				}

				if ( newValue <= maxValue ) {
					quantityInput.val(newValue);
					quantityInput.change();
				}
			});

			// Decrease
			jQuery(document).on('click', '.qty-minus', function(e) {
				e.preventDefault();
				var quantityInput = jQuery(this).parents('.quantity').find('input.qty'),
					step = parseInt(quantityInput.attr('step'), 10),
					newValue = parseInt(quantityInput.val(), 10) - step,
					minValue = parseInt(quantityInput.attr('min'), 10);

				if (!minValue) {
					minValue = 0;
				}

				if ( newValue >= minValue ) {
					quantityInput.val(newValue);
					quantityInput.change();
				}
			});
		},
		smallProductCheck: function() {
			jQuery('.product').each(function() {
				var thisProduct = jQuery(this);

				if (thisProduct.width() < 280) {
					thisProduct.addClass('mini-view');
				} else {
					thisProduct.removeClass('mini-view');
				}
			});
		},
		previewSliderLayout: function() {
			var previewSliderItems = jQuery('.product-type-preview-slider > .products, .products.product-type-preview-slider').children('.product');
		
			previewSliderItems.each(function(){
				var container = jQuery(this),
					sliderDots = SWIFT.woocommerce.pslCreateDots(container);
				
				if ( !container.find('.variable-image-wrapper').hasClass('is-variable') ) {
					return;	
				}
				
				SWIFT.woocommerce.pslUpdatePrice(container, 0);
		
				// update slider when user clicks one of the dots
				if (sliderDots) {
					sliderDots.on('click', function() {
						var selectedDot = jQuery(this);
						if ( !selectedDot.hasClass('selected') ) {
							var selectedPosition = selectedDot.index(),
								activePosition = container.find('.variable-image-wrapper .selected').index();
							if ( activePosition < selectedPosition ) {
								SWIFT.woocommerce.pslNextSlide(container, sliderDots, selectedPosition);
							} else {
								SWIFT.woocommerce.pslPrevSlide(container, sliderDots, selectedPosition);
							}
							SWIFT.woocommerce.pslUpdatePrice(container, selectedPosition);
						}
					});
				}
				
				// update slider on swipeleft
				container.find('.variable-image-wrapper').swipe({
					swipeLeft:function() {
						var wrapper = jQuery(this),
							selectedPosition = 0;
						if ( !wrapper.find('.selected').is(':last-child') ) {
							selectedPosition = container.find('.variable-image-wrapper .selected').index() + 1;
							SWIFT.woocommerce.pslNextSlide(container, sliderDots);
							SWIFT.woocommerce.pslUpdatePrice(container, selectedPosition);
						}
					},
					swipeRight:function() {
						var wrapper = jQuery(this),
							selectedPosition = 0;
						if ( !wrapper.find('.selected').is(':first-child') ) {
							selectedPosition = container.find('.variable-image-wrapper .selected').index() - 1;
							SWIFT.woocommerce.pslPrevSlide(container, sliderDots);
							SWIFT.woocommerce.pslUpdatePrice(container, selectedPosition);
						}
					},
				});
		
				// preview image hover effect - desktop only
				container.on('mouseover', '.move-right, .move-left', function() {
					SWIFT.woocommerce.pslHoverItem(jQuery(this), true);
				});
				container.on('mouseleave', '.move-right, .move-left', function() {
					SWIFT.woocommerce.pslHoverItem(jQuery(this), false);
				});
		
				// update slider when user clicks on the preview images
				container.on('click', '.move-right, .move-left', function(e) {
					e.preventDefault();
					var selectedPosition = 0;
					if ( jQuery(this).hasClass('move-right') ) {
						selectedPosition = container.find('.variable-image-wrapper .selected').index() + 1;
						SWIFT.woocommerce.pslNextSlide(container, sliderDots);
					} else {
						selectedPosition = container.find('.variable-image-wrapper .selected').index() - 1;
						SWIFT.woocommerce.pslPrevSlide(container, sliderDots);
					}
					SWIFT.woocommerce.pslUpdatePrice(container, selectedPosition);
				});
			});
		},
		pslCreateDots: function(container) {
			
			if ( container.find('.variable-image-wrapper .img-wrap').length <= 1) {
				return;
			}
			
			var dotsWrapper = jQuery('<ol class="preview-slider-dots"></ol>').insertAfter(container.find('.variable-image-wrapper'));
			container.find('.variable-image-wrapper .img-wrap').each(function(index){
				var dotWrapper = (index === 0) ? jQuery('<li class="selected"></li>') : jQuery('<li></li>'),
					dot = jQuery('<a href="#0"></a>').appendTo(dotWrapper);
				dotWrapper.appendTo(dotsWrapper);
				dot.text(index+1);
			});
			return dotsWrapper.children('li');
		},
		pslHoverItem: function(item, bool) {
			if ( item.hasClass('move-right') ) {
				item.toggleClass('hover', bool).siblings('.selected, .move-left').toggleClass('focus-on-right', bool);
			} else {
				item.toggleClass('hover', bool).siblings('.selected, .move-right').toggleClass('focus-on-left', bool);
			}
		},
		pslNextSlide: function(container, dots, n) {
			var visibleSlide = container.find('.variable-image-wrapper .selected'),
				navigationDot = container.find('.preview-slider-dots .selected');
			if(typeof n === 'undefined') n = visibleSlide.index() + 1;
			visibleSlide.removeClass('selected');
			container.find('.variable-image-wrapper .img-wrap').eq(n).addClass('selected').removeClass('move-right hover').prevAll().removeClass('move-right move-left focus-on-right').addClass('hide-left').end().prev().removeClass('hide-left').addClass('move-left').end().next().addClass('move-right');
			navigationDot.removeClass('selected');
			dots.eq(n).addClass('selected');
		},
		pslPrevSlide: function(container, dots, n) {
			var visibleSlide = container.find('.variable-image-wrapper .selected'),
				navigationDot = container.find('.preview-slider-dots .selected');
			if(typeof n === 'undefined') n = visibleSlide.index() - 1;
			visibleSlide.removeClass('selected focus-on-left');
			container.find('.variable-image-wrapper .img-wrap').eq(n).addClass('selected').removeClass('move-left hide-left hover').nextAll().removeClass('hide-left move-right move-left focus-on-left').end().next().addClass('move-right').end().prev().removeClass('hide-left').addClass('move-left');
			navigationDot.removeClass('selected');
			dots.eq(n).addClass('selected');
		},
		pslUpdatePrice: function(container, n) {
			var productDetails = container.find('.product-details'),
				priceTag = productDetails.find('span.price'),
				selectedItem = container.find('.variable-image-wrapper .img-wrap').eq(n),
				variationPriceHTML = selectedItem.find('.variation-price').html(),
				isOnSale = selectedItem.data('sale');
			
			if ( !variationPriceHTML || priceTag.html() === selectedItem.find('.variation-price span.price').html() ) {
				return;
			}
			
			if ( isOnSale ) { 
				// if item is on sale
				productDetails.addClass('on-sale');
				priceTag.replaceWith(variationPriceHTML);
				setTimeout(function(){ productDetails.addClass('is-visible'); }, 100);
			} else {
				// if item is not on sale - remove cross on old price and sale price
				productDetails.removeClass('on-sale is-visible');
				priceTag.fadeOut(function() {
				  priceTag.replaceWith(variationPriceHTML);
				}).fadeIn();
			}
			
		},
		infiniteScroll: function() {
			if (!(IEVersion && IEVersion < 9)) {
				var infScrollData = jQuery('#inf-scroll-params'),
					products = jQuery('.products'),
					isLoadMore = products.parent().find('.pagination-wrap').hasClass('load-more') ? true : false;
				
				if ( !products.parent().find('.pagination-wrap').hasClass('infinite-scroll-enabled') ) {
					return;
				}

				var infiniteScroll = {
					loading: {
						img: infScrollData.data('loadingimage'),
						msgText: isLoadMore ? infScrollData.data('msgtext') : '',
						finishedMsg: isLoadMore ? infScrollData.data('finishedmsg') : '',
						selector: '.woocommerce-shop-page .page-content',
						loaderHTML: jQuery('body > .sf-svg-loader').html()
					},
					"nextSelector":".pagenavi li:last-child a",
					"navSelector":".pagination-wrap",
					"itemSelector":".product",
					"contentSelector":"#products",
					errorCallback: function () {
						setTimeout(function() {
							jQuery( '#infscr-loading' ).animate({
								'opacity' : 0
							}, 500);
						}, 1000);
					},
				};
				jQuery( infiniteScroll.contentSelector ).infinitescroll(
					infiniteScroll, function(elements) {
						products.imagesLoaded(function () {
							products.isotope( 'appended', elements );
							jQuery.each(elements, function(i, element) {
								jQuery(element).addClass('item-animated');
							});
						});
						if (isLoadMore) {
							setTimeout(function() {
								jQuery('.load-more-btn').css('display', 'block');							
							}, 200);
						}
					}
				);
				if (isLoadMore) {
					products.parent().addClass('products-load-more-pagination');
					$window.unbind('.infscr');
					jQuery('.load-more-btn').on('click', function(e) {
						e.preventDefault();
						jQuery( infiniteScroll.contentSelector ).infinitescroll('retrieve');
						jQuery('.load-more-btn').css('display', 'none');
						$window.trigger('resize');
					});
				}
			} else {
				jQuery('.pagination-wrap').removeClass('hidden');
			}
		}
	};

	/////////////////////////////////////////////
	// SLIDER FUNCTIONS
	/////////////////////////////////////////////

	SWIFT.sliders = {
		init: function() {

			if ( jQuery('#product-img-slider').length > 0 ) {
				SWIFT.sliders.productSlider();
			}

			if ( jQuery('.item-slider').length > 0 ) {
				SWIFT.sliders.itemSlider();
			}

			if ( jQuery('.content-slider').length > 0 ) {
				SWIFT.sliders.contentSlider();
			}

		},
		itemSlider: function()  {
			jQuery('.item-slider > ul').lightSlider({
				item: 1,
	            pager: true,
	            controls: true,
	            slideMargin: 0,
	            adaptiveHeight: true,
	            loop: true,
	            rtl: isRTL,
	            auto: sliderAuto,
	            pause: sliderSlideSpeed,
	            speed: sliderAnimSpeed
			});
		},
		contentSlider: function() {
			var timeout;
			jQuery('.content-slider > ul').each(function() {
				var slider = jQuery(this),
					autoplay = ((slider.parent().attr('data-autoplay') === "yes") ? true : false);

				var contentSlider = slider.lightSlider({
					mode: "fade",
					item: 1,
		            pager: true,
		            controls: true,
		            slideMargin: 0,
		            adaptiveHeight: true,
		            loop: true,
		            rtl: isRTL,
		            auto: autoplay,
		            pause: sliderSlideSpeed,
		            speed: sliderAnimSpeed,
		            wrapperClass: "container",
		            onSliderLoad: function() {
			            contentSlider.removeClass('cS-hidden');
			        }
				});
				slider.parent().on('mouseenter',function() {
					if (autoplay) {
				    	contentSlider.pause();
				    	clearTimeout(timeout);
					}
				});
				slider.parent().on('mouseleave',function(){
					if (autoplay) {
				    	timeout = setTimeout(function () {
			    	        contentSlider.play();
			    	    }, sliderSlideSpeed);
				    }
				});
			});
		},
		productSlider: function() {

			var galleryMode = jQuery('#product-img-slider > ul > li').length > 1 ? true : false,
				galleryVertical = false,
				sliderVertHeight = parseInt(productSliderVertHeight, 10),
				thumbItems = 3,
				thumbItemsResponsive = 3,
				touchEnabled = true;
				
			if ( body.hasClass('product-fw-split') ) {
				productSliderThumbsPos = "left";
				sliderVertHeight = 1000;
			}
			
			if ( isMobileAlt || $window.width() <= 768 ) {
				productSliderThumbsPos = "bottom";
			}
			
			if ( productSliderThumbsPos === "left" ) {
				galleryVertical = true;
				jQuery('#product-img-slider').addClass('thumbs-left');
				thumbItems = Math.floor(sliderVertHeight / 100);
				thumbItemsResponsive = 3;
			}
	
			if ( hasProductZoomMobile && isMobileAlt ) {
				touchEnabled = false;	
			}
			
			jQuery('#product-img-slider').addClass('hidden');
			SWIFT.productSlider = jQuery('#product-img-slider > ul').lightSlider({
	            item: 1,
	            gallery: galleryMode,
	            autoWidth: false,
	            slideMargin: 0,
	            speed: 400, //ms'
	            auto: false,
	            loop: false,
	            vThumbWidth: 70,
	            vertical: galleryVertical,
	            verticalHeight: sliderVertHeight,
	            pause: 2000,
	            keyPress: true,
	            controls: true,
	            rtl: isRTL,
	            adaptiveHeight: true,
	            thumbItem: thumbItems,
	            thumbMargin: 30,
	            freeMove: false,
	            currentPagerPosition: 'middle',
	            swipeThreshold: 40,
	            enableTouch: touchEnabled,
	            responsive : [
		            {
		                breakpoint: 768,
		                settings: {
		                	verticalHeight: (sliderVertHeight / 2),
		                    thumbItem: thumbItemsResponsive,
		                }
		            }
		        ],
	            onSliderLoad: function (el) {
		            el.addClass('slider-loaded');
		            jQuery('#product-img-slider').removeClass('hidden');
		            if (hasProductZoom) {
						var currentImage = jQuery('#product-img-slider').find('.lslide.active .product-slider-image');
						SWIFT.woocommerce.productZoom(currentImage);
					}
					el.find('.product-slider-image').each(function(){
						var imgClass = (this.width/this.height >= 1) ? 'wide' : 'tall';
						jQuery(this).addClass(imgClass);
					});
	            	$window.trigger('resize');
	            },
	            onBeforeSlide: function () {
		            if (hasProductZoom) {
						jQuery('.zoomContainer').remove();
					}
	            },
	            onAfterSlide: function () {
	            	if ( isMobileAlt && hasProductZoomMobile ) {
	            		jQuery('.product-slider-image').each(function() {
	            			jQuery(this).panzoom('reset');
	            		});
	            	}
		            if (hasProductZoom) {
						var currentImage = jQuery('#product-img-slider').find('.lslide.active .product-slider-image');
						SWIFT.woocommerce.productZoom(currentImage);
					}
	            }
	        });
		},
		thumb: function() {
			if ( jQuery('.thumb-slider').length > 0 ) {
				jQuery('.thumb-slider > ul').lightSlider({
		            item: 1,
		            pager: true,
		            controls: true,
		            slideMargin: 0,
		            loop: true,
		            adaptiveHeight: true,
		            rtl: isRTL,
		            auto: sliderAuto,
		            pause: sliderSlideSpeed,
		            speed: sliderAnimSpeed
				});
			}
		}
	};

	/////////////////////////////////////////////
	// PORTFOLIO
	/////////////////////////////////////////////

	var portfolioContainer = jQuery('.portfolio-wrap').find('.filterable-items');

	SWIFT.portfolio = {
		init: function() {
			portfolioContainer.each(function() {
				var portfolioInstance = jQuery(this);
				if (portfolioInstance.hasClass('masonry-items') && !(IEVersion && IEVersion < 9)) {
					SWIFT.portfolio.masonrySetup(portfolioInstance);
				} else if (portfolioInstance.hasClass('multi-masonry-items') && !(IEVersion && IEVersion < 9)) {
					SWIFT.portfolio.multiMasonrySetup(portfolioInstance);
				} else {
					SWIFT.portfolio.standardSetup(portfolioInstance);
				}
			});

			// PORTFOLIO WINDOW RESIZE
			$window.smartresize( function() {
				SWIFT.portfolio.windowResized();
			});

			// Enable filter options on when there are items from that skill
			SWIFT.portfolio.setupFiltering();
			
			// filter items when filter link is clicked
			jQuery(document).on('click', '.portfolio-wrap .filtering li a', function(e) {
				e.preventDefault();
				jQuery(this).parent().parent().find('li').removeClass('selected');
				jQuery(this).parent().addClass('selected');
				var selector = jQuery(this).data('filter');
				var portfolioItems = jQuery(this).parents('.portfolio-wrap').find('.filterable-items');
				portfolioItems.isotope({ filter: selector });
			});

			jQuery(document).on('click', '.filter-wrap > a', function(e) {
				e.preventDefault();
				jQuery(this).parent().find('.filter-slide-wrap').slideToggle();
			});
		},
		setupFiltering: function() {
			jQuery('.portfolio-wrap .filtering li').each( function() {
				var filter = jQuery(this),
					filterName = jQuery(this).find('a').attr('class'),
					portfolioItems = jQuery(this).parents('.portfolio-wrap').find('.filterable-items'),
					itemCount = 0;
					
				if ( filter.hasClass('all') ) {
					itemCount = portfolioItems.find('.portfolio-item').length;
				}
	
				portfolioItems.find('.portfolio-item').each( function() {
					if ( jQuery(this).hasClass(filterName) ) {
						filter.addClass('has-items');
						itemCount++;
					}
				});
				if ( filter.find('sup.count').length > 0 ) {
					filter.find('sup.count').text(itemCount);
				} else {
					filter.find('a').append('<sup class="count">'+itemCount+'</sup>');
				}
			}).parents('.filtering').animate({
				opacity: 1
			}, 400);
		},
		standardSetup: function(portfolioInstance) {
			portfolioInstance.imagesLoaded(function () {
				SWIFT.sliders.thumb();
				SWIFT.portfolio.setItemHeight();
				portfolioInstance.animate({opacity: 1}, 800);
				portfolioInstance.isotope({
					resizable: true,
					layoutMode: 'fitRows',
					isOriginLeft: !isRTL
				});
				setTimeout(function() {
					SWIFT.portfolio.setItemHeight();
					$window.trigger('resize');
					portfolioInstance.isotope('layout');
				}, 1000);
			});
			portfolioInstance.appear(function() {
				SWIFT.portfolio.animateItems(portfolioInstance);
			});
		},
		masonrySetup: function(portfolioInstance) {
			portfolioInstance.imagesLoaded(function () {
				SWIFT.sliders.thumb();
				portfolioInstance.isotope({
					resizable: false,
					itemSelector : '.portfolio-item',
					layoutMode: 'masonry',
					isOriginLeft: !isRTL
				});
				setTimeout(function() {
					portfolioInstance.isotope('layout');
				}, 500);
			});
			portfolioInstance.appear(function() {
				SWIFT.portfolio.animateItems(portfolioInstance);
			});
		},
		multiMasonrySetup: function(portfolioInstance) {
			portfolioInstance.imagesLoaded(function () {
				SWIFT.sliders.thumb();
				SWIFT.portfolio.multiMasonrySizeFix(false);
				var grid = portfolioInstance.isotope({
					resizable: false,
					itemSelector : '.portfolio-item',
					layoutMode: 'packery',
					packery: {
						columnWidth: '.grid-sizer'
					},
					isOriginLeft: !isRTL
				});
				setTimeout(function() {
					portfolioInstance.isotope('layout');
				}, 500);
			});
			portfolioInstance.appear(function() {
				setTimeout( function() {
					SWIFT.portfolio.animateItems(portfolioInstance);
				}, 300);		
			});
		},
		animateItems: function(portfolioInstance) {
			portfolioInstance.find('.portfolio-item').each(function(i) {
				jQuery(this).delay(i*200).animate({
					'opacity' : 1
				}, 800, 'easeOutExpo', function() {
					jQuery(this).addClass('item-animated');
				});
			});
		},
		setItemHeight: function() {
			if (!portfolioContainer.hasClass('col-1') && !portfolioContainer.hasClass('masonry-items') && !portfolioContainer.hasClass('multi-masonry-items')) {
				portfolioContainer.children().css('min-height','0');
				portfolioContainer.equalHeights();
			}
		},
		multiMasonrySizeFix: function($init) {
			
			// Fix for 1/2 pixel display causing layout issues
			portfolioContainer.find('.portfolio-item.size-standard .multi-masonry-img-wrap').each(function() {
				jQuery(this).css('height', '').css('height', Math.floor( jQuery(this).height() ) );
			});
			
			var baseItem = portfolioContainer.find('.portfolio-item.size-standard').first(),
				standardHeight = baseItem.height(),
				largeHeight = (standardHeight * 2) + parseInt(baseItem.css('margin-bottom'), 10);
			
			if ( standardHeight > 0 ) {
				largeHeight = (standardHeight * 2) + parseInt(baseItem.css('margin-bottom'), 10);
			} else {
				var firstItem = portfolioContainer.find('.portfolio-item.size-tall,.portfolio-item.size-wide-tall').first();
				largeHeight = firstItem.height();
				standardHeight = (largeHeight / 2) - parseInt(baseItem.css('margin-bottom'), 10);			
			}
			
			// Set non-standard sized items
			if (largeHeight > 0) {
				portfolioContainer.find('.portfolio-item.size-wide .multi-masonry-img-wrap').css('height', standardHeight);
				portfolioContainer.find('.portfolio-item.size-wide-tall .multi-masonry-img-wrap').css('height', largeHeight);
				portfolioContainer.find('.portfolio-item.size-tall .multi-masonry-img-wrap').css('height', largeHeight);
				
				// Wide tall sliders
				var heightDiff = (portfolioContainer.find('.portfolio-item.size-wide-tall ul.slides > li').first().height() - largeHeight) / 2;
				portfolioContainer.find('.portfolio-item.size-wide-tall ul.slides').css('max-height', largeHeight);
				portfolioContainer.find('.portfolio-item.size-wide-tall ul.slides > li').css('margin-top', -heightDiff);
				
				// Wide sliders
				var wideHeightDiff = (portfolioContainer.find('.portfolio-item.size-wide ul.slides > li').first().height() - standardHeight) / 2;
				portfolioContainer.find('.portfolio-item.size-wide ul.slides').css('max-height', standardHeight);
				portfolioContainer.find('.portfolio-item.size-wide ul.slides > li').css('margin-top', -wideHeightDiff);
				
			}
			
			// if isotope is initiated, relayout items
			if ($init) {
				portfolioContainer.isotope('layout');
			}
		},
		windowResized: function() {
			if (!portfolioContainer.hasClass('col-1') && !portfolioContainer.hasClass('masonry-items') && !portfolioContainer.hasClass('multi-masonry-items')) {
				SWIFT.portfolio.setItemHeight();
			}

			if (portfolioContainer.hasClass('multi-masonry-items')) {
				SWIFT.portfolio.multiMasonrySizeFix(true);
			}
		},
		infiniteScroll: function() {
			if (!(IEVersion && IEVersion < 9)) {
				var infScrollData = jQuery('#inf-scroll-params');
				var isLoadMore = portfolioContainer.parent().find('.pagination-wrap').hasClass('load-more') ? true : false;
				
				if ( !portfolioContainer.parent().find('.pagination-wrap').hasClass('infinite-scroll-enabled') ) {
					return;
				}

				var infiniteScroll = {
					loading: {
						img: infScrollData.data('loadingimage'),
						msgText: isLoadMore ? infScrollData.data('msgtext') : '',
						finishedMsg: isLoadMore ? infScrollData.data('finishedmsg') : '',
						selector: '.portfolio-wrap .spb-asset-content',
						loaderHTML: jQuery('body > .sf-svg-loader').html()
					},
					"nextSelector":".pagenavi li.next a",
					"navSelector":".pagenavi",
					"itemSelector":".portfolio-item",
					"contentSelector":".portfolio-items",
					errorCallback: function () {
						setTimeout(function() {
							jQuery( '#infscr-loading' ).animate({
								'opacity' : 0
							}, 500);
						}, 1000);
					},
				};
				jQuery( infiniteScroll.contentSelector ).infinitescroll(
					infiniteScroll, function(elements) {
						SWIFT.sliders.thumb();
						portfolioContainer.imagesLoaded(function () {
							portfolioContainer.isotope( 'appended', elements );
							jQuery.each(elements, function(i, element) {
								jQuery(element).addClass('item-animated');
							});
						});
						jQuery('[data-rel="ilightbox[portfolio]"]').removeClass('ilightbox-enabled').iLightBox().destroy();
						SWIFT.page.lightbox();
						SWIFT.portfolio.setupFiltering();
						if (portfolioContainer.parent().find('.pagination-wrap').hasClass('load-more')) {
							setTimeout(function() {
								jQuery('.load-more-btn').css('display', 'block');							
							}, 200);
						}
					}
				);
				if (isLoadMore) {
					portfolioContainer.parent().addClass('portfolio-load-more-pagination');
					$window.unbind('.infscr');
					jQuery('.load-more-btn').on('click', function(e) {
						e.preventDefault();
						jQuery( infiniteScroll.contentSelector ).infinitescroll('retrieve');
						jQuery('.load-more-btn').css('display', 'none');
						$window.trigger('resize');
					});
				}
			} else {
				jQuery('.pagination-wrap').removeClass('hidden');
			}
		}
	};


	/////////////////////////////////////////////
	// BLOG
	/////////////////////////////////////////////

	var blogItems = jQuery('.blog-wrap').find('.blog-items');

	SWIFT.blog = {
		init: function() {

			// BLOG ITEM SETUP
			blogItems.each(function() {
				var blogInstance = jQuery(this);
				if (blogInstance.hasClass('blog-grid-items')) {
					SWIFT.blog.blogGrid(blogInstance.find('.grid-items'));
				} else if (blogInstance.hasClass('timeline-items')) {
					SWIFT.blog.blogTimeline(blogInstance);
				} else {
					SWIFT.blog.blogLayout(blogInstance);
				}
			});

			// Blog Filtering
			SWIFT.blog.blogFiltersInit();

			// BLOG AUX SLIDEOUT
			jQuery('.blog-slideout-trigger').on('click', function(e) {
				e.preventDefault();

				// VARIABLES
				var blogWrap = jQuery(this).parent().parent().parent().parent();
				var filterPanel = blogWrap.find('.blog-filter-wrap .filter-slide-wrap');
				var auxType = jQuery(this).attr('data-aux');

				// ADD COLUMN SIZE AND REMOVE BRACKETS FROM COUNT
				blogWrap.find('.aux-list li').addClass('col-sm-sf-5');
				blogWrap.find('.aux-list li a span').each(function() {
					jQuery(this).html(jQuery(this).html().replace("(","").replace(")",""));
				});

				// IF SELECTING AN OPTION THAT IS OPEN, CLOSE THE PANEL
				if (jQuery(this).parent().hasClass('selected') && !filterPanel.is(':animated')) {
					blogWrap.find('.blog-aux-options li').removeClass('selected');
					filterPanel.slideUp(400);
					return;
				}

				// AUX BUTTON SELECTED STATE
				blogWrap.find('.blog-aux-options li').removeClass('selected');
				jQuery(this).parent().addClass('selected');

				// IF SLIDEOUT IS OPEN
				if (filterPanel.is(':visible')) {

					filterPanel.slideUp(400);
					setTimeout(function() {
						blogWrap.find('.aux-list').css('display', 'none');
						blogWrap.find('.aux-'+auxType).css('display', 'block');
						filterPanel.slideDown();
					}, 600);

				// IF SLIDEOUT IS CLOSED
				} else {

					blogWrap.find('.aux-list').css('display', 'none');
					blogWrap.find('.aux-'+auxType).css('display', 'block');
					filterPanel.slideDown();

				}
			});

		},
		blogFiltersInit: function() {

			SWIFT.blog.blogShowFilters();
			jQuery('.filtering').animate({
				opacity: 1
			}, 400);

			// filter items when filter link is clicked
			jQuery('.blog-wrap .filtering li').on('click', 'a', function(e) {
				e.preventDefault();
				jQuery(this).parent().parent().find('li').removeClass('selected');
				jQuery(this).parent().addClass('selected');
				var selector = jQuery(this).data('filter');
				var blogItems = jQuery(this).parents('.blog-wrap').find('.blog-items');
				blogItems.isotope({ filter: selector });
			});

			jQuery('.filter-wrap > a').on('click', function(e) {
				e.preventDefault();
				jQuery(this).parent().find('.filter-slide-wrap').slideToggle();
			});
		},
		blogShowFilters: function() {
			// Enable filter options on when there are items from that skill
			jQuery('.blog-wrap .filtering li').each( function() {
				var filter = jQuery(this),
					filterName = jQuery(this).find('a').attr('class'),
					blogItems = jQuery(this).parents('.blog-wrap').find('.blog-items'),
					itemCount = 0;
				
				if ( filter.hasClass('all') ) {
					itemCount = blogItems.find('.blog-item').length;
				}

				blogItems.find('.blog-item').each( function() {
					if ( jQuery(this).hasClass(filterName) ) {
						filter.addClass('has-items');
						itemCount++;
					}
				});
				if ( filter.find('sup.count').length > 0 ) {
					filter.find('sup.count').text(itemCount);
				} else {
					filter.find('a').append('<sup class="count">'+itemCount+'</sup>');
				}
			});
		},
		blogLayout: function(blogInstance) {

			var blogType = blogInstance.data('blog-type'),
				layoutMode = 'fitRows';

			if (blogType === "masonry") {
				layoutMode = 'masonry';
			}

			if (blogType === "masonry" && blogInstance.hasClass('social-blog')) {
				var tweets = blogInstance.parent().find('.blog-tweets').html(),
					instagrams = blogInstance.parent().find('.blog-instagrams');

				blogInstance.imagesLoaded(function () {
					SWIFT.sliders.thumb();
					blogInstance.isotope({
						resizable: false,
						itemSelector : '.blog-item',
						layoutMode: 'masonry',
						getSortData : {
							date : function ( elem ) {
								return jQuery(elem).data('date');
							}
						},
						sortBy: 'date',
						sortAscending: false,
						isOriginLeft: !isRTL
					});
					blogInstance.addClass('isotope-loaded');
					if (tweets !== "") {
					blogInstance.isotope('insert', jQuery(tweets));
					}
					if (instagrams.length > 0) {
					SWIFT.blog.masonryInstagram(instagrams, blogInstance);
					}
					blogInstance.isotope('updateSortData').isotope();
					setTimeout(function() {
						blogInstance.isotope('layout');
					}, 500);
				});

			} else {
				blogInstance.imagesLoaded(function () {
					SWIFT.sliders.thumb();
					blogInstance.isotope({
						resizable: true,
						layoutMode: layoutMode,
						isOriginLeft: !isRTL
					});
					blogInstance.addClass('isotope-loaded');
					setTimeout(function() {
						blogInstance.isotope('layout');
					}, 500);
				});
				blogInstance.appear(function() {
					SWIFT.blog.animateItems(blogInstance);
				});
			}
		},
		masonryInstagram: function(instagrams, blogItems) {
			var userID = instagrams.data('userid'),
				token = instagrams.data('token'),
				count = instagrams.data('count'),
				itemClass = instagrams.data('itemclass'),
				clientid = '756db9880cc84c3dab85118df38f9b91';

			jQuery.ajax({
				url: 'https://api.instagram.com/v1/users/' + userID + '/media/recent?access_token=' + token, // specify the ID of the first found user
				dataType: 'jsonp',
				type: 'GET',
				data: {client_id: clientid, count: count},
				success: function(data) {
					for (var i = 0; i < count; i++) {
						if (data.data[i]) {
							var caption = "";
							if (data.data[i].caption) {
								caption = data.data[i].caption.text;
							}
							var imageSrc = data.data[i].images.low_resolution.url;
							if (imageSrc.indexOf("?ig_cache_key") >= 0) {
								imageSrc = imageSrc.substr(0, imageSrc.indexOf('?ig_cache_key')); 
							}
							instagrams.append("<li class='blog-item instagram-item "+itemClass+"' data-date='"+data.data[i].created_time+"'><div class='blog-item-wrap'><figure><div class='inst-overlay'><a target='_blank' href='" + data.data[i].link +"'></a><h3>"+caption+"</h3><data class='date timeago' title='"+data.data[i].created_time+"' value=''>"+data.data[i].created_time+"</data></div><img class='instagram-image' src='" + imageSrc +"' width='306px' height='306px' /></figure></div></li>");
						}
					}
					jQuery("data.timeago").timeago();
					instagrams.imagesLoaded(function(){
						blogItems.isotope('insert', jQuery(instagrams.html()));
					});
					blogItems.isotope('updateSortData').isotope();
				},
				error: function(data2) {
					console.log(data2);
				}
			});
		},
		animateItems: function(blogInstance) {
			blogInstance.find('.blog-item').each(function(i) {
				jQuery(this).delay(i*200).animate({
					'opacity' : 1,
				}, 800, 'easeOutExpo', function() {
					jQuery(this).addClass('item-animated');
				});
			});
		},
		blogGrid: function(gridItems) {
			var tweets = gridItems.parent().find('.blog-tweets').html(),
				instagrams = gridItems.parent().find('.blog-instagrams');

			gridItems.imagesLoaded(function () {
				SWIFT.sliders.thumb();
				gridItems.isotope({
					resizable: false,
					itemSelector : '.blog-item',
					layoutMode: 'fitRows',
					getSortData : {
						id : function ( elem ) {
							return jQuery(elem).data('sortid');
						},
						date : function ( elem ) {
							return jQuery(elem).data('date');
						}
					},
					sortBy: 'id',
					sortAscending: true,
					isOriginLeft: !isRTL
				});
				setTimeout(function() {
					gridItems.isotope('layout');
				}, 500);
				if (tweets !== "") {
				gridItems.isotope('insert', jQuery(tweets));
				}
				if (instagrams.length > 0) {
				SWIFT.blog.blogGridInstagram(instagrams, gridItems);
				}
				gridItems.isotope('updateSortData').isotope();
				SWIFT.blog.blogGridResize();
			}).animate({
				'opacity' : 1
			}, 800, 'easeOutExpo');

			$window.smartresize( function() {
				SWIFT.blog.blogGridResize();
			});
		},
		blogTimeline: function(blogItems) {
			SWIFT.timelineBlocks = blogItems.find('.blog-item');
			
			// hide timeline blocks which are outside the viewport
			SWIFT.blog.blogTimelineHideBlocks(SWIFT.timelineBlocks, SWIFT.timelineOffset);
			
			// show visible blocks
			SWIFT.blog.blogTimelineShowBlocks(SWIFT.timelineBlocks, SWIFT.timelineOffset);
			
			blogItems.imagesLoaded(function () {
				SWIFT.sliders.thumb();
			});
		
			//on scolling, show/animate timeline blocks when enter the viewport
			jQuery(window).on('scroll', function() {
				if (!window.requestAnimationFrame) {
					setTimeout( function() {
						SWIFT.blog.blogTimelineShowBlocks(SWIFT.timelineBlocks, SWIFT.timelineOffset);
					}, 100);
				} else {
					window.requestAnimationFrame( function() {
						SWIFT.blog.blogTimelineShowBlocks(SWIFT.timelineBlocks, SWIFT.timelineOffset);
					});
				}
			});
		},
		blogTimelineShowBlocks: function(blocks, offset) {
			blocks.each(function() {
				if ( jQuery(this).offset().top <= jQuery(window).scrollTop()+jQuery(window).height()*offset && jQuery(this).find('.timeline-item-content-wrap').hasClass('is-hidden') ) {
					jQuery(this).find('.timeline-item-format-icon, .timeline-item-content-wrap').removeClass('is-hidden').addClass('bounce-in');
				}
			});
		},
		blogTimelineHideBlocks: function(blocks, offset) {
			blocks.each(function() {
				if ( jQuery(this).offset().top > jQuery(window).scrollTop()+jQuery(window).height()*offset ) {
					jQuery(this).find('.timeline-item-format-icon, .timeline-item-content-wrap').addClass('is-hidden');
				}
			});
		},
		blogGridResize: function() {
			blogItems.find('.grid-items').each(function() {
				var gridItem = jQuery(this).find('.blog-item'),
					itemWidth = gridItem.first().width();
				if (gridItem.first().hasClass('col-sm-sf-25')) {
					itemWidth = itemWidth / 2;
				}
				gridItem.css('height', itemWidth);
			});
			setTimeout(function() {
				blogItems.find('.tweet-text,.quote-excerpt').dotdotdot();
				blogItems.find('.grid-items').isotope('layout');
			}, 500);
		},
		blogGridInstagram: function(instagrams, gridItems) {
			var userID = instagrams.data('userid'),
				token = instagrams.data('token'),
				count = instagrams.data('count'),
				itemClass = instagrams.data('itemclass'),
				grid_count = 1,
				clientid = '756db9880cc84c3dab85118df38f9b91';
			
			jQuery.ajax({
				url: 'https://api.instagram.com/v1/users/' + userID + '/media/recent?access_token=' + token, // specify the ID of the first found user
				dataType: 'jsonp',
				type: 'GET',
				data: {client_id: clientid, count: count},
				success: function(data) {
					for (var i = 0; i < count; i++) {
						if (data.data[i]) {
							var caption = "";
							if (data.data[i].caption) {
								caption = data.data[i].caption.text;
							}
							var imageSrc = data.data[i].images.low_resolution.url;
							if (imageSrc.indexOf("?ig_cache_key") >= 0) {
								imageSrc = imageSrc.substr(0, imageSrc.indexOf('?ig_cache_key')); 
							}
							instagrams.append("<li class='blog-item "+itemClass+" instagram-item' data-date='"+data.data[i].created_time+"' data-sortid='" + grid_count + "'><figure><div class='inst-overlay'><a target='_blank' href='" + data.data[i].link +"'></a><h3>"+caption+"</h3><data class='date timeago' title='"+data.data[i].created_time+"' value=''>"+data.data[i].created_time+"</data></div><img class='instagram-image' src='" + imageSrc +"' width='306px' height='306px' /></figure></li>");
							grid_count += 2;
						}
					}
					jQuery("data.timeago").timeago();
					SWIFT.blog.blogGridResize();
					instagrams.imagesLoaded(function(){
						gridItems.isotope('insert', jQuery(instagrams.html()));
						SWIFT.blog.blogGridResize();
					});
					gridItems.isotope('updateSortData').isotope();
				},
				error: function(data2) {
					console.log(data2);
				}
			});
		},
		infiniteScroll: function() {
			if (!(IEVersion && IEVersion < 9)) {
				var infScrollData = jQuery('#inf-scroll-params');
				var isLoadMore = blogItems.parent().find('.pagination-wrap').hasClass('load-more') ? true : false;
				
				if ( !blogItems.parent().find('.pagination-wrap').hasClass('infinite-scroll-enabled') ) {
					return;
				}
				
				var infiniteScroll = {
					loading: {
						img: infScrollData.data('loadingimage'),
						msgText: isLoadMore ? infScrollData.data('msgtext') : '',
						finishedMsg: isLoadMore ? infScrollData.data('finishedmsg') : '',
						selector: '.blog-items-wrap',
						loaderHTML: jQuery('body > .sf-svg-loader').html()
					},
					"nextSelector":".pagenavi li.next a",
					"navSelector":".pagenavi",
					"itemSelector":".blog-item",
					"contentSelector":".blog-items",
					errorCallback: function () {
						setTimeout(function() {
							jQuery( '#infscr-loading' ).animate({
								'opacity' : 0
							}, 500);
						}, 1000);
					},
				};
				jQuery( infiniteScroll.contentSelector ).infinitescroll(
					infiniteScroll, function(elements) {
						SWIFT.sliders.thumb();
						SWIFT.page.mediaPlayer();
						if ( blogItems.hasClass('timeline-items') ) {
							SWIFT.timelineBlocks = blogItems.find('.blog-item');
							SWIFT.blog.blogTimelineShowBlocks(SWIFT.timelineBlocks, SWIFT.timelineOffset);
						}
						blogItems.imagesLoaded(function () {
							if ( blogItems.hasClass('isotope-loaded') ) {
								blogItems.isotope( 'appended', elements );
							}
							jQuery.each(elements, function(i, element) {
								jQuery(element).addClass('item-animated');
							});
						});
						jQuery('[data-rel="ilightbox[posts]"]').removeClass('ilightbox-enabled').iLightBox().destroy();
						SWIFT.page.lightbox();
						SWIFT.blog.blogShowFilters();
						if (blogItems.parent().find('.pagination-wrap').hasClass('load-more')) {
							setTimeout(function() {
								jQuery('.load-more-btn').css('display', 'block');							
							}, 200);
						}
					}
				);
				if (isLoadMore) {
					blogItems.parent().addClass('blog-load-more-pagination');
					$window.unbind('.infscr');
					jQuery('.load-more-btn').on('click', function(e) {
						e.preventDefault();
						jQuery( infiniteScroll.contentSelector ).infinitescroll('retrieve');
						jQuery('.load-more-btn').css('display', 'none');
						$window.trigger('resize');
					});
				}
			} else {
				jQuery('.pagination-wrap').removeClass('hidden');
			}
		}
	};

	/////////////////////////////////////////////
	// GALLERIES
	/////////////////////////////////////////////

	var galleriesContainer = jQuery('.galleries-wrap').find('.filterable-items');

	SWIFT.galleries = {
		init: function() {
			galleriesContainer.each(function() {
				var galleriesInstance = jQuery(this);
				if (galleriesInstance.hasClass('masonry-items')) {
					SWIFT.galleries.masonrySetup(galleriesInstance);
				} else {
					SWIFT.galleries.standardSetup(galleriesInstance);
				}
			});

			// PORTFOLIO WINDOW RESIZE
			$window.smartresize( function() {
				SWIFT.galleries.windowResized();
			});

			// Enable filter options on when there are items from that skill
			jQuery('.galleries-wrap .filtering li').each( function() {
				var filter = jQuery(this),
					filterName = jQuery(this).find('a').attr('class'),
					galleryItems = jQuery(this).parents('.galleries-wrap').find('.filterable-items'),
					itemCount = 0;
				
				if ( filter.hasClass('all') ) {
					itemCount = galleryItems.find('.gallery-item').length;
				}

				galleryItems.find('.gallery-item').each( function() {
					if ( jQuery(this).hasClass(filterName) ) {
						filter.addClass('has-items');
						itemCount++;
					}
				});
				if ( filter.find('sup.count').length > 0 ) {
					filter.find('sup.count').text(itemCount);
				} else {
					filter.find('a').append('<sup class="count">'+itemCount+'</sup>');
				}
			}).parents('.filtering').animate({
				opacity: 1
			}, 400);

			// filter items when filter link is clicked
			jQuery('.galleries-wrap .filtering li').on('click', 'a', function(e) {
				e.preventDefault();
				jQuery(this).parent().parent().find('li').removeClass('selected');
				jQuery(this).parent().addClass('selected');
				var selector = jQuery(this).data('filter');
				var galleryItems = jQuery(this).parents('.galleries-wrap').find('.filterable-items');
				galleryItems.isotope({ filter: selector });
			});
		},
		standardSetup: function(galleryInstance) {
			galleryInstance.imagesLoaded(function () {
				SWIFT.galleries.setItemHeight();
				galleryInstance.animate({opacity: 1}, 800);
				galleryInstance.isotope({
					resizable: true,
					layoutMode: 'fitRows',
					isOriginLeft: !isRTL
				});
				setTimeout(function() {
					galleryInstance.isotope('layout');
				}, 500);
			});
			galleryInstance.appear(function() {
				SWIFT.galleries.animateItems(galleryInstance);
			});
		},
		masonrySetup: function(galleryInstance) {
			galleryInstance.imagesLoaded(function () {
				galleryInstance.isotope({
					resizable: false,
					itemSelector : '.gallery-item',
					layoutMode: 'masonry',
					isOriginLeft: !isRTL
				});
				setTimeout(function() {
					galleryInstance.isotope('layout');
				}, 500);
			});
			galleryInstance.appear(function() {
				SWIFT.galleries.animateItems(galleryInstance);
			});
		},
		animateItems: function(galleryInstance) {
			galleryInstance.find('.gallery-item').each(function(i) {
				jQuery(this).delay(i*200).animate({
					'opacity' : 1
				}, 800, 'easeOutExpo', function() {
					jQuery(this).addClass('item-animated');
				});
			});
		},
		setItemHeight: function() {
			if (!galleriesContainer.hasClass('col-1') && !galleriesContainer.hasClass('masonry-items')) {
				galleriesContainer.children().css('min-height','0');
				galleriesContainer.equalHeights();
			}
		},
		windowResized: function() {
			if (!galleriesContainer.hasClass('col-1') && !galleriesContainer.hasClass('masonry-items')) {
				SWIFT.galleries.setItemHeight();
			}
		},
	};


	/////////////////////////////////////////////
	// GALLERY
	/////////////////////////////////////////////

	SWIFT.gallery = {
		init: function() {

			jQuery('.spb_gallery_widget').each(function() {
				if (jQuery(this).hasClass('gallery-masonry')) {
					SWIFT.gallery.galleryMasonry(jQuery(this).find('.filterable-items'));
				} else if (jQuery(this).hasClass('gallery-slider')) {
					SWIFT.gallery.gallerySlider(jQuery(this));
				}
			});
		},
		galleryMasonry: function(element) {
			element.imagesLoaded(function () {
				element.isotope({
					resizable: false,
					itemSelector : '.gallery-image',
					layoutMode: 'masonry',
					isOriginLeft: !isRTL
				});
				setTimeout(function() {
					element.isotope('layout');
				}, 500);
			});
			element.appear(function() {
				SWIFT.gallery.animateItems(element);
			});
		},
		animateItems: function(element) {
			element.find('.gallery-image').each(function(i) {
				jQuery(this).delay(i*200).animate({
					'opacity' : 1
				}, 800, 'easeOutExpo', function() {
					jQuery(this).addClass('item-animated');
				});
			});
		},
		gallerySlider: function(element) {

			var gallerySlider = element.find('.gallery-slider > ul'),
				galleryAuto = gallerySlider.parent().data('autoplay') === "yes" ? true : false,
				galleryThumbs = gallerySlider.parent().data('thumbs') === "yes" ? true : false;

			gallerySlider.lightSlider({
				mode: gallerySlider.parent().data('transition'),
	            item: 1,
	            gallery: galleryThumbs,
	            autoWidth: false,
	            slideMargin: 0,
	            speed: sliderAnimSpeed, //ms'
	            auto: galleryAuto,
	            loop: true,
	            pause: sliderSlideSpeed,
	            keyPress: true,
	            controls: true,
	            rtl: isRTL,
	            adaptiveHeight: true,
	            thumbMargin: 30,
	            galleryMargin: 30,
	            currentPagerPosition: 'middle',
	            swipeThreshold: 40,
	            responsive : [
		            {
		                breakpoint: 1024,
		                settings: {
		                    thumbItem: 3,
		                }
		            }
		        ],
		        onSliderLoad: function (el) {
		            el.addClass('slider-loaded');
		        }
	        });


		}
	};


	/////////////////////////////////////////////
	// RECENT POSTS
	/////////////////////////////////////////////

	SWIFT.recentPosts = {
		init: function() {

			// TEAM EQUAL HEIGHTS
			var recentPostAsset = jQuery('.recent-posts:not(.carousel-items,.posts-type-list)');
			recentPostAsset.imagesLoaded(function () {
				SWIFT.sliders.thumb();
			});

			// TEAM ASSETS
			$window.smartresize( function() {
				jQuery('.recent-posts:not(.carousel-items,.posts-type-list)').children().css('min-height','0');
				jQuery('.recent-posts:not(.carousel-items,.posts-type-list)').equalHeights();
			});
		},
		load: function() {
			setTimeout(function() {
				jQuery('.recent-posts:not(.carousel-items,.posts-type-list)').children().css('min-height','0');
				jQuery('.recent-posts:not(.carousel-items,.posts-type-list)').equalHeights();
			}, 400);
		}
	};


	/////////////////////////////////////////////
	// CAROUSEL FUNCTIONS
	/////////////////////////////////////////////

	SWIFT.carouselWidgets = {
		init: function() {

			// CAROUSELS
			var carousel = jQuery('.carousel-items'),
				carouselAuto = sfOptionParams.data('carousel-autoplay'),
				carouselPSpeed = sfOptionParams.data('carousel-pagespeed'),
				carouselSSpeed = sfOptionParams.data('carousel-slidespeed'),
				carouselPagination = sfOptionParams.data('carousel-pagination'),
				carouselPDirection = 'ltr',
				desktopWidth = 1199;

			if (body.hasClass('vertical-header')) {
				desktopWidth = desktopWidth + jQuery('#header-section').width();
			}

			if (carouselAuto) {
				carouselAuto = true;
			} else {
				carouselAuto = false;
			}
			if (carouselPagination) {
				carouselPagination = true;
			} else {
				carouselPagination = false;
			}
			if (isRTL) {
				carouselPDirection = 'rtl';
			}

			carousel.each(function() {
				var carouselInstance = jQuery('#'+jQuery(this).attr('id')),
					carouselColumns = parseInt(carouselInstance.attr("data-columns"), 10),
					desktopCarouselItems = 4 > carouselColumns ? carouselColumns : 4,
					desktopSmallCarouselItems = 3 > carouselColumns ? carouselColumns : 3,
					mobileCarouselItems = 1,
					testimonialShowcase = jQuery(this).parents('.showcase_testimonial_widget').length > 0 ? true : false;
				
				var carouselAutoplay = false;
				
				if ( typeof carouselInstance.data('autoplay') !== 'undefined') {
					carouselAutoplay = carouselInstance.data('autoplay');
				} else {
					carouselAutoplay = carouselAuto;
				}
								
				if (carouselInstance.hasClass('clients-items')) {
					mobileCarouselItems = 2;
				}
				
				if (carouselInstance.hasClass('testimonials')) {
					desktopCarouselItems = 1;
					desktopSmallCarouselItems = 1;
					mobileCarouselItems = 1;
				}
				
				if (testimonialShowcase) {
					carouselPagination = true;
				}
				
				carouselInstance.imagesLoaded(function () {

					if ( !carouselInstance.hasClass('no-gutters') ) {
						SWIFT.carouselWidgets.carouselSetWidth(carouselInstance);
					}
					
					if ( carouselInstance.hasClass('staged-carousel') ) {
						SWIFT.carouselWidgets.carouselStagedSetWidth(carouselInstance);
						carouselPagination = carouselInstance.attr("data-pagination") === "yes" ? true : false;
					}

					carouselInstance.owlCarousel({
						items : carouselColumns,
						itemsDesktop: [desktopWidth,desktopCarouselItems],
						itemsDesktopSmall: [desktopWidth-220,desktopSmallCarouselItems],
						itemsTablet: mobileCarouselItems,
						itemsMobile: [479,mobileCarouselItems],
						paginationSpeed: carouselPSpeed,
						slideSpeed: carouselSSpeed,
						autoPlay: carouselAutoplay,
						autoPlayDirection : carouselPDirection,
						pagination: carouselPagination,
						autoHeight : false,
						beforeUpdate: function() {
							if ( !carouselInstance.hasClass('no-gutters') ) {
								SWIFT.carouselWidgets.carouselSetWidth(carouselInstance);
							}
							
							if ( carouselInstance.hasClass('staged-carousel') ) {
								SWIFT.carouselWidgets.carouselStagedSetWidth(carouselInstance);
								SWIFT.carouselWidgets.carouselStagedSetActive(carouselInstance);
							}	
						},
						afterUpdate: function () {
							setTimeout(function() {
								SWIFT.sliders.thumb();
								SWIFT.carouselWidgets.carouselStagedSetActive(carouselInstance);
							}, 200);
						},
						afterInit: function() {
							SWIFT.sliders.thumb();
							if ( carouselInstance.hasClass('staged-carousel') ) {
								carouselInstance.find('.owl-item:eq(1),.owl-item:eq(2),.owl-item:eq(3)').addClass('active');
							}
							setTimeout(function() {
								$window.trigger('resize');
								SWIFT.parallax.init(true);
							}, 200);
							if ( testimonialShowcase ) {
								 carouselInstance.find('.owl-pagination').append( carouselInstance.parents('.showcase_testimonial_widget').find('.read-more') );
							}
							if ( carouselInstance.hasClass('staged-carousel') ) { 
								carouselInstance.find('.owl-pagination').append( carouselInstance.parents('.spb-asset-content').parent().find('.view-all') );
								carouselInstance.find('.owl-pagination .view-all').removeClass('hidden');
							}
								
							// Set staged carousel active on window resize
							if ( carouselInstance.hasClass('staged-carousel') ) {
								$window.smartresize( function() {
									setTimeout(function() {
										SWIFT.carouselWidgets.carouselStagedSetActive(carouselInstance);
									}, carouselSSpeed);
									setTimeout(function() {
										SWIFT.carouselWidgets.carouselStagedSetActive(carouselInstance);
									}, carouselPSpeed);
								});
							}
						},
						afterAction: function(){
							if ( carouselInstance.hasClass('staged-carousel') ) {
								setTimeout(function() {
									SWIFT.carouselWidgets.carouselStagedSetActive(carouselInstance);
								}, carouselSSpeed);
								setTimeout(function() {
									SWIFT.carouselWidgets.carouselStagedSetActive(carouselInstance);
								}, carouselPSpeed);
							}
							
							// Show/hide next+prev arrows							
							var carouselNext = carouselInstance.parents('.carousel-wrap').find('.carousel-next'),
								carouselPrev = carouselInstance.parents('.carousel-wrap').find('.carousel-prev');
								
						    if ( this.itemsAmount > this.visibleItems.length ) {
						        carouselNext.show();
						        carouselPrev.show();
						
						        carouselNext.removeClass('disabled');
						        carouselPrev.removeClass('disabled');
						        if ( this.currentItem === 0 ) {
						            carouselPrev.addClass('disabled');
						        }
						        if ( this.currentItem == this.maximumItem ) {
						            carouselNext.addClass('disabled');
						        }
						
						    } else {
						        carouselNext.hide();
						        carouselPrev.hide();
						    }
						}
					}).animate({
						'opacity': 1
					},800);
				});
			});

			// Previous
			jQuery('.carousel-next').on('click', function(e) {
				e.preventDefault();
				var carousel = jQuery(this).closest('.spb_content_element').find('.owl-carousel');
				if (isRTL) {
				carousel.data( 'owlCarousel' ).prev();
				} else {
				carousel.data( 'owlCarousel' ).next();
				}
				jQuery(this).blur();
			});

			// Next
			jQuery('.carousel-prev').on('click', function(e) {
				e.preventDefault();
				var carousel = jQuery(this).closest('.spb_content_element').find('.owl-carousel');
				if (isRTL) {
				carousel.data( 'owlCarousel' ).next();
				} else {
				carousel.data( 'owlCarousel' ).prev();
				}
				jQuery(this).blur();
			});
		},
		carouselSwipeIndicator: function(carousel) {
			carousel.appear(function() {
				var swipeIndicator = jQuery(this).parents('.carousel-wrap').find('.sf-swipe-indicator');
				setTimeout(function() {
					swipeIndicator.fadeIn(500);
				}, 400);
				setTimeout(function() {
					swipeIndicator.addClass('animate');
				}, 1000);
				setTimeout(function() {
					swipeIndicator.fadeOut(400);
				}, 3000);
			});
		},
		carouselMinHeight: function(carousel) {
			var minHeight = parseInt(carousel.find('.carousel-item:not(.no-thumb)').eq(0).css('height'));
			carousel.find('.owl-item').each(function () {
				jQuery(this).css('min-height',minHeight+'px');
			});
		},
		carouselSetWidth: function(carousel) {
			var carouselWidth = carousel.parent().width();
			if ( isRTL ) {
				carousel.css('margin-right', '-15px').css('width', carouselWidth + 30);
			} else {
				carousel.css('margin-left', '-15px').css('width', carouselWidth + 30);
			}
		},
		carouselStagedSetWidth: function(carousel) {
			var carouselWidth = carousel.parent().width(),
				overlapWidth = 200;
			
			if ( $window.width() < 480 ) {
				overlapWidth = 0;
			}
			
			if ( isRTL ) {
				carousel.css('margin-right', -overlapWidth).css('width', carouselWidth + overlapWidth*2);
			} else {
				carousel.css('margin-left', -overlapWidth).css('width', carouselWidth + overlapWidth*2);
			}
		},
		carouselStagedSetActive: function(carousel) {
			carousel.find('.owl-item').each(function() {
				if ( jQuery(this).visible() ) {
					jQuery(this).addClass('active');
				} else {
					jQuery(this).removeClass('active');
				}
			});
			if ( carousel.find('.owl-item.active').length <= 0 ) {
				carousel.find('.owl-item:eq(1),.owl-item:eq(2),.owl-item:eq(3)').addClass('active');
			}
		}
	};


	/////////////////////////////////////////////
	// WIDGET FUNCTIONS
	/////////////////////////////////////////////

	SWIFT.widgets = {
		init: function() {

			// LOAD WIDGETS
			SWIFT.widgets.accordion();
			SWIFT.widgets.toggle();
			SWIFT.widgets.fullWidthVideo();
			SWIFT.widgets.introAnimations();
			SWIFT.widgets.iconBoxes();

			// DYNAMIC TABS
			jQuery('.tabs-type-dynamic .menu-icon').hover(function() {
				jQuery(this).parents('.nav-tabs').addClass('show-tabs');
			});

			jQuery('.tabs-type-dynamic').mouseleave(function() {
				jQuery(this).find('.nav-tabs').removeClass('show-tabs');
			});

			// CATEGORY COUNT DISPLAY
			jQuery('.widget_categories li span').each(function() {
				var thisCategory = jQuery(this),
					thisText = thisCategory.text();
				thisCategory.text(thisText.replace('(', '').replace(')', ''));
				thisCategory.addClass('show-count');
			});

		},
		load: function() {

			SWIFT.widgets.tabs();

			if ( jQuery('.progress').length > 0 ) {
				SWIFT.widgets.initSkillBars();
			}

			// SF TOOLTIPS
			if (jQuery('[data-toggle="tooltip"]').length > 0 && !isMobileAlt) {
				SWIFT.widgets.initTooltips();
			}

		},
		accordion: function() {
			jQuery('.spb_accordion').each(function() {
				var spb_tabs,
					active_tab = false,
					active_attr = parseInt(jQuery(this).attr('data-active'), 10);

				if (jQuery.type( active_attr ) === "number") { active_tab = active_attr; }

				spb_tabs = jQuery(this).find('.spb_accordion_wrapper').accordion({
					header: "> div > h4",
					autoHeight: true,
					collapsible: true,
					active: active_tab,
					heightStyle: "content"
				});
			}).css('opacity', 1);
		},
		tabs: function() {
			// SET ACTIVE TABS PANE
			setTimeout(function() {
				jQuery('.spb_tabs').each(function() {
					jQuery(this).find('.tab-pane').first().addClass('active');
					jQuery(this).find('.tab-pane').removeClass('load');
				});
			}, 200);

			// SET ACTIVE TOUR PANE
			setTimeout(function() {
				jQuery('.spb_tour').each(function() {
					jQuery(this).find('.tab-pane').first().addClass('active');
					jQuery(this).find('.tab-pane').removeClass('load');
				});
			}, 200);

			// RESET MAPS ON TAB CLICK
			jQuery('ul.nav-tabs li a, .spb_accordion_section > h4 a').on('click', '', function(){
				var thisTab = jQuery(this),
					asset = thisTab.parents('.spb_content_element').first();

				if (asset.find('.map-canvas').length > 0) {
					setTimeout(function() {
						jQuery(window).trigger('resize');
						SWIFT.map.init();
					}, 100);
				}
				
				if (asset.find('.spb_blog_widget').length > 0 || asset.find('.spb_portfolio_widget').length > 0) {
					setTimeout(function() {
						jQuery(window).trigger('resize');
					}, 200);
				}
			});

			// Reset isotope layout on tab shown
			jQuery('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		        var target = jQuery(e.target).attr("href");
		        if ( jQuery(target).find('.filterable-items').length > 0 ) {
		            jQuery(target).find('.filterable-items').isotope('layout');
		        }
		    });

			// SET DESIRED TAB ON LOAD
			setTimeout(function() {
				if (jQuery('.spb_tabs').length > 0) {

					$window.trigger('resize');
					
					// Show correct tab on page load
					var tabUrl = document.location.toString();
					if (tabUrl.match('#') && jQuery('.nav-tabs a[href="#'+tabUrl.split('#')[1]+'"]').length > 0) {
					    var tabHash = tabUrl.split('#')[1];

					    jQuery('.nav-tabs a[href="#'+tabHash+'"]').tab('show');
					}

					// Change hash on tab click
					jQuery('.nav-tabs a').click(function (e) {
						var hash = e.target.hash;

						if (history.pushState) {
						    history.pushState(null, null, hash);
						} else {
						    location.hash = hash;
						}
					});
				}
				if (jQuery('.spb_accordion').length > 0) {

					// Show correct accordion section on page load
					var accordionUrl = document.location.toString();
					if (accordionUrl.match('#') && jQuery('.spb_accordion a[href="#'+accordionUrl.split('#')[1]+'"]').length > 0) {
					    var accordionHash = accordionUrl.split('#')[1];

					    jQuery('.spb_accordion a[href="#'+accordionHash+'"]').click();
					}

					// Change hash on tab click
					jQuery('.spb_accordion a').click(function (e) {
						var hash = e.target.hash;

						if (history.pushState) {
						    history.pushState(null, null, hash);
						} else {
						    location.hash = hash;
						}
					});
				}

				if (jQuery('.spb_tour').length > 0) {

					// Show correct accordion section on page load
					var tourUrl = document.location.toString();
					if (tourUrl.match('#') && jQuery('.spb_tour a[href="#'+tourUrl.split('#')[1]+'"]').length > 0) {
					    var tourHash = tourUrl.split('#')[1];

					    jQuery('.spb_tour a[href="#'+tourHash+'"]').click();
					}

					// Change hash on tab click
					jQuery('.spb_tour a').click(function (e) {
						var hash = e.target.hash;

						if ( history.pushState ) {
						    history.pushState(null, null, hash);
						} else {
						    location.hash = hash;
						}
					});
				}

			}, 200);
		},
		toggle: function() {
			jQuery('.spb_toggle').click(function() {
				if ( jQuery(this).hasClass('spb_toggle_title_active') ) {
					jQuery(this).removeClass('spb_toggle_title_active').next().slideUp(500);
				} else {
					jQuery(this).addClass('spb_toggle_title_active').next().slideDown(500);
				}
			});
			jQuery('.spb_toggle_content').each(function() {
				if ( jQuery(this).next().is('h4.spb_toggle') === false ) {
					jQuery('<div class="last_toggle_el_margin"></div>').insertAfter(this);
				}
			});
		},
		initSkillBars: function() {
			// SKILL BARS
			setTimeout(function() {
				SWIFT.widgets.animateSkillBars();
			}, 500);
			
			jQuery('a.ui-tabs-anchor').click(function(){
				SWIFT.widgets.animateSkillBars();
			});
		},
		animateSkillBars: function() {
			jQuery('.progress:not(.animated)').each(function(){
				var progress = jQuery(this);

				progress.appear(function() {
					var progressBar = jQuery(this),
					progressValue = progressBar.find('.bar').data('value');
					progressBar.addClass('animated');
					progressBar.find('.bar').animate({
						width: progressValue + "%"
					}, 800, function() {
						progressBar.parent().find('.bar-text').css('width', progressValue + "%");
						progressBar.parent().find('.bar-text .progress-value').fadeIn(600);
					});
				});
			});
		},
		charts: function() {
			SWIFT.widgets.animateCharts();
		},
		animateCharts: function() {
			jQuery('.chart-shortcode').each(function(){
				var chart = jQuery(this);
				chart.appear(function() {
					if (!jQuery(this).hasClass('animated')) {
						jQuery(this).addClass('animated');
						var animatePercentage = parseInt(jQuery(this).attr('data-animatepercent'), 10);
						jQuery(this).data('easyPieChart').update(animatePercentage);
					}
				});
			});
		},
		fullWidthVideo: function() {
			body.on('click', '.fw-video-link', function(e) {	
				var thisLink = jQuery(this);			
				if (isMobileAlt && body.hasClass('mobile-two-click')) {
					if (thisLink.hasClass('hovered')) {
						if (jQuery(this).data('video') !== "") {
							SWIFT.widgets.openFullWidthVideo(jQuery(this));
						}
						return false;
					} else {
						e.preventDefault();
						thisLink.addClass('hovered');
					}
				} else {
					if (jQuery(this).data('video') !== "") {
						SWIFT.widgets.openFullWidthVideo(jQuery(this));
					}
					return false;
				}
			});

			body.on('click', '.fw-video-close', function(){
				SWIFT.widgets.closeFullWidthVideo();
			});
		},
		openFullWidthVideo: function(element) {
			jQuery('.fw-video-close').addClass('is-open');
			jQuery('.fw-video-spacer').animate({
				height: windowheight
			}, 1000, 'easeInOutExpo');

			jQuery('.fw-video-area').css('display', 'block').animate({
				top: 0,
				height: '100%'
			}, 1000, 'easeInOutExpo', function() {
				// load video here
				jQuery('.fw-video-area > .fw-video-wrap').append('<iframe class="fw-video" src="'+element.data('video')+'" width="100%" height="100%" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>');
			});
		},
		closeFullWidthVideo: function() {
			jQuery('.fw-video-close').removeClass('is-open');
			jQuery('.fw-video-spacer').animate({
				height: 0
			}, 1000, 'easeInOutExpo', function(){
			});
			jQuery('.fw-video-area').animate({
				top:'-100%'
			}, 1000, 'easeInOutExpo', function() {
				jQuery('.fw-video-area').css('display', 'none');
				jQuery('.fw-video-area .fw-video').remove();
			});

			// pause videos
			jQuery('.fw-video-area video').each(function(){
				this.pause();
			});
			setTimeout(function() {
				jQuery('.fw-video-area').find('iframe').remove();
			}, 1500);

			return false;
		},
		introAnimations: function() {		
			if ( !(isMobileAlt && body.hasClass('disable-mobile-animations')) ) {
				jQuery('.sf-animation').each(function() {
					var animatedItem = jQuery(this);
					animatedItem.waypoint(function() {
						var itemAnimation = animatedItem.data('animation'),
						itemDelay = animatedItem.data('delay');
						
						setTimeout(function() {
							window.requestAnimationFrame( function() {
								animatedItem.addClass(itemAnimation);
								setTimeout(function() {
									animatedItem.addClass('sf-animate');
								}, 100);
							});
						}, itemDelay);
					}, {
					    offset: '90%',
					    triggerOnce: true
					});
				});
			}
		},
		iconBoxes: function() {
			if (isMobileAlt) {
				jQuery('.sf-icon-box').on('click', function() {
					jQuery(this).addClass('sf-mobile-hover');
				});
			} else {
				jQuery('.sf-icon-box').hover(
					function() {
						jQuery(this).addClass('sf-hover');
					}, function() {
						jQuery(this).removeClass('sf-hover');
					}
				);
			}
		},
		initTooltips: function() {
			jQuery('[data-toggle="tooltip"]').tooltip({
				trigger: 'hover'
			});
		}
	};


	/////////////////////////////////////////////
	// TEAM MEMBERS FUNCTION
	/////////////////////////////////////////////

	SWIFT.teamMembers = {
		init: function() {
			// TEAM EQUAL HEIGHTS
			var team = jQuery('.team-members:not(.carousel-items)');
			team.imagesLoaded(function () {
				if ($window.width() > 767) {
					team.equalHeights();
				}
			});

			// TEAM ASSETS
			$window.smartresize( function() {
				jQuery('.team-members:not(.carousel-items)').children().css('min-height','0');
				if ($window.width() > 767) {
					jQuery('.team-members:not(.carousel-items)').equalHeights();
				}
			});
		}
	};

	/////////////////////////////////////////////
	// RELATED POSTS FUNCTION
	/////////////////////////////////////////////

	SWIFT.relatedPosts = {
		init: function() {
			// TEAM EQUAL HEIGHTS
			var relatedItems = jQuery('.related-items');
			relatedItems.imagesLoaded(function () {
				if ($window.width() > 767) {
					relatedItems.equalHeights();
				}
			});

			// TEAM ASSETS
			$window.smartresize( function() {
				jQuery('.related-items').children().css('min-height','0');
				if ($window.width() > 767) {
					jQuery('.related-items').equalHeights();
				}
			});
		}
	};

	/////////////////////////////////////////////
	// PARALLAX FUNCTION
	/////////////////////////////////////////////

	SWIFT.parallax = {
		init: function() {

			jQuery('.spb_parallax_asset').each(function() {

				var parallaxAsset = jQuery(this);

				if (parallaxAsset.hasClass('sf-parallax-video')) {

					if (!isMobileAlt) {
						SWIFT.parallax.parallaxVideoInit();
					} else {
						parallaxAsset.find('video').remove();

						// Fade in
						parallaxAsset.transition({
							opacity: 1
						}, 300);
					}

					// Add resize handler
					$window.smartresize( function() {
						SWIFT.parallax.parallaxVideoResize(parallaxAsset);
					});

				} else if (parallaxAsset.hasClass('parallax-window-height')) {

					// Add resize handler
					SWIFT.parallax.windowImageResize(parallaxAsset);
				}
				
				// Add resize handler
				SWIFT.parallax.windowImageResize(parallaxAsset);
				$window.smartresize( function() {
					SWIFT.parallax.windowImageResize(parallaxAsset);
				});
			});
			
		},
		windowImageResize: function(asset) {

			if (asset.hasClass('spb-row-container')) {

				var rowContentHeight = asset.find('> .spb_content_element').height();

				if (asset.hasClass('parallax-window-height')) {

					if (rowContentHeight < $window.height()) {
						rowContentHeight = $window.height();
					}
				}

				if ( !asset.hasClass('parallax-content-height') ) {
					asset.height(rowContentHeight);
				}

			} else {

				var assetHeight = asset.height();

				if (asset.hasClass('parallax-window-height')) {

					if (assetHeight < $window.height()) {
						assetHeight = $window.height();
					}
				}
		
				if ( !asset.hasClass('parallax-content-height') ) {
					asset.height(assetHeight - asset.css('padding-top') / 2);
					asset.find('.spb_content_wrapper').vCenterTop();
				}
			}

		},
		parallaxVideoInit: function() {
			jQuery('.spb_parallax_asset.sf-parallax-video').each(function() {
				var parallaxAsset = jQuery(this),
					parallaxVideo = parallaxAsset.find('video'),
					parallaxVideoWidth = parallaxVideo.width(),
					parallaxContent = parallaxAsset.find('div:first'),
					parallaxAssetHeight = 0;

				if (parallaxAsset.hasClass('parallax-window-height')) {

					if (parallaxContent.height() > $window.height()) {
						parallaxAssetHeight = parallaxContent.height();
					} else {
						parallaxAssetHeight = $window.height();
					}

					parallaxAsset.animate({
						'height': parallaxAssetHeight
					}, 400);

					setTimeout(function() {

						// Scale video
						SWIFT.parallax.parallaxVideoResize(parallaxAsset);

						// Fade in
						parallaxAsset.transition({
							opacity: 1
						}, 300);

					}, 500);

					setTimeout(function() {
						parallaxAsset.find('.video-overlay').animate({
							'opacity': 0.8
						}, 200);
					}, 100);

					setTimeout(function() {
						parallaxContent.animate({
							'opacity': 1,
							'top': '50%'
						}, 600, 'easeOutExpo');
					}, 600);

					parallaxAsset.attr('data-height-default', parallaxVideo.height());

				} else {
					SWIFT.parallax.scaleVideo(parallaxAsset);
				}

				if ($window.width() < parallaxVideoWidth) {
					parallaxVideo.css('left', - (parallaxVideoWidth - $window.width()) /2);
				}
				
                var videoInstance = parallaxVideo.get( 0 );
                videoInstance.load();
                videoInstance.addEventListener( 'loadeddata' , function() {
                        SWIFT.parallax.parallaxVideoResize(parallaxAsset);
                    }
                );

			});
		},
		parallaxVideoResize: function(parallaxAsset) {
			var parallaxContent = parallaxAsset.find('div:first'),
				parallaxAssetHeight = 0;

			if (parallaxAsset.hasClass('parallax-window-height')) {
				if (parallaxContent.height() > $window.height()) {
					parallaxAssetHeight = parallaxContent.height();
				} else {
					parallaxAssetHeight = $window.height();
				}

				parallaxAsset.animate({
					'height': parallaxAssetHeight
				}, 400);
			}

			SWIFT.parallax.scaleVideo(parallaxAsset);
		},
		videoScroll: function(asset) {

			var offsetTop = asset.offset().top,
				windowTop = $window.scrollTop(),
				defaultHeight = parseInt(asset.data('height-default'), 10),
				diff = windowTop - offsetTop,
				currentTop = asset.find('.spb_content_wrapper').css('top'),
				heightDifference = defaultHeight - diff * 1.5;

			if (windowTop > offsetTop) {
				asset.css('height', heightDifference);
				asset.find('.spb_content_wrapper').css('opacity', 1 - (diff / 300));
				if (asset.hasClass('parallax-window-height') && asset.data('v-center') === "true") {
				asset.find('.spb_content_wrapper').css('top', currentTop + (diff / 4));
				} else if (asset.data('v-center') === "true") {
				asset.find('.spb_content_wrapper').css('top', (diff / 3));
				}
			} else {
				asset.css('height', defaultHeight);
				asset.find('.spb_content_wrapper').css('opacity', 1);
				if (asset.hasClass('parallax-video-height') && asset.data('v-center') === "true") {
				asset.find('.spb_content_wrapper').css('top', '50%');
				} else {
				asset.find('.spb_content_wrapper').css('top', 0);
				}
			}

		},
		scaleVideo: function(parallaxAsset) {

			var video = parallaxAsset.find('video'),
				assetHeight = parallaxAsset.outerHeight(),
				assetWidth = parallaxAsset.outerWidth(),
				videoWidth = video[0].videoWidth,
				videoHeight = video[0].videoHeight;

			// Use the largest scale factor of horizontal/vertical
			var scale_h = assetWidth / videoWidth;
			var scale_v = assetHeight / videoHeight;
			var scale = scale_h > scale_v ? scale_h : scale_v;

			// Update minium width to never allow excess space
			var min_w = videoWidth/videoHeight * (assetHeight+20);

			// Don't allow scaled width < minimum video width
			if (scale * videoWidth < min_w) {scale = min_w / videoWidth;}

			// Scale the video
			video.width(Math.ceil(scale * videoWidth +2));
			video.height(Math.ceil(scale * videoHeight +50));
			video.css('margin-top', - (video.height() - assetHeight) /2);
			video.css('margin-left', - (video.width() - assetWidth) /2);
		}
	};


	/////////////////////////////////////////////
	// MAP FUNCTIONS
	/////////////////////////////////////////////

	var infowindow, bounds, directory_bounds, mapTypeIdentifier = "", mapType, mapColor, mapSaturation, mapCenterLat, mapCenterLng, companyPos = "", isDraggable = true, latitude, longitude, mapCoordinates, markersArray = [], pinTitle, pinContent, pinLink, address, pinButtonText = "";


	SWIFT.map = {
		init:function() {

			var maps = jQuery('.map-canvas');
			var mapContainer;

			if (typeof google !== 'undefined') {
				bounds = new google.maps.LatLngBounds();
			}

			maps.each(function(i, element) {
				mapContainer = element;
				var mapZoom = mapContainer.getAttribute('data-zoom'),
					mapControls = mapContainer.getAttribute('data-controls') == "yes" ? true : false;

				mapType = mapContainer.getAttribute('data-maptype');
				mapColor = mapContainer.getAttribute('data-mapcolor');
				mapCenterLat = mapContainer.getAttribute('data-center-lat');
				mapCenterLng = mapContainer.getAttribute('data-center-lng');
				mapSaturation = mapContainer.getAttribute('data-mapsaturation');

				SWIFT.map.createMap( mapContainer, mapZoom, mapControls, mapType, mapColor, mapSaturation, jQuery(this));
			});

		},
		getLatLong: function(address, pintit, pinimage, fn) {
			var geocoder;
			geocoder = new google.maps.Geocoder();
			geocoder.geocode( { 'address': address }, function(results) {
				if ( results && results.length > 0 ) {
					fn(results[0].geometry.location, results[0].geometry.location.lat(), results[0].geometry.location.lng() , pintit, pinimage);
				}
			});
		},
		addWinContent: function(marker, html, map) {
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.setContent(html);
				infowindow.open(map, marker);
			});
		},
		addMarker: function(mapInstance, pinLogoURL, pinTitle, pinContent, pinLink, address, pinButtonText) {
			var companyMarker;

			mapCoordinates = new google.maps.LatLng(latitude, longitude);

			if (pinLogoURL) {
				companyPos = new google.maps.LatLng(latitude, longitude);
				companyMarker = new google.maps.Marker({
					position: mapCoordinates,
					map: mapInstance,
					icon: pinLogoURL,
					animation: google.maps.Animation.DROP });
			} else {
				companyPos = new google.maps.LatLng(latitude, longitude);
				companyMarker = new google.maps.Marker({
					position: mapCoordinates,
					map: mapInstance,
					animation: google.maps.Animation.DROP });
			}

			var html = '<div class="pinmarker">';
			if (pinTitle !== "") {
			html += '<h3>'+pinTitle+'</h3>';
			}
			if (pinContent !== "") {
			html += '<p>'+pinContent+' </p>';
			}
			if (pinLink !== "" && pinButtonText !== "") {
			html += '<div><a href="' + pinLink + '" target="_blank">'+pinButtonText+'</a></div>';
			}
			html += '</div>';

			infowindow = new google.maps.InfoWindow();
			SWIFT.map.addWinContent(companyMarker, html, mapInstance);
			bounds.extend(mapCoordinates);
		},
		createMap: function(mapContainer, mapZoom, mapControls, mapType, mapColor, mapSaturation, targetMap) {

			if (typeof google == 'undefined') {
				return;
			}
			
			directory_bounds = new google.maps.LatLngBounds();
			
			var pinLogoURL = "", mapLightness = false;

			// MAP STYLES
			var stylesArray = [],
				isStyled = false;

			if (jQuery(mapContainer).parent().find('.map-styles-array').length > 0) {
				stylesArray = jQuery(mapContainer).parent().find('.map-styles-array').text();
				if ( stylesArray.length > 0 ) {
					isStyled = true;
					stylesArray = JSON.parse(jQuery(mapContainer).parent().find('.map-styles-array').text());
				}
			} else {
				if (mapSaturation == "mono-light") {
					if (mapColor === "") {
						mapColor = "#ffffff";
					}
					mapSaturation = -100;
				} else if (mapSaturation == "mono-dark") {
					if (mapColor === "") {
						mapColor = "#222222";
					}
					mapSaturation = -100;
					mapLightness = true;
				} else {
					mapSaturation = -20;
				}
				stylesArray = [
					{
						stylers: [
							{hue: mapColor},
							{"invert_lightness": mapLightness},
							{saturation: mapSaturation}
						]
					}
				];
			}

			if (isMobileAlt) {
			isDraggable = false;
			}

			if (mapType === "satellite") {
			mapTypeIdentifier = google.maps.MapTypeId.SATELLITE;
			} else if (mapType === "terrain") {
			mapTypeIdentifier = google.maps.MapTypeId.TERRAIN;
			} else if (mapType === "hybrid") {
			mapTypeIdentifier = google.maps.MapTypeId.HYBRID;
			} else {
			mapTypeIdentifier = google.maps.MapTypeId.ROADMAP;
			}

			var options = {
				zoom: parseInt(mapZoom, 10),
				scrollwheel: false,
				draggable: isDraggable,
				mapTypeControl: true,
				disableDefaultUI: !mapControls,
				mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
				navigationControl: true,
				navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
				mapTypeId: mapTypeIdentifier,
				styles: stylesArray
			};

			var mapInstance = new google.maps.Map(mapContainer, options);
			var pincount = targetMap.parent().find('.pin_location').length;

			//Resize Window Responsiveness
//			google.maps.event.addDomListener(window, 'resize', function() {
//				mapInstance.fitBounds(bounds);
//				mapInstance.setZoom(parseInt(mapZoom, 10));
//				mapInstance.setCenter(new google.maps.LatLng(latitude, longitude));
//			});
			google.maps.event.addDomListener(window, "resize", function() {
				var center = mapInstance.getCenter();
				google.maps.event.trigger(mapInstance, "resize");
				mapInstance.setCenter(center);
			});

			bounds = new google.maps.LatLngBounds();
			targetMap.parent().find('.pin_location').each(function(i, element) {

				pinLogoURL = element.getAttribute('data-pinimage');
				pinTitle = element.getAttribute('data-title');
				pinContent = element.getAttribute('data-content');
				address = element.getAttribute('data-address');
				pinLink = element.getAttribute('data-pinlink');
				latitude = element.getAttribute('data-lat');
				longitude = element.getAttribute('data-lng');
				pinButtonText = element.getAttribute('data-button-text');


				if (latitude === '' && longitude === '') {

					SWIFT.map.getLatLong(address, pinTitle, pinLogoURL ,function(location, lati,longi, pintit, pinimage ){

						latitude = lati;
						longitude = longi;
						pinTitle = pintit;
						pinLogoURL = pinimage;

						SWIFT.map.addMarker(mapInstance, pinLogoURL, pinTitle, pinContent, pinLink, address, pinButtonText);

						if ( pincount > 1 ) {
							if(mapCenterLat !== '' && mapCenterLng !== ''){
								mapInstance.setZoom(parseInt(mapZoom, 10));
								mapInstance.setCenter(new google.maps.LatLng(mapCenterLat, mapCenterLng));
							}else{
								mapInstance.fitBounds(bounds);
							}
						} else {
							mapInstance.setZoom(parseInt(mapZoom, 10));
							mapInstance.setCenter(new google.maps.LatLng(latitude, longitude));
						}

					});

				} else {

					SWIFT.map.addMarker(mapInstance, pinLogoURL, pinTitle, pinContent, pinLink, address, pinButtonText);

					if ( pincount > 1 ) {
						if(mapCenterLat !== '' && mapCenterLng !== ''){
								mapInstance.setZoom(parseInt(mapZoom, 10));
								mapInstance.setCenter(new google.maps.LatLng(mapCenterLat, mapCenterLng));
							}else{
								mapInstance.fitBounds(bounds);
						}
					} else {
						mapInstance.setZoom(parseInt(mapZoom, 10));
						mapInstance.setCenter(new google.maps.LatLng(latitude, longitude));
					}

				}

			});
		}
	};


	/////////////////////////////////////////////
	// MAP DIRECTORY FUNCTIONS
	/////////////////////////////////////////////

	SWIFT.mapDirectory = {
		init : function(searchTerm, locationFilter, categoryFilter) {

			searchTerm = jQuery('#dir-search-value').val();
			locationFilter = jQuery('.directory-location-option').val();
			categoryFilter = jQuery('.directory-category-option').val();

			var mapsDirectory = jQuery('.map-directory-canvas');

			mapsDirectory.each(function(i, element) {

				var mapDirContainer = element,
					mapZoom = mapDirContainer.getAttribute('data-zoom'),
					mapType = mapDirContainer.getAttribute('data-maptype'),
					mapColor = mapDirContainer.getAttribute('data-mapcolor'),
					mapSaturation = mapDirContainer.getAttribute('data-mapsaturation'),
					mapExcerpt = mapDirContainer.getAttribute('data-excerpt');

					if ( categoryFilter === null || categoryFilter == 'All' ){
						categoryFilter = mapDirContainer.getAttribute('data-directory-category');
					}


				SWIFT.mapDirectory.directoryMap( mapDirContainer, mapZoom, mapType, mapColor, mapSaturation, jQuery(this), searchTerm, locationFilter, categoryFilter, mapExcerpt);

			});
		},
		searchDirectory: function(){
			SWIFT.mapDirectory.init(jQuery('#dir-search-value').val(), jQuery('.directory-location-option').val(), jQuery('.directory-category-option').val());
		},
		getLatLong: function(address, fn){
			var geocoder;
			geocoder = new google.maps.Geocoder();
			geocoder.geocode( { 'address': address }, function(results) {
				if ( results && results.length > 0 ) {
					fn(results[0].geometry.location, results[0].geometry.location.lat(), results[0].geometry.location.lng());
				}
			});
		},
		addWinContent: function(marker, html, map){
				markersArray.push(marker);
				google.maps.event.addListener(marker, 'click', function() {
				infowindow.setContent(html);
				infowindow.open(map, marker);
			});
		},
		addMarkerDir: function(mapInstance, pinLogoURL, pinTitle, pinContent, pinLink, address, pinButtonText,pinFeaturedImage, lat, lng){
			var companyMarker, pinImgContainer;

			mapCoordinates = new google.maps.LatLng(lat, lng);

			if (pinLogoURL) {
				companyPos = new google.maps.LatLng(lat, lng);
				companyMarker = new google.maps.Marker({
					position: mapCoordinates,
					map: mapInstance,
					icon: pinLogoURL,
					optimized: false,
					animation: google.maps.Animation.DROP });
			} else {
				companyPos = new google.maps.LatLng(lat, lng);
				companyMarker = new google.maps.Marker({
					position: mapCoordinates,
					map: mapInstance,
					animation: google.maps.Animation.DROP });
			}
			if (pinFeaturedImage === null) {
				pinImgContainer = '';
			} else {
				pinImgContainer = '<img class="info-window-img" alt="" src="'+pinFeaturedImage+'" height="140" width="140"/>';
			}

			var html = '';
			if (pinLink === '' || pinButtonText === '') {
				html = '<div class="pinmarker">'+pinImgContainer+'<div class="pinmarker-container"><h3>'+pinTitle+'</h3><div class="excerpt">'+pinContent+'</div></div></div>';
			} else {
				html = '<div class="pinmarker">'+pinImgContainer+'<div class="pinmarker-container"><h3>'+pinTitle+'</h3><div class="excerpt">'+pinContent+'</div><a class="pin-button" href="' + pinLink + '" target="_blank">'+pinButtonText+'</a></div></div>';
			}


			infowindow = new google.maps.InfoWindow();
			SWIFT.mapDirectory.addWinContent(companyMarker, html, mapInstance);
			directory_bounds.extend(mapCoordinates);
		},
		directoryMap: function(mapContainer, mapZoom, mapType, mapColor, mapSaturation, targetMap, searchTerm, locationFilter, categoryFilter, excerpt) {

			var mapLightness = false;
			var mapResults =  mapContainer.getAttribute('data-directory-map-results');

			//Only if we want to display the map
			if (mapResults !== 'list') {

				if (mapSaturation == "mono-light") {
					if (mapColor === "") {
						mapColor = "#ffffff";
					}
					mapSaturation = -100;
				} else if (mapSaturation == "mono-dark") {
					if (mapColor === "") {
						mapColor = "#222222";
					}
					mapSaturation = -100;
					mapLightness = true;
				} else {
					mapSaturation = -20;
				}

				var styles = [
					{
						stylers: [
							{hue: mapColor},
							{"invert_lightness": mapLightness},
							{saturation: mapSaturation}
						]
					}
				];

				var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});

				if (isMobileAlt) {
					isDraggable = false;
				}

				if (mapType === "satellite") {
				mapTypeIdentifier = google.maps.MapTypeId.SATELLITE;
				} else if (mapType === "terrain") {
				mapTypeIdentifier = google.maps.MapTypeId.TERRAIN;
				} else if (mapType === "hybrid") {
				mapTypeIdentifier = google.maps.MapTypeImapDirContainerd.HYBRID;
				} else {
				mapTypeIdentifier = google.maps.MapTypeId.ROADMAP;
				}


			} else {
				jQuery(mapContainer).hide();
			}

			directory_bounds = new google.maps.LatLngBounds();

			if (categoryFilter === "") {
				categoryFilter = mapContainer.getAttribute('data-directory-category');
			}

			//Ajax call to get the Directory Itens
			var data = {
				action: 'sf_directory',
				search_term: searchTerm,
				location_term: locationFilter,
				category_term: categoryFilter,
				item_excerpt: excerpt

			};

			jQuery.post(mapContainer.getAttribute('data-ajaxurl'), data, function(response) {
				var json = jQuery.parseJSON(response);
				var pincount = json.results;

				jQuery('.directory-results').hide();

				var settings = {
					scrollwheel: false,
					draggable: isDraggable,
					mapTypeControl: true,
					mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
					navigationControl: true,
					navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
					mapTypeId: mapTypeIdentifier
				};

				if (pincount > 0) {

					var mapInstance = new google.maps.Map(mapContainer, settings);
					markersArray = [];

					// MAP COLOURIZE
					if (mapColor !== "" && mapResults != 'list') {
						mapInstance.mapTypes.set('map_style', styledMap);
						mapInstance.setMapTypeId('map_style');
					}

					//Resize Window Responsiveness
					google.maps.event.addDomListener(window, 'resize', function() {
						mapInstance.fitBounds(directory_bounds);
						mapInstance.setZoom(parseInt(mapZoom, 10));
					});

					var resultText = '';

					if ( pincount > 1 ) {
						resultText = json.results_text_1 + ' '+pincount+' '+json.results_text_2plural;
					} else {
						resultText = json.results_text_1 + ' '+pincount+' '+json.results_text_2;
					}
					jQuery(mapContainer).parent().parent().parent().find('.directory-results').prepend('<div class="results-title"><h2>'+resultText+'</h2>');

				} else {

					for (var i=0; i < markersArray.length; i++) {
						markersArray[i].setMap(null);
					}

					jQuery(mapContainer).parent().parent().parent().find('.directory-results').append('<div class="results-title"><h2>'+json.errormsg+'</h2>');

				}

				if (pincount > 0 && mapResults != 'list') {

					jQuery(mapContainer).show();
					jQuery('.directory-results').append(json.pagination);

					jQuery.each(json.items, function(i, item) {

						//Get the directory itens details
						var pinTitle = item.pin_title,
							pinLogoURL = item.pin_logo_url,
							pinContent = item.pin_content,
							pinShortContent = item.pin_short_content,
							address = item.pin_address,
							pinLink = item.pin_link,
							pinButtonText = item.pin_button_text,
							latitude = item.pin_lat,
							longitude = item.pin_lng,
							pinThumbnail = item.pin_thumbnail,
							thumbnail_image	= '',
							hasThumb = false,
							extra_class = '';
							if ( excerpt !== '' ){
								pinContent = pinShortContent;
							}

						if (pinThumbnail && pinLink) {
							hasThumb = true;
							thumbnail_image = '<figure class="animated-overlay overlay-alt"><img itemprop="image" src="'+pinThumbnail+'" alt="'+pinTitle+'"><a href="'+pinLink+'" target="_blank" class="link-to-post"></a><div class="figcaption-wrap"></div><figcaption><div class="thumb-info"><h4>'+pinTitle+'</h4></div></figcaption></figure>';
						} else if (pinThumbnail) {
							hasThumb = true;
							thumbnail_image = '<figure><img itemprop="image" src="'+pinThumbnail+'" alt="'+pinTitle+'"></figure>';
						}

						//Add the Directory List Results
						if (!hasThumb) {
							extra_class = 'no-thumb';
						}

						if ( mapResults != 'list') {

							//Add directory item to the map
							SWIFT.mapDirectory.addMarkerDir(mapInstance, pinLogoURL, pinTitle, pinShortContent, pinLink, address, pinButtonText,pinThumbnail, latitude, longitude);

							if ( pincount > 1 ) {
								mapInstance.fitBounds(directory_bounds);
							} else {
								mapInstance.setZoom(parseInt(mapZoom, 10));
								mapInstance.setCenter(new google.maps.LatLng(latitude, longitude));
							}
						}
					});
				}else{
					jQuery(mapContainer).hide();
				}
				jQuery('.directory-results').show();
			});
		}
	};


	/////////////////////////////////////////////
	// CROWDFUNDING FUNCTIONS
	/////////////////////////////////////////////

	SWIFT.crowdfunding = {
		init:function() {

			if (jQuery('#back-this-project').find('.edd_price_options').length <= 0) {
				jQuery('#back-this-project > h2').css('display', 'none');
			}

			if (jQuery('#back-this-project').hasClass('project-donate-only')) {
				jQuery('.edd_price_options').find('li').first().addClass('atcf-selected');
				jQuery('.edd_price_options').find('li').first().find('input[type="radio"]').prop('checked', true);
			}

			jQuery('.atcf-price-option').on('click', function() {

				var selectedOption = jQuery(this),
					selectedPrice = selectedOption.data('price').substr(0, selectedOption.data('price').indexOf('-'));

				if (selectedOption.hasClass('inactive')) {
					return false;
				}

				if (selectedPrice && jQuery('#atcf_custom_price').val().length <= 0) {
				jQuery('#atcf_custom_price').val(selectedPrice);
				}
				jQuery('.atcf-price-option').find('input[type="radio"]').prop('checked', false);
				jQuery('.atcf-price-option').removeClass('atcf-selected');
				selectedOption.find('input[type="radio"]').prop('checked', true);
				selectedOption.addClass('atcf-selected');
			});

			var campaignItems = jQuery('.campaign-items:not(.carousel-items)');
			campaignItems.imagesLoaded(function () {
				campaignItems.equalHeights();
			});

			$window.smartresize( function() {
				jQuery('.campaign-items:not(.carousel-items)').children().css('min-height','0');
				jQuery('.campaign-items:not(.carousel-items)').equalHeights();
			});

		}
	};

	
	/////////////////////////////////////////////
	// RELOAD FUNCTIONS
	/////////////////////////////////////////////

	SWIFT.reloadFunctions = {
		init:function() {

			// Remove title attributes from images to avoid showing on hover
			jQuery('img[title]').each(function() {
				jQuery(this).removeAttr('title');
			});

			if (!isAppleDevice) {
				jQuery('embed').show();
			}

			// Animate Top Links
			jQuery('.animate-top').on('click', function(e) {
				e.preventDefault();
				jQuery('body,html').animate({scrollTop: 0}, 800, 'easeOutCubic');
			});
		},
		load:function() {
			if (!isMobileAlt) {

				// Button hover tooltips
				jQuery('.tooltip').each( function() {
					jQuery(this).css( 'marginLeft', '-' + Math.round( (jQuery(this).outerWidth(true) / 2) ) + 'px' );
				});

				jQuery('.comment-avatar').hover( function() {
					jQuery(this).find('.tooltip' ).stop().animate({
						bottom: '44px',
						opacity: 1
					}, 500, 'easeInOutExpo');
				}, function() {
						jQuery(this).find('.tooltip').stop().animate({
							bottom: '25px',
							opacity: 0
						}, 400, 'easeInOutExpo');
				});

				jQuery('.grid-image').hover( function() {
					jQuery(this).find('.tooltip' ).stop().animate({
						bottom: '85px',
						opacity: 1
					}, 500, 'easeInOutExpo');
				}, function() {
						jQuery(this).find('.tooltip').stop().animate({
							bottom: '65px',
							opacity: 0
						}, 400, 'easeInOutExpo');
				});

			}
		}
	};


	/////////////////////////////////////////////
	// GLOBAL VARIABLES
	/////////////////////////////////////////////

	var $window = jQuery(window),
		body = jQuery('body'),
		sfIncluded = jQuery('#sf-included'),
		sfOptionParams = jQuery('#sf-option-params'),
		windowheight = SWIFT.page.getViewportHeight(),
		deviceAgent = navigator.userAgent.toLowerCase(),
		isMobile = deviceAgent.match(/(iphone|ipod|android|iemobile)/),
		isMobileAlt = deviceAgent.match(/(iphone|ipod|ipad|android|iemobile)/),
		isAppleDevice = deviceAgent.match(/(iphone|ipod|ipad)/),
		isIEMobile = deviceAgent.match(/(iemobile)/),
		isSafari = navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1 &&  navigator.userAgent.indexOf('Android') == -1,
		//isFirefox = navigator.userAgent.indexOf('Firefox') > -1,
		parallaxScroll = navigator.userAgent.indexOf('Safari') != -1 || navigator.userAgent.indexOf('Chrome') == -1,
		IEVersion = SWIFT.page.checkIE(),
		isRTL = body.hasClass('rtl') ? true : false,
		shopBagHovered = false,
		wishlistHovered = false,
		stickyHeaderTop = 0,
		sliderAuto = sfOptionParams.data('slider-autoplay') ? true : false,
		sliderSlideSpeed = sfOptionParams.data('slider-slidespeed'),
		sliderAnimSpeed = sfOptionParams.data('slider-animspeed'),
		lightboxControlArrows = sfOptionParams.data('lightbox-nav') === "arrows" ? true : false,
		lightboxThumbs = sfOptionParams.data('lightbox-thumbs') ? true : false,
		lightboxSkin = sfOptionParams.data('lightbox-skin') === "dark" ? "metro-black" : "metro-white",
		lightboxSharing = sfOptionParams.data('lightbox-sharing') ? true : false,
		hasProductZoom = jQuery('#sf-included').hasClass('has-productzoom') ? true : false,
		hasProductZoomMobile = jQuery('#sf-included').hasClass('has-productzoom-mobile') ? true : false,
		productZoomType = sfOptionParams.data('product-zoom-type') === "lens" ? "lens" : "inner",
		productSliderThumbsPos = sfOptionParams.data('product-slider-thumbs-pos') === "left" ? "left" : "bottom",
		productSliderVertHeight = sfOptionParams.data('product-slider-vert-height'),
		cartNotification = sfOptionParams.data('cart-notification');

	SWIFT.isScrolling = false;
	SWIFT.isResizing = false;
	SWIFT.sidebarAnimation = false;
	SWIFT.productSlider = false;
	SWIFT.offset = 0;
	SWIFT.wpadminbarheight = 0;
	SWIFT.timelineBlocks = jQuery();
	SWIFT.timelineOffset = 0.8;
	
	/////////////////////////////////////////////
	// LOAD + READY FUNCTION
	/////////////////////////////////////////////

	SWIFT.onReady = {
		init: function(){
			SWIFT.page.init();
			SWIFT.sliders.init();
			SWIFT.gallery.init();
			if (jQuery('.sf-super-search').length > 0) {
			SWIFT.superSearch.init();
			}
			if (jQuery('#header-section').length > 0) {
			SWIFT.header.init();
			}
			SWIFT.nav.init();
			
			SWIFT.woocommerce.init();
			
			SWIFT.portfolio.init();
			
			if (jQuery('.portfolio-wrap').length > 0) {
			SWIFT.portfolio.infiniteScroll();
			}
			if ( jQuery('.blog-wrap').length > 0 ) {
			SWIFT.blog.init();
			}
			if (jQuery('.blog-items-wrap').length > 0) {
			SWIFT.blog.infiniteScroll();
			}
			SWIFT.galleries.init();
			SWIFT.widgets.init();
			SWIFT.teamMembers.init();
			if (jQuery('.carousel-items').length > 0) {
			SWIFT.carouselWidgets.init();
			}
			SWIFT.parallax.init();
			SWIFT.crowdfunding.init();
			SWIFT.reloadFunctions.init();
		}
	};
	SWIFT.onLoad = {
		init: function(){
			SWIFT.page.load();
			
			if (body.hasClass('sf-preloader')) {
			SWIFT.page.homePreloader();
			}
			SWIFT.woocommerce.load();
			if (body.hasClass('page-transitions')) {
			SWIFT.page.fadePageIn();
			}
			
			SWIFT.widgets.load();
			
			// Google Map
			if (jQuery('.map-canvas').length > 0) {
				SWIFT.map.init();
				jQuery('ul.nav-tabs li a').click(function(){
					var thisTabHref = jQuery(this).attr('href');
					if (jQuery(thisTabHref).find('.spb_gmaps_widget').length > 0) {
						SWIFT.map.init();
					}
				});
			}
			
			// Directory Map
			if (jQuery('.map-directory-canvas').length > 0) {
				SWIFT.mapDirectory.init('', '', '');
				jQuery(document).on( "click", '#directory-search-button', function() {
					jQuery('.directory-search-form').submit();
				});
				jQuery('ul.nav-tabs li a').click(function(){
					var thisTabHref = jQuery(this).attr('href');
					if (jQuery(thisTabHref).find('.spb_gmaps_widget').length > 0) {
						SWIFT.mapDirectory.init('', '', '');
					}
				});
			}
			
			SWIFT.reloadFunctions.load();

			if (sfIncluded.hasClass('stickysidebars') && jQuery('.sticky-widget').length > 0) {
				SWIFT.page.stickyWidget();
			}

		}
	};

	jQuery(document).ready(SWIFT.onReady.init);
	jQuery(window).load(SWIFT.onLoad.init);

})(jQuery);

window.onpageshow = function(event) {
    if ( event.persisted && jQuery('body').hasClass("sf-preloader") ) {
        window.location.reload();
    }
};

window.onunload = function(){
	if (jQuery('body').hasClass("page-transitions") ) {
	    var preloadTime = 1000;

		if (jQuery('.parallax-window-height').length > 0) {
			preloadTime = 1200;
		}

		jQuery('body').addClass('page-fading-in');
		jQuery('#site-loading').css('opacity', '0');

		setTimeout(function() {
			jQuery('#site-loading').css('display', 'none');
			jQuery('body').removeClass('page-fading-in');
		}, preloadTime);
	}
};