<?php
// Hero Banner
$bg_image       = get_sub_field('background_image');
$headline       = get_sub_field('headline');
$main_heading   = get_sub_field('main_heading');
$intro_text     = get_sub_field('intro_text');
$bg_style = $bg_image ? 'style="background-image: url(' . esc_url($bg_image['url']) . ')"' : '';
?>

<section class="hero" id="hero" <?php echo $bg_style; ?>>
    <div class="hero__overlay"></div>
    <div class="container hero__content">
        <?php if ($headline): ?>
            <h3 class="hero__subtitle font--h3-700"><?php echo esc_html($headline); ?></h3>
        <?php endif; ?>

        <?php if ($main_heading): ?>
            <h1 class="hero__title font--h1"><?php echo esc_html($main_heading); ?></h1>
        <?php endif; ?>

        <?php if ($intro_text): ?>
            <div class="hero__meta font--h4-500"><?php echo $intro_text; ?></div>
        <?php endif; ?>

        <?php if (have_rows('hero_buttons')): ?>
            <div class="hero-buttons">
                <?php while (have_rows('hero_buttons')): the_row();
                    $button_type   = get_sub_field('hero_button_type');
                    $button_label  = get_sub_field('hero_button_label');
                    $button_link   = get_sub_field('hero_button_url');  
                    $popup_selector = get_sub_field('popup_selector');
                    $button_color  = get_sub_field('button_color'); // e.g. primary, secondary, etc.
                ?>

                    <?php if ($button_type && $button_label): ?>
                        <?php if ($button_type === 'redirect' && $button_link): ?>
                            <a href="<?php echo esc_url($button_link); ?>"
                                class="hero-button btn btn-<?php echo esc_attr($button_color ?: 'secondary'); ?> margin-top-48">
                                <?php echo esc_html($button_label); ?>
                            </a>

                        <?php elseif ($button_type === 'popup' && $popup_selector): ?>
                            <div class="popup-button">
                                <button class="hero-button open-popup btn btn-<?php echo esc_attr($button_color ?: 'secondary'); ?>"
                                    data-popup-selector="<?php echo esc_attr($popup_selector); ?>">
                                    <?php echo esc_html($button_label); ?>
                                </button>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>