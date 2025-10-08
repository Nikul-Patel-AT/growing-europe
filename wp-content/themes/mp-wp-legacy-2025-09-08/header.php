<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php
// Get ACF fields (Theme Header - Options Page)
$logo      = get_field('logo', 'option'); 
$header_menu = get_field('header_menu', 'option');
$btn_label = get_field('button_label', 'option');
$btn_url   = get_field('button_url', 'option');
?>

    <header class="header">
        <div class="container">
            <div class="header__inner">

            <!-- Logo -->
            <div class="header__logo">
                <?php if ($logo): ?>
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                </a>
                <?php else: ?>
                <h1><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
                <?php endif; ?>
            </div>

            <!-- Navigation -->
            <nav class="header__nav">
                <?php
                if ($header_menu):
                    wp_nav_menu(array(
                    'menu'           => $header_menu,
                    'container'      => false,
                    'menu_class'     => 'nav__list',
                    'fallback_cb'    => false,
                    ));
                endif;
                ?>
            </nav>

            <div class="header__main-flex-btn">

            <!-- CTA Button -->
            <?php if ($btn_label && $btn_url): ?>
                <div class="header__cta">
                <a href="<?php echo esc_url($btn_url); ?>" class="btn_design_1" target="_blank">
                    <span class="btn btn--primary"><?php echo esc_html($btn_label); ?></span>
                </a>
                </div>
            <?php endif; ?>

            <!-- Hamburger Button -->
            <button class="header__toggle" aria-label="Menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
            </div>

            </div>
        </div>
    </header>

    <main>