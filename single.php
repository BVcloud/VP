<?php get_header(); ?>

<div class="container main-container">
    <div class="row">
        <main class="col-lg-8">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                    <header class="entry-header">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        
                        <div class="entry-meta">
                            <span class="meta-item">
                                <i class="fas fa-user"></i>
                                <?php the_author_posts_link(); ?>
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-calendar"></i>
                                <?php echo get_the_date(); ?>
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-folder"></i>
                                <?php the_category(', '); ?>
                            </span>
                            <?php if (get_theme_mod('show_post_views', true)) : ?>
                                <span class="meta-item">
                                    <i class="fas fa-eye"></i>
                                    <?php echo get_post_views(get_the_ID()); ?>
                                </span>
                            <?php endif; ?>
                            <?php if (get_theme_mod('show_post_likes', true)) : ?>
                                <span class="meta-item">
                                    <i class="fas fa-heart"></i>
                                    <?php echo get_post_likes(get_the_ID()); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </header>

                    <div class="entry-content">
                        <?php the_content(); ?>
                        
                        <?php
                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('分页:', 'vp-theme'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>
                    
                    <footer class="entry-footer">
                        <?php if (get_theme_mod('show_post_tags', true)) : ?>
                            <div class="entry-tags">
                                <?php the_tags('<i class="fas fa-tags"></i> ', ', '); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (get_theme_mod('show_post_share', true)) : ?>
                            <div class="post-share">
                                <span class="share-title">分享到：</span>
                                <a href="http://service.weibo.com/share/share.php?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" class="share-item weibo">
                                    <i class="fab fa-weibo"></i>
                                </a>
                                <a href="https://connect.qq.com/widget/shareqq/index.html?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" class="share-item qq">
                                    <i class="fab fa-qq"></i>
                                </a>
                                <a href="javascript:void(0)" class="share-item wechat" data-url="<?php the_permalink(); ?>">
                                    <i class="fab fa-weixin"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (get_theme_mod('show_post_author', true)) : ?>
                            <div class="post-author">
                                <div class="author-avatar">
                                    <?php echo get_avatar(get_the_author_meta('ID'), 100); ?>
                                </div>
                                <div class="author-info">
                                    <h4 class="author-name"><?php the_author(); ?></h4>
                                    <p class="author-description"><?php echo get_the_author_meta('description'); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <nav class="post-navigation">
                            <div class="nav-links">
                                <div class="nav-previous">
                                    <?php previous_post_link('%link', '<i class="fas fa-angle-left"></i> %title'); ?>
                                </div>
                                <div class="nav-next">
                                    <?php next_post_link('%link', '%title <i class="fas fa-angle-right"></i>'); ?>
                                </div>
                            </div>
                        </nav>
                    </footer>
                </article>

                <?php
                // 如果评论开启，加载评论模板
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>

            <?php endwhile; ?>
        </main>

        <aside class="col-lg-4">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</div>

<?php get_footer(); ?> 