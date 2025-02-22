<?php get_header(); ?>

<div class="container">
    <div class="error-404 not-found">
        <div class="error-icon">
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <header class="page-header">
            <h1 class="page-title"><?php esc_html_e('页面未找到', 'vp-theme'); ?></h1>
        </header>

        <div class="page-content">
            <p><?php esc_html_e('很抱歉，您访问的页面不存在或已被删除。', 'vp-theme'); ?></p>
            
            <div class="error-actions">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                    <i class="fas fa-home"></i> 返回首页
                </a>
                
                <?php get_search_form(); ?>
            </div>
            
            <div class="suggested-posts">
                <h3><?php esc_html_e('您可能感兴趣的文章：', 'vp-theme'); ?></h3>
                <?php
                $recent_posts = get_posts(array(
                    'posts_per_page' => 4,
                    'orderby' => 'rand'
                ));
                
                if ($recent_posts) : ?>
                    <div class="post-grid">
                        <?php foreach ($recent_posts as $post) : 
                            setup_postdata($post); ?>
                            <article class="post-card">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="post-content">
                                    <h3 class="post-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                </div>
                            </article>
                        <?php endforeach; 
                        wp_reset_postdata(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?> 