<?php

/**
 * Baden Baden functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Baden_Baden
 */

if (! defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function baden_setup()
{
    /*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Baden Baden, use a find and replace
		* to change 'baden' to the name of your theme in all the template files.
		*/
    load_theme_textdomain('baden', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
    add_theme_support('title-tag');

    /*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', 'baden'),
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
    add_theme_support('customize-selective-refresh-widgets');

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
add_action('after_setup_theme', 'baden_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function baden_content_width()
{
    $GLOBALS['content_width'] = apply_filters('baden_content_width', 640);
}
add_action('after_setup_theme', 'baden_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function baden_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'baden'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'baden'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'baden_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function baden_scripts()
{

    $array_css = array(
        'Gilroy' => 'assets/webfonts/Gilroy/gilroy.css',
        'Cormorantsc' => 'assets/webfonts/Cormorantsc/cormorantsc.css',
        'fontawesome' => 'assets/css/fontawesome.css',
        'swiper' => 'assets/css/swiper-bundle.min.css',
        'bootstrap' => 'assets/css/bootstrap.min.css',
        'styles' => 'assets/css/styles.min.css',
    );

    $array_js = array(
        'bootstrap' => 'assets/js/bootstrap.min.js',
        'swiper' => 'assets/js/swiper-bundle.min.js',
        'script' => 'assets/js/script.js',
    );

    foreach ($array_css as $key => $value) {
        wp_enqueue_style($key, get_template_directory_uri() . '/' . $value, array(), _S_VERSION);
    }

    foreach ($array_js as $key => $value) {
        wp_enqueue_script($key, get_template_directory_uri() . '/' . $value, array(), _S_VERSION, true);
    }
}
add_action('wp_enqueue_scripts', 'baden_scripts');

/**
 * Отключаем XML-RPC
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Возвращает URL папки с ассетами
 */
function get_badden_assets($type, $file)
{
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

/**
 * Выводит URL папки с ассетами
 */
function the_badden_assets($type, $file)
{
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

function rename_post_type_to_news()
{
    global $wp_post_types;

    if (isset($wp_post_types['post'])) { // Меняем стандартный тип записи "post"
        $wp_post_types['post']->labels->name = 'Новости';
        $wp_post_types['post']->labels->singular_name = 'Новость';
        $wp_post_types['post']->labels->menu_name = 'Новости';
        $wp_post_types['post']->labels->all_items = 'Все новости';
        $wp_post_types['post']->labels->add_new = 'Добавить новость';
        $wp_post_types['post']->labels->add_new_item = 'Добавить новую новость';
        $wp_post_types['post']->labels->edit_item = 'Редактировать новость';
        $wp_post_types['post']->labels->new_item = 'Новая новость';
        $wp_post_types['post']->labels->view_item = 'Просмотреть новость';
        $wp_post_types['post']->labels->search_items = 'Поиск новостей';
        $wp_post_types['post']->labels->not_found = 'Новости не найдены';
        $wp_post_types['post']->labels->not_found_in_trash = 'В корзине новостей нет';
    }
}
add_action('init', 'rename_post_type_to_news');

function remove_archive_title_prefix($title)
{
    if (is_archive()) {
        // Убираем "Архивы:" из заголовка
        $title = preg_replace('/^Архивы: /', '', $title);
    }
    return $title;
}
add_filter('get_the_archive_title', 'remove_archive_title_prefix');


/**
 * Register custom post types and taxonomies.
 */
function register_custom_post_types()
{
    $post_types = [
        'prozhivanie' => ['name' => 'Проживание', 'taxonomy' => 'tip_kompleksa', 'name_taxonomy' => 'Тип комплекса'],
        'spa' => ['name' => 'СПА'],
        'vodnye_termy' => ['name' => 'Водные Термы'],
        'bannaya_kollekciya' => ['name' => 'Банная коллекция'],
        'akcii' => ['name' => 'Акции', 'taxonomy' => 'akcii_category', 'name_taxonomy' => 'Категории акций'],
        'sertifikaty' => ['name' => 'Сертификаты'],
        'straight' => ['name' => 'Туры', 'taxonomy' => 'tour_category', 'name_taxonomy' => 'Категории туров'],
    ];

    foreach ($post_types as $slug => $data) {
        register_post_type($slug, [
            'labels' => [
                'name' => $data['name'],
                'singular_name' => $data['name'],
            ],
            'public' => true,
            'menu_position' => 5,
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
            'has_archive' => true,
            'show_in_rest' => true,
        ]);

        if (!empty($data['taxonomy'])) {
            register_taxonomy($data['taxonomy'], $slug, [
                'labels' => [
                    'name' => $data['name_taxonomy'],
                    'singular_name' => 'Категории' . $data['name'],
                ],
                'public' => true,
                'hierarchical' => true,
                'show_in_rest' => true,
            ]);
        }
    }
}
add_action('init', 'register_custom_post_types');


/**
 * ACF Options Page
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'    => 'Настройки шаблона',
        'menu_title'    => 'Настройки сайта',
        'menu_slug'     => 'theme-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Блоки',
        'menu_title'    => 'ACF Блоки',
        'parent_slug'   => 'theme-settings',
        'capability'    => 'edit_posts'
    ));
}

function restrict_acf_options_page_access()
{
    if (is_admin() && isset($_GET['page']) && $_GET['page'] === 'theme-acf-settings') {
        $current_user = wp_get_current_user();
        if ($current_user->user_login !== 'Developer') {
            wp_die(__('У вас нет доступа к этой странице.'));
        }
    }
}
add_action('admin_init', 'restrict_acf_options_page_access');

/**
 * ACF Block Category
 */
function register_acf_block_category($categories, $post)
{
    return array_merge(
        $categories,
        [
            [
                'slug'  => 'baden-baden',
                'title' => __('Баден Баден', 'textdomain'),
                'icon'  => 'admin-site'
            ]
        ]
    );
}
add_filter('block_categories_all', 'register_acf_block_category', 10, 2);

function register_acf_blocks_from_admin()
{
    if (have_rows('acf_blocks', 'option')) {
        while (have_rows('acf_blocks', 'option')) {
            the_row();

            $name = get_sub_field('nazvanie');
            $slug = get_sub_field('slug');
            $template_file = get_sub_field('fajl_shablona');

            if ($name && $slug && $template_file) {
                acf_register_block_type([
                    'name'              => $slug,
                    'title'             => __($name),
                    'render_template'   => get_template_directory() . '/template-parts/blocks/acf-' . $template_file . '.php',
                    'category'          => 'baden-baden',
                    'icon'              => 'admin-generic',
                    'keywords'          => [$name, 'acf'],
                    'supports'          => [
                        'align' => true,
                        'anchor' => true,
                    ],
                ]);
            }
        }
    }
}
add_action('acf/init', 'register_acf_blocks_from_admin');


class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    private $current_item;
    private $dropdown_menu_alignment_values = [
        'dropdown-menu-start',
        'dropdown-menu-end',
        'dropdown-menu-sm-start',
        'dropdown-menu-sm-end',
        'dropdown-menu-md-start',
        'dropdown-menu-md-end',
        'dropdown-menu-lg-start',
        'dropdown-menu-lg-end',
        'dropdown-menu-xl-start',
        'dropdown-menu-xl-end',
        'dropdown-menu-xxl-start',
        'dropdown-menu-xxl-end'
    ];

    function start_lvl(&$output, $depth = 0, $args = null) {
        $dropdown_menu_class = [];
        foreach ($this->current_item->classes as $class) {
            if (in_array($class, $this->dropdown_menu_alignment_values)) {
                $dropdown_menu_class[] = $class;
            }
        }
        $indent = str_repeat("\t", $depth);
        $submenu = ($depth > 0) ? ' sub-menu' : '';
        $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ", $dropdown_menu_class)) . " depth_$depth\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $this->current_item = $item;

        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $li_attributes = '';
        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;

        $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
        $classes[] = 'nav-item';
        $classes[] = 'nav-item-' . $item->ID;
        if ($depth && $args->walker->has_children) {
            $classes[] = 'dropdown-menu dropdown-menu-end';
        }

        $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        $active_class = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item->classes, true) || in_array("current_post_ancestor", $item->classes, true)) ? 'active' : '';
        $nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
        $attributes .= ( $args->walker->has_children ) ? ' class="'. $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="'. $nav_link_class . $active_class . '"';

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}