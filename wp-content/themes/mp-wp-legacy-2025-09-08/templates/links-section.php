<?php
$heading = get_sub_field('section_heading');
$padding_class = get_sub_field('section_padding') ?: 'padding-top-108 padding-bottom-108';
$display_condition = get_sub_field('section_visibility') ?: 'show'; // default to 'show'
?>
<?php if ($display_condition == 'show') { ?>
    <section class="links-section <?php echo esc_attr($padding_class . ' ' . $display_condition); ?>">
        <div class="container">
            <?php if ($heading) : ?>
                <h2 class="links-section__title font--h2-600 padding-bottom-56"><?php echo esc_html($heading); ?></h2>
            <?php endif; ?>

            <?php if (have_rows('links')) : ?>
                <div class="links-section__links-list">
                    <?php while (have_rows('links')) : the_row();
                        $label = get_sub_field('link_label');
                        $link_target = get_sub_field('link_target');
                        $url = get_sub_field('link_url');
                        $links_options = get_sub_field('link_type');
                        $links_popup_content = get_sub_field('link_popup_content');
                        $links_id = uniqid('link_');
                        $popup_banner_image = get_sub_field('popup_banner_image');

                        if ($label) : ?>
                            <div class="links-section__item hideme">
                                <?php if ($links_options === 'link' && $url) : ?>
                                    <a class="font--h4-500 primary-color padding-zero"
                                        target="<?php echo esc_attr($link_target); ?>"
                                        href="<?php echo esc_url($url); ?>">
                                        <?php echo esc_html($label); ?>
                                        <span class="btn btn--primary btn--icon">
                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 1H11M11 1V11M11 1L1 11" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </a>

                                <?php elseif ($links_options === 'popup' && $links_popup_content) : ?>
                                    <a href="javascript:void(0);"
                                        class="link-popup-btn font--h4-500 primary-color padding-zero"
                                        data-popup-key="<?php echo esc_attr($links_id); ?>">
                                        <?php echo esc_html($label); ?>
                                        <span class="btn btn--primary btn--icon">
                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 1H11M11 1V11M11 1L1 11" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </a>

                                    <!-- Hidden popup content -->
                                    <div class="link-popup-data" id="link_content_<?php echo esc_attr($links_id); ?>" style="display:none;">
                                        <?php if ($popup_banner_image): ?>
                                            <img src="<?php echo esc_url($popup_banner_image['url']); ?>" alt="<?php echo esc_attr($popup_banner_image['alt']); ?>" class="popup-image">
                                        <?php endif; ?>

                                        <?php if ($links_popup_content): ?>
                                            <div class="popup-content"><?php echo apply_filters('the_content', $links_popup_content); ?></div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                    <?php endif;
                    endwhile; ?>
                </div>
            <?php endif; ?>

            <div id="link-block-popup" class="guest-popup link-popup" aria-hidden="true">
                <div class="guest-popup-content" role="dialog" aria-modal="true">
                    <span class="guest-popup-close btn btn--primary btn--icon close_icon_color">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M8.25729 7.75736L16.7426 16.2426M16.7426 7.75736L8.25729 16.2426" stroke="#492447" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="bevel" />
                        </svg>
                    </span>
                    <div id="link-modal-body" class="link-block-content"></div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>