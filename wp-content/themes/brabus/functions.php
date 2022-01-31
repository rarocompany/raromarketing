<?php
/**
 * Brabus functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Brabus
 */

if ( ! function_exists( 'brabus_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function brabus_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Anchor, use a find and replace
		 * to change 'brabus' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'brabus', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'brabus-post-thumb-small', 1015, 698, true );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
	}
endif;
add_action( 'after_setup_theme', 'brabus_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function brabus_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'brabus_content_width', 640 );
}
add_action( 'after_setup_theme', 'brabus_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function brabus_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'brabus' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'brabus' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'brabus' ),
		'id'            => 'footer-widget-1',
		'before_widget' => '<div class="widget footer-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'brabus' ),
		'id'            => 'footer-widget-2',
		'before_widget' => '<div class="widget footer-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'brabus' ),
		'id'            => 'footer-widget-3',
		'before_widget' => '<div class="widget footer-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'brabus_widgets_init' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Enqueue styles and scripts.
 */
require_once get_template_directory() . '/inc/styles-and-scripts.php';

/**
 * Register nav menus
 */
require_once get_template_directory() . '/inc/nav-menus.php';

/**
 * Custom menu walker.
 */
require_once get_template_directory() . '/inc/class.custom-menu-walker.php';

require_once get_template_directory() . '/inc/tgm.php';

if ( ! function_exists( 'brabus_get_the_post_excerpt' ) ) {
	/**
	 * This function makes excerpt for the post.
	 *
	 * @param integer $limit of charachers
	 * @return string
	 */
	function brabus_get_the_post_excerpt( $string, $limit = 70, $more = '...', $break_words = false ) {
		if($limit == 0) return '';

		if( mb_strlen( $string, 'utf8' ) > $limit ) {
			$limit -= mb_strlen( $more, 'utf8' );

			if( !$break_words ) {
				$string = preg_replace('/\s+\S+\s*$/su', '', mb_substr($string, 0, $limit + 1, 'utf8'));
			}

			return '<p>' . mb_substr( $string, 0, $limit, 'utf8' ) . $more . '</p>';
		} else {

			return '<p>' . $string . '</p>';
		}
	}

}

if( ! function_exists( 'brabus_posted_date_with_tags' ) ) {

	function brabus_posted_date_with_tags() {

		echo sprintf( esc_html__( 'Posted %s', 'brabus' ), get_the_date('j F Y') );

		$tags = get_the_tags();
		if ( false !== $tags ) {
			foreach ( $tags as $tag ) {
				$link = get_tag_link( $tag->term_id );
				$data[] = '<a href="' . $link . '">' . $tag->name . '</a>';
			}

			echo ' | ' . implode( ', ', $data );
		}
	}
}

if( ! function_exists( 'brabus_move_comment_field_to_bottom' ) ) {
	function brabus_move_comment_field_to_bottom( $fields ) {
		$comment_field = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $comment_field;

		return $fields;
	}

	add_filter( 'comment_form_fields', 'brabus_move_comment_field_to_bottom' );
}

if( ! function_exists( 'brabus_bootstrap_comment' ) ) {
	/**
	 * Custom callback for comment output
	 *
	 */
	function brabus_bootstrap_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;

		$comment_link_args = array(
			'add_below'  => 'comment',
			'respond_id' => 'respond',
			'reply_text' => esc_html__('Reply', 'brabus'),
			'login_text' => esc_html__('Log in to Reply', 'brabus'),
			'depth'      => 1,
			'before'     => '',
			'after'      => '',
			'max_depth'  => 5
		);
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>
            <li class="comment">
                <figure class="comment-avatar"><?php echo get_avatar( $comment ); ?></figure>
                <div class="comment-content">
                    <h4><?php comment_author_link() ?></h4>
                    <p><?php comment_text() ?></p>
                    <small> <?php comment_date() ?></small>
					<?php
					comment_reply_link( $comment_link_args );
					?>
                </div>
            </li>
		<?php endif;
	}

}

if( ! function_exists( 'brabus_get_option' ) ) {

	function brabus_get_option( $slug ) {
		if( function_exists( 'get_field' ) ) {
			return get_field( $slug, 'option' );
		}

		return false;
	}
}

if( ! function_exists( 'brabus_get_field' ) ) {

	function brabus_get_field( $slug, $post_id = 0 ) {
		if( function_exists( 'get_field' ) ) {
			return get_field( $slug, $post_id );
		}

		return false;
	}
}

if( ! function_exists( 'brabus_pagination' ) ) {
	/**
	 * Custom Pagination
	 */
	function brabus_pagination( $animate = false, $masonry = false ) {
		global $wp_query, $wp_rewrite;

		$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
		$pagination = array(
			'base' 		=> add_query_arg('paged','%#%'),
			'format' 	=> '',
			'total' 	=> $wp_query->max_num_pages,
			'current' 	=> $current,
			'prev_text' => esc_html__( 'Previous', 'brabus' ),
			'next_text' => esc_html__( 'Next', 'brabus' ),
			'type' 		=> 'list'
		);
		if( $wp_rewrite->using_permalinks() )
			$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

		if( !empty($wp_query->query_vars['s']) )
			$pagination['add_args'] = array( 's' => get_query_var( 's' ) );

		$class = '';
		if( $animate ) {
			$class .= 'wow fadeInUp ';
		}
		if( $masonry ) {
			$class .= 'masonry-cols ';
		}
		echo "<div class='clearfix'></div>";
		echo "<div class='pagination" . esc_attr( $class ) . "'>";
		echo paginate_links( $pagination );
		echo "</div>";
	}
}


if( ! function_exists( 'brabus_get_post_thumbnail_url' ) ) {
	/**
	 * Get Post Thumbnail URL
	 */
	function brabus_get_post_thumbnail_url() {
		if( get_the_post_thumbnail_url() ) {
			return get_the_post_thumbnail_url( get_the_ID(), 'brabus-post-thumb-small' );
		}

		return false;
	}
}

if( ! function_exists( 'brabus_get_page_title' ) ) {

	function brabus_get_page_title() {
		$title = '';

		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_term_title( "", false ) . esc_html__( 'Tag', 'brabus' );
		} elseif ( is_date() ) {
			$title = get_the_time( 'F Y' );
		} elseif ( is_author() ) {
			$title = esc_html__( 'Author:', 'brabus' ) . ' ' . esc_html( get_the_author() );
		} elseif ( is_search() ) {
			$title = esc_html__( 'Search Result', 'brabus' );
		} elseif ( is_404() ) {
			$title = esc_html__( 'Page not found', 'brabus' );
		} elseif ( is_archive() ) {
			$title = esc_html__( 'Archive', 'brabus' );
		} elseif ( is_home() || is_front_page() ) {
			if ( is_home() && ! is_front_page() ) {
				$title = esc_html( single_post_title( '', false ) );
			} else {
				$title = ( brabus_get_option( 'archive_blog_title' ) ) ? esc_html( brabus_get_option( 'archive_blog_title' ) ) : esc_html__( 'Blog', 'brabus' );
			}
		} else {
			global $post;
			if ( ! empty( $post ) ) {
				$id = $post->ID;
				$title = esc_html( get_the_title( $id ) );
			} else {
				$title = esc_html__( 'Post not found.', 'brabus' );
			}
		}

		return $title;
	}

}

if( ! function_exists( 'brabus_get_archive_description' ) ) {
	function brabus_get_archive_description() {
		$description = '';

		if ( is_home() || is_front_page() ) {
			$description = ( brabus_get_option( 'archive_blog_description' ) ) ? esc_html( brabus_get_option( 'archive_blog_description' ) ) : '';
		}
        elseif( is_category() || is_tag() || is_author() || is_post_type_archive() || is_archive() ) {
			$description = get_the_archive_description();
		}

		return $description;
	}
}
if( ! function_exists( 'brabus_render_page_header' ) ) {

	function brabus_render_page_header( $type ) {

		$show_header = true;
		$header_style = '';
		$header_title = '';
		$header_description = '';
		$enable_social_icons = true;
		$enable_soundbar = true;
		$enable_scrolldown = true;
		$header_bg_video = '';

		switch ( $type ){
			case 'page' :
				$show_header = false;
				$enable_soundbar = false;
				if( brabus_get_field( 'show_page_header' ) !== 'no' ) {
					$show_header = true;

					if( brabus_get_field( 'header_title_type') === 'custom' ) {
						$header_title = brabus_get_field( 'header_title');
					}
					else {
						$header_title = get_the_title();
					}

					$header_bg_type = brabus_get_field( 'header_bg_type' ) ? brabus_get_field( 'header_bg_type' ) : 'image';
					$header_bg_color = brabus_get_field( 'header_bg_color' ) ? brabus_get_field( 'header_bg_color' ) : '#0e0e0e';
					$header_bg_image = brabus_get_field( 'header_bg_image' ) ? brabus_get_field( 'header_bg_image' ) : '';

					if( $header_bg_image && $header_bg_type == 'image' ) {
						$header_style = 'background: url(' . esc_url( $header_bg_image ) .') center ' . $header_bg_color .';' ;
					}
					else {
						$header_style = 'background: ' . $header_bg_color .';' ;
					}

					if( $header_bg_type == 'video' ) {
						$header_bg_video = brabus_get_field( 'header_bg_video' ) ? brabus_get_field( 'header_bg_video' ) : '';
					}

					$header_description = brabus_get_field( 'description' );
					$enable_social_icons = ( brabus_get_field( 'disable_social_icons' ) ) ? false : true;
					$enable_soundbar = ( brabus_get_field( 'disable_soundbar' ) ) ? false : true;
				}

				break;
			case 'portfolio' :

				$show_header = true;

				if( brabus_get_field( 'header_title_type') === 'custom' ) {
					$header_title = brabus_get_field( 'header_title');
				}
				else {
					$header_title = get_the_title();
				}

				$header_bg_type = brabus_get_field( 'header_bg_type' ) ? brabus_get_field( 'header_bg_type' ) : 'image';
				$header_bg_color = brabus_get_field( 'header_bg_color' ) ? brabus_get_field( 'header_bg_color' ) : '#0e0e0e';
				$header_bg_image = brabus_get_field( 'header_bg_image' ) ? brabus_get_field( 'header_bg_image' ) : '';

				if( $header_bg_image && $header_bg_type == 'image' ) {
					$header_style = 'background: url(' . esc_url( $header_bg_image ) .') center ' . $header_bg_color .';' ;
				}
				else {
					$header_style = 'background: ' . $header_bg_color .';' ;
				}

				if( $header_bg_type == 'video' ) {
					$header_bg_video = brabus_get_field( 'header_bg_video' ) ? brabus_get_field( 'header_bg_video' ) : '';
				}

				$header_description = brabus_get_field( 'description' );

				$enable_social_icons = ( brabus_get_field( 'disable_social_icons' ) ) ? false : true;
				$enable_soundbar = ( brabus_get_field( 'disable_soundbar' ) ) ? false : true;
				break;
			case 'archive':
			case 'single':
			case 'frontpage':
				$header_description = brabus_get_archive_description();
				if( $type == 'single' ) {
					$header_title = get_the_title();
				}
				else{
					$header_title = brabus_get_page_title();
				}
				$header_bg_type = brabus_get_option( 'archive_header_bg_type' ) ? brabus_get_option( 'archive_header_bg_type' ) : 'image';
				$header_bg_color = brabus_get_option( 'archive_header_bg_color' ) ? brabus_get_option( 'archive_header_bg_color' ) : '#0e0e0e';
				$header_bg_image = brabus_get_option( 'archive_header_bg_image' ) ? brabus_get_option( 'archive_header_bg_image' ) : '';

				if( $header_bg_image && $header_bg_type == 'image' ) {
					$header_style = 'background: url(' . esc_url( $header_bg_image ) .') center ' . $header_bg_color .';' ;
				}
				else {
					$header_style = 'background: ' . $header_bg_color .';' ;
				}
				if( $header_bg_type == 'video' ) {
					$header_bg_video = brabus_get_option( 'archive_header_bg_video' ) ? brabus_get_option( 'archive_header_bg_video' ) : '';
				}

				break;
			case '404':
				$header_title = brabus_get_page_title();

				$header_bg_type = brabus_get_option( 'page_404_header_bg_type' ) ? brabus_get_option( 'page_404_header_bg_type' ) : 'image';
				$header_bg_color = brabus_get_option( 'page_404_header_bg_color' ) ? brabus_get_option( 'page_404_header_bg_color' ) : '#0e0e0e';
				$header_bg_image = brabus_get_option( 'page_404_header_bg_image' ) ? brabus_get_option( 'page_404_header_bg_image' ) : '';

				if( $header_bg_image && $header_bg_type == 'image' ) {
					$header_style = 'background: url(' . esc_url( $header_bg_image ) .') center ' . $header_bg_color .';' ;
				}
				else {
					$header_style = 'background: ' . $header_bg_color .';' ;
				}

				if( $header_bg_type == 'video' ) {
					$header_bg_video = brabus_get_option( 'page_404_header_bg_video' ) ? brabus_get_option( 'page_404_header_bg_video' ) : '';
				}

				break;
			case 'search':
				$header_title = brabus_get_page_title();
				$header_description = sprintf( __('Search result for: %s ', 'brabus' ), '<span>' . get_search_query() . '</span>' );

				$header_bg_type = brabus_get_option( 'search_header_bg_type' ) ? brabus_get_option( 'search_header_bg_type' ) : 'image';
				$header_bg_color = brabus_get_option( 'search_header_bg_color' ) ? brabus_get_option( 'search_header_bg_color' ) : '#0e0e0e';
				$header_bg_image = brabus_get_option( 'search_header_bg_image' ) ? brabus_get_option( 'search_header_bg_image' ) : '';

				if( $header_bg_image  && $header_bg_type == 'image' ) {
					$header_style = 'background: url(' . esc_url( $header_bg_image ) .') center ' . $header_bg_color .';' ;
				}
				else {
					$header_style = 'background: ' . $header_bg_color .';' ;
				}

				if( $header_bg_type == 'video' ) {
					$header_bg_video = brabus_get_option( 'search_header_bg_video' ) ? brabus_get_option( 'search_header_bg_video' ) : '';
				}
				break;
		}

		if( $show_header ) {
			$enable_soundbar_option = brabus_get_option( 'enable_soundbar' );
			$enable_scrolldown_option = brabus_get_option( 'enable_scrolldown' );

			?>
            <header class="page-header" <?php if ( $header_style !== '' ) { echo 'style="' . esc_attr( $header_style ) . '"'; } ?>>

				<?php if( $header_bg_video ) { ?>
                    <div class="video-bg">
                        <video src="<?php echo esc_url( $header_bg_video ); ?>" muted loop autoplay></video>
                    </div>
				<?php } ?>
                <div class="container">
                    <h1><?php echo wp_kses_post( $header_title ); ?></h1>

					<?php if( $header_description ) { ?>
                        <p><?php echo wp_kses_post( $header_description ); ?></p>
					<?php } ?>
                </div>

				<?php
				if( $enable_social_icons ) {
					$social_media = brabus_get_option( 'social_media' );
					if ( $social_media ) {
						?>
                        <aside class="left-side">
                            <ul>
								<?php foreach ( $social_media as $social ) { ?>
                                    <li><a href="<?php echo esc_url( $social['url'] ); ?>"
                                           target="_blank"
                                           title="<?php echo esc_attr( $social['title'] ); ?>"><?php echo esc_html( $social['title'] ); ?></a></li>
								<?php } ?>
                            </ul>
                        </aside>
						<?php
					}
				}
				?>
				<?php
				if( $enable_scrolldown_option ) {
					$scrolldown_label = ( brabus_get_option( 'scrolldown_label' ) ) ? brabus_get_option( 'scrolldown_label' ) : 'SCROLL DOWN';
					?>
                    <div class="scroll-down"><small><?php echo esc_html( $scrolldown_label ); ?></small><span></span></div>
				<?php } ?>

				<?php if( $enable_soundbar_option && $enable_soundbar ) {
					$soundbar_label = ( brabus_get_option( 'soundbar_label' ) ) ? brabus_get_option( 'soundbar_label' ) : 'SOUND';
					?>
                    <div class="sound"> <span> <?php echo esc_html( $soundbar_label ); ?> </span>
                        <div class="equalizer">
                            <div class="holder"> <span></span> <span></span> <span></span> <span></span><span></span><span></span> </div>
                            <!-- end holder -->
                        </div>
                        <!-- end equalizer -->
                    </div>
                    <!-- end sound -->
				<?php } ?>
            </header>
            <!-- end navbar -->
			<?php
		}

	}
}


if( ! function_exists( 'brabus_post_tags' ) ) {

	function brabus_post_tags() {

		$tags = get_the_tags();
		if ( false !== $tags ) {
			?>
            <ul class="post-categories">
				<?php
				foreach ( $tags as $tag ) {
					$link = get_tag_link( $tag->term_id );
					?>
                    <li><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $tag->name ); ?></a></li>
					<?php
				}
				?>
            </ul>
			<?php
		}
	}
}

if( ! function_exists( 'brabus_get_wpml_langs' ) ) {

	function brabus_get_wpml_langs() {

		if ( function_exists( 'icl_get_languages' ) ) {
			$langs = icl_get_languages( 'skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str' );
			if ( $langs ) {
				?>
                <ul class="language">
					<?php foreach ( $langs as $lang ) { ?>
                        <li <?php if( $lang['active'] === 1 ) { ?> class="active" <?php } ?>>
                            <a href="<?php echo esc_url( $lang['url'] ); ?>" title="<?php echo esc_attr__( $lang['native_name'], 'brabus' ); ?>"><?php echo esc_html( strtoupper( $lang['language_code'] ) ); ?></a>
                        </li>
					<?php } ?>
                </ul>
				<?php
			}
		}

	}
}
function brabus_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	$upload_mimes['svgz'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'brabus_mime_types');

function brabus_import_files() {
	return array(
		array(
			'import_file_name'             	=> 'Brabus Demo Import',
			'import_file_url' 				=> 'http://brabus.themezinho.net/import/demo-data.xml',
      		'import_widget_file_url' 		=> 'http://brabus.themezinho.net/import/widgets.wie',
			'import_notice'                	=> esc_html__( 'After you import this demo, you will have to setup the theme option separately.', 'brabus' ),
			'preview_url'                  	=> 'https://brabus.themezinho.net',
		),
	);

}
add_filter( 'pt-ocdi/import_files', 'brabus_import_files' );

function brabus_after_import_setup() {
	// Assign menus to their locations.
	$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
	$left_menu = get_term_by( 'name', 'Left Menu', 'nav_menu' );
	set_theme_mod( 'nav_menu_locations', array(
			'main_menu' => $main_menu->term_id,
			'left_menu' => $left_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'START' );
	$blog_page_id  = get_page_by_title( 'NEWS' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

	if( function_exists( 'brabus_after_import' ) ) {
		brabus_after_import();
    }
}
add_action( 'pt-ocdi/after_import', 'brabus_after_import_setup' );
add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
add_action( 'pt-ocdi/disable_pt_branding', '__return_true' );