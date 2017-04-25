<?php
	/*
	*
	*	Portfolio Overrides
	*	------------------------------------------------
	*	Uplift specific functionality
	* 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
	*
	*/


	/* PORTFOLIO FILTERS
	================================================== */
	function uplift_portfolio_filter_show_all_text() {
		return __('All', 'uplift');
	}
	add_filter('sf_portfolio_filter_show_all_text', 'uplift_portfolio_filter_show_all_text');
	
	function uplift_portfolio_item_title_tag() {
		return 'h4';
	}
	add_filter('sf_portfolio_item_title_tag', 'uplift_portfolio_item_title_tag');

	function uplift_related_projects_heading() {
		return __('More Projects', 'uplift');
	}
	add_filter('sf_related_projects_heading', 'uplift_related_projects_heading');
	
	
	/* PORTFOLIO ITEM CLASS
	================================================== */
	function uplift_portfolio_item_class($class) {
		if ( strpos( $class, 'multi-masonry-item') ) {
			$class .= 'gallery-item';
			return $class;
		} else {
			return $class;
		}
	}
	add_filter('sf_portfolio_item_class', 'uplift_portfolio_item_class');
	
	
	/*
	*	PORTFOLIO ITEM DETAILS OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/content/sf-portfolio-detail.php
	*
	================================================== */
	if ( ! function_exists( 'sf_portfolio_item_details' ) ) {
		function sf_portfolio_item_details() {
		    global $post;
		    $item_sidebar_content = sf_get_post_meta( $post->ID, 'sf_item_sidebar_content', true );
		    $client               = sf_get_post_meta( $post->ID, 'sf_portfolio_client', true );
		    $project              = sf_get_post_meta( $post->ID, 'sf_portfolio_project', true );
		    $item_link            = sf_get_post_meta( $post->ID, 'sf_portfolio_external_link', true );
		    $social_sharing       = sf_get_post_meta( $post->ID, 'sf_social_sharing', true );
		    $item_categories      = get_the_term_list( $post->ID, 'portfolio-category', '<li>', '</li><li>', '</li>' );
		    $fw_media_display     = sf_get_post_meta( $post->ID, 'sf_fw_media_display', true );
		    $image                = wp_get_attachment_url( get_post_thumbnail_id() );
		    $pb_active            = sf_get_post_meta( $post->ID, '_spb_status', true );
		    ?>
		<?php if ($fw_media_display == "split") { ?>
		<section class="item-details">
		    <?php } else if ($pb_active == "true") { ?>
		    <section class="item-details horizontal-details container">
		    <?php } else { ?>
		    <section class="item-details col-sm-3">
		        <?php } ?>
		        <?php if ( $item_sidebar_content != "" ) { ?>
		            <div class="sidebar-content">
		                <?php echo do_shortcode( $item_sidebar_content ); ?>
		            </div>
		        <?php } ?>
		        <time class="date updated" itemprop="datePublished" datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><i class="sf-icon-date"></i><?php echo get_the_date(); ?></time>
		        <?php if ( $client != "" ) { ?>
		            <div class="client"><i class="sf-icon-name"></i><span><?php _e( "Client", 'uplift' ); ?></span><?php echo esc_attr($client); ?></div>
		        <?php } ?>
		        <?php if ( $project != "" ) { ?>
		            <div class="project"><i class="sf-icon-project"></i><span><?php _e( "Project", 'uplift' ); ?></span><?php echo esc_attr($project); ?></div>
		        <?php } ?>
		        <?php if ( $item_categories != "" ) { ?>
		            <ul class="portfolio-categories">
		                <?php echo $item_categories; ?>
		            </ul>
		        <?php }
		        if ( $item_link != "" ) { ?>
				    <a class="item-link sf-button accent standard" href="<?php echo esc_url($item_link); ?>" target="_blank"><?php _e( "View Project", 'uplift' ); ?><i class="sf-icon-external-link"></i></a>
				<?php } ?>
				<?php if ( $social_sharing ) {
	    			echo do_shortcode('[sf_social_share]');
	    		} ?>
		    </section>
		
		<?php
		}
	    add_action( 'sf_after_portfolio_content', 'sf_portfolio_item_details', 0 );
	}
	
	
	/*
	*	PORTFOLIO ITEM DETAILS OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/core/sf-comments.php
	*
	================================================== */
	if ( ! function_exists( 'sf_custom_comments' ) ) {
	    function sf_custom_comments( $comment, $args, $depth ) {
	        $GLOBALS['comment']       = $comment;
	        $GLOBALS['comment_depth'] = $depth;
	        ?>
	        <li id="comment-<?php comment_ID() ?>" <?php comment_class( 'clearfix' ) ?>>
	        <div class="comment-wrap clearfix">
	            <div class="comment-avatar">
	                <?php if ( function_exists( 'get_avatar' ) ) {
	                    echo get_avatar( $comment, '100' );
	                } ?>
	                <?php if ( $comment->comment_author_email == get_the_author_meta( 'email' ) ) { ?>
	                    <span class="tooltip"><?php _e( "Author", 'uplift' ); ?><span
	                            class="arrow"></span></span>
	                <?php } ?>
	            </div>
	            <div class="comment-content">
	            	<div class="comment-meta">
	            	    <?php
	            	        printf( '<span class="comment-author">%1$s</span> <span class="comment-date">%2$s</span>',
	            	            get_comment_author_link(),
	            	            human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) . ' ' . __( "ago", 'uplift' )
	            	        );
	            	    ?>
	            	</div>
	                <?php if ( $comment->comment_approved == '0' ) _e( "\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'uplift' ) ?>
	                <div class="comment-body">
	                    <?php comment_text() ?>
	                </div>
	                <div class="comment-meta-actions">
	                    <?php
	                        edit_comment_link( __( 'Edit', 'uplift' ), '<span class="edit-link">', '</span><span class="meta-sep">|</span>' );
	                    ?>
	                    <?php if ( $args['type'] == 'all' || get_comment_type() == 'comment' ) :
	                        comment_reply_link( array_merge( $args, array(
	                            'reply_text' => __( 'Reply', 'uplift' ),
	                            'login_text' => __( 'Log in to reply.', 'uplift' ),
	                            'depth'      => $depth,
	                            'before'     => '<span class="comment-reply">',
	                            'after'      => '</span>'
	                        ) ) );
	                    endif; ?>
	                </div>
	            </div>
	        </div>
	    <?php
	    }
	}