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
	
	// Add active class to current page menu item
	if(in_array('current-menu-item', $item->classes)) {
		$atts['class'] .= ' active';
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
    
    $labels = array(
        'name'                  => $str,
        'singular_name'         => $str,
        'menu_name'             => $str,
        'name_admin_bar'        => $str,
        'archives'              => $str . ' Archives',
        'attributes'            => $str . ' Attributes',
        'parent_item_colon'     => 'Parent ' . $str . ':',
        'all_items'             => 'All ' . $str . 's',
        'add_new_item'          => 'Add New ' . $str,
        'add_new'               => 'Add New',
        'new_item'              => 'New ' . $str,
        'edit_item'             => 'Edit ' . $str,
        'update_item'           => 'Update ' . $str,
        'view_item'             => 'View ' . $str,
        'view_items'            => 'View ' . $str . 's',
        'search_items'          => 'Search ' . $str,
        'not_found'             => 'Not found',
        'not_found_in_trash'    => 'Not found in Trash',
        'featured_image'        => 'Featured Image',
        'set_featured_image'    => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image'    => 'Use as featured image',
        'insert_into_item'      => 'Insert into ' . $str,
        'uploaded_to_this_item' => 'Uploaded to this ' . $str,
        'items_list'            => $str . 's list',
        'items_list_navigation' => $str . 's list navigation',
        'filter_items_list'     => 'Filter ' . $str . 's list',
    );
    
    $args = array(
        'label'                 => $str,
        'description'           => $str,
        'labels'                => $labels,
        'supports'              => array('title', $editor, 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields'),
        'hierarchical'          => ($sub) ? true : false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 4,
        'menu_icon'             => 'dashicons-' . $icoin,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => ($sub) ? true : false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => $publicly_queryable,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array('slug' => $slug, 'with_front' => false),
        'taxonomies'            => $taxonomies,
    );

    register_post_type($slug, $args);
}

/**/
/*Register Post Type*/
function register_taxonomy_cmg($str = '', $str1 = '', $post_type = '', $taxonomy_type = 'category', $publicly_queryable = true) {
    $slug = slugify($str);
    $slug_tx = slugify($str1);

    $labels = [
        "name"                  => __($str1, "px"),
        "singular_name"         => __($str1, "px"),
        "menu_name"             => __($str1, "px"),
        "all_items"             => __("All " . $str1, "px"),
        "parent_item"           => __("Parent " . $str1, "px"),
        "parent_item_colon"     => __("Parent " . $str1 . ":", "px"),
        "new_item_name"         => __("New " . $str1 . " Name", "px"),
        "add_new_item"          => __("Add New " . $str1, "px"),
        "edit_item"             => __("Edit " . $str1, "px"),
        "update_item"           => __("Update " . $str1, "px"),
        "view_item"             => __("View " . $str1, "px"),
        "separate_items_with_commas" => __("Separate " . $str1 . " with commas", "px"),
        "add_or_remove_items"   => __("Add or remove " . $str1, "px"),
        "choose_from_most_used" => __("Choose from the most used " . $str1, "px"),
        "popular_items"         => __("Popular " . $str1, "px"),
        "search_items"          => __("Search " . $str1, "px"),
        "not_found"             => __("Not Found", "px"),
        "no_terms"              => __("No " . $str1, "px"),
        "items_list"            => __($str1 . " list", "px"),
        "items_list_navigation" => __($str1 . " list navigation", "px"),
    ];
    $args = [
        "label"                 => __($str1, "px"),
        "labels"                => $labels,
        "public"                => true,
        "publicly_queryable"    => $publicly_queryable,
        "hierarchical"          => $taxonomy_type === 'category', 
        "show_ui"               => true,
        "show_in_menu"          => true,
        "show_in_nav_menus"     => true,
        "query_var"             => true,
        "rewrite"               => ['slug' => $slug_tx, 'with_front' => true, 'hierarchical' => $taxonomy_type === 'category'],
        "show_admin_column"     => true, 
        "show_in_rest"          => true,
        "rest_base"             => $slug_tx,
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit"    => true,
    ];
    register_taxonomy($slug_tx, [$post_type], $args);
}

function create_post_type()
{
	custom_array('Recipe', 'recipe', 'carrot', false, true); 
}
add_action('init', 'create_post_type');


function recipe_add_meta_boxes() {
    add_meta_box(
        'recipe_details_meta_box',
        'Recipe Details',
        'render_recipe_details_meta_box',
        'recipe',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'recipe_add_meta_boxes');

function render_recipe_details_meta_box($post) {
    wp_nonce_field('recipe_details_nonce', 'recipe_details_nonce');
    
    $ingredients = get_post_meta($post->ID, '_recipe_ingredients', true);
    $instructions = get_post_meta($post->ID, '_recipe_instructions', true);
    $cooking_time = get_post_meta($post->ID, '_recipe_cooking_time', true);
    $servings = get_post_meta($post->ID, '_recipe_servings', true);
    ?>
    <div class="recipe-meta-box">
        <style>
            .recipe-details-section {
                margin-bottom: 20px;
                padding: 15px;
                background: #f9f9f9;
                border-radius: 4px;
            }
            .recipe-details-section h4 {
                margin-top: 0;
                margin-bottom: 15px;
                padding-bottom: 10px;
                border-bottom: 1px solid #eee;
            }
            .form-field {
                margin-bottom: 15px;
            }
            .form-field label {
                display: block;
                margin-bottom: 5px;
                font-weight: 600;
            }
            .form-field input[type="text"],
            .form-field textarea {
                width: 100%;
            }
            .form-field textarea {
                min-height: 150px;
            }
            .form-field-inline {
                display: flex;
                gap: 15px;
            }
            .form-field-inline .form-field {
                flex: 1;
            }
        </style>
        
        <div class="recipe-details-section">
            <h4>Recipe Information</h4>
            
            <div class="form-field-inline">
                <div class="form-field">
                    <label for="recipe_cooking_time"><?php _e('Cooking Time (minutes)', 'kurowassan'); ?></label>
                    <input type="number" id="recipe_cooking_time" name="recipe_cooking_time" value="<?php echo esc_attr($cooking_time); ?>" />
                </div>
                
                <div class="form-field">
                    <label for="recipe_servings"><?php _e('Servings', 'kurowassan'); ?></label>
                    <input type="number" id="recipe_servings" name="recipe_servings" value="<?php echo esc_attr($servings); ?>" />
                </div>
            </div>
            
            <div class="form-field">
                <label for="recipe_ingredients"><?php _e('Ingredients', 'kurowassan'); ?></label>
                <textarea id="recipe_ingredients" name="recipe_ingredients"><?php echo esc_textarea($ingredients); ?></textarea>
                <p class="description"><?php _e('Enter each ingredient on a new line.', 'kurowassan'); ?></p>
            </div>
            
            <div class="form-field">
                <label for="recipe_instructions"><?php _e('Instructions', 'kurowassan'); ?></label>
                <textarea id="recipe_instructions" name="recipe_instructions"><?php echo esc_textarea($instructions); ?></textarea>
                <p class="description"><?php _e('Enter each step on a new line.', 'kurowassan'); ?></p>
            </div>
        </div>
    </div>
    <?php
}

function save_recipe_details($post_id) {
    
    if (!isset($_POST['recipe_details_nonce']) || !wp_verify_nonce($_POST['recipe_details_nonce'], 'recipe_details_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['recipe_ingredients'])) {
        update_post_meta($post_id, '_recipe_ingredients', sanitize_textarea_field($_POST['recipe_ingredients']));
    }
    
    if (isset($_POST['recipe_instructions'])) {
        update_post_meta($post_id, '_recipe_instructions', sanitize_textarea_field($_POST['recipe_instructions']));
    }
    
    if (isset($_POST['recipe_cooking_time'])) {
        update_post_meta($post_id, '_recipe_cooking_time', intval($_POST['recipe_cooking_time']));
    }
    
    if (isset($_POST['recipe_servings'])) {
        update_post_meta($post_id, '_recipe_servings', intval($_POST['recipe_servings']));
    }
}
add_action('save_post_recipe', 'save_recipe_details');

function recipe_custom_columns($columns) {
    $new_columns = array();
    
    if (isset($columns['cb'])) {
        $new_columns['cb'] = $columns['cb'];
    }
    
    $new_columns['thumbnail'] = __('Image', 'kurowassan');
    
    if (isset($columns['title'])) {
        $new_columns['title'] = $columns['title'];
    }
    
    if (isset($columns['date'])) {
        $new_columns['date'] = $columns['date'];
    }
    
    return $new_columns;
}
add_filter('manage_recipe_posts_columns', 'recipe_custom_columns');

function recipe_custom_column_content($column, $post_id) {
    switch ($column) {
        case 'thumbnail':
            if (has_post_thumbnail($post_id)) {
                echo get_the_post_thumbnail($post_id, array(50, 50));
            } else {
                $gallery_images = get_post_meta($post_id, '_recipe_gallery_images', true);
                if ($gallery_images) {
                    $gallery_images = explode(',', $gallery_images);
                    $first_image_id = $gallery_images[0];
                    echo wp_get_attachment_image($first_image_id, array(50, 50));
                } else {
                    echo '<div style="width:50px;height:50px;background:#f0f0f0;display:flex;align-items:center;justify-content:center;">No Image</div>';
                }
            }
            break;
            
        case 'cooking_time':
            $cooking_time = get_post_meta($post_id, '_recipe_cooking_time', true);
            if ($cooking_time) {
                echo esc_html($cooking_time) . ' ' . __('mins', 'kurowassan');
            } else {
                echo '—';
            }
            break;
            
        case 'servings':
            $servings = get_post_meta($post_id, '_recipe_servings', true);
            if ($servings) {
                echo esc_html($servings);
            } else {
                echo '—';
            }
            break;
    }
}
add_action('manage_recipe_posts_custom_column', 'recipe_custom_column_content', 10, 2);

function recipe_sortable_columns($columns) {
    $columns['cooking_time'] = 'cooking_time';
    $columns['servings'] = 'servings';
    return $columns;
}
add_filter('manage_edit-recipe_sortable_columns', 'recipe_sortable_columns');

function recipe_custom_orderby($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }
    
    if ($query->get('post_type') !== 'recipe') {
        return;
    }
    
    $orderby = $query->get('orderby');
    
    if ('cooking_time' === $orderby) {
        $query->set('meta_key', '_recipe_cooking_time');
        $query->set('orderby', 'meta_value_num');
    }
    
    if ('servings' === $orderby) {
        $query->set('meta_key', '_recipe_servings');
        $query->set('orderby', 'meta_value_num');
    }
}
add_action('pre_get_posts', 'recipe_custom_orderby');

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

/**
 * Custom Breadcrumb Function
 */
function kurowassan_breadcrumb() {
    // Home page
    $home_text = __('Home', 'kurowassan');
    $home_link = home_url('/');
    $breadcrumb = '<div class="breadcrumb-container"><div class="container">';
    $breadcrumb .= '<div class="page-title-wrapper"><h1 class="text-dark font-secondary">' . get_the_title() . '</h1></div>';
    $breadcrumb .= '<div class="breadcrumb">';
    $breadcrumb .= '<a href="' . esc_url($home_link) . '"><span>' . esc_html($home_text) . '</span></a>';

    // Don't display breadcrumbs on home page
    if (!is_front_page()) {
        $breadcrumb .= '<span class="separator">/</span>';

        if (is_category() || is_single()) {
            if (is_single()) {
                // If it's a post, show its category and then the post title
                $categories = get_the_category();
                if ($categories) {
                    $category = $categories[0];
                    $breadcrumb .= '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
                    $breadcrumb .= '<span class="separator">/</span>';
                }
                $breadcrumb .= '<span class="current">' . get_the_title() . '</span>';
            } else {
                // If it's a category archive
                $breadcrumb .= '<span class="current">' . single_cat_title('', false) . '</span>';
            }
        } elseif (is_page()) {
            // If it's a page
            $breadcrumb .= '<span class="current">' . get_the_title() . '</span>';
        } elseif (is_search()) {
            // Search results page
            $breadcrumb .= '<span class="current">' . sprintf(__('Search Results for: %s', 'kurowassan'), get_search_query()) . '</span>';
        } elseif (is_404()) {
            // 404 page
            $breadcrumb .= '<span class="current">' . __('404 Not Found', 'kurowassan') . '</span>';
        } elseif (is_archive()) {
            if (is_post_type_archive('product') || is_tax('product_cat')) {
                // WooCommerce Shop page
                if (is_shop()) {
                    $breadcrumb .= '<span class="current">' . __('Shop', 'kurowassan') . '</span>';
                } else {
                    $breadcrumb .= '<a href="' . esc_url(get_permalink(wc_get_page_id('shop'))) . '">' . __('Shop', 'kurowassan') . '</a>';
                    $breadcrumb .= '<span class="separator">/</span>';
                    
                    if (is_tax('product_cat')) {
                        $current_term = get_queried_object();
                        if ($current_term->parent) {
                            $parent_terms = get_term_parents_list($current_term->term_id, 'product_cat', array(
                                'separator' => '<span class="separator">/</span>',
                                'link' => true,
                                'format' => 'name'
                            ));
                            $breadcrumb .= $parent_terms;
                        } else {
                            $breadcrumb .= '<span class="current">' . $current_term->name . '</span>';
                        }
                    }
                }
            } else {
                $breadcrumb .= '<span class="current">' . get_the_archive_title() . '</span>';
            }
        }
    }

    $breadcrumb .= '</div></div></div>';
    
    echo $breadcrumb;
}

// Add meta box for recipe images
function add_recipe_images_meta_box() {
    add_meta_box(
        'recipe_images_meta_box',
        'Recipe Images',
        'render_recipe_images_meta_box',
        'recipe',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_recipe_images_meta_box');

// Render recipe images meta box
function render_recipe_images_meta_box($post) {
    wp_nonce_field('recipe_images_nonce', 'recipe_images_nonce');
    
    // Get gallery images
    $gallery_images = get_post_meta($post->ID, '_recipe_gallery_images', true);
    $gallery_images = $gallery_images ? explode(',', $gallery_images) : array();
    ?>
    <div class="recipe-meta-box">
        <style>
            .recipe-images-section {
                margin-bottom: 20px;
                padding: 15px;
                background: #f9f9f9;
                border-radius: 4px;
            }
            .recipe-images-section h4 {
                margin-top: 0;
                margin-bottom: 15px;
                padding-bottom: 10px;
                border-bottom: 1px solid #eee;
            }
            .recipe-gallery-images {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
                gap: 10px;
                margin-bottom: 15px;
            }
            .gallery-image {
                position: relative;
                border: 1px solid #ddd;
                border-radius: 4px;
                overflow: hidden;
                height: 120px;
            }
            .gallery-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            .remove-image {
                position: absolute;
                top: 5px;
                right: 5px;
                background: rgba(255,0,0,0.7);
                color: white;
                border: none;
                border-radius: 50%;
                width: 20px;
                height: 20px;
                line-height: 1;
                font-size: 14px;
                cursor: pointer;
            }
            .upload-gallery-images {
                margin-top: 10px;
            }
        </style>
        <div class="recipe-images-section">
            <h4>Recipe Images</h4>
            <p class="description">Thêm các hình ảnh cho công thức nấu ăn. Hình ảnh đầu tiên sẽ được hiển thị làm hình đại diện.</p>
            <div class="recipe-gallery-wrapper">
                <div class="recipe-gallery-images">
                    <?php
                    if (!empty($gallery_images)) {
                        foreach ($gallery_images as $image_id) {
                            $image_url = wp_get_attachment_image_url($image_id, 'thumbnail');
                            if ($image_url) {
                                echo '<div class="gallery-image">';
                                echo '<img src="' . esc_url($image_url) . '" alt="">';
                                echo '<input type="hidden" name="recipe_gallery_images[]" value="' . esc_attr($image_id) . '">';
                                echo '<button type="button" class="remove-image">×</button>';
                                echo '</div>';
                            }
                        }
                    }
                    ?>
                </div>
                <div class="recipe-gallery-upload">
                    <button type="button" class="button button-primary upload-gallery-images">Add Gallery Images</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    jQuery(document).ready(function($) {
        // Sortable for gallery images
        $('.recipe-gallery-images').sortable({
            items: '.gallery-image',
            cursor: 'move',
            opacity: 0.7
        });

        // Upload gallery images
        $('.upload-gallery-images').on('click', function(e) {
            e.preventDefault();
            
            var button = $(this);
            var galleryWrapper = button.closest('.recipe-gallery-wrapper');
            var galleryContainer = galleryWrapper.find('.recipe-gallery-images');
            
            var frame = wp.media({
                title: 'Select or Upload Recipe Images',
                button: {
                    text: 'Add to Recipe'
                },
                multiple: true
            });
            
            frame.on('select', function() {
                var attachments = frame.state().get('selection').toJSON();
                
                $.each(attachments, function(index, attachment) {
                    var imageUrl = attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
                    var imageHtml = '<div class="gallery-image">' +
                                    '<img src="' + imageUrl + '" alt="">' +
                                    '<input type="hidden" name="recipe_gallery_images[]" value="' + attachment.id + '">' +
                                    '<button type="button" class="remove-image">×</button>' +
                                    '</div>';
                    
                    galleryContainer.append(imageHtml);
                });
            });
            
            frame.open();
        });
        
        // Remove gallery image
        $(document).on('click', '.remove-image', function() {
            $(this).closest('.gallery-image').remove();
        });
    });
    </script>
    <?php
}

// Enqueue media scripts for recipe gallery
function enqueue_recipe_gallery_scripts($hook) {
    global $post;
    if ($hook == 'post-new.php' || $hook == 'post.php') {
        if ($post && $post->post_type === 'recipe') {
            wp_enqueue_media();
            wp_enqueue_script('jquery-ui-sortable');
        }
    }
}
add_action('admin_enqueue_scripts', 'enqueue_recipe_gallery_scripts');

// Save recipe images
function save_recipe_images($post_id) {
    if (!isset($_POST['recipe_images_nonce']) || !wp_verify_nonce($_POST['recipe_images_nonce'], 'recipe_images_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['recipe_gallery_images'])) {
        $gallery_images = array_map('intval', $_POST['recipe_gallery_images']);
        update_post_meta($post_id, '_recipe_gallery_images', implode(',', $gallery_images));
    } else {
        delete_post_meta($post_id, '_recipe_gallery_images');
    }
}
add_action('save_post_recipe', 'save_recipe_images');

/**
 * Function để lấy hình ảnh recipe
 * 
 * @param int $post_id ID của recipe
 * @param string $size Kích thước hình ảnh (thumbnail, medium, large, full)
 * @param int $limit Số lượng hình ảnh muốn lấy, nếu 0 sẽ lấy tất cả
 * @return array Mảng chứa URL của các hình ảnh
 */
function get_recipe_images($post_id = null, $size = 'medium', $limit = 0) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $result = array();
    
    // Lấy gallery images từ post meta
    $gallery_images = get_post_meta($post_id, '_recipe_gallery_images', true);
    $gallery_images = $gallery_images ? explode(',', $gallery_images) : array();
    
    // Nếu có gallery images
    if (!empty($gallery_images)) {
        foreach ($gallery_images as $index => $image_id) {
            // Kiểm tra xem đã đạt giới hạn chưa
            if ($limit > 0 && $index >= $limit) {
                break;
            }
            
            $image_url = wp_get_attachment_image_url($image_id, $size);
            $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
            
            if ($image_url) {
                $result[] = array(
                    'id' => $image_id,
                    'url' => $image_url,
                    'alt' => $image_alt ?: get_the_title($post_id),
                );
            }
        }
    } 
    // Nếu không có gallery images nhưng có featured image
    else if (has_post_thumbnail($post_id)) {
        $thumb_id = get_post_thumbnail_id($post_id);
        $image_url = wp_get_attachment_image_url($thumb_id, $size);
        $image_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
        
        if ($image_url) {
            $result[] = array(
                'id' => $thumb_id,
                'url' => $image_url,
                'alt' => $image_alt ?: get_the_title($post_id),
            );
        }
    }
    
    return $result;
}

/**
 * Function để lấy hình ảnh đại diện của recipe
 * 
 * @param int $post_id ID của recipe
 * @param string $size Kích thước hình ảnh
 * @return string|false URL của hình ảnh hoặc false nếu không có
 */
function get_recipe_thumbnail($post_id = null, $size = 'medium') {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $images = get_recipe_images($post_id, $size, 1);
    
    if (!empty($images)) {
        return $images[0]['url'];
    }
    
    return false;
}
