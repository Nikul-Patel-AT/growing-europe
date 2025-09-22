<?php
// Event Section
?>

<section class="event-section padding-tb-100">
    <div class="container">
        <div class="event-row">
            <?php if ( have_rows('event_person') ) : ?>
                <?php while ( have_rows('event_person') ) : the_row(); 
                    $person_role        = get_sub_field('person_role');
                    $person_image       = get_sub_field('person_image');
                    $person_name        = get_sub_field('person_name');
                    $person_description = get_sub_field('person_description');

                    $image_url = '';
                    $image_alt = '';
                    if ( ! empty( $person_image ) ) {
                        if ( is_array( $person_image ) && ! empty( $person_image['url'] ) ) {
                            $image_url = $person_image['url'];
                            $image_alt = ! empty( $person_image['alt'] ) ? $person_image['alt'] : $person_name;
                        } elseif ( is_numeric( $person_image ) ) {
                            $image_url = wp_get_attachment_image_url( $person_image, 'full' );
                            $image_alt = get_post_meta( $person_image, '_wp_attachment_image_alt', true ) ?: $person_name;
                        } elseif ( is_string( $person_image ) ) {
                            $image_url = $person_image;
                            $image_alt = $person_name;
                        }
                    }
                ?>
                    <div class="event-card hideme">
                            <?php if ( $person_role ) : ?>
                                <h2 class="event-role font--h2-600 padding-bottom-56">
                                    <?php echo esc_html( $person_role ); ?>
                                </h2>
                            <?php endif; ?>

                            <?php if ( $image_url ) : ?>
                                <div class="event-image">
                                    <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
                                </div>
                            <?php endif; ?>

                            <div class="event-info">
                                <?php if ( $person_name ) : ?>
                                    <h3 class="event-name font--h3-700 primary-color">
                                        <?php echo esc_html( $person_name ); ?>
                                    </h3>
                                <?php endif; ?>
                                <?php if ( $person_description ) : ?>
                                    <div class="event-subtitle font--p-18">
                                        <?php echo wp_kses_post( $person_description ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                <?php endwhile; ?>
            <?php else: ?>
                <p>No event persons added yet.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
