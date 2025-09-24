<?php
$heading = get_sub_field( 'section_heading' );
?>

<section class="links-section padding-top-108 padding-bottom-108 hideme">
    <div class="container">
        <?php if ( $heading ) : ?>
            <h2 class="links-section__title font--h2-600 padding-bottom-56"><?php echo esc_html( $heading ); ?></h2>
        <?php endif; ?>

        <?php if ( have_rows( 'links' ) ) : ?>
            <div class="links-section__links-list">
                <?php while ( have_rows( 'links' ) ) : the_row();
                    $label = get_sub_field( 'link_label' );
                    $link_target = get_sub_field( 'link_target' );
                    $url   = get_sub_field( 'link_url' );

                    if ( $label && $url ) : ?>
                        <div class="links-section__item hideme">
                            <a class="font--h4-500 primary-color padding-zero" target="<?php echo esc_attr($link_target); ?>" href="<?php echo esc_url( $url ); ?>">
                                <?php echo esc_html( $label ); ?>
                                <span class="btn btn--primary btn--icon">
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 1H11M11 1V11M11 1L1 11" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    <?php endif;
                endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
