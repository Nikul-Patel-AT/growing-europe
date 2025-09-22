<?php

add_image_size('full-hd', 1920, 1080);

function enqueue_scripts($entry, $dep = '', $dep_name = '', $handle = 'mpwbpk') {
    $count = count($entry);

    foreach ( $entry as $index => $js ) {

        if ($index != 0) { $dep = $dep_name . 'dep-' . $index - 1; }
        if ($index + 1 != $count) {
            wp_enqueue_script($dep_name . 'dep-' . $index, get_template_directory_uri() . '/dist/' . $js, $dep, null, true);
        } else {
            wp_enqueue_script($handle, get_template_directory_uri() . '/dist/' . $js, $dep, null, true);
        }
    }
}

function enqueue_styles($entry, $dep = '', $dep_name = '', $handle = 'mpwbpk') {
    $count = count($entry);

    foreach ( $entry as $index => $css ) {
        $dep = '';
        if ($index != 0) { $dep = $dep_name . 'dep-' . $index - 1; }
        if ($index+1 != $count) {
            wp_enqueue_style($dep_name . 'dep-' . $index, get_template_directory_uri() . '/dist/' . $css, $dep, null);
        } else {
            wp_enqueue_style($handle, get_template_directory_uri() . '/dist/' . $css, $dep, null);
        }
    }
}

function mpwbpk_scripts()
{
    $filepath = get_template_directory() . '/dist/manifest.json';
    $manifest = json_decode( file_get_contents( $filepath ), true );

    $page = $manifest['entrypoints']['page'];
    unset($manifest['entrypoints']['page']);
    $manifest['entrypoints']['page'] = $page;

    wp_enqueue_script('runtime', get_template_directory_uri() . '/dist/' . $manifest['runtime.js'], '', null, false);

    $final_entry = false;

    foreach ( $manifest['entrypoints'] as $entry => $entrypoint ) {

        $strippedSingular = str_replace('single-', '', $entry);
        $strippedArchive = str_replace('archive-', '', $entry);

        array_shift($entrypoint['assets']['js']);

        if (is_page_template($entry . '.php') || is_404() || is_singular($strippedSingular) || is_post_type_archive($strippedArchive)) {
            $final_entry = $entrypoint;
            break;
        }
    }

    if (!$final_entry) { $final_entry = $manifest['entrypoints']['page']; }

    enqueue_scripts($final_entry['assets']['js'], 'runtime');
    enqueue_styles($final_entry['assets']['css']);

    wp_localize_script( 'mpwbpk', 'postmpwbpk', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'ajax_nonce' => wp_create_nonce('ajax-nonce'),
        'template_directory' => get_template_directory_uri()
    ));
}
add_action('wp_enqueue_scripts', 'mpwbpk_scripts');

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

function mpwbpk_init_functions()
{
    register_nav_menus([
        'menu-default' => __('Main menu')
    ]);

    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', false);
    }
}
add_action('init', 'mpwbpk_init_functions');

/**
 * Remove unnecessary admin pages
 */
function remove_menus(){
//	remove_menu_page( 'edit.php' );
//	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'remove_menus' );

/**
 * Default theme supports
 */
function mpwbpk_setup()
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
add_action('after_setup_theme', 'mpwbpk_setup');

function allow_svg_upload( $mimes = array() ) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    $mimes['json'] = 'application/json';

    return $mimes;
}
add_filter( 'upload_mimes', 'allow_svg_upload' );

function mpwbpk_remove_wp_block_library_css()
{
    wp_dequeue_style('wp-block-library');
    wp_deregister_style('wc-blocks-style');
    wp_dequeue_style('wc-blocks-style');
}
add_action( 'wp_enqueue_scripts', 'mpwbpk_remove_wp_block_library_css' );

add_theme_support('editor-styles');
add_editor_style( '/editor-style.css' );

add_action('acf/init', 'acf_init_blocks');
function acf_init_blocks() {

    if( function_exists('acf_register_block_type') ) {

        $filepath = get_template_directory() . '/acf-blocks.json';
        $blocks = json_decode( file_get_contents( $filepath ), true );

        foreach ($blocks as $block) {
            acf_register_block_type(array(
                'name'              => $block['slug'],
                'title'             => $block['name'],
                'description'       => $block['description'],
                'render_template'   => 'template-parts/blocks/' . $block['slug'] . '/' . $block['slug'] . '.php',
                'enqueue_assets'    => 'enqueue_block_assets',
                'render_callback'   => 'block_render',
                'category'          => 'layout',
                'icon'              => $block['dashicon'],
                'keywords'          => '',
                'supports'          => array('align' => false, 'anchor' => true),
                'example' => array(
                    'attributes' => array(
                        'mode' => 'preview',
                        'data' => array(
                            'preview_image_help' => get_template_directory_uri() . '/template-parts/blocks/' . $block['slug'] . '/' . $block['slug'] . '.png'
                        )
                    )
                )
            ));
        }

        function enqueue_block_assets($data) {
            $name = explode('/', $data['name'])[1];

            $filepath = get_template_directory() . '/dist/manifest.json';
            $manifest = json_decode( file_get_contents( $filepath ), true );

            if(is_admin()) {
                enqueue_scripts($manifest['entrypoints'][$name . '-editor']['assets']['js'], '', $name .'-', $name);
                enqueue_styles($manifest['entrypoints'][$name . '-editor']['assets']['css'], '', $name .'-', $name);
            }
        }

        function block_render( $block, $content = '', $is_preview = false ) {
            /**
             * Back-end preview
             */
            if ( $is_preview && !empty( $block['data']['preview_image_help'] ) ) {
                echo '<img src="'. $block['data']['preview_image_help'] . '" style="display: block; margin: 0 auto; width: 100%;  height auto;">';
                return;
            } else {
                if ( $block ) :
                    $template = $block['render_template'];
                    $template = str_replace( '.php', '', $template );
                    get_template_part('/' . $template, null, $block );
                endif;
            }
        }
    }
}

/**
 * Has block function which searches as well in reusable blocks.
 *
 * Extends functionality of core's has_block (https://developer.wordpress.org/reference/functions/has_block/)
 *
 * @param mixed $block_name Full Block type to look for.
 * @return bool
 * @author Karolína Vyskočilová <karolina@kybernaut.cz>
 * @since 2021-04-12
 */
function enhanced_has_block($block_name)
{

    if (has_block($block_name)) {
        return true;
    }

    if (has_block('core/block')) {
        $content = get_post_field('post_content');
        $blocks = parse_blocks($content);
        return search_reusable_blocks_within_innerblocks($blocks, $block_name);
    }

    return false;
}

/**
 * Search for selected block within inner blocks.
 *
 * The helper function for enhanced_has_block() function.
 *
 * @param array $blocks Blocks to loop through.
 * @param string $block_name Full Block type to look for.
 * @return bool
 * @since 2021-04-12
 * @author Karolína Vyskočilová <karolina@kybernaut.cz>
 */
function search_reusable_blocks_within_innerblocks($blocks, $block_name)
{
    foreach ($blocks as $block) {
        if (isset($block['innerBlocks']) && !empty($block['innerBlocks'])) {
            search_reusable_blocks_within_innerblocks($block['innerBlocks'], $block_name);
        } elseif ($block['blockName'] === 'core/block' && !empty($block['attrs']['ref']) && \has_block($block_name, $block['attrs']['ref'])) {
            return true;
        }
    }
    return false;
}

/**
 * Register the styles (CSS) for the blocks outside
 * acf_register_block_type() as loading styles
 * using acf_register_block_type() will load the
 * styles in the footer and not in <head> causing
 * CLS issues
 */
add_action( 'wp_enqueue_scripts', 'register_acf_block_styles' );

function register_acf_block_styles() : void {
    $filepath = get_template_directory() . '/acf-blocks.json';
    $blocks = json_decode(file_get_contents($filepath), true);

    $filepath = get_template_directory() . '/dist/manifest.json';
    $manifest = json_decode(file_get_contents($filepath), true);

    foreach ($blocks as $block) {
        $name = $block['slug'];

        if( enhanced_has_block( 'acf/' . $name ) ) {
            array_shift($manifest['entrypoints'][$name]['assets']['js']);

            enqueue_scripts($manifest['entrypoints'][$name]['assets']['js'], 'runtime', $name .'-', $name);
            enqueue_styles($manifest['entrypoints'][$name]['assets']['css'], '', $name .'-', $name);
        }
    }
}

/**
 * This function allows to disable gutenberg editor for custom post types
 * (uncomment add_filter to start using)
 */
//add_filter('use_block_editor_for_post_type', 'custom_disable_gutenberg', 10, 2);
function custom_disable_gutenberg($current_status, $post_type)
{
    if ($post_type === 'example_post_type') return false;
    return $current_status;
}

/**
 * Allow only custom gutenberg blocks from this theme
 */
add_filter('allowed_block_types_all', 'custom_allow_blocks', 25, 2);
function custom_allow_blocks($allowed_blocks, $editor_context)
{
    $filepath = get_template_directory() . '/acf-blocks.json';
    $blocks = json_decode(file_get_contents($filepath), true);

    $allowed_blocks = [];
    foreach ($blocks as $block) {
        $allowed_blocks[] = 'acf/' . $block['slug'];
    }
    $allowed_blocks[] = 'core/block';
    $allowed_blocks[] = 'core/pattern';

    return $allowed_blocks;
}

/**
 * Add reusable blocks to menu
 */
add_action('admin_menu', 'add_reusables_to_menu');
function add_reusables_to_menu()
{
    add_menu_page(
        'Reusable Blocks',
        'Reusable Blocks',
        'delete_published_posts',
        'edit.php?post_type=wp_block',
        '',
        'dashicons-layout',
        21
    );
}

include 'functions/block-patterns.php';