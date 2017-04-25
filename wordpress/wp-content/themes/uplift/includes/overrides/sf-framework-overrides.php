<?php
	/*
	*
	*	Swift Framework Overrides
	*	------------------------------------------------
	*	Uplift specific functionality
	* 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
	*
	*/
	
	
	/* WIDGET FILTERS
	================================================== */
	function uplift_widget_posts_thumb_width() {
		return 50;
	}
	add_filter('sf_widget_posts_thumb_width', 'uplift_widget_posts_thumb_width');
	
	function uplift_widget_posts_thumb_height() {
		return 50;
	}
	add_filter('sf_widget_posts_thumb_height', 'uplift_widget_posts_thumb_height');
	
					
	/* POST ACTION ORDER
	================================================== */
	remove_action( 'sf_post_content_end', 'sf_post_share', 30 );

	remove_action( 'sf_post_after_article', 'sf_post_related_articles', 10 );
	add_action( 'sf_post_after_article_extras', 'sf_post_related_articles', 10 );

	remove_action( 'sf_post_after_article', 'sf_post_comments', 20 );
	add_action( 'sf_post_after_article', 'sf_post_comments', 10 );
	
	remove_action( 'sf_post_after_article', 'sf_post_pagination', 5 );
	
	
	/*
	*	SOCIAL SHARE OVERRIDE
	*	-----------------------------------------------
	*	@original - /swift-framework plugin
	*
	================================================== */
	if ( !function_exists( 'uplift_social_share_override' ) ) {
	    function uplift_social_share_override($share_output, $atts) {
			
			global $post;
			$sf_options = sf_get_theme_opts();
			
			$social_share_config = $sf_options['social_share_config'];
			$social_output = "";
			$post_permalink = urlencode(get_the_permalink());
			$post_title = get_the_title();
			$post_title_encode =  urlencode(html_entity_decode($post_title, ENT_COMPAT, 'UTF-8'));
			$post_url = urlencode(get_permalink());
			$media_image = get_post_thumbnail_id();
			$post_thumb = wp_get_attachment_url( $media_image, 'large' );
			
			if ( isset( $atts['share_url'] ) && $atts['share_url'] != "" ) {
				$post_permalink = $atts['share_url'];
			}
			
            $social_output = '<div class="sf-share-counts" data-url="' . $post_permalink . '">';
            
            $social_output .= '<div class="share-text"><h2 class="total-count">0</h2><span>'.__("Shares", 'uplift').'</span></div>';
            
            if (!empty($social_share_config) && isset($social_share_config['enabled'])) {

				foreach ($social_share_config['enabled'] as $item_id => $item) {

					if ($item_id == "twitter") {
						$social_output .= '<a href="http://twitter.com/share?text='.$post_title_encode.'&url='.$post_permalink.'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=440,width=660\');return false;" class="sf-share-link sf-share-twitter"><i class="fa-twitter"></i><span class="count">0</span></a>';
					} else if ($item_id == "facebook") {
						$social_output .= '<a href="https://www.facebook.com/sharer/sharer.php?u='.$post_permalink.'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=440,width=660\');return false;" class="sf-share-link sf-share-fb"><i class="fa-facebook"></i><span class="count">0</span></a>';
					} else if ($item_id == "google-plus") {
						$social_output .= '<a href="https://plus.google.com/share?url='.$post_permalink.'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=440,width=660\');return false;" class="sf-share-link sf-share-googleplus"><i class="fa-google-plus"></i><span class="count">'. sf_get_gshare_count( $post_permalink ) .'</span></a>';
					} else if ($item_id == "pinterest") {
						$social_output .= '<a href="http://pinterest.com/pin/create/button/?url='.$post_permalink.'&media='.$post_thumb.'&description='.$post_title_encode.'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=690,width=750\');return false;" class="sf-share-link sf-share-pinterest"><i class="fa-pinterest"></i><span class="count">0</span></a>';
					} else if ($item_id == "linkedin") {
						$social_output .= '<a href="https://www.linkedin.com/shareArticle?mini=true&url='.$post_permalink.'&title='.$post_title_encode.'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=690,width=750\');return false;" class="sf-share-link sf-share-linkedin"><i class="fa-linkedin"></i><span class="count">0</span></a>';
					} else if ($item_id == "whatsapp") {
						$social_output .= '<a href="whatsapp://send?text='.$post_title_encode.' '.$post_permalink.'" class="sf-share-link sf-share-whatsapp"><i class="fa-whatsapp"></i><span class="count">0</span></a>';
					} else if ($item_id == "email") {
						$social_output .= '<a href="mailto:?subject=' . $post_title_encode . '&body='.$post_permalink.'"  class="sf-share-link sf-share-email"><i class="fa-envelope" aria-hidden="true"></i></a>';
					}
				}
			
			}
			
            $social_output .= '</div>';
	        
	        return $social_output;
	        
		}
	    add_filter( 'sf_social_share_output', 'uplift_social_share_override', 10, 2 );
	}