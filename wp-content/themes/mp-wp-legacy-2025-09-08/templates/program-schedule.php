<section class="program-schedule padding-top-56">
    <div class="container">
        <div class="program-schedule__flex">
            <?php if (have_rows('program_schedule_box')): ?>
                <?php while (have_rows('program_schedule_box')): the_row(); ?>
                    <?php $design = get_sub_field('select_design'); ?>

                    <?php if ($design == 'design_one'): ?>
                        <div class="program-item hideme">
                            <div class="program-item__number">
                                <?php the_sub_field('number'); ?>
                            </div>
                            <h3 class="program-item__heading font--h4-500 darkblue_color">
                                <?php echo wp_kses_post(get_sub_field('heading')); ?>
                            </h3>
                            <?php if (get_sub_field('time')) : ?>
                                <div class="program-item__time font--h4-500 darkblue_color">
                                    <?php the_sub_field('time'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="program-item__content font--p-16">
                                <?php the_sub_field('content'); ?>
                            </div>
                        </div>

                        <?php elseif ($design == 'design_two'):
                        $program_link = get_sub_field('program_link'); // ACF URL field
                        $program_target = get_sub_field('program_target'); // ACF target field (_blank, _self, etc.)

                        if ($program_link) { ?>
                            <a href="<?php echo esc_url($program_link); ?>" class="program-item-link"  target="<?php echo esc_attr($program_target); ?>">
                        <?php } ?>
                            <div class="program-item program-item--highlight hideme">
                                <div class="program-item__number font--h4-500">
                                    <?php the_sub_field('part_number'); ?>
                                </div>
                                <div class="program-item__content-hightlighted">
                                    <h3 class="program-item__title font--h3-700">
                                        <?php the_sub_field('title'); ?>
                                    </h3>
                                    <div class="program-item__desc font--p-16">
                                        <?php the_sub_field('description'); ?>
                                    </div>
                                </div>
                            </div>
                        <?php if ($program_link){ ?>
                        </a>
                        <?php } ?>


                    <?php endif; ?>

                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>