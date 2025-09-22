<?php

/**
 * This function allows to register custom block patterns (series of blocks)
 * (uncomment add_filter to start using)
 */

//add_action( 'init', 'register_block_patterns' );

function register_block_patterns() {
    register_block_pattern(
        'mpwbpk/enter-custom-pattern-name-here',
        array(
            'title'       => 'Enter custom pattern name here',
            'description' => 'Enter custom pattern description here',
            'categories'  => array( 'featured' ),
            'content'     => 'here you need to add content for that pattern, you can copy it from a page code editor'
        )
    );
}

/**
 * This function allows to add registered custom block patterns by default to a new post
 * (uncomment add_filter to start using)
 */

//add_filter( 'register_post_type_args', 'register_block_patterns_for_post_types', 20, 2 );

function register_block_patterns_for_post_types( $args, $post_type ) {
    if ( $post_type == "example_post_type" ) {
        $args['template'] = array(
            array(
                'core/pattern',
                array(
                    'slug' => 'mpwbpk/enter-custom-pattern-name-here',
                ),
            ),
        );
    }

    return $args;
}