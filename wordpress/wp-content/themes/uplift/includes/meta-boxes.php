<?php

	/*
	*
	*	Meta Box Functions
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
	*
	*/
	
	function sf_register_meta_boxes() {
		$prefix = 'sf_';
	
		$sf_options = get_option('sf_uplift_options');
	
		$meta_boxes = array();
	
		$default_show_page_heading = $sf_options['default_show_page_heading'];
		$default_sidebar_config = $sf_options['default_sidebar_config'];
		$default_left_sidebar = $sf_options['default_left_sidebar'];
		$default_right_sidebar = $sf_options['default_right_sidebar'];
	
		if ($default_show_page_heading == "") {
			$default_show_page_heading = 1;
		}
		if ($default_sidebar_config == "") {
			$default_sidebar_config = "no-sidebars";
		}
		if ($default_left_sidebar == "") {
			$default_left_sidebar = "Sidebar-1";
		}
		if ($default_right_sidebar == "") {
			$default_right_sidebar = "Sidebar-1";
		}
	
		/* PRODUCT SIDEBARS */
		$default_product_sidebar_config = $sf_options['default_product_sidebar_config'];
		$default_product_left_sidebar = $sf_options['default_product_left_sidebar'];
		$default_product_right_sidebar = $sf_options['default_product_right_sidebar'];
	
		if ($default_product_sidebar_config == "") {
			$default_product_sidebar_config = "no-sidebars";
		}
		if ($default_product_left_sidebar == "") {
			$default_product_left_sidebar = "Sidebar-1";
		}
		if ($default_product_right_sidebar == "") {
			$default_product_right_sidebar = "Sidebar-1";
		}
	
		/* POST META */
		$default_post_sidebar_config = $sf_options['default_post_sidebar_config'];
		$default_post_left_sidebar = $sf_options['default_post_left_sidebar'];
		$default_post_right_sidebar = $sf_options['default_post_right_sidebar'];
		$default_include_author = $sf_options['default_include_author'];
		$default_include_social = $sf_options['default_include_social'];
		$default_include_related = $sf_options['default_include_related'];
		$default_thumb_media = $sf_options['default_thumb_media'];
		$default_detail_media = $sf_options['default_detail_media'];
	
		if ($default_post_sidebar_config == "") {
			$default_post_sidebar_config = "right-sidebar";
		}
		if ($default_post_left_sidebar == "") {
			$default_post_left_sidebar = "Sidebar-1";
		}
		if ($default_post_right_sidebar == "") {
			$default_post_right_sidebar = "Sidebar-1";
		}
		if ($default_include_author == "") {
			$default_include_author = 1;
		}
		if ($default_include_social == "") {
			$default_include_social = 1;
		}
		if ($default_include_related == "") {
			$default_include_related = 1;
		}
	
		/* PAGE MENU */
		$menu_list = array();
		if ( function_exists( 'sf_get_menu_list' ) ) {
			$menu_list = sf_get_menu_list();
		}
	
		/* SWIFT SLIDER */
		$swift_slider_categories = array();
		if ( function_exists( 'sf_get_category_list_key_array' ) ) {
			$swift_slider_categories = sf_get_category_list_key_array('swift-slider-category');
		}

		/* Thumbnail Meta Box
		================================================== */
		$meta_boxes[] = array(
			'id' => 'thumbnail_meta_box',
			'title' => __('Thumbnail', 'uplift'),
			'pages' => array( 'post' ),
			'context' => 'normal',
			'fields' => array(
	
				// THUMBNAIL TYPE
				array(
					'name' => __('Thumbnail type', 'uplift'),
					'id'   => "{$prefix}thumbnail_type",
					'type' => 'select',
					'options' => array(
						'none'		=> 'None',
						'image'		=> 'Image',
						'video'		=> 'Video',
						'slider'	=> 'Slider',
						'audio'		=> 'Audio',
						'sh-video'	=> 'Self Hosted Video'
					),
					'multiple' => false,
					'std'  => $default_thumb_media,
					'desc' => __('Choose what will be used for the item thumbnail.', 'uplift')
				),
	
				// THUMBNAIL IMAGE
				array(
					'name'  => __('Thumbnail image', 'uplift'),
					'desc'  => __('The image that will be used as the thumbnail image.', 'uplift'),
					'id'    => "{$prefix}thumbnail_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
	
				// THUMBNAIL VIDEO
				array(
					'name' => __('Thumbnail video URL', 'uplift'),
					'id' => $prefix . 'thumbnail_video_url',
					'desc' => __('Enter the video url for the thumbnail. Only links from Vimeo & YouTube are supported.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// THUMBNAIL AUDIO
				array(
					'name' => __('Thumbnail audio URL', 'uplift'),
					'id' => $prefix . 'thumbnail_audio_url',
					'desc' => __('Enter the audio url for the thumbnail.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// THUMBNAIL AUDIO TITLE
				array(
					'name' => __('Thumbnail audio title', 'uplift'),
					'id' => $prefix . 'thumbnail_audio_title',
					'desc' => __('Enter the audio title for the thumbnail.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// THUMBNAIL AUDIO ARTIST
				array(
					'name' => __('Thumbnail audio artist', 'uplift'),
					'id' => $prefix . 'thumbnail_audio_artist',
					'desc' => __('Enter the audio artist for the thumbnail.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// THUMBNAIL AUDIO IMAGE
				array(
					'name'  => __('Thumbnail audio cover', 'uplift'),
					'desc'  => __('The image that will be used as the cover image.', 'uplift'),
					'id'    => "{$prefix}thumbnail_audio_cover",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
	
				// THUMBNAIL SELF HOSTED VIDEO
				array(
					'name' => __('Thumbnail Self Hosted Video MP4 URL', 'uplift'),
					'id' => $prefix . 'thumbnail_video_mp4',
					'desc' => __('Enter the video mp4 url for the thumbnail.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				array(
					'name' => __('Thumbnail Self Hosted Video WEBM URL', 'uplift'),
					'id' => $prefix . 'thumbnail_video_webm',
					'desc' => __('Enter the video webm url for the thumbnail.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				array(
					'name' => __('Thumbnail Self Hosted Video OGG URL', 'uplift'),
					'id' => $prefix . 'thumbnail_video_ogg',
					'desc' => __('Enter the video ogg url for the thumbnail.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// THUMBNAIL GALLERY
				array(
					'name'             => __('Thumbnail gallery', 'uplift'),
					'desc'             => __('The images that will be used in the thumbnail gallery.', 'uplift'),
					'id'               => "{$prefix}thumbnail_gallery",
					'type'             => 'image_advanced',
					'max_file_uploads' => 50,
				),
	
				// THUMBNAIL LINK TYPE
				array(
					'name' => __('Thumbnail link type', 'uplift'),
					'id'   => "{$prefix}thumbnail_link_type",
					'type' => 'select',
					'options' => array(
						'link_to_post'		=> __('Link to item', 'uplift'),
						'link_to_url'		=> __('Link to URL', 'uplift'),
						'link_to_url_nw'	=> __('Link to URL (New Window)', 'uplift'),
						'lightbox_thumb'	=> __('Lightbox to the thumbnail image', 'uplift'),
						'lightbox_image'	=> __('Lightbox to image (select below)', 'uplift'),
						'lightbox_video'	=> __('Fullscreen Video Overlay (input below)', 'uplift')
					),
					'multiple' => false,
					'std'  => 'link-to-post',
					'desc' => __('Choose what link will be used for the image(s) and title of the item.', 'uplift')
				),
	
				// THUMBNAIL LINK URL
				array(
					'name' => __('Thumbnail link URL', 'uplift'),
					'id' => $prefix . 'thumbnail_link_url',
					'desc' => __('Enter the url for the thumbnail link.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// THUMBNAIL LINK LIGHTBOX IMAGE
				array(
					'name'  => __('Thumbnail link lightbox image', 'uplift'),
					'desc'  => __('The image that will be used as the lightbox image.', 'uplift'),
					'id'    => "{$prefix}thumbnail_link_image",
					'type'  => 'thickbox_image'
				),
	
				// THUMBNAIL LINK LIGHTBOX VIDEO
				array(
					'name' => __('Thumbnail link lightbox video URL', 'uplift'),
					'id' => $prefix . 'thumbnail_link_video_url',
					'desc' => __('Enter the video url for the thumbnail lightbox. Only links from Vimeo & YouTube are supported.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				)
			)
		);
	
		/* Thumbnail Meta Box
		================================================== */
		$meta_boxes[] = array(
			'id' => 'alt_thumbnail_meta_box',
			'title' => __('Thumbnail', 'uplift'),
			'pages' => array( 'download' ),
			'context' => 'normal',
			'fields' => array(
	
				// THUMBNAIL TYPE
				array(
					'name' => __('Thumbnail type', 'uplift'),
					'id'   => "{$prefix}thumbnail_type",
					'type' => 'select',
					'options' => array(
						'none'		=> 'None',
						'image'		=> 'Image',
						'video'		=> 'Video',
						'slider'	=> 'Slider',
						'sh-video'	=> 'Self Hosted Video'
					),
					'multiple' => false,
					'std'  => 'image',
					'desc' => __('Choose what will be used for the item thumbnail.', 'uplift')
				),
	
				// THUMBNAIL IMAGE
				array(
					'name'  => __('Thumbnail image', 'uplift'),
					'desc'  => __('The image that will be used as the thumbnail image.', 'uplift'),
					'id'    => "{$prefix}thumbnail_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
	
				// THUMBNAIL VIDEO
				array(
					'name' => __('Thumbnail video URL', 'uplift'),
					'id' => $prefix . 'thumbnail_video_url',
					'desc' => __('Enter the video url for the thumbnail. Only links from Vimeo & YouTube are supported.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// THUMBNAIL SELF HOSTED VIDEO
				array(
					'name' => __('Thumbnail Self Hosted Video MP4 URL', 'uplift'),
					'id' => $prefix . 'thumbnail_video_mp4',
					'desc' => __('Enter the video mp4 url for the thumbnail.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				array(
					'name' => __('Thumbnail Self Hosted Video WEBM URL', 'uplift'),
					'id' => $prefix . 'thumbnail_video_webm',
					'desc' => __('Enter the video webm url for the thumbnail.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				array(
					'name' => __('Thumbnail Self Hosted Video OGG URL', 'uplift'),
					'id' => $prefix . 'thumbnail_video_ogg',
					'desc' => __('Enter the video ogg url for the thumbnail.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// THUMBNAIL GALLERY
				array(
					'name'             => __('Thumbnail gallery', 'uplift'),
					'desc'             => __('The images that will be used in the thumbnail gallery.', 'uplift'),
					'id'               => "{$prefix}thumbnail_gallery",
					'type'             => 'image_advanced',
					'max_file_uploads' => 50,
				),
	
				// THUMBNAIL LINK TYPE
				array(
					'name' => __('Thumbnail link type', 'uplift'),
					'id'   => "{$prefix}thumbnail_link_type",
					'type' => 'select',
					'options' => array(
						'link_to_post'		=> __('Link to item', 'uplift'),
						'link_to_url'		=> __('Link to URL', 'uplift'),
						'link_to_url_nw'	=> __('Link to URL (New Window)', 'uplift'),
						'lightbox_thumb'	=> __('Lightbox to the thumbnail image', 'uplift'),
						'lightbox_image'	=> __('Lightbox to image (select below)', 'uplift'),
						'lightbox_video'	=> __('Fullscreen Video Overlay (input below)', 'uplift')
					),
					'multiple' => false,
					'std'  => 'link-to-post',
					'desc' => __('Choose what link will be used for the image(s) and title of the item.', 'uplift')
				),
	
				// THUMBNAIL LINK URL
				array(
					'name' => __('Thumbnail link URL', 'uplift'),
					'id' => $prefix . 'thumbnail_link_url',
					'desc' => __('Enter the url for the thumbnail link.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// THUMBNAIL LINK LIGHTBOX IMAGE
				array(
					'name'  => __('Thumbnail link lightbox image', 'uplift'),
					'desc'  => __('The image that will be used as the lightbox image.', 'uplift'),
					'id'    => "{$prefix}thumbnail_link_image",
					'type'  => 'thickbox_image'
				),
	
				// THUMBNAIL LINK LIGHTBOX VIDEO
				array(
					'name' => __('Thumbnail link lightbox video URL', 'uplift'),
					'id' => $prefix . 'thumbnail_link_video_url',
					'desc' => __('Enter the video url for the thumbnail lightbox. Only links from Vimeo & YouTube are supported.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				)
			)
		);
	
	
		/* Thumbnail Meta Box
		================================================== */
		$meta_boxes[] = array(
			'id' => 'alt_thumbnail_meta_box',
			'title' => __('Thumbnail', 'uplift'),
			'pages' => array( 'portfolio' ),
			'context' => 'normal',
			'fields' => array(
	
				// THUMBNAIL TYPE
				array(
					'name' => __('Thumbnail type', 'uplift'),
					'id'   => "{$prefix}thumbnail_type",
					'type' => 'select',
					'options' => array(
						'none'		=> 'None',
						'image'		=> 'Image',
						'video'		=> 'Video',
						'slider'	=> 'Slider'
					),
					'multiple' => false,
					'std'  => 'image',
					'desc' => __('Choose what will be used for the item thumbnail.', 'uplift')
				),
	
				// THUMBNAIL IMAGE
				array(
					'name'  => __('Thumbnail image', 'uplift'),
					'desc'  => __('The image that will be used as the thumbnail image.', 'uplift'),
					'id'    => "{$prefix}thumbnail_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
	
				// THUMBNAIL VIDEO
				array(
					'name' => __('Thumbnail video URL', 'uplift'),
					'id' => $prefix . 'thumbnail_video_url',
					'desc' => __('Enter the video url for the thumbnail. Only links from Vimeo & YouTube are supported.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// THUMBNAIL GALLERY
				array(
					'name'             => __('Thumbnail gallery', 'uplift'),
					'desc'             => __('The images that will be used in the thumbnail gallery.', 'uplift'),
					'id'               => "{$prefix}thumbnail_gallery",
					'type'             => 'image_advanced',
					'max_file_uploads' => 50,
				),
	
				// THUMBNAIL LINK TYPE
				array(
					'name' => __('Thumbnail link type', 'uplift'),
					'id'   => "{$prefix}thumbnail_link_type",
					'type' => 'select',
					'options' => array(
						'link_to_post'		=> __('Link to item', 'uplift'),
						'link_to_url'		=> __('Link to URL', 'uplift'),
						'link_to_url_nw'	=> __('Link to URL (New Window)', 'uplift'),
						'lightbox_thumb'	=> __('Lightbox to the thumbnail image', 'uplift'),
						'lightbox_image'	=> __('Lightbox to image (select below)', 'uplift'),
						'lightbox_video'	=> __('Fullscreen Video Overlay (input below)', 'uplift')
					),
					'multiple' => false,
					'std'  => 'link-to-post',
					'desc' => __('Choose what link will be used for the image(s) and title of the item.', 'uplift')
				),
	
				// THUMBNAIL LINK URL
				array(
					'name' => __('Thumbnail link URL', 'uplift'),
					'id' => $prefix . 'thumbnail_link_url',
					'desc' => __('Enter the url for the thumbnail link.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// THUMBNAIL LINK LIGHTBOX IMAGE
				array(
					'name'  => __('Thumbnail link lightbox image', 'uplift'),
					'desc'  => __('The image that will be used as the lightbox image.', 'uplift'),
					'id'    => "{$prefix}thumbnail_link_image",
					'type'  => 'thickbox_image'
				),
	
				// THUMBNAIL LINK LIGHTBOX VIDEO
				array(
					'name' => __('Thumbnail link lightbox video URL', 'uplift'),
					'id' => $prefix . 'thumbnail_link_video_url',
					'desc' => __('Enter the video url for the thumbnail lightbox. Only links from Vimeo & YouTube are supported.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// PAGE TITLE BACKGROUND COLOR
				array(
					'name' => __('Thumbnail Hover Background Color', 'uplift'),
					'id' => $prefix . 'port_hover_bg_color',
					'desc' => __("Optionally set an alternate background colour for the thumbnail hover.", 'uplift'),
					'type'  => 'color',
					'std' => '',
				),
	
				// PAGE TITLE TEXT COLOR
				array(
					'name' => __('Thumbnail Hover Text Color', 'uplift'),
					'id' => $prefix . 'port_hover_text_color',
					'desc' => __("Optionally set an alternate text colour for the thumbnail hover.", 'uplift'),
					'type'  => 'color',
					'std' => '',
				),
			)
		);
	
	
		/* Portfolio Masonry Thumbnail Meta Box
		================================================== */
		$meta_boxes[] = array(
			'id' => 'masonry_thumbnail_meta_box',
			'title' => __('Masonry Thumbnail', 'uplift'),
			'pages' => array('portfolio'),
			'context' => 'normal',
			'fields' => array(
	
				// THUMBNAIL TYPE
				array(
					'name' => __('Masonry Thumbnail Size', 'uplift'),
					'id'   => "{$prefix}masonry_thumb_size",
					'type' => 'select',
					'options' => array(
						'standard'	=> 'Standard',
						'wide'		=> 'Wide',
						'tall'		=> 'Tall',
						'wide-tall'	=> 'Wide & Tall'
					),
					'multiple' => false,
					'std'  => 'standard',
					'desc' => __('Choose the size that you would like the item to show as with the Multi-Size Masonry setup. This will only affect the display in an asset with that display type.', 'uplift')
				),
			)
		);
	
	
		/* Detail Media Meta Box
		================================================== */
		$meta_boxes[] = array(
			'id' => 'detail_media_meta_box',
			'title' => __('Detail Media', 'uplift'),
			'pages' => array( 'post', 'portfolio', 'download' ),
			'context' => 'normal',
			'fields' => array(
	
				// USE THUMBNAIL CONTENT FOR THE MAIN DETAIL DISPLAY
				array(
					'name' => __('Use the thumbnail content', 'uplift'),    // File type: checkbox
					'id'   => "{$prefix}thumbnail_content_main_detail",
					'type' => 'checkbox',
					'desc' => __('Uncheck this box if you wish to select different media for the main detail display.', 'uplift'),
					'std' => 0,
				),
	
				// DETAIL TYPE
				array(
					'name' => __('Detail type', 'uplift'),
					'id'   => "{$prefix}detail_type",
					'type' => 'select',
					'options' => array(
						'none'		=> __('None', 'uplift'),
						'image'		=> __('Image', 'uplift'),
						'video'		=> __('Video', 'uplift'),
						'slider'	=> __('Standard Slider', 'uplift'),
						'gallery-stacked'	=> __('Stacked Gallery', 'uplift'),
						'layer-slider' => __('Revolution/Layer Slider', 'uplift'),
						'audio' => __('Audio', 'uplift'),
						'sh-video' => __('Self Hosted Video', 'uplift'),
						'custom' => __('Custom', 'uplift')
					),
					'multiple' => false,
					'std'  => $default_detail_media,
					'desc' => __('Choose what will be used for the item detail media.', 'uplift')
				),
	
				// DETAIL IMAGE
				array(
					'name'  => __('Detail image', 'uplift'),
					'desc'  => __('The image that will be used as the detail image.', 'uplift'),
					'id'    => "{$prefix}detail_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
	
				// DETAIL VIDEO
				array(
					'name' => __('Detail video URL', 'uplift'),
					'id' => $prefix . 'detail_video_url',
					'desc' => __('Enter the video url for the detail display. Only links from Vimeo & YouTube are supported.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// DETAIL AUDIO
				array(
					'name' => __('Detail audio URL', 'uplift'),
					'id' => $prefix . 'detail_audio_url',
					'desc' => __('Enter the audio url for the detail display.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// DETAIL SELF HOSTED VIDEO
				array(
					'name' => __('Detail Self Hosted Video MP4 URL', 'uplift'),
					'id' => $prefix . 'detail_video_mp4',
					'desc' => __('Enter the video mp4 url for the detail display.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				array(
					'name' => __('Detail Self Hosted Video WEBM URL', 'uplift'),
					'id' => $prefix . 'detail_video_webm',
					'desc' => __('Enter the video webm url for the detail display.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				array(
					'name' => __('Detail Self Hosted Video OGG URL', 'uplift'),
					'id' => $prefix . 'detail_video_ogg',
					'desc' => __('Enter the video ogg url for the detail display.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// DETAIL GALLERY
				array(
					'name'             => __('Post detail gallery', 'uplift'),
					'desc'             => __('The images that will be used in the detail gallery.', 'uplift'),
					'id'               => "{$prefix}detail_gallery",
					'type'             => 'image_advanced',
					'max_file_uploads' => 50,
				),
	
				// DETAIL REV SLIDER
				array(
					'name' => __('Revolution slider alias', 'uplift'),
					'id' => $prefix . 'detail_rev_slider_alias',
					'desc' => __("Enter the revolution slider alias for the slider that you want to show.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// DETAIL LAYER SLIDER
				array(
					'name' => __('Layer Slider alias', 'uplift'),
					'id' => $prefix . 'detail_layer_slider_alias',
					'desc' => __("Enter the Layer Slider ID for the slider that you want to show.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// DETAIL CUSTOM
				array(
					'name' => __('Custom detail display', 'uplift'),
					'desc' => __("If you'd like to provide your own detail media, please add it here", 'uplift'),
					'id'   => "{$prefix}custom_media",
					'type' => 'textarea',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
			)
		);
	
		/* Page Title Meta Box
		================================================== */
		$meta_boxes[] = array(
			'id' => 'page_heading_meta_box',
			'title' => __('Page Title', 'uplift'),
			'pages' => array( 'post', 'page', 'portfolio', 'product', 'team', 'galleries' ),
			'context' => 'normal',
			'fields' => array(
	
				// SHOW PAGE TITLE
				array(
					'name' => __('Show page title', 'uplift'),    // File type: checkbox
					'id'   => "{$prefix}page_title",
					'type' => 'checkbox',
					'desc' => __('Show the page title at the top of the page.', 'uplift'),
					'std' => $default_show_page_heading,
				),
	
				// PAGE TITLE BACKGROUND COLOR
				array(
					'name' => __('Page Title Background Color', 'uplift'),
					'id' => $prefix . 'page_title_bg_color',
					'desc' => __("Optionally set a background color for the page title.", 'uplift'),
					'type'  => 'color',
					'std' => '',
				),
	
				// PAGE TITLE TEXT COLOR
				array(
					'name' => __('Page Title Text Color', 'uplift'),
					'id' => $prefix . 'page_title_text_color',
					'desc' => __("Optionally set a text color for the page title.", 'uplift'),
					'type'  => 'color',
					'std' => '',
				),
	
				// PAGE TITLE STYLE
				array(
					'name' => __('Page Title Style', 'uplift'),
					'id'   => "{$prefix}page_title_style",
					'type' => 'select',
					'options' => array(
						'standard'		=> __('Standard', 'uplift'),
						'fancy'		=> __('Hero', 'uplift'),
					),
					'multiple' => false,
					'std'  => 'standard',
					'desc' => __('Choose the heading style.', 'uplift')
				),
	
				// PAGE TITLE LINE 1
				array(
					'name' => __('Page Title', 'uplift'),
					'id' => $prefix . 'page_title_one',
					'desc' => __("Enter a custom page title if you'd like.", 'uplift'),
					'type'  => 'text',
					'std' => '',
				),
	
				// PAGE TITLE LINE 2
				array(
					'name' => __('Page Subtitle', 'uplift'),
					'id' => $prefix . 'page_subtitle',
					'desc' => __("Enter a custom page title if you'd like (Hero Page Title Style Only).", 'uplift'),
					'type'  => 'text',
					'std' => '',
				),
				// PAGE TITLE BACKGROUND COLOR
	            array(
	                'name' => __( 'Hero Overlay Color', 'uplift' ),
	                'id'   => "{$prefix}bg_color_title",
	                'desc' => __( "Set an overlay color for hero heading image.", 'uplift' ),
	                'type' => 'color',
	                'std'  => '',
	            ),
	            // Overlay Opacity Value
	            array(
	                'name'       => __( 'Overlay Opacity', 'uplift' ),
	                'id'         => "{$prefix}bg_opacity_title",
	                'desc'       => __( 'Set the opacity level of the overlay. This will lighten or darken the image depening on the color selected.', 'uplift' ),
	                'clone'      => false,
	                'type'       => 'slider',
	                'prefix'     => '',
	                'js_options' => array(
	                    'min'  => 0,
	                    'max'  => 100,
	                    'step' => 1,
	                ),
	            ),
	
				// HERO HEADING IMAGE UPLOAD
				array(
					'name'  => __('Hero Heading Background Image', 'uplift'),
					'desc'  => __('The image that will be used as the background for the hero header.', 'uplift'),
					'id'    => "{$prefix}page_title_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
	
				// HERO HEADING OVERLAY STYLE
	//			array(
	//				'name' => __('Hero Heading Overlay Effect', 'uplift'),
	//				'id'   => "{$prefix}page_title_overlay_effect",
	//				'type' => 'select',
	//				'options' => array(
	//					'none'			=> __('None', 'uplift'),
	//					'circles'		=> __('Falling Circles', 'uplift'),
	//					'geometric'		=> __('Geometric', 'uplift')
	//				),
	//				'multiple' => false,
	//				'std'  => 'none',
	//				'desc' => __('Optionally have an animated canvas overlay on the hero heading background.', 'uplift')
	//			),
	
				// HERO HEADING TEXT STYLE
				array(
					'name' => __('Hero Heading Text Style', 'uplift'),
					'id'   => "{$prefix}page_title_text_style",
					'type' => 'select',
					'options' => array(
						'light'		=> __('Light', 'uplift'),
						'dark'		=> __('Dark', 'uplift')
					),
					'multiple' => false,
					'std'  => 'light',
					'desc' => __('If you uploaded an image in the option above, choose light/dark styling for the text heading text here.', 'uplift')
				),
	
				// HERO HEADING TEXT ALIGN
				array(
					'name' => __('Hero Heading Text Align', 'uplift'),
					'id'   => "{$prefix}page_title_text_align",
					'type' => 'select',
					'options' => array(
						'left'		=> __('Left', 'uplift'),
						'center'		=> __('Center', 'uplift'),
						'right'		=> __('Right', 'uplift')
					),
					'multiple' => false,
					'std'  => 'left',
					'desc' => __('Choose the text alignment for the hero heading.', 'uplift')
				),
	
				// HERO HEADING HEIGHT
				array(
					'name' => __('Hero Heading Height', 'uplift'),
					'id' => "{$prefix}page_title_height",
					'desc' => __("Set the height for the Hero Heading (no px).", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '400',
				),
	
				// REMOVE BREADCRUMBS
				array(
					'name' => __('Remove breadcrumbs', 'uplift'),
					'id'   => "{$prefix}no_breadcrumbs",
					'type' => 'checkbox',
					'desc' => __('Remove the breadcrumbs from under the page title on this page.', 'uplift'),
					'std' => 0,
				),
			)
		);
	
		/* Portfolio Meta Box
		================================================== */
		$meta_boxes[] = array(
			'id' => 'portfolio_meta_box',
			'title' => __('Portfolio Meta', 'uplift'),
			'pages' => array( 'portfolio' ),
			'context' => 'normal',
			'fields' => array(
	
				// PORTFOLIO HEADER OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => __('Portfolio Header Options', 'uplift'),
				    'id' 	=> "{$prefix}heading_header",
				    'type' 	=> 'section'
				),
	
				// PORTFOLIO HEADER TYPE
				array(
					'name' => __('Portfolio Header Type', 'uplift'),
					'id'   => "{$prefix}page_header_type",
					'type' => 'select',
					'options' => array(
						'standard'		=> __('Standard', 'uplift'),
						'naked-light'	=> __('Naked (Light)', 'uplift'),
						'naked-dark'	=> __('Naked (Dark)', 'uplift'),
					),
					'multiple' => false,
					'std'  => 'standard',
					'desc' => __('Choose the type of header that is shown on this portfolio. NOTE: The naked options are only possible when you have the hero heading enabled, or the media display below set to "Full Width Media" & no heading shown.', 'uplift'),
				),
	
				// ITEM DETAILS OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => __('Portfolio Item Details', 'uplift'),
				    'id' 	=> "{$prefix}heading_item_details",
				    'type' 	=> 'section'
				),
	
				// Client Text
				array(
					'name' => __('Client', 'uplift'),
					'id' => $prefix . 'portfolio_client',
					'desc' => __("Enter a client for use within the portfolio item index (optional).", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// Client Text
				array(
					'name' => __('Project', 'uplift'),
					'id' => $prefix . 'portfolio_project',
					'desc' => __("Enter a project name (optional).", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// Sub Text
				array(
					'name' => __('Subtitle', 'uplift'),
					'id' => $prefix . 'portfolio_subtitle',
					'desc' => __("Enter a subtitle for use within the portfolio item index (optional).", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// External Link
				array(
					'name' => __('External Link', 'uplift'),
					'id' => $prefix . 'portfolio_external_link',
					'desc' => __("Enter an external link for the item  (optional) (NOTE: INCLUDE HTTP://).", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// CUSTOM EXCERPT SECTION
				array (
					'name' 	=> '',
					'title' => __('Custom Excerpt', 'uplift'),
				    'id' 	=> "{$prefix}heading_custom_excerpt",
				    'type' 	=> 'section'
				),
	
				// CUSTOM EXCERPT
				array(
					'name' => __('Custom excerpt', 'uplift'),
					'desc' => __("You can optionally write a custom excerpt here to display instead of the excerpt that is automatically generated. If you use the page builder, then you'll want to add content to this box.", 'uplift'),
					'id'   => "{$prefix}custom_excerpt",
					'type' => 'textarea',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
	
				// MAIN DETAIL SECTION
				array (
					'name' 	=> '',
					'title' => __('Main Detail Options', 'uplift'),
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
	
				// FULL WIDTH MEDIA DISPLAY
				array(
					'name' => __('Media Display', 'uplift'),
					'id'   => "{$prefix}fw_media_display",
					'type' => 'select',
					'options' => array(
						'fw-media'		=> __('Full Width Media', 'uplift'),
						'poster' => __('Poster', 'uplift'),
						'split'		=> __('Split Media / Description', 'uplift'),
						'standard'	=> __('Standard', 'uplift'),
					),
					'multiple' => false,
					'std'  => 'standard',
					'desc' => __('Choose how you would like to display your selected media - full width (edge to edge), split, or standard (media with content below).', 'uplift')
				),
				
				// TITLE OVERLAY TEXT COLOR
				array(
					'name' => __('Poster Title Overlay Text Color', 'uplift'),
					'id' => $prefix . 'poster_title_overlay_text_color',
					'desc' => __("Set a text color for the poster title overlay text.", 'uplift'),
					'type'  => 'color',
					'std' => '',
				),
	
				// MEDIA IMAGE HEIGHT
				array(
					'name' => __('Media Image Height', 'uplift'),
					'id' => $prefix . 'media_height',
					'desc' => __("If you are using the image detail type, and would like to set a height for the image - then please do so here (no px).", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				array(
					'name' => __('Item Sidebar Content', 'uplift'),
					'desc' => __("You can optionally add some content here to display in the details column, including shortcodes etc. Only visible on Standard and Full Width Media display types.", 'uplift'),
					'id'   => "{$prefix}item_sidebar_content",
					'type' => 'wysiwyg',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
	
				// HIDE DETAILS BAR
				array(
					'name' => __('Hide item details bar', 'uplift'),
					'id'   => "{$prefix}hide_details",
					'type' => 'checkbox',
					'desc' => __('Check this box to hide the item details on the detail page.', 'uplift'),
					'std' => 0,
				),
	
				// INCLUDE SOCIAL SHARING
				array(
					'name' => __('Include social sharing', 'uplift'),
					'id'   => "{$prefix}social_sharing",
					'type' => 'checkbox',
					'desc' => __('Check this box to show social sharing icons on the detail page.', 'uplift'),
					'std' => 1,
				),
	
				// ONE PAGE OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => __('One Page Options', 'uplift'),
				    'id' 	=> "{$prefix}heading_onepage",
				    'type' 	=> 'section'
				),
	
				// ONE PAGE OPTIONS
				array(
					'name' => __('Enable One Page Navigation', 'uplift'),    // File type: checkbox
					'id'   => "{$prefix}enable_one_page_nav",
					'type' => 'checkbox',
					'desc' => __('Enable the one page nav which appears on the right of the page.', 'uplift'),
					'std' => 0,
				),			
	
				// MISC
				array (
					'name' 	=> '',
					'title' => __('Misc. Options', 'uplift'),
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
	
				// Extra Page Class
				array(
					'name' => __('Extra page class', 'uplift'),
					'id' => $prefix . 'extra_page_class',
					'desc' => __("If you wish to add extra classes to the body class of the page (for custom css use), then please add the class(es) here.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// REMOVE TOP SPACING
				array(
					'name' => __('Remove top spacing', 'uplift'),    // File type: checkbox
					'id'   => "{$prefix}no_top_spacing",
					'type' => 'checkbox',
					'desc' => __('Remove the spacing at the top of the page.', 'uplift'),
					'std' => 0,
				),
	
				// REMOVE PROMO BAR
				array(
					'name' => __('Remove promo bar', 'uplift'),   // File type: checkbox
					'id'   => "{$prefix}remove_promo_bar",
					'type' => 'checkbox',
					'desc' => __('Remove the promo bar at the bottom of the page.', 'uplift'),
					'std' => 0,
				)
			)
		);
	
	
		/* Page Layout Meta Box
		================================================== */
		$meta_boxes[] = array(
			'id' => 'page_style_meta_box',
			'title' => __('Page Style', 'uplift'),
			'pages' => array( 'page' , 'post' ),
			'context' => 'normal',
			'fields' => array(
	
				// BOXED INNER PAGE
				array(
					'name' => __('Page Design Style', 'uplift'),    // File type: checkbox
					'id'   => "{$prefix}page_design_style",
					'type' => 'select',
					'options' => array(
						'standard'		=> __('Standard', 'uplift'),
						'boxed-inner-page'	=> __('Boxed Inner Page', 'uplift'),
						'hero-content-split'	=> __('Hero / Content Split', 'swiftframework'),
					),
					'multiple' => false,
					'std'  => 'standard',
					'desc' => __('Select the design style for the page. NOTE: if using the "Hero / Content Split" style, then please make sure you have the page title style set to "Hero" and that you have set the background image for it there.', 'uplift'),
				),
	
			)
		);
	
	
		/* Page Background Meta Box
		================================================== */
		$meta_boxes[] = array(
			'id' => 'page_background_meta_box',
			'title' => __('Page Background', 'uplift'),
			'pages' => array( 'post', 'portfolio', 'product', 'page' ),
			'context' => 'normal',
			'fields' => array(
	
				// BACKGROUND IMAGE
				array(
					'name'  => __('Background Image', 'uplift'),
					'desc'  => __('The image that will be used as the OUTER page background image.', 'uplift'),
					'id'    => "{$prefix}background_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
	
				// BACKGROUND SIZE
				array(
					'name' => __('Background Image Size', 'uplift'),
					'desc' => __('For fullscreen images, choose Cover. For repeating patterns, choose Auto.', 'uplift'),
					'id'   => "{$prefix}background_image_size",
					'type' => 'select',
					'options' => array(
						'cover'		=> 'Cover',
						'auto'	=> 'Auto'
					),
					'multiple' => false,
					'std'  => 'cover',
				),
	
				// INNER BACKGROUND IMAGE
				array(
					'name'  => __('Inner Background Image', 'uplift'),
					'desc'  => __('The image that will be used as the INNER page background image.', 'uplift'),
					'id'    => "{$prefix}inner_background_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
	
				// BACKGROUND SIZE
				array(
					'name' => __('Inner Background Image Size', 'uplift'),
					'desc' => __('For fullscreen images, choose Cover. For repeating patterns, choose Auto.', 'uplift'),
					'id'   => "{$prefix}inner_background_image_size",
					'type' => 'select',
					'options' => array(
						'cover'		=> 'Cover',
						'auto'	=> 'Auto'
					),
					'multiple' => false,
					'std'  => 'auto',
				),
	
				// INNER BACKGROUND COLOR
				array(
					'name' => __('Inner Background Color', 'uplift'),
					'id' => $prefix . 'inner_background_color',
					'desc' => __("Optionally set a background color for the inner page background.", 'uplift'),
					'type'  => 'color',
					'std' => '',
				),
	
			)
		);
	
		/* Download Options Meta Box
		================================================== */
		$meta_boxes[] = array(
			'id' => 'download_meta_box',
			'title' => __('Download Options', 'uplift'),
			'pages' => array( 'post' ),
			'context' => 'normal',
			'priority' => 'low',
			'fields' => array(
				// DOWNLOAD BUTTON
				array(
					'name' => __('Show Download Button', 'uplift'),   // File type: checkbox
					'id'   => "{$prefix}download_button",
					'type' => 'checkbox',
					'desc' => __('Enable a download button on the detail and index for the post.', 'uplift'),
					'std' => 0,
				),
	
				// DOWNLOAD FILE
				array(
					'name'  => __('Download File', 'uplift'),
					'desc'  => __('The file that the download button will link to.', 'uplift'),
					'id'    => "{$prefix}download_file",
					'type'  => 'file_advanced',
					'max_file_uploads' => 1
				),
	
				// DOWNLOAD SHORTCODE
				array(
					'name' => __('Download shortcode', 'uplift'),
					'desc' => __("Alternatively, you can provide a shortcode here for your download, for example from the Easy Digital Downloads plugin.", 'uplift'),
					'id'   => "{$prefix}download_shortcode",
					'type' => 'textarea',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
			)
		);
	
	
		/* Post Meta Box
		================================================== */
		$meta_boxes[] = array(
			'id' => 'post_meta_box',
			'title' => __('Post Meta', 'uplift'),
			'pages' => array( 'post' ),
			'context' => 'normal',
			'fields' => array(
	
				// CUSTOM EXCERPT SECTION
				array (
					'name' 	=> '',
					'title' => __('Custom Excerpt', 'uplift'),
				    'id' 	=> "{$prefix}heading_custom_excerpt",
				    'type' 	=> 'section'
				),
	
				// CUSTOM EXCERPT
				array(
					'name' => __('Custom excerpt', 'uplift'),
					'desc' => __("You can optionally write a custom excerpt here to display instead of the excerpt that is automatically generated. If you use the page builder, then you'll want to add content to this box.", 'uplift'),
					'id'   => "{$prefix}custom_excerpt",
					'type' => 'textarea',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
	
				// MAIN DETAIL SECTION
				array (
					'name' 	=> '',
					'title' => __('Main Detail Options', 'uplift'),
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
	
				// PAGE HEADER TYPE
				array(
					'name' => __('Post Header Type', 'uplift'),
					'id'   => "{$prefix}page_header_type",
					'type' => 'select',
					'options' => array(
						'standard'		=> __('Standard', 'uplift'),
						'naked-light'	=> __('Naked (Light)', 'uplift'),
						'naked-dark'	=> __('Naked (Dark)', 'uplift'),
					),
					'multiple' => false,
					'std'  => 'standard',
					'desc' => __('Choose the type of header that is shown on this post. NOTE: The naked options are only possible when you have the hero heading enabled, or the media display below set to "Full Width with Title Overlay".', 'uplift'),
				),
	
				// FULL WIDTH MEDIA
				array(
					'name' => __('Media Display', 'uplift'),
					'id'   => "{$prefix}fw_media_display",
					'type' => 'select',
					'options' => array(
						'fw-media-title'		=> __('Full Width with Title Overlay', 'uplift'),
						'fw-media'		=> __('Full Width', 'uplift'),
						'standard-above'		=> __('Standard (Above content)', 'uplift'),
						'standard'	=> __('Standard', 'uplift'),
					),
					'multiple' => false,
					'std'  => 'standard',
					'desc' => __('Choose how you would like to display your selected media - full width (edge to edge) with or without the title overlay, or standard. If you choose the title overlay option, it is recommended that you hide the page title in the page title meta options.', 'uplift')
				),
				
				// MEDIA IMAGE HEIGHT
				array(
					'name' => __('Title Overlay Min Height', 'uplift'),
					'id' => $prefix . 'media_height',
					'desc' => __("If you are using the 'Full Width with Title Overlay' media display type, you can set a min-height for it here (no px).", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '500',
				),
	
				// TITLE OVERLAY TEXT COLOR
				array(
					'name' => __('Title Overlay Text Color', 'uplift'),
					'id' => $prefix . 'title_overlay_text_color',
					'desc' => __("Optionally set a text color for the title overlay text.", 'uplift'),
					'type'  => 'color',
					'std' => '',
				),
	
				// CONTENT FORMATTING
				array(
					'name' => __('Extra Paragraph Spacing', 'uplift'),
					'id'   => "{$prefix}extra_paragraph_spacing",
					'type' => 'checkbox',
					'desc' => __('Check this box to enable extra spacing around paragraph elements within the post content.', 'uplift'),
					'std' => 0,
				),
	
				// INCLUDE AUTHOR INFO
				array(
					'name' => __('Include author info', 'uplift'),
					'id'   => "{$prefix}author_info",
					'type' => 'checkbox',
					'desc' => __('Check this box to show the author info box on the detail page.', 'uplift'),
					'std' => $default_include_author,
				),
	
				// INCLUDE SOCIAL SHARING
				array(
					'name' => __('Include social sharing', 'uplift'),
					'id'   => "{$prefix}social_sharing",
					'type' => 'checkbox',
					'desc' => __('Check this box to show social sharing icons on the detail page.', 'uplift'),
					'std' => $default_include_social,
				),
				
				// REMOVE PAGINATION
				// array(
				// 	'name' => __('Remove article pagination', 'uplift'),
				// 	'id'   => "{$prefix}remove_next_prev",
				// 	'type' => 'checkbox',
				// 	'desc' => __('Check this box to remove the next/previous article pagination on the detail page.', 'uplift'),
				// 	'std' => 0,
				// ),
	
				// INCLUDE RELATED ARTICLES
				array(
					'name' => __('Include related articles', 'uplift'),
					'id'   => "{$prefix}related_articles",
					'type' => 'checkbox',
					'desc' => __('Check this box to show related articles on the detail page.', 'uplift'),
					'std' => $default_include_related,
				),
	
				// MISC
				array (
					'name' 	=> '',
					'title' => __('Misc. Options', 'uplift'),
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
	
				// Extra Page Class
				array(
					'name' => __('Extra page class', 'uplift'),
					'id' => $prefix . 'extra_page_class',
					'desc' => __("If you wish to add extra classes to the body class of the page (for custom css use), then please add the class(es) here.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// REMOVE PROMO BAR
				array(
					'name' => __('Remove promo bar', 'uplift'),   // File type: checkbox
					'id'   => "{$prefix}remove_promo_bar",
					'type' => 'checkbox',
					'desc' => __('Remove the promo bar at the bottom of the page.', 'uplift'),
					'std' => 0,
				),
	
				// REMOVE TOP SPACING
				array(
					'name' => __('Remove top spacing', 'uplift'),    // File type: checkbox
					'id'   => "{$prefix}no_top_spacing",
					'type' => 'checkbox',
					'desc' => __('Remove the spacing at the top of the page.', 'uplift'),
					'std' => 0,
				),
	
				// REMOVE BOTTOM SPACING
				array(
					'name' => __('Remove bottom spacing', 'uplift'),    // File type: checkbox
					'id'   => "{$prefix}no_bottom_spacing",
					'type' => 'checkbox',
					'desc' => __('Remove the spacing at the bottom of the page.', 'uplift'),
					'std' => 0,
				)
	
			)
		);
	
	
		/* Product Meta Box
		================================================== */
		$meta_boxes[] = array(
			'id' => 'product_meta_box',
			'title' => __('Product Meta', 'uplift'),
			'pages' => array( 'product' ),
			'context' => 'normal',
			'fields' => array(
	
				// PRODUCT DISPLAY SECTION
				array (
					'name' 	=> '',
					'title' => __('Product Display', 'uplift'),
				    'id' 	=> "{$prefix}heading_product_display",
				    'type' 	=> 'section'
				),
	
				// PAGE HEADER TYPE
				array(
					'name' => __('Page Display Type', 'uplift'),
					'id'   => "{$prefix}product_layout",
					'type' => 'select',
					'options' => array(
						'standard'		=> __('Standard', 'uplift'),
						'fw-split'	=> __('Fullscreen Split', 'uplift'),
					),
					'multiple' => false,
					'std'  => 'standard',
					'desc' => __('Choose the layout for the product detail display.', 'uplift'),
				),
	
				// FULLSCREEN SPLIT BACKGROUND COLOR
				array(
					'name' => __('Fullscreen Display Background Color', 'uplift'),
					'id' => $prefix . 'fw_split_bg_color',
					'desc' => __("Optionally set a background colour for product display slider (ONLY when using the Fullscreen Split display type above).", 'uplift'),
					'type'  => 'color',
					'std' => '',
				),
	
				// PRODUCT DESCRIPTION SECTION
				array (
					'name' 	=> '',
					'title' => __('Product Description', 'uplift'),
				    'id' 	=> "{$prefix}heading_custom_excerpt",
				    'type' 	=> 'section'
				),
	
				// PRODUCT DESCRIPTION
				array(
					'name' => __('Product Short Description', 'uplift'),
					'desc' => __("You can optionally write a short description here, which shows above the variations/cart options.", 'uplift'),
					'id'   => "{$prefix}product_short_description",
					'type' => 'textarea',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
	
				// PRODUCT DESCRIPTION
				array(
					'name' => __('Product Description', 'uplift'),
					'desc' => __("You can optionally write a product description here, which shows under the description accordion heading if you have the page builder enabled for product pages.", 'uplift'),
					'id'   => "{$prefix}product_description",
					'type' => 'textarea',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
	
				// MISC
				array (
					'name' 	=> '',
					'title' => __('Misc. Options', 'uplift'),
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
				
				// REMOVE PAGINATION
				array(
					'name' => __('Remove product tabs', 'uplift'),
					'id'   => "{$prefix}remove_product_tabs",
					'type' => 'checkbox',
					'desc' => __('Check this box to remove the product tabs.', 'uplift'),
					'std' => 0,
				),
	
				// INCLUDE RELATED ARTICLES
				array(
					'name' => __('Remove related products', 'uplift'),
					'id'   => "{$prefix}remove_related_products",
					'type' => 'checkbox',
					'desc' => __('Check this box to remove related products.', 'uplift'),
					'std' => 0,
				),
	
				// Extra Page Class
				array(
					'name' => __('Extra page class', 'uplift'),
					'id' => $prefix . 'extra_page_class',
					'desc' => __("If you wish to add extra classes to the body class of the page (for custom css use), then please add the class(es) here.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// REMOVE PROMO BAR
				array(
					'name' => __('Remove promo bar', 'uplift'),    // File type: checkbox
					'id'   => "{$prefix}remove_promo_bar",
					'type' => 'checkbox',
					'desc' => __('Remove the promo bar at the bottom of the page.', 'uplift'),
					'std' => 0,
				)
	
			)
		);
	
	
	
		/* Product Masonry Thumbnail Meta Box
		================================================== */
		$meta_boxes[] = array(
			'id' => 'masonry_thumbnail_meta_box',
			'title' => __('Masonry Thumbnail', 'uplift'),
			'pages' => array('product'),
			'context' => 'normal',
			'fields' => array(
	
				// THUMBNAIL TYPE
				array(
					'name' => __('Masonry Thumbnail Size', 'uplift'),
					'id'   => "{$prefix}masonry_thumb_size",
					'type' => 'select',
					'options' => array(
						'standard'	=> 'Standard',
						'large'		=> 'Large',
						'tall'		=> 'Tall'
					),
					'multiple' => false,
					'std'  => 'standard',
					'desc' => __('Choose the size that you would like the item to show as with the Multi-Size Masonry setup. This will only affect the display in an asset with that display type.', 'uplift')
				),
			)
		);
	
	
		/* Team Meta Box
		================================================== */
		$meta_boxes[] = array(
			'id'    => 'team_meta_box',
			'title' => __('Team Member Meta', 'uplift'),
			'pages' => array( 'team' ),
			'fields' => array(
	
				// CUSTOM EXCERPT SECTION
				array (
					'name' 	=> '',
					'title' => __('Custom Excerpt', 'uplift'),
				    'id' 	=> "{$prefix}heading_custom_excerpt",
				    'type' 	=> 'section'
				),
	
				// CUSTOM EXCERPT
				array(
					'name' => __('Custom excerpt', 'uplift'),
					'desc' => __("You can optionally write a custom excerpt here to display instead of the excerpt that is automatically generated (this is needed if you use the page builder above).", 'uplift'),
					'id'   => "{$prefix}custom_excerpt",
					'type' => 'textarea',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
	
				// TEAM MEMBER DETAILS SECTION
				array (
					'name' 	=> '',
					'title' => __('Team Member Details', 'uplift'),
				    'id' 	=> "{$prefix}heading_team_member_details",
				    'type' 	=> 'section'
				),
	
				// TEAM MEMBER POSITION
				array(
					'name' => __('Position', 'uplift'),
					'id' => $prefix . 'team_member_position',
					'desc' => __("Enter the team member's position within the team.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// TEAM MEMBER EMAIL
				array(
					'name' => __('Email Address', 'uplift'),
					'id' => $prefix . 'team_member_email',
					'desc' => __("Enter the team member's email address.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// TEAM MEMBER PHONE NUMBER
				array(
					'name' => __('Phone Number', 'uplift'),
					'id' => $prefix . 'team_member_phone_number',
					'desc' => __("Enter the team member's phone number.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// TEAM MEMBER TWITTER
				array(
					'name' => __('Twitter', 'uplift'),
					'id' => $prefix . 'team_member_twitter',
					'desc' => __("Enter the team member's Twitter username.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// TEAM MEMBER FACEBOOK
				array(
					'name' => __('Facebook', 'uplift'),
					'id' => $prefix . 'team_member_facebook',
					'desc' => __("Enter the team member's Facebook URL.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// TEAM MEMBER LINKEDIN
				array(
					'name' => __('LinkedIn', 'uplift'),
					'id' => $prefix . 'team_member_linkedin',
					'desc' => __("Enter the team member's LinkedIn URL.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// TEAM MEMBER GOOGLE+
				array(
					'name' => __('Google+', 'uplift'),
					'id' => $prefix . 'team_member_google_plus',
					'desc' => __("Enter the team member's Google+ URL.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// TEAM MEMBER SKYPE
				array(
					'name' => __('Skype', 'uplift'),
					'id' => $prefix . 'team_member_skype',
					'desc' => __("Enter the team member's Skype username.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// TEAM MEMBER INSTAGRAM
				array(
					'name' => __('Instagram', 'uplift'),
					'id' => $prefix . 'team_member_instagram',
					'desc' => __("Enter the team member's Instragram URL (e.g. http://hashgr.am/).", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// TEAM MEMBER DRIBBBLE
				array(
					'name' => __('Dribbble', 'uplift'),
					'id' => $prefix . 'team_member_dribbble',
					'desc' => __("Enter the team member's Dribbble username.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER BEHANCE
				array(
					'name' => __('Behance', 'uplift'),
					'id' => $prefix . 'team_member_behance',
					'desc' => __("Enter the team member's Behance URL.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER FLICKR
				array(
					'name' => __('Flickr', 'uplift'),
					'id' => $prefix . 'team_member_flickr',
					'desc' => __("Enter the team member's Flickr URL.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER VIMEO
				array(
					'name' => __('Vimeo', 'uplift'),
					'id' => $prefix . 'team_member_vimeo',
					'desc' => __("Enter the team member's Vimeo URL.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER SNAPCHAT
				array(
					'name' => __('Snapchat', 'uplift'),
					'id' => $prefix . 'team_member_snapchat',
					'desc' => __("Enter the team member's Snapchat URL.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
			)
		);
	
	
		/* Clients Meta Box
		================================================== */
		$meta_boxes[] = array(
			'id'    => 'client_meta_box',
			'title' => __('Client Meta', 'uplift'),
			'pages' => array( 'clients' ),
			'fields' => array(
	
				// CLIENT IMAGE LINK
				array(
					'name' => __('Client Link', 'uplift'),
					'id' => $prefix . 'client_link',
					'desc' => __("Enter the link for the client if you want the image to be clickable.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => ''
				)
			)
		);
	
	
		/* Testimonials Meta Box
		================================================== */
		$meta_boxes[] = array(
			'id'    => 'testimonials_meta_box',
			'title' => __('Testimonial Meta', 'uplift'),
			'pages' => array( 'testimonials' ),
			'fields' => array(
	
				// TESTIMONAIL CITE
				array(
					'name' => __('Testimonial Cite', 'uplift'),
					'id' => $prefix . 'testimonial_cite',
					'desc' => __("Enter the cite name for the testimonial.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => ''
				),
	
				// TESTIMONAIL CITE
				array(
					'name' => __('Testimonial Cite Subtext', 'uplift'),
					'id' => $prefix . 'testimonial_cite_subtext',
					'desc' => __("Enter the cite subtext for the testimonial (optional).", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => ''
				),
	
				// TESTIMONAIL IMAGE
				array(
					'name'  => __('Testimonial Cite Image', 'uplift'),
					'desc'  => __('Enter the cite image for the testimonial (optional).', 'uplift'),
					'id'    => "{$prefix}testimonial_cite_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
			)
		);
	
	
		/* Slider Meta Box
		================================================== */
		$meta_boxes[] = array(
			'id'    => 'page_header_meta_box',
			'title' => __('Page Header / Slider', 'uplift'),
			'pages' => array( 'page' ),
			'fields' => array(
	
				// PAGE HEADER TYPE
				array(
					'name' => __('Page Header Type', 'uplift'),
					'id'   => "{$prefix}page_header_type",
					'type' => 'select',
					'options' => array(
						'standard'		=> __('Standard', 'uplift'),
						'standard-overlay'	=> __('Standard (Overlay)', 'uplift'),
						'naked-light'	=> __('Naked (Light)', 'uplift'),
						'naked-dark'	=> __('Naked (Dark)', 'uplift'),
						'below-slider'	=> __('Below Slider', 'uplift')
					),
					'multiple' => false,
					'std'  => 'standard',
					'desc' => __('Choose the type of header that is shown on this page. If you choose one of the Naked header options, then the header will be overlaid over the slider/area below it. NOTE: These options are only applicable for non-vertical headers.', 'uplift'),
				),
				
				// APP STYLE HEADER
				array(
					'name' => __('App Style Header', 'uplift'),
					'id'   => "{$prefix}page_header_app_style",
					'type' => 'checkbox',
					'std'  => 0,
					'desc' => __('Choose if you would like to display an app style header. NOTE: This requires the page title to be set to Hero style, and a heading background image to be set to function correctly.', 'uplift'),
				),
				
				// APP STYLE HEADER
				array(
					'name' => __('Forced Transparent Sticky Header', 'uplift'),
					'id'   => "{$prefix}sticky_header_transparent",
					'type' => 'checkbox',
					'std'  => 0,
					'desc' => __('Choose if you would like the sticky header on this page to be forced transparent. Cannot be used in conjunction with the app header option above.', 'uplift'),
				),
	
				// PAGE HEADER ALT LOGO
				array(
					'name' => __('Use Alt Logo', 'uplift'),
					'id'   => "{$prefix}page_header_alt_logo",
					'type' => 'checkbox',
					'std'  => 0,
					'desc' => __('Choose if you would like to use the ALT logo on this page (the logo will revert to the standard logo for the sticky header if you are using it).', 'uplift'),
				),
	
				// PAGE MENU
				array(
					'name' => __('Page Menu', 'uplift'),
					'id'   => "{$prefix}page_menu",
					'type' => 'select',
					'options' => $menu_list,
					'multiple' => false,
					'std'  => '',
					'desc' => __('Optionally you can choose to override the menu that is used on the page. This is ideal if you want to create a page with a anchor link scroll menu.', 'uplift'),
				),
	
				// PAGE SLIDER
				array(
					'name' => __('Page Slider', 'uplift'),
					'id'   => "{$prefix}page_slider",
					'type' => 'select',
					'options' => array(
						'none'		=> __('None', 'uplift'),
						'swift-slider'	=> __('Swift Slider', 'uplift'),
						'revslider'	=> __('Revolution Slider', 'uplift'),
						'layerslider'	=> __('LayerSlider', 'uplift'),
						'masterslider'	=> __('Master Slider', 'uplift'),
					),
					'multiple' => false,
					'std'  => 'none',
					'desc' => __('Choose the type of slider you would like to display at the top of the page, if any. You can then set the slider settings below.', 'uplift'),
				),
	
				// SWIFT SLIDER OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => __('Swift Slider Options', 'uplift'),
				    'id' 	=> "{$prefix}ss_options",
				    'class' => 'pageslider-swift-slider',
				    'type' 	=> 'section'
				),
	
				// SWIFT SLIDER TYPE
				array(
					'name' => __('Swift Slider Type', 'uplift'),
					'id'   => "{$prefix}ss_type",
					'type' => 'select',
					'options' => array(
						'slider'		=> __('Standard Slider', 'uplift'),
						'curtain'	=> __('Curtain Slider', 'uplift'),
					),
					'multiple' => false,
					'std'  => 'none',
					'class' => 'pageslider-swift-slider',
					'desc' => __('Choose if you would like to display the Swift Slider in horizontal slider mode, or vertical curtain slider format.', 'uplift'),
				),
	
				// SWIFT SLIDER CATEGORY
				array(
					'name' => __('Swift Slider Slide Category', 'uplift'),
					'id'   => "{$prefix}ss_category",
					'type' => 'select',
					'options' => $swift_slider_categories,
					'multiple' => false,
					'std'  => 'none',
					'class' => 'pageslider-swift-slider',
					'desc' => __('Choose the category of slide that you would like to show, or all.', 'uplift'),
				),
				
				// SWIFT SLIDER RANDOM
				array(
					'name' => __('Swift Slider Random', 'uplift'),
					'id'   => "{$prefix}ss_random",
					'type' => 'checkbox',
					'std'  => 0,
					'class' => 'pageslider-swift-slider',
					'desc' => __('Choose if you would like the slider to show slides in random order.', 'uplift'),
				),
	
	
				// SWIFT SLIDER SLIDE COUNT
				array(
					'name' => __('Swift Slider Slides', 'uplift'),
					'id' => "{$prefix}ss_slides",
					'desc' => __("Set the number of slides to show. If blank then all will show.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'class' => 'pageslider-swift-slider',
					'std' => '5',
				),
	
				// SWIFT SLIDER FULLSCREEN
				array(
					'name' => __('Swift Slider Fullscreen', 'uplift'),
					'id'   => "{$prefix}ss_fs",
					'type' => 'checkbox',
					'std'  => 0,
					'class' => 'pageslider-swift-slider',
					'desc' => __('Choose if you would like the slider to be window height.', 'uplift'),
				),
	
				// SWIFT SLIDER MAX HEIGHT
				array(
					'name' => __('Swift Slider Max Height', 'uplift'),
					'id' => "{$prefix}ss_maxheight",
					'desc' => __("Set the maximum height that the Swift Slider should display at (optional) (no px).", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'class' => 'pageslider-swift-slider',
					'std' => '600',
				),
	
				// SWIFT SLIDER AUTOPLAY
				array(
					'name' => __('Swift Slider Autoplay', 'uplift'),
					'id' => "{$prefix}ss_autoplay",
					'desc' => __("If you would like the slider to auto-rotate, then set the autoplay rotate time in ms here. I.e. you would enter '5000' for the slider to rotate every 5 seconds.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'class' => 'pageslider-swift-slider',
					'std' => '',
				),
	
				// SWIFT SLIDER TRANSITION
				array(
					'name' => __('Swift Slider Transition', 'uplift'),
					'id'   => "{$prefix}ss_transition",
					'type' => 'select',
					'options' => array(
						'slide'		=> __('Slide', 'uplift'),
						'fade'	=> __('Fade', 'uplift'),
					),
					'multiple' => false,
					'std'  => 'slide',
					'class' => 'pageslider-swift-slider',
					'desc' => __('Choose if you would like the slider to loop (not possible on curtain slider).', 'uplift'),
				),
	
				// SWIFT SLIDER LOOP
				array(
					'name' => __('Swift Slider Loop', 'uplift'),
					'id'   => "{$prefix}ss_loop",
					'type' => 'checkbox',
					'std'  => 1,
					'class' => 'pageslider-swift-slider',
					'desc' => __('Choose if you would like the slider to loop (not possible on curtain slider).', 'uplift'),
				),
	
				// SWIFT SLIDER NAVIGATION
				array(
					'name' => __('Swift Slider Navigation', 'uplift'),
					'id'   => "{$prefix}ss_nav",
					'type' => 'checkbox',
					'std'  => 1,
					'class' => 'pageslider-swift-slider',
					'desc' => __('Choose if you would like to display the left/right arrows on the slider (only if slider type is set to "Slider").', 'uplift'),
				),
	
				// SWIFT SLIDER PAGINATION
				array(
					'name' => __('Swift Slider Pagination', 'uplift'),
					'id'   => "{$prefix}ss_pagination",
					'type' => 'checkbox',
					'std'  => 1,
					'class' => 'pageslider-swift-slider',
					'desc' => __('Choose if you would like to display the slider pagination.', 'uplift'),
				),
	
				// SWIFT SLIDER CONTINUE
				array(
					'name' => __('Swift Slider Continue', 'uplift'),
					'id'   => "{$prefix}ss_continue",
					'type' => 'checkbox',
					'std'  => 1,
					'class' => 'pageslider-swift-slider',
					'desc' => __('Choose if you would like to display the continue button on Curtain slider type to progress to the content. If you want to only display the slider on the page, and no content, then make sure you set this to NO.', 'uplift'),
				),
	
				// REVSLIDER OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => __('Revolution Slider Options', 'uplift'),
				    'id' 	=> "{$prefix}rs_options",
				    'class' => 'pageslider-revslider',
				    'type' 	=> 'section'
				),
	
				// REV SLIDER
				array(
					'name' => __('Revolution slider alias', 'uplift'),
					'id' => $prefix . 'rev_slider_alias',
					'desc' => __("Enter the revolution slider alias for the slider that you want to show.", 'uplift'),
					'type'  => 'text',
					'class' => 'pageslider-revslider',
					'std' => '',
				),
	
				// LAYERSLIDER OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => __('LayerSlider Options', 'uplift'),
				    'id' 	=> "{$prefix}ls_options",
				    'class' => 'pageslider-layerslider',
				    'type' 	=> 'section'
				),
	
				// LAYERSLIDER
				array(
					'name' => __('LayerSlider ID', 'uplift'),
					'id' => $prefix . 'layerslider_id',
					'desc' => __("Enter the LayerSlider ID for the slider that you want to show.", 'uplift'),
					'type'  => 'text',
					'class' => 'pageslider-layerslider',
					'std' => '',
				),
	
				// MASTER SLIDER OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => __('Master Slider Options', 'uplift'),
				    'id' 	=> "{$prefix}ms_options",
				    'class' => 'pageslider-masterslider',
				    'type' 	=> 'section'
				),
	
				// MASTER SLIDER
				array(
					'name' => __('Master Slider ID', 'uplift'),
					'id' => $prefix . 'masterslider_id',
					'desc' => __("Enter the Master Slider ID for the slider that you want to show.", 'uplift'),
					'type'  => 'text',
					'class' => 'pageslider-masterslider',
					'std' => '',
				)
			)
		);
	
	
		/* Page Meta Box
		================================================== */
		$meta_boxes[] = array(
			'id'    => 'page_meta_box',
			'title' => __('Page Meta', 'uplift'),
			'pages' => array( 'page' ),
			'fields' => array(
	
				// MISC OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => __('One Page Options', 'uplift'),
				    'id' 	=> "{$prefix}heading_onepage",
				    'type' 	=> 'section'
				),
	
				// ONE PAGE NAV
				array(
					'name' => __('Enable One Page Navigation', 'uplift'),    // File type: checkbox
					'id'   => "{$prefix}enable_one_page_nav",
					'type' => 'checkbox',
					'desc' => __('Enable the one page nav which appears on the right of the page.', 'uplift'),
					'std' => 0,
				),
				
				// SIDEBAR PROGRESS MENU
				array(
					'name' => __('Sidebar Progress Menu', 'uplift'),
					'id'   => "{$prefix}sidebar_progress_menu",
					'desc' => __('Enable the sidebar progress menu - requires left or right sidebar to be active, and will replace the contents of the chosen sidebar.', 'uplift'),
					'type' => 'select',
					'options' => array(
						'disabled'		=> __('Disabled', 'uplift'),
						'left-sidebar'		=> __('Left Sidebar', 'uplift'),
						'right-sidebar'		=> __('Right Sidebar', 'uplift'),
					),
				),			
	
				// MISC OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => __('Misc. Options', 'uplift'),
				    'id' 	=> "{$prefix}heading_misc",
				    'type' 	=> 'section'
				),
	
				// Extra Page Class
				array(
					'name' => __('Extra page class', 'uplift'),
					'id' => $prefix . 'extra_page_class',
					'desc' => __("If you wish to add extra classes to the body class of the page (for custom css use), then please add the class(es) here.", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// NEWSLETTER BAR
				array(
					'name' => __('Enable Newsletter Bar', 'uplift'),    // File type: checkbox
					'id'   => "{$prefix}enable_newsletter_bar",
					'type' => 'checkbox',
					'desc' => __('Enable the newsletter bar, you can configure this in the theme options.', 'uplift'),
					'std' => 0,
				),
	
				// REMOVE PROMO BAR
				array(
					'name' => __('Remove promo bar', 'uplift'),    // File type: checkbox
					'id'   => "{$prefix}remove_promo_bar",
					'type' => 'checkbox',
					'desc' => __('Remove the promo bar at the bottom of the page.', 'uplift'),
					'std' => 0,
				),
	
				// REMOVE TOP SPACING
				array(
					'name' => __('Remove top spacing', 'uplift'),    // File type: checkbox
					'id'   => "{$prefix}no_top_spacing",
					'type' => 'checkbox',
					'desc' => __('Remove the spacing at the top of the page.', 'uplift'),
					'std' => 0,
				),
	
				// REMOVE BOTTOM SPACING
				array(
					'name' => __('Remove bottom spacing', 'uplift'),    // File type: checkbox
					'id'   => "{$prefix}no_bottom_spacing",
					'type' => 'checkbox',
					'desc' => __('Remove the spacing at the bottom of the page.', 'uplift'),
					'std' => 0,
				)
			)
		);
	
		/* Sidebar Meta Box Page
		================================================== */
		$meta_boxes[] = array(
			'id'    => 'sidebar_meta_box_page',
			'title' => __('Sidebar Options', 'uplift'),
			'pages' => array( 'page' ),
			'priority' => 'low',
			'fields' => array(
	
				// SIDEBAR CONFIG
				array(
					'name' => __('Sidebar configuration', 'uplift'),
					'id'   => "{$prefix}sidebar_config",
					'type' => 'select',
					'options' => array(
						'no-sidebars'		=> __('No Sidebars', 'uplift'),
						'left-sidebar'		=> __('Left Sidebar', 'uplift'),
						'right-sidebar'		=> __('Right Sidebar', 'uplift'),
						'both-sidebars'		=> __('Both Sidebars', 'uplift')
					),
					'multiple' => false,
					'std'  => $default_sidebar_config,
					'desc' => __('Choose the sidebar configuration for the detail page of this page.', 'uplift'),
				),
	
				// LEFT SIDEBAR
				array (
					'name' 	=> __('Left Sidebar', 'uplift'),
				    'id' 	=> "{$prefix}left_sidebar",
				    'type' 	=> 'sidebars',
				    'std' 	=> $default_left_sidebar
				),
	
				// RIGHT SIDEBAR
				array (
					'name' 	=> __('Right Sidebar', 'uplift'),
				    'id' 	=> "{$prefix}right_sidebar",
				    'type' 	=> 'sidebars',
				    'std' 	=> $default_right_sidebar
				),
			)
		);
	
		/* Sidebar Meta Box Post
		================================================== */
		$meta_boxes[] = array(
			'id'    => 'sidebar_meta_box_post',
			'title' => __('Sidebar Options', 'uplift'),
			'pages' => array( 'post' ),
			'priority' => 'low',
			'fields' => array(
	
				// SIDEBAR CONFIG
				array(
					'name' => __('Sidebar configuration', 'uplift'),
					'id'   => "{$prefix}sidebar_config",
					'type' => 'select',
					'options' => array(
						'no-sidebars'		=> __('No Sidebars', 'uplift'),
						'left-sidebar'		=> __('Left Sidebar', 'uplift'),
						'right-sidebar'		=> __('Right Sidebar', 'uplift'),
					),
					'multiple' => false,
					'std'  => $default_post_sidebar_config,
					'desc' => __('Choose the sidebar configuration for the detail page of this post.', 'uplift'),
				),
	
				// LEFT SIDEBAR
				array (
					'name' 	=> __('Left Sidebar', 'uplift'),
				    'id' 	=> "{$prefix}left_sidebar",
				    'type' 	=> 'sidebars',
				    'std' 	=> $default_post_left_sidebar
				),
	
				// RIGHT SIDEBAR
				array (
					'name' 	=> __('Right Sidebar', 'uplift'),
				    'id' 	=> "{$prefix}right_sidebar",
				    'type' 	=> 'sidebars',
				    'std' 	=> $default_post_right_sidebar
				),
			)
		);
	
		/* Sidebar Meta Box Product
		================================================== */
		$meta_boxes[] = array(
			'id'    => 'sidebar_meta_box_product',
			'title' => __('Sidebar Options', 'uplift'),
			'pages' => array( 'product' ),
			'priority' => 'low',
			'fields' => array(
	
				// SIDEBAR CONFIG
				array(
					'name' => __('Sidebar configuration', 'uplift'),
					'id'   => "{$prefix}sidebar_config",
					'type' => 'select',
					'options' => array(
						'no-sidebars'		=> __('No Sidebars', 'uplift'),
						'left-sidebar'		=> __('Left Sidebar', 'uplift'),
						'right-sidebar'		=> __('Right Sidebar', 'uplift'),
						'both-sidebars'		=> __('Both Sidebars', 'uplift')
					),
					'multiple' => false,
					'std'  => $default_product_sidebar_config,
					'desc' => __('Choose the sidebar configuration for the detail page of this product.', 'uplift'),
				),
	
				// LEFT SIDEBAR
				array (
					'name' 	=> __('Left Sidebar', 'uplift'),
				    'id' 	=> "{$prefix}left_sidebar",
				    'type' 	=> 'sidebars',
				    'std' 	=> $default_product_left_sidebar
				),
	
				// RIGHT SIDEBAR
				array (
					'name' 	=> __('Right Sidebar', 'uplift'),
				    'id' 	=> "{$prefix}right_sidebar",
				    'type' 	=> 'sidebars',
				    'std' 	=> $default_product_right_sidebar
				),
			)
		);
	
	
		/* ==================================================
	
		Reviews Meta Box
	
		================================================== */
	
		$review_format = $review_cat_1 = $review_cat_2 = $review_cat_3 = $review_cat_4 = $review_suffix = $review_max = $review_step = "";
	
		if (isset($sf_options['review_format'])) {
		$review_format = $sf_options['review_format'];
		}
		if (isset($sf_options['review_cat_1'])) {
		$review_cat_1 = $sf_options['review_cat_1'];
		}
		if (isset($sf_options['review_cat_2'])) {
		$review_cat_2 = $sf_options['review_cat_2'];
		}
		if (isset($sf_options['review_cat_3'])) {
		$review_cat_3 = $sf_options['review_cat_3'];
		}
		if (isset($sf_options['review_cat_4'])) {
		$review_cat_4 = $sf_options['review_cat_4'];
		}
	
		if ($review_format == "" || $review_format == "percentage") {
			$review_suffix = " %";
			$review_max = 100;
			$review_step = 1;
		} else {
			$review_suffix = "";
			$review_max = 10;
			$review_step = .1;
		}
	
		$meta_boxes[] = array(
			'id'    => 'reviews_meta_box',
			'title' => 'Review Meta',
			'priority' => 'low',
			'pages' => array( 'post' ),
			'fields' => array(
	
				// REVIEW POST ON/OFF
				array(
					'name' => 'Review Post',
					'id'   => "{$prefix}review_post",
					'type' => 'checkbox',
					'std'  => 0,
					'desc' => 'Select this checkbox if this is a review post.',
				),
	
				// Review Category 1 - Name
				array(
					'name' => 'Review Category 1 - Name',
					'id' => $prefix . 'review_cat_1',
					'desc' => 'Enter the name for review category 1.',
					'clone' => false,
					'type'  => 'text',
					'std' => $review_cat_1,
				),
	
				// Review Category 1 Value
				array(
					'name' => 'Review Category 1 - Value',
					'id' => $prefix . 'review_cat_1_value',
					'desc' => 'Select the value for review category 1.',
					'clone' => false,
					'type'  => 'slider',
					'prefix' => '',
					'suffix' => $review_suffix,
					'js_options' => array(
						'min'   => 0,
						'max'   => $review_max,
						'step'  => $review_step,
					),
				),
	
				// Review Category 2 - Name
				array(
					'name' => 'Review Category 2 - Name',
					'id' => $prefix . 'review_cat_2',
					'desc' => 'Enter the name for review category 2.',
					'clone' => false,
					'type'  => 'text',
					'std' => $review_cat_2,
				),
	
				// Review Category 2 Value
				array(
					'name' => 'Review Category 2 - Value',
					'id' => $prefix . 'review_cat_2_value',
					'desc' => 'Select the value for review category 2.',
					'clone' => false,
					'type'  => 'slider',
					'prefix' => '',
					'suffix' => $review_suffix,
					'js_options' => array(
						'min'   => 0,
						'max'   => $review_max,
						'step'  => $review_step,
					),
				),
	
				// Review Category 3 - Name
				array(
					'name' => 'Review Category 3 - Name',
					'id' => $prefix . 'review_cat_3',
					'desc' => 'Enter the name for review category 3.',
					'clone' => false,
					'type'  => 'text',
					'std' => $review_cat_3,
				),
	
				// Review Category 3 Value
				array(
					'name' => 'Review Category 3 - Value',
					'id' => $prefix . 'review_cat_3_value',
					'desc' => 'Select the value for review category 3.',
					'clone' => false,
					'type'  => 'slider',
					'prefix' => '',
					'suffix' => $review_suffix,
					'js_options' => array(
						'min'   => 0,
						'max'   => $review_max,
						'step'  => $review_step,
					),
				),
	
				// Review Category 4 - Name
				array(
					'name' => 'Review Category 4 - Name',
					'id' => $prefix . 'review_cat_4',
					'desc' => 'Enter the name for review category 4.',
					'clone' => false,
					'type'  => 'text',
					'std' => $review_cat_4,
				),
	
				// Review Category 4 Value
				array(
					'name' => 'Review Category 4 - Value',
					'id' => $prefix . 'review_cat_4_value',
					'desc' => 'Select the value for review category 4.',
					'clone' => false,
					'type'  => 'slider',
					'prefix' => '',
					'suffix' => $review_suffix,
					'js_options' => array(
						'min'   => 0,
						'max'   => $review_max,
						'step'  => $review_step,
					),
				),
	
				// Review Summary Text
				array(
					'name' => 'Summary Text',
					'desc' => "You can write the summary text here to display next to the overall score.",
					'id'   => "{$prefix}review_summary",
					'type' => 'textarea',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
			)
		);
	
	
		/* Gallery Meta Box
		================================================== */
		$meta_boxes[] = array(
			'id' => 'gallery_meta_box',
			'title' => __('Gallery Options', 'uplift'),
			'pages' => array( 'galleries' ),
			'context' => 'normal',
			'fields' => array(
	
				// GALLERY IMAGES
				array(
					'name'             => __('Gallery Images', 'uplift'),
					'desc'             => __('The images that will be used in the gallery.', 'uplift'),
					'id'               => "{$prefix}gallery_images",
					'type'             => 'image_advanced',
					'max_file_uploads' => 200,
				),
	
				// Sub Text
				array(
					'name' => __('Gallery Subtitle', 'uplift'),
					'id' => $prefix . 'gallery_subtitle',
					'desc' => __("Enter a subtitle for use within the galleries list (optional).", 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// CUSTOM EXCERPT
				array(
					'name' => __('Gallery Excerpt', 'uplift'),
					'desc' => __("You can write an excerpt here which will display on the galleries list if you have it set to show.", 'uplift'),
					'id'   => "{$prefix}custom_excerpt",
					'type' => 'textarea',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
	
				// GALLERY SHARE
				array(
					'name' => __('Include social sharing', 'uplift'),
					'id'   => "{$prefix}gallery_share",
					'type' => 'checkbox',
					'desc' => __('Check this box to show social sharing on the detail page.', 'uplift'),
					'std' => 1,
				),
			)
		);
	
	
		/* Directory Meta Box
		================================================== */
		$meta_boxes[] = array(
			'id' => 'directory_meta_box',
			'title' => __('Directory Options', 'uplift'),
			'pages' => array( 'directory' ),
			'context' => 'normal',
			'fields' => array(
	
	
	
				// Address
				array(
					'name' => __('Address', 'uplift'),
					'id' => $prefix . 'directory_address',
					'desc' => __('Enter the address that you would like to show on the map here, i.e. "Cupertino".', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// Pin Button Text
				array(
					'name' => __('Generate Coordinates', 'uplift'),
					'id' => $prefix . 'directory_calculate_coordinates',
					'desc' => __('Will automatically generate the latitude/longitude coordinates witht the given address.', 'uplift'),
					'clone' => false,
					'type'  => 'button',
					'std' => 'Generate Coordinates',
				),
				// Latitude Coordinate
				array(
					'name' => __('Latitude Coordinate', 'uplift'),
					'id' => $prefix . 'directory_lat_coord',
					'desc' => __('Enter the Latitude coordinate of the Directory Item.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// Longitude Coordinate
				array(
					'name' => __('Longitude Coordinate', 'uplift'),
					'id' => $prefix . 'directory_lng_coord',
					'desc' => __('Enter the Longitude coordinate of the Directory Item.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// Custom Map Pin
				array(
					'name'  => __('Custom Map Pin', 'uplift'),
					'desc'  => __('Choose an image to use as the custom pin for the address on the map. Upload your custom map pin, the image size must be 150px x 75px.', 'uplift'),
					'id'    => "{$prefix}directory_map_pin",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
	
				// Pin Link
				array(
					'name' => __('Pin Link', 'uplift'),
					'id' => $prefix . 'directory_pin_link',
					'desc' => __('Enter the Link url of the location marker.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// Pin Button Text
				array(
					'name' => __('Pin Button Text', 'uplift'),
					'id' => $prefix . 'directory_pin_button_text',
					'desc' => __('Enter the text of the Pin Button.', 'uplift'),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
	
				// CUSTOM EXCERPT SECTION
				array (
					'name' 	=> '',
					'title' => __('Custom Excerpt', 'uplift'),
				    'id' 	=> "{$prefix}heading_custom_excerpt",
				    'type' 	=> 'section'
				),
	
				// CUSTOM EXCERPT
				array(
					'name' => __('Custom excerpt', 'uplift'),
					'desc' => __("You can optionally write a custom excerpt here to display instead of the excerpt that is automatically generated. If you use the page builder, then you'll want to add content to this box.", 'uplift'),
					'id'   => "{$prefix}custom_excerpt",
					'type' => 'textarea',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
			)
		);

		$sf_meta_boxes = apply_filters( 'add_sf_meta_boxes', $meta_boxes );
		$meta_boxes = array_merge( $meta_boxes, $sf_meta_boxes );
		
		return $meta_boxes;
	}
	add_filter( 'rwmb_meta_boxes', 'sf_register_meta_boxes' );
	
	function sf_build_meta_box() {
		echo'<div class="sf-meta-tabs-wrap"><div id="sf-tabbed-meta-boxes"></div></div>';
	}
	
	function sf_register_meta_box_holder() {
		add_meta_box( 'sf_meta_box', __( 'Meta Options', 'uplift' ), 'sf_build_meta_box', '', 'normal', 'high' );
	}
	add_action( 'add_meta_boxes', 'sf_register_meta_box_holder' );
