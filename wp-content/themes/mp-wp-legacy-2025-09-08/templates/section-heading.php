<?php
$heading = get_sub_field('heading_text');
$subheading = get_sub_field('subheading_text');
$section_id = get_sub_field('section_id');
?>

<section class="section padding-top-108 hideme" id="<?php echo $section_id; ?>">
    <?php if($heading): ?>
        <h2 class="section__title font--h2-600"><?php echo esc_html($heading); ?></h2>
    <?php endif; ?>

    <?php if($subheading): ?>
        <div class="section__date font--h1"><?php echo esc_html($subheading); ?></div>
    <?php endif; ?>
</section>
