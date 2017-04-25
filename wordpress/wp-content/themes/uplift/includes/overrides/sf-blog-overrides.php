<?php
	/*
	*
	*	Blog Overrides
	*	------------------------------------------------
	*	Uplift specific functionality
	* 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
	*
	*
	*	uplift_timeline_blog_nosidebars_wrap_class()
	*	
	*
	* 
	*	sf_get_post_details()
	*	sf_post_top_author()
	*	sf_post_info()
	*	sf_get_masonry_post()
	*	sf_get_mini_post()
	*	sf_get_timeline_post()
	*	sf_get_standard_post()
	*	sf_post_pagination()
	*
	*/
	
	
	/* BLOG FILTERS
	================================================== */
	function uplift_timeline_blog_nosidebars_wrap_class() {
		return '';
	}
	add_filter('sf_timeline_blog_nosidebars_wrap_class', 'uplift_timeline_blog_nosidebars_wrap_class');

	function uplift_post_content_wrap_class_nosidebar() {
		return 'col-sm-10';
	}
	add_filter('sf_post_content_wrap_class_nosidebar', 'uplift_post_content_wrap_class_nosidebar');
	
	function uplift_post_page_content_class_pb_active() {
		return 'container';
	}
	add_filter('sf_post_page_content_class_pb_active', 'uplift_post_page_content_class_pb_active');
	
	function uplift_post_content_wrap_class_content_pb_active() {
		return 'col-sm-10';
	}
	add_filter('sf_post_content_wrap_class_content_pb_active', 'uplift_post_content_wrap_class_content_pb_active');
	

	/* POST DETAIL FILTERS
	================================================== */
	function uplift_related_articles_display_type() {
		return 'standard';
	}
	add_filter('sf_related_articles_display_type', 'uplift_related_articles_display_type');

	function uplift_related_articles_excerpt_length() {
		return 0;
	}
	add_filter('sf_related_articles_excerpt_length', 'uplift_related_articles_excerpt_length');

	function uplift_post_comments_wrap_class() {
		return 'comments-wrap container clearfix';
	}
	add_filter( 'sf_post_comments_wrap_class', 'uplift_post_comments_wrap_class' );

	function uplift_post_comments_class() {
		return 'col-sm-8 col-sm-offset-2';
	}
	add_filter( 'sf_post_comments_class', 'uplift_post_comments_class' );
	
	function uplift_related_posts_count() {
		return 3;
	}
	add_filter('sf_related_posts_count', 'uplift_related_posts_count');
	
	function uplift_related_posts_item_class() {
		return 'col-sm-4';
	}
	add_filter('sf_related_posts_item_class', 'uplift_related_posts_item_class');
	
	
	/* POST WRAP
	================================================== */	
	if ( ! function_exists( 'sf_post_wrap_start' ) ) {
	    function sf_post_wrap_start() {
	    	global $post;
	    	$sidebar_config = sf_get_sidebar_global();
	    	$author_info = sf_get_post_meta( $post->ID, 'sf_author_info', true );
	    	
	    	if ( $sidebar_config != "no-sidebars" && $author_info ) {
	    		echo '<div class="uplift-post-wrap">';
	    	}
		}
	}
	add_action( 'sf_post_content_start', 'sf_post_wrap_start', 20 );
	
	if ( ! function_exists( 'sf_post_content_wrap_end' ) ) {
	    function sf_post_content_wrap_end() {
	    	global $post;
	    	$sidebar_config = sf_get_sidebar_global();
	    	$author_info = sf_get_post_meta( $post->ID, 'sf_author_info', true );
	    	
	    	if ( $sidebar_config != "no-sidebars" && $author_info ) {
	    		echo '</div>';
	    	}
		}
	}
	add_action( 'sf_post_content_end', 'sf_post_content_wrap_end', 50 );
	
	
	/* POST THUMB CATEGORY OVERLAY
	================================================== */	
	if ( ! function_exists( 'uplift_before_blog_item_thumb' ) ) {
		function uplift_before_blog_item_thumb() {
			global $post;
			$post_categories = sf_get_custom_post_cat_list( $post->ID, 1 );
			
			if ( $post_categories != "" ) {
				return '<div class="post-cats">'.$post_categories.'</div>';
			} else {
				return '';
			}
		}
		add_filter('sf_before_blog_item_thumb', 'uplift_before_blog_item_thumb');
	}
	
	
	/* GET AUDIO MEDIA
    ================================================== */
    if ( ! function_exists( 'sf_audio_post' ) ) {
        function sf_audio_post( $postID, $use_thumb_content ) {
            $audio_output = $media_audio = $image = $media_image_url = $image_id = "";
            
            if ( $use_thumb_content ) {
                $media_audio = sf_get_post_meta( $postID, 'sf_thumbnail_audio_url', true );
                $media_audio_title = sf_get_post_meta( $postID, 'sf_thumbnail_audio_title', true );
                $media_audio_artist = sf_get_post_meta( $postID, 'sf_thumbnail_audio_artist', true );
                $media_image = rwmb_meta( 'sf_thumbnail_audio_cover', 'type=image&size=thumbnail', $postID );
            } else {
                $media_audio = sf_get_post_meta( $postID, 'sf_detail_audio_url', true );
            }
            
            foreach ( $media_image as $detail_image ) {
                $image_id        = $detail_image['ID'];
                $media_image_url = $detail_image['url'];
                break;
            }

            $cover_image = sf_aq_resize( $media_image_url, 70, 70, true, false );
            $image_meta 		= sf_get_attachment_meta( $image_id );
            $image_caption = $image_alt = $image_title = $caption_html = "";
            if ( isset($image_meta) ) {
            	$image_caption 		= esc_attr( $image_meta['caption'] );
            	$image_title 		= esc_attr( $image_meta['title'] );
            	$image_alt 			= esc_attr( $image_meta['alt'] );
            }
            
            $audio_output .= '<div class="audio-details">';
	        	if ( $cover_image ) {
	        	    $image = '<img itemprop="image" src="' . $cover_image[0] . '" width="' . $cover_image[1] . '" height="' . $cover_image[2] . '" alt="' . $image_alt . '" />';
	        	    $audio_output .= '<div class="cover-image">' . $image . '</div>';
	        	}
	            if ( $media_audio_title ) {
	            	$audio_output .= '<h4>' . $media_audio_title . '</h4>';
	            }
	            if ( $media_audio_artist ) {
	            	$audio_output .= '<h5>' . $media_audio_artist . '</h5>';
	            }
            $audio_output .= '</div>';

            $audio_output .= '<div class="player" id="player-' . $postID . '">
                <audio controls>
                    <!-- Audio file -->
                    <source src="' . $media_audio . '" type="audio/mp3">
         
                    <!-- Fallback -->
                    <a href="' . $media_audio . '">Download</a>
                </audio>
            </div>';

            return $audio_output;
        }
    }
    
    
    /* GET SELF HOSTED VIDEO MEDIA
    ================================================== */
    if ( ! function_exists( 'sf_sh_video_post' ) ) {
        function sf_sh_video_post( $postID, $video_width = null, $video_height = null, $use_thumb_content = false ) {
            $media_mp4 = $media_ogg = $media_webm = "";
            $poster    = wp_get_attachment_image_src( get_post_thumbnail_id( $postID ), 'large', true );
            if ( isset( $poster ) & $poster != "" ) {
                $poster = 'poster="' . $poster[0] . '"';
            }

            if ( $use_thumb_content ) {
                $media_mp4  = sf_get_post_meta( $postID, 'sf_thumbnail_video_mp4', true );
                $media_ogg  = sf_get_post_meta( $postID, 'sf_thumbnail_video_ogg', true );
                $media_webm = sf_get_post_meta( $postID, 'sf_thumbnail_video_webm', true );
            } else {
                $media_mp4  = sf_get_post_meta( $postID, 'sf_detail_video_mp4', true );
                $media_ogg  = sf_get_post_meta( $postID, 'sf_detail_video_ogg', true );
                $media_webm = sf_get_post_meta( $postID, 'sf_detail_video_webm', true );
            }
            
            $video_output = '<div class="player" id="player-' . $postID . '">
                    <video preload="auto" ' . $poster . ' width="' . $video_width . '" height="' . $video_height . '" controls crossorigin>
                    
                           <!-- Video files -->';
                           if ( $media_webm != "" ) {
                               $video_output .= '<source src="' . $media_webm . '" type="video/webm">';
                           }
                           if ( $media_mp4 != "" ) {
                               $video_output .= '<source src="' . $media_mp4 . '" type="video/mp4">';
                           }
                           if ( $media_ogg != "" ) {
                               $video_output .= '<source src="' . $media_ogg . '" type="video/ogv">';
                           }
                                      
                           $video_output .= '<!-- Fallback -->
                           <a href="' . $media_mp4 . '">Download</a>
                       </video>
               </div>';

            return $video_output;
        }
    }
        
	    
	/* GET POST CATEGORY LIST WITH COLOURS
	================================================== */
	if ( !function_exists( 'sf_get_filter_category_list' ) ) {
		function sf_get_filter_category_list( $limit = 1000 ) {
		
			$post_categories = wp_get_post_categories( $postID );
			$output = '';
			$i = 1;
							
			foreach( $post_categories as $category ){
				$cat = get_category( $category );
				$colors = sf_get_category_colors($cat->term_id, true);
				$color = "#222";
				$text_color = "#fff";
				
				if ( is_array($colors) ) {
				$color = $colors['color'];
				$text_color = $colors['color_alt'];
				}				
				$category_link = get_category_link( $cat->cat_ID );
				$output .= '<a class="cat-item" style="background-color:'.$color.';color:'.$text_color.';" href="'.$category_link.'">'.$cat->name.'</a>';
				
				$i++;
				if ( $i > $limit ) {
					break;
				}
			}			
			
			return $output;	
		}
	}
	
    /*
    *	POST FILTER OVERRIDE
    *	------------------------------------------------
    *	@original - /swift-framework/core/sf-functions.php
    *
    ================================================== */
    if ( ! function_exists( 'sf_post_filter' ) ) {
        function sf_post_filter( $style = "basic", $post_type = "post", $parent_category = "" ) {
		
            $blog_aux_output = "";
            $sf_options = sf_get_theme_opts();
            
            if ( $style == "" ) {
	            $rss_feed_url = $sf_options['rss_feed_url'];
	
	            $archive_list  = wp_get_archives( 'type=monthly&limit=50&echo=0' );
	            $tags_list     = wp_tag_cloud( 'smallest=12&largest=12&unit=px&format=list&number=50&orderby=name&echo=0' );
	
	            $blog_aux_output .= '<div class="blog-aux-wrap">'; // open .blog-aux-wrap
	            $blog_aux_output .= '<ul class="blog-aux-options clearfix">'; // open .blog-aux-options
	
	            // CATEGORIES
	            $blog_aux_output .= '<li><a href="#" class="blog-slideout-trigger" data-aux="categories"><i class="sf-icon-categories"></i>' . __( "Categories", 'uplift' ) . '</a>';
	
	            // TAGS
	            $blog_aux_output .= '<li><a href="#" class="blog-slideout-trigger" data-aux="tags"><i class="sf-icon-tags"></i>' . __( "Tags", 'uplift' ) . '</a>';
	
	            // ARCHIVES
	            $blog_aux_output .= '<li><a href="#" class="blog-slideout-trigger" data-aux="archives"><i class="sf-icon-archive"></i>' . __( "Archives", 'uplift' ) . '</a>';
							
	            // SEARCH FORM
	            $blog_aux_output .= '<li class="search"><form method="get" class="search-form" action="' . home_url() . '/">';
	            $blog_aux_output .= '<input type="text" placeholder="' . __( "Search", 'uplift' ) . '" name="s" />';
	            $blog_aux_output .= '</form></li>';
	
	            $blog_aux_output .= '</ul>'; // close .blog-aux-options
	            $blog_aux_output .= '</div>'; // close .blog-aux-wrap
	
	            $blog_aux_output .= '<div class="slideout-filter blog-filter-wrap clearfix">'; // open .blog-filter-wrap
	            $blog_aux_output .= '<div class="filter-slide-wrap">';
	
				// CATEGORIES OUTPUT
				$category_args = array(
		        	'type'			=> 'post',
		        	'orderby'	    => 'name',
		        	'number'	    => 50,
		        	'taxonomy'      => 'category',
	            );
	            $categories = get_categories($category_args);        
	                    
	            $blog_aux_output .= '<ul class="aux-list aux-categories row clearfix">';
	           	
	           	foreach( $categories as $category ) {
	           		$category_id = $category->term_id;
	           		$category_colours = sf_get_category_colors( $category_id , true );
					$blog_aux_output .= '<li class="col-sm-sf-5"><a href="' . get_category_link( $category_id ) . '" title="' . sprintf( __( "View all posts in %s", 'uplift' ), $category->name ) . '" class="clearfix">';
					$blog_aux_output .= '<span class="cat-name">'. $category->name.'<sup class="count">'. $category->count.'</sup></span>';
					$blog_aux_output .= '<span class="cat-color" style="background:'.$category_colours['color'].';"></span>';
					$blog_aux_output .= '</a></li>';
	            } 
	        
	            $blog_aux_output .= '</ul>';
	            
	            if ( $tags_list != '' ) {
	                $blog_aux_output .= '<ul class="aux-list aux-tags row clearfix">' . $tags_list . '</ul>';
	            }
	            if ( $archive_list != '' ) {
	                $blog_aux_output .= '<ul class="aux-list aux-archives row clearfix">' . $archive_list . '</ul>';
	            }
	
	            $blog_aux_output .= '</div></div>'; // close .blog-filter-wrap
            } else {
            	$tax_terms = "";
            	
				$taxonomy_name = 'category';
	
				if ( $post_type != "post") {
					$taxonomy_name = $post_type . '-category';
				}
	
	            if ( $parent_category == "" || $parent_category == "All" ) {
	                $tax_terms = sf_get_category_list( $taxonomy_name, 1, '', true );
	            } else {
	                $tax_terms = sf_get_category_list( $taxonomy_name, 1, $parent_category, true );
	            }
	
	            $blog_aux_output .= '<div class="filter-wrap clearfix">' . "\n";
	            $blog_aux_output .= '<ul class="post-filter-tabs filtering clearfix">' . "\n";
	            $blog_aux_output .= '<li class="all selected"><a data-filter="*" href="#"><span class="item-name">' . __( "Show all", 'uplift' ) . '</span></a></li>' . "\n";
	            foreach ( $tax_terms as $tax_term ) {
	                $term = get_term_by( 'slug', $tax_term, $taxonomy_name );
	                if ( $term ) {
	                	$slug = strtolower($term->slug);
	                    $blog_aux_output .= '<li><a href="#" title="' . $term->name . '" class="' . $slug . '" data-filter=".' . $slug . '"><span class="item-name">' . $term->name . '</span></a></li>' . "\n";
	                } else {
	                    $blog_aux_output .= '<li><a href="#" title="' . $tax_term . '" class="' . $tax_term . '" data-filter=".' . $tax_term . '"><span class="item-name">' . $tax_term . '</span></a></li>' . "\n";
	                }
	            }
	            $blog_aux_output .= '</ul></div>' . "\n";
            }

            /* AUX BUTTONS OUTPUT
            ================================================== */

            return $blog_aux_output;
		}
    }
	        
	        
	/*
	*	GET POST DETAILS OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/content/sf-post-formats.php
	*
	================================================== */
	if ( ! function_exists( 'sf_get_post_details' ) ) {
	    function sf_get_post_details( $postID, $recent_post = false ) {

	    	$sf_options = sf_get_theme_opts();
	    	$single_author  = $sf_options['single_author'];
	    	$remove_dates   = $sf_options['remove_dates'];
			$post_date      = get_the_date();
			$post_date_str  = get_the_date('Y-m-d');
			
	   		$post_details = "";
	    	$post_author  = get_the_author();

	    	if ( !$single_author && !$remove_dates ) {
	    	    $post_details .= '<div class="blog-item-details">';
				$post_details .= sprintf( __( '<time datetime="%1$s">%2$s</time>', 'uplift' ), $post_date_str, $post_date );
	    	    $post_details .= ' - ';
	    	    $post_details .= '<span class="author">' . sprintf( __( 'by <a href="%2$s">%1$s</a>', 'uplift' ), $post_author, get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '</span>';
	    	    $post_details .= '</div>';
	    	} else if ( $single_author && !$remove_dates ) {
	    		$post_details .= '<div class="blog-item-details">';
	    	    $post_details .= sprintf( __( '<time datetime="%1$s">%2$s</time>', 'uplift' ), $post_date_str, $post_date );
	    	    $post_details .= '</div>';
	    	} else {
	    	    $post_details .= '<div class="blog-item-details">';
	    	    $post_details .= '<span class="author">' . sprintf( __( 'by <a href="%2$s">%1$s</a>', 'uplift' ), $post_author, get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '</span>';
	    	    $post_details .= '</div>';
	    	}

	    	return $post_details;
	    }
	}

	
	/*
    *	POST INFO OVERRIDE
    *	------------------------------------------------
    *	@original - /swift-framework/content/sf-post-detail.php
    *
    ================================================== */
    if ( ! function_exists( 'sf_post_side_author' ) ) {
        function sf_post_side_author() {
            global $post;
            $sf_options = sf_get_theme_opts();
            $author_info 	 = sf_get_post_meta( $post->ID, 'sf_author_info', true );
            $social_sharing  = sf_get_post_meta( $post->ID, 'sf_social_sharing', true );
			$post_date       = get_the_date();
			$single_author    = $sf_options['single_author'];
			$remove_dates     = $sf_options['remove_dates'];
			$author_id       = $post->post_author;
			$author_name     = get_the_author_meta( 'display_name', $author_id );
			$author_url      = get_author_posts_url( $author_id );
			$post_date       = get_the_date();
			$post_date_str  = get_the_date('Y-m-d');
			$post_comments   = get_comments_number();

            if ( is_singular( 'directory' ) ) {
                $author_info = false;
            }

            $post_categories = get_the_category_list( ', ' );
            ?>

            <?php if ( $author_info ) { ?>
                <div class="side-post-info col-sm-2 clearfix">
                    <div class="author-avatar"><?php if ( function_exists( 'get_avatar' ) ) {
                            echo get_avatar( get_the_author_meta( 'ID' ), '140' );
                        } ?></div>
                    <div class="post-details">
                        <div class="author-name" itemprop="author" itemscope itemtype="http://schema.org/Person">
                        	<h5 class="vcard author"><?php echo sprintf( __( 'By <a href="%2$s" rel="author" itemprop="name" class="fn">%1$s</a>', 'uplift' ), $author_name, $author_url ); ?></h5>
                        </div>
                        <?php if ( !$remove_dates ) { ?>
                        	<div class="post-date">
                        	<?php echo sprintf( __( '<time datetime="%1$s">%2$s</time>', 'uplift' ), $post_date_str, $post_date ); ?>
                        	</div>
                        <?php } ?>
                        <div class="comments-likes">
		                	<?php if ( comments_open() ) { ?>
		                        <div class="comments-wrapper">
			                        <a href="#comment-area" class="smooth-scroll-link"><span><i class="sf-icon-comments"></i><?php echo esc_attr($post_comments); ?></span></a>
		                        </div>
		                    <?php } ?>
	
		                    <?php if ( function_exists( 'lip_love_it_link' ) ) {
			                    lip_love_it_link( get_the_ID(), true, '' );
			                } ?>
		                </div>
		                <?php if ( $social_sharing ) { ?>
		                <div class="post-share">
		                	<a href="#post-share" class="share-link smooth-scroll-link" data-offset="-20">
		                		<i class="sf-icon-share"></i>
		                		<span class="share-count">0</span>
		                		<span class="share-text"><?php _e("Shares", 'uplift'); ?></span>
		                	</a>
		                </div>
		                <?php } ?>
                    </div>
                </div>
            <?php } ?>

        <?php
        }
    }
    add_action( 'sf_post_content_start', 'sf_post_side_author', 30 );


    /*
    *	POST INFO OVERRIDE
    *	------------------------------------------------
    *	@original - /swift-framework/content/sf-post-detail.php
    *
    ================================================== */
    if ( ! function_exists( 'sf_post_info' ) ) {
        function sf_post_info() {
            global $post;
            $sf_options = sf_get_theme_opts();
            $author_info 	 = sf_get_post_meta( $post->ID, 'sf_author_info', true );
            $social_sharing  = sf_get_post_meta( $post->ID, 'sf_social_sharing', true );
			$post_date       = get_the_date();
			$remove_dates    = $sf_options['remove_dates'];
			$author_id       = $post->post_author;
			$author_name     = get_the_author_meta( 'display_name', $author_id );
			$author_url      = get_author_posts_url( $author_id );
			$post_permalink  = get_permalink();
			$post_comments   = get_comments_number();
			$comments_text   = "";

            if ( is_singular( 'directory' ) ) {
                $author_info = true;
            }

            $post_categories = get_the_category_list( ', ' );
            ?>

            
            <div class="post-info clearfix">
           		
           		<?php if ( has_tag() ) { ?>
           		    <div class="tags-wrap">
           		    	<ul class="wp-tag-cloud"><?php the_tags( '<li>', '</li><li>', '</li>' ); ?></ul>
           		    </div>
           		<?php } ?>
           	
                <div class="post-details-wrap clearfix">

					<div class="comments-likes">
	                	<?php if ( comments_open() ) {
	                			if ( $post_comments == 0 ) {
                					$comments_text = __('0 Comments', 'uplift');
                				} elseif ( $post_comments > 1 ) {
                					$comments_text = $post_comments . __(' Comments', 'uplift');
                				} else {
                					$comments_text = __('1 Comment', 'uplift');
                				}
	                		?>
	                        <div class="comments-wrapper">
		                        <a href="#comment-area" class="smooth-scroll-link"><span><i class="sf-icon-comments"></i><?php echo esc_attr($comments_text); ?></span></a>
	                        </div>
	                    <?php } ?>

	                    <?php if ( function_exists( 'lip_love_it_link' ) ) {
		                    lip_love_it_link( get_the_ID(), true, 'text' );
		                } ?>
	                </div>
	                
	                
	                <div class="post-share" id="post-share">
	                	<?php if ( $social_sharing && function_exists( 'sf_social_share' ) ) { 
	                		echo sf_social_share();
	                	} ?>
	                </div>

		        </div>
		        
		        <?php if ( $author_info ) { ?>
		            <div class="author-info-wrap clearfix">
		                <div class="author-avatar"><?php if ( function_exists( 'get_avatar' ) ) {
		                        echo get_avatar( get_the_author_meta( 'ID' ), '140' );
		                    } ?></div>
		                <div class="author-bio">
		                    <div class="author-name" itemprop="author" itemscope itemtype="http://schema.org/Person"><h3
		                            class="vcard author"><?php _e( "About", 'uplift' ); ?> <span itemprop="name" class="fn"><?php echo esc_attr($author_name); ?></span>
		                        </h3></div>
		                    <div class="author-bio-text">
		                    	<?php the_author_meta( 'description' ); ?>
		                    </div>
		                   	<?php echo sprintf( __( '<a href="%2$s" class="author-more-link read-more">More by %1$s</a>', 'uplift' ), $author_name, $author_url ); ?>
		                </div>
		            </div>
		        <?php } ?>

			</div>
        <?php
        }
    }
    add_action( 'sf_post_content_end', 'sf_post_info', 40 );


    /*
    *	POST INFO OVERRIDE
    *	------------------------------------------------
    *	@original - /swift-framework/content/sf-post-detail.php
    *
    ================================================== */
    if ( ! function_exists( 'sf_post_pagination' ) ) {
        function sf_post_pagination() {
        	$sf_options = sf_get_theme_opts();
        	$post_pagination = false;
        	if ( isset($sf_options['single_post_navigation']) ) {
        		$post_pagination = $sf_options['single_post_navigation'];
        	}

        	if ( !$post_pagination ) {
        		return;
        	}
        	?>
        	<div class="post-navigation-wrap">
        		<?php
        			// Previous/next post navigation.
					the_post_navigation( array(
						'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentysixteen' ) . '</span> ' .
							'<span class="screen-reader-text">' . __( 'Next post:', 'twentysixteen' ) . '</span> ' .
							'<span class="post-title">%title</span>',
						'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentysixteen' ) . '</span> ' .
							'<span class="screen-reader-text">' . __( 'Previous post:', 'twentysixteen' ) . '</span> ' .
							'<span class="post-title">%title</span>',
					) );
				?>
        	</div>
        <?php
        }
    }
    add_action( 'sf_post_content_end', 'sf_post_pagination', 50 );


	/*
	*	GET MASONRY POST OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/content/sf-post-formats.php
	*
	================================================== */
	if ( ! function_exists( 'sf_get_masonry_post' ) ) {
		function sf_get_masonry_post( $postID, $thumb_type, $fullwidth, $show_title, $show_excerpt, $show_details, $show_read_more, $content_output, $excerpt_length ) {
			
			$sf_options = sf_get_theme_opts();
			
			// Get Post Object
			$post_object = sf_build_post_object( $postID , $content_output, $excerpt_length );
			$post_categories = sf_get_custom_post_cat_list( $postID );
			
			// Link config			
		    $post_links_match_thumb = false;
		    if ( isset( $sf_options['post_links_match_thumb'] ) ) {
		    	$post_links_match_thumb = $sf_options['post_links_match_thumb'];	
		    }
		
		    $post_permalink_config = 'href="' . $post_object['permalink'] . '" class="link-to-post"';
		    if ( $post_links_match_thumb ) {
		    	$link_config = sf_post_item_link();
		    	$post_permalink_config = $link_config['config'];
		    }
		    
			// Variable setup
			$post_item = "";
			
			$post_item .= '<div class="blog-item-wrap">' . "\n";
			
				// THUMBNAIL MEDIA TYPE SETUP
				$item_figure = "";
				if ( $thumb_type != "none" ) {
				    $item_figure .= sf_post_thumbnail( 'masonry', $fullwidth );
				}
			    if ( $item_figure != "" ) {
			        $post_item .= $item_figure;
			    }
			
				// Start Output
			    $post_item .= '<div class="details-wrap">';
							
					// Details inner
					$post_item .= '<div class="details-inner">';
					
					if ( $post_categories != "" && $item_figure == "" ) {
						$post_item .= '<div class="post-cats">'.$post_categories.'</div>';
					}
					
					// Title
				    if ( $show_title == "yes" && $post_object['format'] != "quote" && $post_object['format'] != "link" ) {
				        $post_item .= '<h3 itemprop="name headline"><a ' . $post_permalink_config . '>' . $post_object['title'] . '</a></h3>';
				    } else if ( $post_object['format'] == "quote" ) {
				        $post_item .= '<div class="quote-excerpt" itemprop="name headline">' . $post_object['excerpt'] . '</div>';
				    } else if ( $post_object['format'] == "link" ) {
				        $post_item .= '<div class="excerpt" itemprop="name headline">' . $post_object['excerpt'] . '</div>';
				    }
						
					// Details		
			        if ( $show_details == "yes" ) {
			        	$post_item .= sf_get_post_details($postID);
					}
					
					// Excerpt
			    	if ( $show_excerpt == "yes" && $post_object['format'] != "quote" && $post_object['format'] != "link" ) {
			            $post_item .= '<div class="excerpt" itemprop="description">' . $post_object['excerpt'] . '</div>';
			        }
					
					$post_item .= '</div>';
					
					
					// Aux
					$post_item .= '<div class="blog-item-aux">';
					
					if ( is_sticky() ) {
					    $post_item .= '<div class="sticky-post-icon"><i class="sf-icon-sticky-post"></i></div>';
					}
					
					// Read More
					if ( $show_read_more == "yes" ) {
					    if ( $post_object['download_button'] ) {
					        if ( $post_object['download_shortcode'] != "" ) {
					            $post_item .= do_shortcode( $post_object['download_shortcode'] );
					        } else {
					            $post_item .= '<a href="' . wp_get_attachment_url( $post_object['download_file'] ) . '" class="download-button read-more-button">' . $post_object['download_text'] . '</a>';
					        }
					    } else {
					    	$post_item .= '<a class="read-more-button" href="' . $post_object['permalink'] . '">' . __( "Read more", 'uplift' ) . '</a>';
						}
					}
					
					// Comments / Likes
			        if ( $show_details == "yes" ) {
			            $post_item .= '<div class="comments-likes">';
			            if ( comments_open() ) {
			                $post_item .= '<div class="comments-wrapper"><a href="' . $post_object['permalink'] . '#comment-area"><i class="sf-icon-comments"></i><span>' . $post_object['comments'] . '</span></a></div>';
			            }
			
			            if ( function_exists( 'lip_love_it_link' ) ) {
			                $post_item .= lip_love_it_link( $postID, false );
			            }
			            $post_item .= '</div>';
			        }
					
					$post_item .= '</div>';
					
			    $post_item .= '</div>';
		    
		    // Close Output
		    $post_item .= '</div>';
			
			// Return 
			return $post_item;
		}
	}
	
	
	/*
	*	GET MINI POST OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/content/sf-post-formats.php
	*
	================================================== */
	if ( ! function_exists( 'sf_get_mini_post' ) ) {
		function sf_get_mini_post( $postID, $thumb_type, $fullwidth, $show_title, $show_excerpt, $show_details, $show_read_more, $content_output, $excerpt_length ) {
			
			$sf_options = sf_get_theme_opts();
				
			// Get Post Object
			$post_object = sf_build_post_object( $postID , $content_output, $excerpt_length );
			$post_categories = sf_get_custom_post_cat_list( $postID );
						
			// Link config			
            $post_links_match_thumb = false;
            if ( isset( $sf_options['post_links_match_thumb'] ) ) {
            	$post_links_match_thumb = $sf_options['post_links_match_thumb'];	
            }
            $post_permalink_config = 'href="' . $post_object['permalink'] . '" class="link-to-post"';
            if ( $post_links_match_thumb ) {
            	$link_config = sf_post_item_link();
            	$post_permalink_config = $link_config['config'];
            }
            
            // Variable setup
            $post_item = "";
			
			// THUMBNAIL MEDIA TYPE SETUP
			$item_figure = "";
			if ( $thumb_type != "none" ) {
			    $item_figure .= sf_post_thumbnail( 'mini', $fullwidth );
			}

			// Open output
            $post_item .= '<div class="mini-blog-item-wrap clearfix">';
           	
	           	$post_item .= $item_figure;
	           	
	           	if ( $item_figure == "" ) {
	           	$post_item .= '<div class="blog-details-wrap no-figure clearfix">';
	           	} else {
	            $post_item .= '<div class="blog-details-wrap clearfix">';
	            }
	            
	            	$post_item .= '<div class="blog-details-inner">';
	            		
	            		if ( $post_categories != "" ) {
	            			$post_item .= '<div class="post-cats">'.$post_categories.'</div>';
						}
						
			            if ( $show_title == "yes" && $post_object['format'] != "quote" && $post_object['format'] != "link" ) {
			                $post_item .= '<h3 itemprop="name headline"><a ' . $post_permalink_config . '>' . $post_object['title'] . '</a></h3>';
			            }
			
			            if ( $show_details == "yes" && $post_object['format'] != "quote" && $post_object['format'] != "link" ) {
			                $post_item .= sf_get_post_details($postID);
			            }
			            if ( $show_excerpt == "yes" ) {
			                if ( $post_object['format'] == "quote" ) {
			                    $post_item .= '<div class="quote-excerpt heading-font" itemprop="description">' . $post_object['excerpt'] . '</div>';
			                } else if ( $post_object['format'] == "link" ) {
			                    $post_item .= '<div class="link-excerpt heading-font" itemprop="description">' . $link_icon . $post_object['excerpt'] . '</div>';
			                } else {
			                    $post_item .= '<div class="excerpt" itemprop="description">' . $post_object['excerpt'] . '</div>';
			                }
			            }

					$post_item .= '</div>';
					          
		            // Aux
		            $post_item .= '<div class="blog-item-aux clearfix">';
		            
		            if ( is_sticky() ) {
		                $post_item .= '<div class="sticky-post-icon"><i class="sf-icon-sticky-post"></i></div>';
		            }
		
		            if ( $show_read_more == "yes" ) {
		                if ( $post_object['download_button'] ) {
		                    if ( $post_object['download_shortcode'] != "" ) {
		                        $post_item .= do_shortcode( $post_object['download_shortcode'] );
		                    } else {
		                        $post_item .= '<a href="' . wp_get_attachment_url( $post_object['download_file'] ) . '" class="download-button read-more-button">' . $post_object['download_text'] . '</a>';
		                    }
		                }
		                $post_item .= '<a class="read-more-button" href="' . $post_object['permalink'] . '">' . __( "Read more", 'uplift' ) . '</a>';
		            }
		
					// Details
		            if ( $show_details == "yes" ) {
		                $post_item .= '<div class="comments-likes">';
		                if ( comments_open() ) {
		                    $post_item .= '<div class="comments-wrapper"><a href="' . $post_object['permalink'] . '#comment-area"><i class="sf-icon-comments"></i><span>' . $post_object['comments'] . '</span></a></div>';
		                }
		
		                if ( function_exists( 'lip_love_it_link' ) ) {
		                    $post_item .= lip_love_it_link( $postID, false );
		                }
		                $post_item .= '</div>';
		
		            }
		
		            $post_item .= '</div>';
	            
	            $post_item .= '</div>';
	            
				
			// Close output
            $post_item .= '</div>';
       	               
			// Return 
        	return $post_item;
		}
	}


	/*
	*	GET TIMELINE POST OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/content/sf-post-formats.php
	*
	================================================== */
	if ( ! function_exists( 'sf_get_timeline_post' ) ) {
		function sf_get_timeline_post( $postID, $thumb_type, $fullwidth, $show_title, $show_excerpt, $show_details, $show_read_more, $content_output, $excerpt_length ) {
			
			$sf_options = sf_get_theme_opts();
						
			// Get Post Object
			$post_object = sf_build_post_object( $postID , $content_output, $excerpt_length );
			$post_categories = sf_get_custom_post_cat_list( $postID );
			
			// Link config			
            $post_links_match_thumb = false;
            if ( isset( $sf_options['post_links_match_thumb'] ) ) {
            	$post_links_match_thumb = $sf_options['post_links_match_thumb'];	
            }
            $post_permalink_config = 'href="' . $post_object['permalink'] . '" class="link-to-post"';
            if ( $post_links_match_thumb ) {
            	$link_config = sf_post_item_link();
            	$post_permalink_config = $link_config['config'];
            }
            
            // Variable setup
            $post_item = "";
           	$comments_icon 	 = apply_filters( 'sf_comments_icon', '<i class="ss-chat"></i>' );
           	$link_icon		 = apply_filters( 'sf_link_icon', '<i class="ss-link"></i>' );
           	$sticky_icon   	 = apply_filters( 'sf_sticky_icon', '<i class="ss-bookmark"></i>' );
			
			// THUMBNAIL MEDIA TYPE SETUP
			$item_figure = "";
			if ( $thumb_type != "none" ) {
			    $item_figure .= sf_post_thumbnail( "timeline", $fullwidth );
			}

			// Open output                        
            $post_item .= '<div class="timeline-item-format-icon-bg"></div>';
            $post_item .= '<div class="timeline-item-format-icon is-hidden">';
            if ( $post_object['format'] == "quote" ) {
            $post_item .= '<i class="sf-icon-quote"></i>';
            } else if ( $post_object['format'] == "image" ) {
            $post_item .= '<i class="sf-icon-image"></i>';
			} else if ( $post_object['format'] == "audio" ) {
			$post_item .= '<i class="sf-icon-audio"></i>';
            } else if ( $post_object['format'] == "video" ) {
            $post_item .= '<i class="sf-icon-video"></i>';
            } else if ( $thumb_type == "slider" ) {
            $post_item .= '<i class="sf-icon-gallery"></i>';
            } else {
            $post_item .= '<i class="sf-icon-text"></i>';
            }
            $post_item .= '</div>';
            
            $post_item .= '<div class="timeline-item-content-wrap is-hidden">';

	            $post_item .= $item_figure;
	            	
	            $post_item .= '<div class="blog-details-wrap clearfix">';
	            	
	            	$post_item .= '<div class="blog-details-inner">';
	            	
	            		if ( $post_categories != "" && $item_figure == "" ) {
	            			$post_item .= '<div class="post-cats">'.$post_categories.'</div>';
	            		}

			            if ( $show_title == "yes" && $post_object['format'] != "quote" && $post_object['format'] != "link" ) {
			                $post_item .= '<h3 itemprop="name headline"><a ' . $post_permalink_config . '>' . $post_object['title'] . '</a></h3>';
			            }
			
			            if ( $show_details == "yes" && $post_object['format'] != "quote" && $post_object['format'] != "link" ) {
			                $post_item .= sf_get_post_details($postID);
			            }
			            
			            if ( $show_excerpt == "yes" ) {
			                if ( $post_object['format'] == "quote" ) {
			                    $post_item .= '<div class="quote-excerpt heading-font" itemprop="description">' . $post_object['excerpt'] . '</div>';
			                } else if ( $post_object['format'] == "link" ) {
			                    $post_item .= '<div class="link-excerpt heading-font" itemprop="description">' . $link_icon . $post_object['excerpt'] . '</div>';
			                } else {
			                    $post_item .= '<div class="excerpt" itemprop="description">' . $post_object['excerpt'] . '</div>';
			                }
			            }
			            
			            // Details		
			            if ( $show_details == "yes" && ( $post_object['format'] == "quote" || $post_object['format'] == "link" ) ) {
			            	$post_item .= sf_get_post_details($postID);
			            }

					$post_item .= '</div>';
					          
		            // Aux
		            $post_item .= '<div class="blog-item-aux clearfix">';
		            
		            if ( is_sticky() ) {
		                $post_item .= '<div class="sticky-post-icon"><i class="sf-icon-sticky-post"></i></div>';
		            }
		
		            if ( $show_read_more == "yes" ) {
		                if ( $post_object['download_button'] ) {
		                    if ( $post_object['download_shortcode'] != "" ) {
		                        $post_item .= do_shortcode( $post_object['download_shortcode'] );
		                    } else {
		                        $post_item .= '<a href="' . wp_get_attachment_url( $post_object['download_file'] ) . '" class="download-button read-more-button">' . $post_object['download_text'] . '</a>';
		                    }
		                }
		                $post_item .= '<a class="read-more-button" href="' . $post_object['permalink'] . '">' . __( "Read more", 'uplift' ) . '</a>';
		            }
		
					// Details
		            if ( $show_details == "yes" ) {
		                $post_item .= '<div class="comments-likes">';
		                if ( comments_open() ) {
		                    $post_item .= '<div class="comments-wrapper"><a href="' . $post_object['permalink'] . '#comment-area"><i class="sf-icon-comments"></i><span>' . $post_object['comments'] . '</span></a></div>';
		                }
		
		                if ( function_exists( 'lip_love_it_link' ) ) {
		                    $post_item .= lip_love_it_link( $postID, false );
		                }
		                $post_item .= '</div>';
		
		            }
		
		            $post_item .= '</div>';
	            
	            $post_item .= '</div>';
            
            $post_item .= '</div>'; // close timeline-item-content-wrap
       	               
			// Return 
        	return $post_item;
		}
	}
	
	
	/*
	*	GET STANDARD POST OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/content/sf-post-formats.php
	*
	================================================== */
    if ( ! function_exists( 'sf_get_standard_post' ) ) {
        function sf_get_standard_post( $postID, $thumb_type, $fullwidth, $show_title, $show_excerpt, $show_details, $show_read_more, $content_output, $excerpt_length ) {
			
			$sf_options = sf_get_theme_opts();
			$single_author = $sf_options['single_author'];
			$remove_dates  = $sf_options['remove_dates'];
			
			// Get Post Object
			$post_object = sf_build_post_object( $postID , $content_output, $excerpt_length );
			$post_categories = sf_get_custom_post_cat_list( $postID );
			
			// Link config			
            $post_links_match_thumb = false;
            if ( isset( $sf_options['post_links_match_thumb'] ) ) {
            	$post_links_match_thumb = $sf_options['post_links_match_thumb'];	
            }
            $post_permalink_config = 'href="' . $post_object['permalink'] . '" class="link-to-post"';
            if ( $post_links_match_thumb ) {
            	$link_config = sf_post_item_link();
            	$post_permalink_config = $link_config['config'];
            }
            
            // Variable setup
            $post_item = "";
           	$comments_icon 	 = apply_filters( 'sf_comments_icon', '<i class="ss-chat"></i>' );
           	$link_icon		 = apply_filters( 'sf_link_icon', '<i class="ss-link"></i>' );
           	$sticky_icon   	 = apply_filters( 'sf_sticky_icon', '<i class="ss-bookmark"></i>' );
			
			// THUMBNAIL MEDIA TYPE SETUP
			$item_figure = "";
			if ( $thumb_type != "none" ) {
			    $item_figure .= sf_post_thumbnail( "timeline", $fullwidth );
			}
			
			// DETAILS SETUP
			$item_details = "";
			if ( $single_author && ! $remove_dates ) {
			    $item_details .= '<div class="blog-item-details">' . sprintf( __( 'In %1$s on <time datetime="%2$s">%3$s</time>', 'uplift' ), $post_object['categories'], $post_object['date_str'], $post_object['date'] ) . '</div>';
			} else if ( ! $remove_dates ) {
			    $item_details .= '<div class="blog-item-details">' . sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> in %3$s on <time datetime="%4$s">%5$s</time>', 'uplift' ), $post_object['author'], get_author_posts_url( get_the_author_meta( 'ID' ) ), $post_object['categories'], $post_object['date_str'], $post_object['date'] ) . '</div>';
			} else if ( ! $single_author ) {
			    $item_details .= '<div class="blog-item-details">' . sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> in %3$s', 'uplift' ), $post_object['author'], get_author_posts_url( get_the_author_meta( 'ID' ) ), $post_object['categories'] ) . '</div>';
			}
			

			// Open output            	
	        $post_item .= $item_figure;
	
	        if ( $item_figure == "" ) {
	            $post_item .= '<div class="standard-post-content no-thumb clearfix">'; // open standard-post-content
	        } else {
	            $post_item .= '<div class="standard-post-content clearfix">'; // open standard-post-content
	        }
	
		        $post_item .= '<div class="blog-details-inner">';
		        
		        	if ( $post_categories != "" && $item_figure == "" ) {
		        		$post_item .= '<div class="post-cats">'.$post_categories.'</div>';
		        	}

		            if ( $show_title == "yes" && $post_object['format'] != "quote" && $post_object['format'] != "link" ) {
		                $post_item .= '<h3 itemprop="name headline"><a ' . $post_permalink_config . '>' . $post_object['title'] . '</a></h3>';
		            }
		
		            if ( $show_details == "yes" && $post_object['format'] != "quote" && $post_object['format'] != "link" ) {
		                $post_item .= sf_get_post_details($postID);
		            }
		            
		            if ( $show_excerpt == "yes" ) {
		                if ( $post_object['format'] == "quote" ) {
		                    $post_item .= '<div class="quote-excerpt heading-font" itemprop="description">' . $post_object['excerpt'] . '</div>';
		                } else if ( $post_object['format'] == "link" ) {
		                    $post_item .= '<div class="link-excerpt heading-font" itemprop="description">' . $link_icon . $post_object['excerpt'] . '</div>';
		                } else {
		                    $post_item .= '<div class="excerpt clearfix" itemprop="description">' . $post_object['excerpt'] . '</div>';
		                }
		            }

				$post_item .= '</div>';
		        
		        // Aux
	            $post_item .= '<div class="blog-item-aux clearfix">';
	            
	            if ( is_sticky() ) {
	                $post_item .= '<div class="sticky-post-icon"><i class="sf-icon-sticky-post"></i></div>';
	            }
	
	            if ( $show_read_more == "yes" ) {
	                if ( $post_object['download_button'] ) {
	                    if ( $post_object['download_shortcode'] != "" ) {
	                        $post_item .= do_shortcode( $post_object['download_shortcode'] );
	                    } else {
	                        $post_item .= '<a href="' . wp_get_attachment_url( $post_object['download_file'] ) . '" class="download-button read-more-button">' . $post_object['download_text'] . '</a>';
	                    }
	                }
	                $post_item .= '<a class="read-more" href="' . $post_object['permalink'] . '">' . __( "Read more", 'uplift' ) . '</a>';
	            }
	
				// Details
	            if ( $show_details == "yes" ) {
	                $post_item .= '<div class="comments-likes">';
	                if ( comments_open() ) {
	                    $post_item .= '<div class="comments-wrapper"><a href="' . $post_object['permalink'] . '#comment-area"><i class="sf-icon-comments"></i><span>' . $post_object['comments'] . '</span></a></div>';
	                }
	
	                if ( function_exists( 'lip_love_it_link' ) ) {
	                    $post_item .= lip_love_it_link( $postID, false );
	                }
	                $post_item .= '</div>';
	
	            }
	
	            $post_item .= '</div>';	
	
	        $post_item .= '</div>'; // close standard-post-content
	       	               
			// Return 
        	return $post_item;
        }
    }
    