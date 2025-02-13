<?php
/**
 * kurowassan functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package kurowassan
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
function kurowassan_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on kurowassan, use a find and replace
		* to change 'kurowassan' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'kurowassan', get_template_directory() . '/languages' );

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
			'primary-menu' => esc_html__( 'Primary', 'kurowassan' ),
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
			'kurowassan_custom_background_args',
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
add_action( 'after_setup_theme', 'kurowassan_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kurowassan_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kurowassan_content_width', 640 );
}
add_action( 'after_setup_theme', 'kurowassan_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kurowassan_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'kurowassan' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'kurowassan' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'kurowassan_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function kurowassan_scripts() {
	wp_enqueue_style( 'kurowassan-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'kurowassan-style', 'rtl', 'replace' );

	wp_enqueue_style( 'css-main', get_stylesheet_directory_uri(). '/css/main.css', array(),  _S_VERSION );
	wp_enqueue_style( 'css-owlcarousel', get_stylesheet_directory_uri(). '/lib/owlcarousel/assets/owl.carousel.min.css', array(),  _S_VERSION );
	wp_enqueue_style( 'css-owlcarousel.theme', get_stylesheet_directory_uri(). '/lib/owlcarousel/assets/owl.theme.default.min.css', array(),  _S_VERSION );

	wp_enqueue_script( 'kurowassan-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'js-main', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'js-owlcarousel', get_template_directory_uri() . '/lib/owlcarousel/owl.carousel.min.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kurowassan_scripts' );

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/*Adding class to menu item - li tag */
function add_menu_list_item_class($classes, $item, $args) {
	if($args->list_item_class) {
		$classes[] = $args->list_item_class;
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'add_menu_list_item_class', 1, 3);

/*Adding class to link menu item - a tag */
function add_menu_link_class( $atts, $item, $args ) {
	if($args->link_class) {
		$atts['class'] = $args->link_class;
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );

/*Create slug */
function slugify($text, string $divider = '-')
{
	$text = preg_replace('~[^\pL\d]+~u', $divider, $text);
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	$text = preg_replace('~[^-\w]+~', '', $text);
	$text = trim($text, $divider);
	$text = preg_replace('~-+~', $divider, $text);
	$text = strtolower($text);
	if (empty($text)) {
		return 'n-a';
	}
	return $text;
}

/*Register Post Type*/
/**/
function custom_array($str, $slug, $icoin = 'generic', $sub = false, $publicly_queryable = true, $editor = true, $taxonomies = ['category', 'post_tag']) {
    $editor = ($editor) ? 'editor' : '';
    
    $args = array(
        'labels' => array('name' => $str, 'singular_name' => $str),
        'description' => $str,
        'supports' => array('title', $editor, 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields'),
        'hierarchical' => ($sub) ? true : false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'rewrite' => array('slug' => $slug, 'with_front' => false),
        'menu_position' => 4,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-' . $icoin,
        'can_export' => true,
        'has_archive' => ($sub) ? true : false,
        'exclude_from_search' => false,
        'publicly_queryable' => $publicly_queryable,
        'capability_type' => 'post',
        'taxonomies' => $taxonomies // Liên kết với category và tag
    );

    register_post_type($slug, $args);
}

/**/
/*Register Post Type*/
function register_taxonomy_cmg($str = '', $str1 = '', $post_type = '', $taxonomy_type = 'category', $publicly_queryable = true) {
    $slug = slugify($str);
    $slug_tx = slugify($str1);

    $labels = [
        "name" => __($str1, "px"),
        "singular_name" => __($str1, "px"),
    ];
    $args = [
        "label" => __($str1, "px"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => $publicly_queryable,
        "hierarchical" => $taxonomy_type === 'category', // Chỉ cho phép phân cấp nếu là 'category'
        "show_ui" => true,
        'supports' => array('thumbnail'),
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => ['slug' => $slug_tx, 'with_front' => true, 'hierarchical' => $taxonomy_type === 'category'],
        "show_admin_column" => true, // Hiển thị cột trong admin
        "show_in_rest" => true,
        "rest_base" => $slug_tx,
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => true,
    ];
    register_taxonomy($slug_tx, [$post_type], $args);
}

function create_post_type()
{
	custom_array('Recipe', 'recipe', 'carrot', false, true); 
}
add_action('init', 'create_post_type');

function register_taxonomy_px() {
	register_taxonomy_cmg('Recipe', "Recipe Category", false);
}
add_action( 'init', 'register_taxonomy_px' );

add_filter('template_include', 'custom_product_category_template', 99);

function custom_product_category_template($template) {
    if (is_tax('product_cat')) {
        $custom_template = get_stylesheet_directory() . '/product-category.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }
    return $template;
}

add_action('wp_ajax_add_to_cart_ajax', 'custom_ajax_add_to_cart');
add_action('wp_ajax_nopriv_add_to_cart_ajax', 'custom_ajax_add_to_cart');
function custom_ajax_add_to_cart() {
    $product_id = intval($_POST['product_id']);
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    if ($product_id && WC()->cart->add_to_cart($product_id, $quantity)) {
        wp_send_json_success([
            'message' => 'Success!',
            'cart_count' => WC()->cart->get_cart_contents_count(),
            'cart_total' => WC()->cart->get_cart_total()
        ]);
    } else {
        wp_send_json_error(['message' => 'Cant add products to cart!']);
    }

    wp_die();
}

add_action('wp_ajax_get_cart_count', 'custom_get_cart_count');
add_action('wp_ajax_nopriv_get_cart_count', 'custom_get_cart_count');
function custom_get_cart_count() {
    $cart_count = WC()->cart->get_cart_contents_count();
    wp_send_json_success(['cart_count' => $cart_count]);
}

add_action('wp_enqueue_scripts', 'custom_enqueue_ajax_script');
function custom_enqueue_ajax_script() {
    wp_enqueue_script('custom-ajax', get_template_directory_uri() . '/js/custom-ajax.js', ['jquery'], null, true);
    wp_localize_script('custom-ajax', 'ajax_params', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);
}