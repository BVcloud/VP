<?php get_header(); ?>

<div class="container main-container">
    <div class="row">
        <main class="col-lg-8">
            <?php if (have_posts()) : ?>
                <div class="post-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium_large'); ?>
                                    </a>
                                    <?php if (get_post_format()) : ?>
                                        <div class="post-format">
                                            <i class="fas fa-<?php echo get_post_format_icon(); ?>"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-content">
                                <header class="entry-header">
                                    <h2 class="entry-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    <div class="entry-meta">
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

                                <div class="entry-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <div class="entry-footer">
                                    <a href="<?php the_permalink(); ?>" class="btn read-more">
                                        阅读更多
                                        <i class="fas fa-angle-right"></i>
                                    </a>
                                    <?php if (get_theme_mod('show_post_tags', true)) : ?>
                                        <div class="entry-tags">
                                            <?php the_tags('<i class="fas fa-tags"></i> ', ', '); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                
                <?php
                echo '<div class="pagination">';
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => '<i class="fas fa-angle-left"></i>',
                    'next_text' => '<i class="fas fa-angle-right"></i>',
                    'screen_reader_text' => '分页导航'
                ));
                echo '</div>';
                ?>
                
            <?php else : ?>
                <div class="no-posts">
                    <div class="no-posts-icon">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <h3><?php esc_html_e('暂时没有文章', 'vp-theme'); ?></h3>
                    <p><?php esc_html_e('试试搜索或者查看其他分类', 'vp-theme'); ?></p>
                </div>
            <?php endif; ?>
        </main>

        <aside class="col-lg-4">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</div>

<?php get_footer(); ?> 