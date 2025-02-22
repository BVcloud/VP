<?php
if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<div class="sidebar">
    <?php if (is_user_logged_in()) : ?>
        <div class="widget user-widget">
            <?php
            $current_user = wp_get_current_user();
            $avatar = get_avatar($current_user->ID, 80);
            ?>
            <div class="user-info">
                <div class="user-avatar">
                    <?php echo $avatar; ?>
                </div>
                <div class="user-meta">
                    <h3 class="user-name"><?php echo $current_user->display_name; ?></h3>
                    <?php if (function_exists('get_user_member_level')) : ?>
                        <div class="user-level">
                            <?php echo get_user_member_level($current_user->ID); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="user-links">
                <a href="<?php echo esc_url(home_url('/user-center')); ?>" class="user-link">
                    <i class="fas fa-user-circle"></i> 个人中心
                </a>
                <a href="<?php echo wp_logout_url(home_url()); ?>" class="user-link">
                    <i class="fas fa-sign-out-alt"></i> 退出登录
                </a>
            </div>
        </div>
    <?php endif; ?>

    <?php if (get_theme_mod('show_popular_posts', true)) : ?>
        <div class="widget popular-posts">
            <h3 class="widget-title">热门文章</h3>
            <?php
            $popular_posts = new WP_Query(array(
                'posts_per_page' => 5,
                'meta_key' => '_post_views',
                'orderby' => 'meta_value_num',
                'order' => 'DESC'
            ));
            
            if ($popular_posts->have_posts()) : ?>
                <ul class="post-list">
                    <?php while ($popular_posts->have_posts()) : $popular_posts->the_post(); ?>
                        <li class="post-item">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('thumbnail'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="post-info">
                                <h4 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h4>
                                <div class="post-meta">
                                    <span class="views">
                                        <i class="fas fa-eye"></i> <?php echo get_post_views(get_the_ID()); ?>
                                    </span>
                                </div>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if (get_theme_mod('show_categories', true)) : ?>
        <div class="widget categories">
            <h3 class="widget-title">分类目录</h3>
            <ul>
                <?php
                wp_list_categories(array(
                    'title_li' => '',
                    'show_count' => true,
                    'orderby' => 'count',
                    'order' => 'DESC',
                    'number' => 10
                ));
                ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (get_theme_mod('show_tags', true)) : ?>
        <div class="widget tags">
            <h3 class="widget-title">标签云</h3>
            <?php
            wp_tag_cloud(array(
                'smallest' => 12,
                'largest' => 22,
                'unit' => 'px',
                'number' => 20,
                'format' => 'flat',
                'orderby' => 'count',
                'order' => 'DESC'
            ));
            ?>
        </div>
    <?php endif; ?>

    <?php dynamic_sidebar('sidebar-1'); ?>
</div> 