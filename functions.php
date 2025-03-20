<?php
/**
 * Baden Baden functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Baden_Baden
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function baden_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Baden Baden, use a find and replace
		* to change 'baden' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'baden', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'baden' ),
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
			'baden_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'baden_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function baden_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'baden_content_width', 640 );
}
add_action( 'after_setup_theme', 'baden_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function baden_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'baden' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'baden' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'baden_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function baden_scripts() {

	$array_css = array(
		'Gilroy' => 'assets/webfonts/Gilroy/gilroy.css',
		'Cormorantsc' => 'assets/webfonts/Cormorantsc/cormorantsc.css',
		'fontawesome' => 'assets/css/fontawesome.css',
		'swiper' => 'assets/css/swiper-bundle.min.css',
		'bootstrap' => 'assets/css/bootstrap.min.css',
		'styles' => 'assets/css/styles.min.css',
	);

	$array_js = array(
		'swiper' => 'assets/js/swiper-bundle.min.js',
		'bootstrap' => 'assets/js/bootstrap.min.js',
		'script' => 'assets/js/script.js',
	);

	foreach ($array_css as $key => $value) {
		wp_enqueue_style( $key, get_template_directory_uri() . '/' . $value, array(), _S_VERSION );
	}

	foreach ($array_js as $key => $value) {
		wp_enqueue_script( $key, get_template_directory_uri() . '/' . $value, array(), _S_VERSION, true );
	}
}
add_action( 'wp_enqueue_scripts', 'baden_scripts' );

function get_badden_assets($type, $file) {
    $base_url = get_template_directory_uri(); // Получаем URL темы

    switch ($type) {
        case 'img':
            $type = '/assets/img/';
            break;
        case 'css':
            $type = '/assets/css/';
            break;
        case 'js':
            $type = '/assets/js/';
            break;
        default:
            $type = '/';
            break;
    }

    return esc_url($base_url . $type . $file);
}


function the_badden_assets($type, $file) {
    $base_url = get_template_directory_uri(); 

    switch ($type) {
        case 'img':
            $type = '/assets/img/';
            break;
		case 'css':
			$type = '/assets/css/';
			break;
		case 'js':
			$type = '/assets/js/';
			break;
        default:
            $type = '/';
            break;
    }

    echo esc_url($base_url . $type . $file);
}
