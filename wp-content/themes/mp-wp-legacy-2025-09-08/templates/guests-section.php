<?php
$heading = get_sub_field( 'guests_section_title' );
$sub_title = get_sub_field('guest_sub_text');
?>

<section class="guests light_background padding-top-108 padding-bottom-108" id="guests">
    <div class="container">
        <h2 class="guests__title font--h2-600"><?php echo esc_html( $heading ); ?></h2>
        <?php if ( $sub_title ) : ?>
                <div class="guests-subtitle font--p-18 padding-bottom-56">
                    <p><?php echo esc_html($sub_title); ?></p>
                </div>
        <?php endif; ?>

        <div class="guests__grid padding-bottom-56">
            <?php 
            $visible_number = get_sub_field('guests_visible_number');
            $counter = 0;

            if ( have_rows('guests') ) : 
                while ( have_rows('guests') ) : the_row();
                    $counter++;

                    $guest_image = get_sub_field('guest_image');
                    $guest_name  = get_sub_field('guest_name');
                    $guest_role  = get_sub_field('guest_role__description');
                    $guest_position = get_sub_field('guest_position');
                    $guest_link_text  = get_sub_field('guest_link_text');
                    $option      = get_sub_field('guest_option');
                    $link        = get_sub_field('guest_link');
                    $popup_content = get_sub_field('guest_popup_content');
                    $guest_id = uniqid('guest_');

                    // Normalize image
                    $image_url = '';
                    $image_alt = '';
                    if ( ! empty( $guest_image ) ) {
                        if ( is_array( $guest_image ) && ! empty( $guest_image['url'] ) ) {
                            $image_url = $guest_image['url'];
                            $image_alt = ! empty( $guest_image['alt'] ) ? $guest_image['alt'] : $guest_name;
                        } elseif ( is_numeric( $guest_image ) ) {
                            $image_url = wp_get_attachment_image_url( $guest_image, 'full' );
                            $image_alt = get_post_meta( $guest_image, '_wp_attachment_image_alt', true ) ?: $guest_name;
                        } elseif ( is_string( $guest_image ) ) {
                            $image_url = $guest_image;
                            $image_alt = $guest_name;
                        }
                    }
            ?>
                <div class="guest-card <?php if( $visible_number && $counter > $visible_number ) echo 'hidden-guest'; ?> hideme">
                    <?php if ( $image_url ) : ?>
                        <div class="guest-card__image guest-50-flex">
                            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
                        </div>
                    <?php endif; ?>

                    <div class="guest-card__content guest-50-flex">
                        <div class="guest-card__flex-box">
                            <?php if ( $guest_name ) : ?>
                                <h3 class="guest-card__name font--h4-500"><?php echo esc_html( $guest_name ); ?></h3>
                            <?php endif; ?>
                            <?php if ( $guest_position ) : ?>
                                <div class="guest-card__role font--p-16"><?php echo wp_kses_post( $guest_position ); ?></div>
                            <?php endif; ?>    
                            <?php if ( $guest_role ) : ?>
                                <div class="guest-card__role font--p-16"><?php echo wp_kses_post( $guest_role ); ?></div>
                            <?php endif; ?>
                        </div>
                        <?php if( $option == 'link' && $link ): ?>
                            <a href="<?php echo esc_url($link); ?>" target="_blank" class="guest-link guest-card__link font--p-16"><?php echo esc_html($guest_link_text); ?></a>
                        <?php elseif( $option == 'popup' && $popup_content ): ?>

                            <button class="guest-popup-btn guest-card__link font--p-16" data-popup-key="<?php echo esc_attr($guest_id); ?>"><?php echo esc_html($guest_link_text); ?></button>

                            <!-- hidden content -->
                            <div class="guest-popup-data" id="guest_content_<?php echo esc_attr($guest_id); ?>" style="display:none;">
                            <?php echo apply_filters('the_content', $popup_content); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php else: ?>
                <p>No guests added yet.</p>
            <?php endif; ?>
        </div>


        <?php if( $visible_number && $counter > $visible_number ): ?>
        <div class="guests__footer">
            <a id="show-more" class="btn_design_1 show-more" data-perpage="<?php echo esc_attr($visible_number); ?>">
                <span class="btn btn--primary">Show More</span>
            </a>
        </div>
        <?php endif; ?>


        <div id="guest-modal" class="guest-popup" aria-hidden="true">
        <div class="guest-popup-content" role="dialog" aria-modal="true">
            <span class="guest-popup-close btn btn--primary btn--icon close_icon_color">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M8.25729 7.75736L16.7426 16.2426M16.7426 7.75736L8.25729 16.2426" stroke="#492447" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="bevel"/>
                    </svg>
                </span>
            <div id="guest-modal-body"></div>
        </div>
        </div>
    </div>

</section>
