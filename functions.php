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

// ==============================================
// setup database table at initial stage
// ==============================================
add_action( 'init', 'setupDatabaseTable' , 10, 1 );
function setupDatabaseTable(){
	global $wpdb;
	$table_name = $wpdb->prefix . "demo_request";
	$my_products_db_version = '1.0.0';
	$charset_collate = $wpdb->get_charset_collate();
	if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" ) != $table_name ) {
		$sql = "CREATE TABLE $table_name (
			id int(20) NOT NULL AUTO_INCREMENT,
			name varchar(200) NOT NULL,
			email varchar(200)NOT NULL,
			restaurant_name varchar(200) NOT NULL,
			created_date  datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
			UNIQUE KEY id (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}
}
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
		'name'          => esc_html__( 'Home Page Widget Container', 'gamiphy' ),
		'id'            => 'home-page-sidebar',
		'description'   => esc_html__( 'Add home widgets here.', 'gamiphy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar( array(
		'name'          => esc_html__( 'Sharable page Widget container', 'gamiphy' ),
		'id'            => 'sharable-page-sidebar',
		'description'   => esc_html__( 'Add Sharable page widgets here.', 'gamiphy' ),
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

	wp_enqueue_script( 'gamiphy-main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), '20151215989889', true );

	wp_enqueue_script( 'gamiphy-form-validator', get_template_directory_uri() . '/js/form-validator.js', array('jquery'), '20151215989889', true );

	wp_enqueue_script( 'gamiphy-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	// use from javascript file wil be like
	// site.ajax_url
	wp_localize_script( 'jquery', 'site', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	));
}
add_action( 'wp_enqueue_scripts', 'gamiphy_scripts' );

/**
 * Read more text customizing
 * @param  [type] $more
 */
function new_excerpt_more($more) {
	global $post;
	return '… <a href="'. get_permalink($post->ID) . '">' . 'Read More &raquo;' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

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
				break;
				default :
				// Proceed with normal comments. ?>
			<li id="li-comment-<?php comment_ID(); ?>"  class="col-12 comment-div">
				<div class="row" id="comment-<?php comment_ID(); ?>" <?php comment_class('clr'); ?>>
					<div class="comment-author vcard col-md-2 hidden-md-down avatar-large">
						<?php echo get_avatar( $comment, 45 ); ?>
					</div><!-- .comment-author -->
					<div class="col-md-10">
                        <div class="row">
                        	<div class="col-2  hidden-lg-up avatar-small">
                                   <?php echo get_avatar( $comment, 45 ); ?>
                            </div>
                            <div class="col-10  comment-title">
                                <div class="user-name"><?php comment_author_link(); ?></div>
                                <div class="comment-time">
                                	<?php printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								sprintf( _x( '%1$s', '1: date', 'gamiphy' ), get_comment_date() )
							); ?> <?php esc_html_e( 'at', 'gamiphy' ); ?> <?php comment_time(); ?>
                                </div>
                            </div>

                            <div class="col-12 comment-text">
                                <?php comment_text(); ?>
                            </div>
                            <div class="col-8 align-items-center comment-reactions">
                                <embed class="like-chat-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/lol.png">
                                <embed class="like-chat-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/like.png">
                                <embed class="like-chat-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/cool.png">
                                <span class="reaction-number">82</span>
                                <span class="reaction">Reaction</span>
                                <div class="reply comment-reply-link">
							<?php comment_reply_link( array_merge( $args, array(
								'reply_text' => esc_html__( 'Reply', 'gamiphy' ),
								'depth'      => $depth,
								'max_depth'	 => $args['max_depth'] )
							) ); ?>
								</div>
                                <span class="report">Report</span>
                            </div>
                        </div>

                    </div>
					
					<!-- .comment-details -->
				</div><!-- #comment-## -->
			</li>
		<?php
			break;
		endswitch; // End comment_type check.
}


/**
* Comment form hidden fields
*/
function comment_form_hidden_fields(){
	comment_id_fields();
	if ( current_user_can( 'unfiltered_html' ) )
	{
		wp_nonce_field( 'unfiltered-html-comment_' . get_the_ID(), '_wp_unfiltered_html_comment', false );
	}
}
/**
 * customizing excerpt length
 * @param  [type] $length
 */
function custom_excerpt_length( $length ){
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/**
 * shortcode function for demo request form
 * @param  [type] $attributes
 */
function demo_request_func( $atts ) {
    $request = shortcode_atts( array(
        'title' => 'something',
        'subtitle' => 'something else',
        'button_text' => '',
        'type' => '' // vertical,horizontal
    ), $atts );

    // for vertical form
    // representation
    ob_start();
    ?>
    <div class="col-md-5 request-demo-form-div">
        <div class="row">
            <div class="col-12 title">
                <?php echo $request['title']; ?>
            </div>
            <div class="col-12 description">
                <?php echo $request['subtitle']; ?>
            </div>
            <div id='vertical' class="col-12 description"></div>
            <div class="col-12 request-demo-form">
                <form class="row demo-request-form" data-response-id='vertical'>
                    <div class="col-12">
                        <input type="text" class="form-control" name="emailOrPhone" placeholder="Email Address or phone number">
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control" name="name"  placeholder="Full Name">
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control" name="restaurantName"   placeholder="Restaurant name">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="form-control"><?php echo $request['button_text']; ?></button>
                    </div>
                </form>
            </div>
        </div>
     </div>
    <?php
	$verticalfORM= ob_get_contents();
	ob_end_clean();
	// for Horizontal form
    // representation
    ob_start();
    ?>
    <div class="row">
        <div class="col-12 title">
            <?php echo $request['title']; ?>
        </div>
        <div id='horizontal' class="col-12 description"></div>
        <div class="col-12 request-demo-form">
            <form class="row demo-request-form"  data-response-id='horizontal'>
                <div class="col-md-3">
                    <input type="text" class="form-control"  required="required" name="emailOrPhone"  placeholder="Email Address or phone number">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control"  required="required" name="name" placeholder="Full Name">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control"  required="required" name="restaurantName" placeholder="Restaurant name">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="form-control"><?php echo $request['button_text']; ?></button>
                </div>
            </form>
        </div>
    </div>
    <?php
    $HorizontalFORM = ob_get_contents();
    ob_end_clean();
    if($request['type'] == 'horizontal')
    	return $HorizontalFORM;
    if($request['type'] == 'vertical')
    	return $verticalfORM;
}
add_shortcode( 'demorequestform', 'demo_request_func' );


/**
 * Demo request endpoint handling from ajax call
 */
add_action("wp_ajax_add_demo_request", "add_demo_request");
add_action("wp_ajax_nopriv_add_demo_request", "add_demo_request");

function add_demo_request() {
	global $wpdb;
   	$email = $_POST['emailOrPhone'];
   	$name = $_POST['name'];
   	$restaurantName = $_POST['restaurantName'];
   	if($email !=='' && $name !=='' && $restaurantName !==''){
   		$table = $wpdb->prefix.'demo_request';
		$data = array('email' => $email, 'name' => $name,'restaurant_name' => $restaurantName);
		$format = array('%s','%s', '%s');
		$wpdb->insert($table,$data,$format);
		$id = $wpdb->insert_id;
		if(isset($id)){
			echo json_encode(array(
				'status' => true,
				'message' => 'We have recieved your request.We will get back to you soon.'
			));
		}else{
			echo json_encode(array(
				'status' => true,
				'message' => 'error saving data.'
			));
		}
   	}else{
   		echo json_encode(array(
				'status' => false,
				'message' => 'Please fill the required fields.'
			));
   	}
   	die();
}


// =======================================================
// demo regustration page initialization
// =======================================================

add_action( 'admin_menu', 'register_demo_registration_page' );
function register_demo_registration_page() {
  // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
  add_menu_page( 'List of Registered Demo', 'Demo Registration', 'manage_options', 'demo-registration', 'list_of_registered_demo', 'dashicons-welcome-widgets-menus', 90 );
}

function list_of_registered_demo(){
	?>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
  
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(document).ready( function () {
		    	$('#request_table').DataTable();
			});	
		});
	</script>
	<div class="wrap">
		<h1>Demo registration information list</h1>
		<p></p>
		<?php
			global $wpdb;
			$table = $wpdb->prefix.'demo_request';
			$querystr = 
			"SELECT * FROM ".$table." ORDER BY id ASC";
			$get_all_demo = $wpdb->get_results($querystr, OBJECT);
			// echo $wpdb->prefix.'demo_request';
		?>
		<table id="request_table" class="display" style="width:100%">
	        <thead>
	            <tr>
	                <th>Email/Phone</th>
	                <th>Name</th>
	                <th>Restaurant Name</th>
	                <th>Request Created On</th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php
	        	foreach ( $get_all_demo as $row ) {
					?>
					<tr>
		                <td><?php echo $row->email;?></td>
		                <td><?php echo $row->name;?></td>
		                <td><?php echo $row->restaurant_name;?></td>
		                <td><?php echo $row->created_date;?></td>
	            	</tr>
					<?php
				}
	        	?>
	        </tbody>
    	</table>
	</div>
	<?php
}

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
 * Gamiphy widgets
 */
require get_template_directory() . '/gamiphy-widget/widgets.php';

/**
 * Custom breadcumb
 */
require get_template_directory() . '/inc/custom-breadcumb.php';

