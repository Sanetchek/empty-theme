<?php
/**
 * emptytheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package emptytheme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Check if required plugins are active
 */
function emptytheme_check_required_plugins() {
	$missing_plugins = array();

	// Check if LiteImage plugin is active
	if ( ! function_exists( 'liteimage' ) ) {
		$missing_plugins[] = 'LiteImage';
	}

	// Check if ACF plugin is active
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		$missing_plugins[] = 'Advanced Custom Fields';
	}

	if ( ! empty( $missing_plugins ) ) {
		// Only add admin notice once to prevent duplicates
		static $notice_added = false;
		if ( ! $notice_added ) {
			add_action( 'admin_notices', function() use ($missing_plugins) {
				emptytheme_required_plugins_notice( $missing_plugins );
			});
			$notice_added = true;
		}
		add_action( 'wp_footer', 'emptytheme_required_plugin_frontend_notice' );
		return false;
	}
	return true;
}

/**
 * Admin notice for missing required plugins
 */
function emptytheme_required_plugins_notice( $missing_plugins ) {
	$plugin_names = implode( ', ', $missing_plugins );

	echo '<div class="notice notice-error is-dismissible">';
	/* translators: %s: List of plugin names */
	echo '<p><strong>' . sprintf( esc_html__( 'The emptytheme theme requires the following plugins to work correctly: %s', 'emptytheme' ), $plugin_names ) . '</strong></p>';
	echo '<p>' . esc_html__( 'These plugins will be installed automatically when you activate the theme.', 'emptytheme' ) . '</p>';
	echo '</div>';
}

/**
 * Frontend notice for missing required plugin
 */
function emptytheme_required_plugin_frontend_notice() {
	if ( current_user_can( 'manage_options' ) ) {
		echo '<div style="position: fixed; top: 32px; right: 20px; background: #dc3232; color: white; padding: 15px; border-radius: 4px; z-index: 999999; max-width: 300px;">';
		echo '<strong>' . esc_html__( 'Theme Error:', 'emptytheme' ) . '</strong><br>';
		echo esc_html__( 'The emptytheme theme requires the LiteImage plugin to work correctly!', 'emptytheme' );
		echo '<br><a href="' . admin_url( 'plugins.php' ) . '" style="color: white; text-decoration: underline;">' . esc_html__( 'Plugin management', 'emptytheme' ) . '</a>';
		echo '</div>';
	}
}

/**
 * Theme activation hook - check required plugins
 */
function emptytheme_theme_activation_check() {
	emptytheme_check_required_plugins();
}
add_action( 'after_switch_theme', 'emptytheme_theme_activation_check' );

// Check required plugin on init
add_action( 'init', 'emptytheme_check_required_plugins' );

/**
 * Prevent theme from working without required plugin (optional strict mode)
 * Uncomment the following lines if you want to completely disable theme functionality
 */
function emptytheme_strict_mode_check() {
	if (!emptytheme_check_required_plugins()) {
		add_action('template_redirect', function() {
			if (!current_user_can('manage_options')) {
				wp_die(
					'<h1>emptytheme theme requires LiteImage plugin</h1><p>For the theme to work correctly, you need to install and activate the LiteImage plugin.</p><p><a href="' . admin_url('plugins.php') . '">Go to plugin management</a></p>',
					'Requires LiteImage plugin',
					array('response' => 503)
				);
			}
		});
	}
}
add_action('init', 'emptytheme_strict_mode_check');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function emptytheme_setup() {
	/*
	* Make theme available for translation.
	* Translations can be filed in the /languages/ directory.
	* If you're building a theme based on emptytheme, use a find and replace
	* to change 'emptytheme' to the name of your theme in all the template files.
	*/
	load_theme_textdomain( 'emptytheme', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'header-menu' => esc_html__( 'Header Menu', 'emptytheme' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'emptytheme' ),
			'privacy-menu' => esc_html__( 'Privacy Menu', 'emptytheme' ),
			'mobile-menu' => esc_html__( 'Mobile Menu', 'emptytheme' ),
		)
	);

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'emptytheme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'emptytheme_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function emptytheme_widgets_init() {
	register_sidebar(array(
		'name'          => esc_html__( 'Sidebar', 'emptytheme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'emptytheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar(array(
		'name' => esc_html__( 'Footer Widget 1', 'emptytheme' ),
		'id' => 'footer-1',
		'description' => esc_html__( 'First area', 'emptytheme' ),
		'before_widget' => '<div class="wsfooterwdget">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
    ));

    register_sidebar(array(
		'name' => esc_html__( 'Footer Widget 2', 'emptytheme' ),
		'id' => 'footer-2',
		'description' => esc_html__( 'Second area', 'emptytheme' ),
		'before_widget' => '<div class="wsfooterwdget">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
    ));

    register_sidebar(array(
		'name' => esc_html__( 'Footer Widget 3', 'emptytheme' ),
		'id' => 'footer-3',
		'description' => esc_html__( 'Third area', 'emptytheme' ),
		'before_widget' => '<div class="wsfooterwdget">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
    ));

	register_sidebar(array(
		'name' => esc_html__( 'Footer Widget 4', 'emptytheme' ),
		'id' => 'footer-4',
		'description' => esc_html__( 'Fourth area', 'emptytheme' ),
		'before_widget' => '<div class="wsfooterwdget">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
}
add_action( 'widgets_init', 'emptytheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function emptytheme_scripts() {
	// main styles
	wp_enqueue_style( 'emptytheme-main', get_template_directory_uri() . '/assets/css/main.min.css', array(), _S_VERSION );
	wp_style_add_data( 'emptytheme-main', 'rtl', 'replace' );

	// script - theme
	wp_enqueue_script( 'emptytheme-script', get_template_directory_uri() . '/assets/js/scripts.min.js', array('jquery'), _S_VERSION, true );

	// script - comment reply
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// wordpress localize
	wp_localize_script('emptytheme-script', 'emptytheme', [
		'ajax_url' => admin_url('admin-ajax.php'),
		'site_url' => get_home_url(),
		'nonce' => wp_create_nonce('emptytheme_nonce'),
	]);

	// No cache headers.
	if (defined('DOING_AJAX') && DOING_AJAX) {
		nocache_headers();
	}
}
add_action( 'wp_enqueue_scripts', 'emptytheme_scripts' );

/**
 * Settings.
 */
require get_template_directory() . '/inc/__settings.php';

/**
 * Hooks.
 */
require get_template_directory() . '/inc/__hooks.php';

/**
 * Ajax.
 */
require get_template_directory() . '/inc/__ajax.php';

/**
 * ACF functionality.
 */
require get_template_directory() . '/inc/__acf.php';

/**
 * Blocks Registration.
 */
require get_template_directory() . '/inc/__blocks-register.php';

/**
 * Breadcrumbs.
 */
require get_template_directory() . '/inc/__breadcrumbs.php';

/**
 * Utils.
 */
require get_template_directory() . '/inc/__utils.php';

/**
 * Sidebar helpers.
 */
require get_template_directory() . '/inc/utils/__sidebar-helpers.php';

/**
 * Optimization.
 */
require get_template_directory() . '/inc/__optimization.php';

/**
 * Preload fonts.
 */
require get_template_directory() . '/inc/__preload-fonts.php';

/**
 * Woocommerce.
 */
require get_template_directory() . '/inc/__woocommerce.php';

/**
 * Theme Options Functionality.
 */
require get_template_directory() . '/inc/__theme-options.php';

/**
 * Theme Shortcodes.
 */
require get_template_directory() . '/inc/__shortcodes.php';

/**
 * Custom Post Types.
 */
require get_template_directory() . '/inc/__post-types.php';

/**
 * Meta Boxes.
 */
require get_template_directory() . '/inc/__meta-boxes.php';

/**
 * Views Management.
 */
require get_template_directory() . '/inc/__views-management.php';

/**
 * Custom Columns for Post Types.
 */
require get_template_directory() . '/inc/__custom-columns.php';

/**
 * Accessibility Functions.
 */
require get_template_directory() . '/inc/__accessibility.php';

/**
 * Comments Functions.
 */
require get_template_directory() . '/inc/__comments.php';