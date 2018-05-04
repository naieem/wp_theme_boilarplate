<?php
/**
 * Gamiphy functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Gamiphy
 */

if ( ! function_exists( 'gamiphy_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function gamiphy_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Gamiphy, use a find and replace
		 * to change 'gamiphy' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'gamiphy', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		// add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Main Menu', 'gamiphy' )
		) );

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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'gamiphy_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'gamiphy_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gamiphy_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'gamiphy_content_width', 640 );
}
add_action( 'after_setup_theme', 'gamiphy_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gamiphy_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'gamiphy' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'gamiphy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'gamiphy_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function gamiphy_scripts() {
	wp_enqueue_style( 'gamiphy-style', get_stylesheet_uri() );

	wp_enqueue_script( 'gamiphy-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'gamiphy-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gamiphy_scripts' );

// Replaces the excerpt "Read More" text by a link
function new_excerpt_more($more) {
	global $post;
	return '… <a href="'. get_permalink($post->ID) . '">' . 'Read More &raquo;' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Adding Custom Post type
 */
require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Gamiphy options panel Added
 */
require get_template_directory() . '/theme_options/gamiphy_options.php';

/**
 * Formatting comments 
 * @param  [type] $comment [comments]
 * @param  [type] $args    [argument]
 * @param  [type] $depth   [Depth]
 * @return [type] 
 */
function better_comments( $comment, $args, $depth ) {
	global $post;
	$author_id = $post->post_author;
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments. ?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
				<div class="pingback-entry"><span class="pingback-heading"><?php esc_html_e( 'Pingback:', 'gamiphy' ); ?></span> <?php comment_author_link(); ?></div>
			</li>
			<?php
				break;
				default :
				// Proceed with normal comments. ?>
			<li id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" <?php comment_class('clr'); ?>>
					<div class="comment-author vcard">
						<?php echo get_avatar( $comment, 45 ); ?>
					</div><!-- .comment-author -->
					<div class="comment-details clr">
						<div class="comment-meta">
							<cite class="fn"><?php comment_author_link(); ?></cite>
							<span class="comment-date">
							<?php printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								sprintf( _x( '%1$s', '1: date', 'gamiphy' ), get_comment_date() )
							); ?> <?php esc_html_e( 'at', 'gamiphy' ); ?> <?php comment_time(); ?>
							</span><!-- .comment-date -->
						</div><!-- .comment-meta -->
						<?php if ( '0' == $comment->comment_approved ) : ?>
							<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'gamiphy' ); ?></p>
						<?php endif; ?>
						<div class="comment-content entry clr">
							<?php comment_text(); ?>
						</div><!-- .comment-content -->
						<div class="reply comment-reply-link">
							<?php comment_reply_link( array_merge( $args, array(
								'reply_text' => esc_html__( 'Reply to this message', 'gamiphy' ),
								'depth'      => $depth,
								'max_depth'	 => $args['max_depth'] )
							) ); ?>
						</div><!-- .reply -->
					</div><!-- .comment-details -->
				</article><!-- #comment-## -->
			</li>
		<?php
			break;
		endswitch; // End comment_type check.
}
