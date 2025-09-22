<?php
/**
 * Template Name: Flexible Content
 */

get_header();
?>

<main data-slug="<?php echo esc_attr(get_post_field('post_name')); ?>">
    <?php if( have_rows('flexible_content') ): ?>
    <?php while( have_rows('flexible_content') ): the_row(); ?>

    <?php 
    $layout = get_row_layout();

    if( $layout == 'hero_banner' ):
    get_template_part('templates/hero-banner');

    elseif( $layout == 'event_section' ):
    get_template_part('templates/event-section');

    elseif( $layout == 'guests_section' ):
    get_template_part('templates/guests-section');

    elseif( $layout == 'section_heading' ):
    get_template_part('templates/section-heading');

    elseif( $layout == 'program_schedule' ):
    get_template_part('templates/program-schedule');

    elseif( $layout == 'links_section' ):
    get_template_part('templates/links-section');

    elseif( $layout == 'logo_section' ):
    get_template_part('templates/logo-section');


    else: 
        // Other layouts dynamically
        $section_name = str_replace('_', '-', $layout);
        get_template_part("templates/{$section_name}");
        endif;
  

     endwhile; 
     else: ?>
    <p>No content found. Make sure you added layouts in ACF.</p>
    <?php endif; ?>

</main>

<?php get_footer(); ?>