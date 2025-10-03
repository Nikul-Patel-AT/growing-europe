<?php
// Hero Banner
$bg_image       = get_sub_field('background_image');
$headline       = get_sub_field('headline');
$main_heading   = get_sub_field('main_heading');
$intro_text     = get_sub_field('intro_text');
$hero_button    = get_sub_field('hero_button'); // group
$button_type    = $hero_button['hero_button_type'] ?? '';
$button_label   = $hero_button['hero_button_label'] ?? '';
$button_link    = $hero_button['hero_button_link'] ?? '';
$popup_selector = $hero_button['popup_selector'] ?? '';
$hero_button_two    = get_sub_field('hero_button_two'); // group
$button_type_two    = $hero_button_two['hero_button_type_two'] ?? '';
$button_label_two   = $hero_button_two['hero_button_label_two'] ?? '';
$button_link_two    = $hero_button_two['hero_button_link_two'] ?? '';
$popup_selector_two = $hero_button_two['popup_selector_two'] ?? '';

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

        <div class="hero-buttons">
            <?php if ($button_type && $button_label): ?>
                <?php if ($button_type === 'redirect' && $button_link): ?>
                    <a href="<?php echo esc_url($button_link); ?>" class="hero-button btn btn--secondary margin-top-48">
                        <?php echo esc_html($button_label); ?>
                    </a>
                <?php elseif ($button_type === 'popup' && $popup_selector): ?>
                    <div class="poup-button">
                        <button class="hero-button open-popup btn btn--secondary" data-popup-selector="<?php echo esc_attr($popup_selector); ?>">
                            <?php echo esc_html($button_label); ?>
                        </button>
                    </div>
                <?php endif; ?>

            <?php endif; ?>

            <?php if ($button_type_two && $button_label_two): ?>
                <?php if ($button_type_two === 'redirect' && $button_link_two): ?>
                    <a href="<?php echo esc_url($button_link_two); ?>" class="hero-button btn btn--secondary margin-top-48">
                        <?php echo esc_html($button_label_two); ?>
                    </a>
                <?php elseif ($button_type_two === 'popup' && $popup_selector_two): ?>
                    <div class="poup-button-two">
                        <button class="hero-button open-popup btn btn--secondary" data-popup-selector="<?php echo esc_attr($popup_selector_two); ?>">
                            <?php echo esc_html($button_label_two); ?>
                        </button>
                    </div>
                <?php endif; ?>

            <?php endif; ?>
        </div>
    </div>
</section>