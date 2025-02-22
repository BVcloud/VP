<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container">
        <div class="header-content">
            <div class="site-branding">
                <?php if (has_custom_logo()): ?>
                    <?php the_custom_logo(); ?>
                <?php else: ?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php bloginfo('name'); ?>
                        </a>
                    </h1>
                <?php endif; ?>
            </div>

            <nav class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class' => 'nav-menu',
                    'container' => false
                ));
                ?>
            </nav>

            <div class="header-actions">
                <?php if (is_user_logged_in()): ?>
                    <a href="<?php echo esc_url(home_url('/user-center')); ?>" class="user-link">
                        <?php echo get_avatar(get_current_user_id(), 32); ?>
                    </a>
                <?php else: ?>
                    <a href="<?php echo wp_login_url(); ?>" class="login-link">登录</a>
                    <a href="<?php echo wp_registration_url(); ?>" class="register-link">注册</a>
                <?php endif; ?>
                <button id="search-toggle" class="search-toggle">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>

        <div class="header-search">
            <?php get_search_form(); ?>
        </div>
    </div>
</header>

<div id="page" class="site"> 