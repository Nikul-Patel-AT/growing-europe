<?php get_header(); ?>
	<?php if( have_rows('flexible_content') ): ?>
		<?php while( have_rows('flexible_content') ): the_row(); ?>

			<?php 
			$layout = get_row_layout();

			if( $layout == 'hero_banner' ):
				// Hero Banner
$bg_image       = get_sub_field('background_image');
$headline       = get_sub_field('headline');
$main_heading   = get_sub_field('main_heading');
$intro_text     = get_sub_field('intro_text');
$bg_style = $bg_image ? 'style="height: 300px;background-image: url(' . esc_url($bg_image['url']) . ')"' : '';
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
<?php
			else:
				// Other layouts dynamically
				$section_name = str_replace('_', '-', $layout);
				get_template_part("templates/{$section_name}");
			endif;
		endwhile; 
	else: ?>
		<p>No content found. Make sure you added layouts in ACF.</p>
	<?php endif; ?>
<style type="text/css">
	h1 {font-size: clamp(1.68rem, 1.307rem + 1.866vw, 2.986rem);padding-bottom: 1.125rem;}
	h2 {font-size: clamp(1.575rem, 1.314rem + 1.304vw, 2.488rem);padding-bottom: 1.125rem;}
	h3 {font-size: clamp(1.476rem, 1.305rem + 0.854vw, 2.074rem);padding-bottom: 1.125rem;}
	ul {list-style: disc;margin-left: 3rem;}
	table {
		font-family: Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 100%;
		margin-bottom: 1rem;
	}

	td, th {
		border: 1px solid #ddd;
		padding: 8px;
	}

	tr:nth-child(even){background-color: #f2f2f2;}

	tr:hover {background-color: #ddd;}

	th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color: #A3197C;
		color: white;
	}
	p {padding-top: 0.5rem; padding-bottom: 0.5rem;}

	.policy {
		border-radius: 88px 88px 0px 0px;
		margin: 0 0px;
		padding-top: 4rem;
		padding-bottom: 4rem;
		margin-top: 2rem;
	}
</style>
<section class="policy light_background" id="policy" style="text-align: left;">
    <div class="container">
        <?php the_content(); ?>
    </div>
</section>	

<?php get_footer();