<section class="logo-section">
    <?php
    $logo_section_type = get_sub_field( 'logo_section_type' );

    if ( $logo_section_type === 'without_background_logo_section' ) : ?>

        <div class="logo-section__without-background padding-bottom-108">
            <div class="container">
                <?php if ( have_rows( 'without_background_logo_section' ) ) :
                    while ( have_rows( 'without_background_logo_section' ) ) : the_row(); ?>
                        <div class="logo-item">
                            <?php
                            $heading = get_sub_field( 'heading' );
                            $logos   = get_sub_field( 'logos' ); // Gallery array
                            ?>
                            <?php if ( $heading ) : ?>
                                <h2 class="logo-item__heading font--h2-600 padding-bottom-56 blue_secound_color hideme"><?php echo esc_html( $heading ); ?></h2>
                            <?php endif; ?>

                            <?php if ( $logos ) : ?>
                                <div class="logo-item__logos">
                                    <?php foreach ( $logos as $logo ) :
                                        $logo_image = $logo['logo_images'] ?? null;
                                        $logo_size  = $logo['logo_size'] ?? 'medium';
                                        if ( $logo_image && ! empty( $logo_image['link'] ) ) : ?>
                                            <div class="logo-item__image <?php echo esc_attr($logo_size); ?> hideme">
                                                <img src="<?php echo esc_url( $logo_image['link'] ); ?>"
                                                    alt="<?php echo esc_attr( $logo_image['alt'] ?? '' ); ?>">
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
        </div>

    <?php elseif ( $logo_section_type === 'with_background_logo_section' ) : ?>

        <div class="logo-section__with-background padding-top-108 light_background">
            <div class="container">
                <?php if ( have_rows( 'with_background_logo_section' ) ) :
                    while ( have_rows( 'with_background_logo_section' ) ) : the_row(); ?>
                        <div class="logo-item logo-item--highlighted">
                            <?php
                            $heading = get_sub_field( 'heading' );
                            $logos   = get_sub_field( 'logos' ); // Gallery array
                            $logos_per_row = get_sub_field( 'logos_per_row' ); // 3 or 4
                            $custom_font_size = get_sub_field( 'custom_font_size');
                            ?>
                            <?php if ( $heading ) : ?>
                                <h2 class="logo-item__heading font--h2-600 blue_secound_color" style="font-size: <?php echo $custom_font_size; ?>px; line-height: 100%;"><?php echo esc_html( $heading ); ?></h2>
                            <?php endif; ?>

                            <?php if ( ! empty( $logos ) && is_array( $logos ) ) : ?>
                                <div class="logo-item__logos padding-bottom-56 padding-top-56 logos__<?php echo esc_attr( $logos_per_row ?: 4 ); ?>">
                                    <?php foreach ( $logos as $logo ) :
                                        if ( ! empty( $logo['url'] ) ) : ?>
                                            <div class="logo-item__image hideme">
                                                <img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php echo esc_attr( $logo['alt'] ?? '' ); ?>">
                                            </div>
                                        <?php endif;
                                    endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
        </div>

    <?php endif; ?>
</section>
