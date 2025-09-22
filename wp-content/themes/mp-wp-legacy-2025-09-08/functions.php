<?php

define('ASSETS_VER', time());

add_image_size('full-hd', 1920, 1080);

function mpwp_scripts()
{
    wp_enqueue_style('mpwp', get_template_directory_uri() . '/assets/css/prod.css', [], ASSETS_VER);

    wp_enqueue_script('mpwp', get_template_directory_uri() . '/assets/js/prod.js', ['jquery'], ASSETS_VER, true);

    wp_localize_script('mpwp', 'postmpwp', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'template_directory' => get_template_directory_uri(),
            'ajax_nonce' => wp_create_nonce('ajax-nonce'),
            'page_id' => get_queried_object_id(),
    ));
}

add_action('wp_enqueue_scripts', 'mpwp_scripts');

/**
 * Remove admin bar from frontend
 */
add_filter('show_admin_bar', '__return_false');

/**
 * Add google API key for ACF
 */
//add_filter('acf/settings/google_api_key', function () {
//	return 'AIzaSyDapBpTcw73vklFvaLqmeaiA7H-USyQSDk';
//});

function mpwp_nav_menus()
{
    register_nav_menus([
            'menu-default' => __('Main menu'),
            'side-menu' => __('Side menu'),
    ]);
}

add_action('init', 'mpwp_nav_menus');

/**
 * Remove unnecessary admin pages
 */
function remove_menus()
{
	remove_menu_page( 'edit.php' );
	remove_menu_page( 'comments.php' );
}

add_action('admin_menu', 'remove_menus');

/**
 * Default theme supports
 */
function mpwp_setup()
{
    add_theme_support('title-tag');

    add_theme_support('post-thumbnails');

    add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ));

    add_theme_support('post-formats', array(
            'aside', 'image', 'video', 'quote', 'link',
    ));
}

add_action('after_setup_theme', 'mpwp_setup');

//Adding ACF options pages
if (function_exists('acf_add_options_page')) {
    $adv_settings = acf_add_options_page(array(
                    'page_title' => 'Options',
                    'menu_title' => '',
                    'menu_slug' => '',
                    'capability' => 'customize',
                    'position' => false,
                    'parent_slug' => '',
                    'icon_url' => false,
                    'redirect' => false,
                    'post_id' => 'options',
                    'autoload' => false
            )
    );
}

add_action('wp_print_styles', 'my_deregister_styles', 100);
function my_deregister_styles()
{
    wp_deregister_style('dashicons');
}

//Remove Gutenberg Block Library CSS from loading on the frontend
function remove_wp_block_library_css()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('wc-blocks-style'); // Remove WooCommerce block CSS
}

add_action('wp_enqueue_scripts', 'remove_wp_block_library_css', 100);

//Disable emojis in WordPress
add_action('init', 'disable_emojis');

function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}

function disable_emojis_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}

add_filter('use_block_editor_for_post_type', '__return_false');


add_filter('acf/load_field/name=header_menu', 'my_acf_load_menus');

function my_acf_load_menus($field) {
    $menus = wp_get_nav_menus(); // Get all registered menus
    $field['choices'] = [];

    if ($menus) {
        foreach ($menus as $menu) {
            $field['choices'][$menu->term_id] = $menu->name; // key = menu ID, value = menu name
        }
    }

    return $field;
}
