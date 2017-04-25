<?php
	/*
	*
	*	Gallery Overrides
	*	------------------------------------------------
	*	Uplift specific functionality
	* 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
	*
	*/
	
	
	/* GALLERY THUMBNAIL
    ================================================== */
    if ( ! function_exists( 'sf_gallery_thumbnail' ) ) {
        function sf_gallery_thumbnail( $display_type = "gallery", $link_type = "lightbox", $columns = "2", $gutters = "yes", $count = 0, $gallery_id = 0 ) {

            global $post;
            $sf_options = sf_get_theme_opts();

            $gallery_thumb = $item_class = $link_config = '';
            $thumb_width   = 600;
            $thumb_height  = 450;
            $video_height  = 450;

            if ( $columns == "1" ) {
                $thumb_width  = 1200;
                $thumb_height = 900;
                $video_height = 900;
            } else if ( $columns == "2" ) {
                $thumb_width  = 800;
                $thumb_height = 600;
                $video_height = 600;
            } else if ( $columns == "3" ) {
                $thumb_width  = 600;
                $thumb_height = 450;
                $video_height = 450;
            }

            if ( $display_type == "masonry" || $display_type == "masonry-gallery" ) {
                $thumb_height = null;
            }

            $thumb_image   = get_post_thumbnail_id();
            $thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );

            $item_title    = get_the_title();
            $item_subtitle = sf_get_post_meta( $post->ID, 'sf_gallery_subtitle', true );
            $permalink     = get_permalink();
            $item_link	   = sf_gallery_item_link( $link_type, $gallery_id );

            if ( $display_type == "gallery" || $display_type == "masonry-gallery" ) {
                $gallery_thumb .= '<figure class="animated-overlay overlay-style">' . "\n";
            } else {
                $gallery_thumb .= '<figure class="animated-overlay overlay-alt">' . "\n";
            }

            $image = sf_aq_resize( $thumb_img_url, $thumb_width, $thumb_height, true, false );

            if ( $image ) {

                $gallery_thumb .= '<a ' . $item_link['config'] . '></a>';

                $gallery_thumb .= '<img itemprop="image" src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . $item_title . '" />' . "\n";

                $gallery_thumb .= '<div class="figcaption-wrap"></div>';
				$gallery_thumb .= '<figcaption><div class="thumb-info">';
                
                	if ( $item_link['svg_icon'] != "" ) {
                		$gallery_thumb .= $item_link['svg_icon'];
                	} else {
                		$gallery_thumb .= '<i class="' . $item_link['icon'] . '"></i>';
                	}
	                if ( $display_type == "gallery" || $display_type == "masonry-gallery" ) {
	                    $gallery_thumb .= '<h4 itemprop="name headline">' . $item_title . '</h4>';
	                    if ( $item_subtitle != "" ) {
	                        $gallery_thumb .= '<div class="name-divide"></div>';
	                    }
	                    $gallery_thumb .= '<h5 itemprop="name alternativeHeadline">' . $item_subtitle . '</h5>';
	                }
                $gallery_thumb .= '</div></figcaption>';
            }

            $gallery_thumb .= '</figure>' . "\n";

            return $gallery_thumb;
        }
    }
