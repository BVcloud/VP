<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            printf(
                _nx(
                    '%1$s条评论',
                    '%1$s条评论',
                    $comment_count,
                    'comments title',
                    'vp-theme'
                ),
                number_format_i18n($comment_count)
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style' => 'ol',
                'short_ping' => true,
                'avatar_size' => 60,
                'callback' => 'vp_comment_callback'
            ));
            ?>
        </ol>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <nav class="comment-navigation">
                <div class="nav-previous"><?php previous_comments_link('上一页'); ?></div>
                <div class="nav-next"><?php next_comments_link('下一页'); ?></div>
            </nav>
        <?php endif; ?>

    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments"><?php esc_html_e('评论已关闭。', 'vp-theme'); ?></p>
    <?php endif; ?>

    <?php
    comment_form(array(
        'title_reply' => '发表评论',
        'title_reply_to' => '回复 %s',
        'cancel_reply_link' => '取消回复',
        'label_submit' => '提交评论',
        'comment_field' => '<div class="comment-form-comment">
            <label for="comment">' . _x('评论', 'noun') . '</label>
            <textarea id="comment" name="comment" cols="45" rows="8" required></textarea>
        </div>',
        'comment_notes_before' => '<p class="comment-notes">
            <span id="email-notes">您的邮箱地址不会被公开。</span>
            必填项已用<span class="required">*</span>标注
        </p>',
        'fields' => array(
            'author' => '<div class="comment-form-author">
                <label for="author">' . __('姓名', 'vp-theme') . '<span class="required">*</span></label>
                <input id="author" name="author" type="text" required>
            </div>',
            'email' => '<div class="comment-form-email">
                <label for="email">' . __('邮箱', 'vp-theme') . '<span class="required">*</span></label>
                <input id="email" name="email" type="email" required>
            </div>',
            'url' => '<div class="comment-form-url">
                <label for="url">' . __('网站', 'vp-theme') . '</label>
                <input id="url" name="url" type="url">
            </div>'
        )
    ));
    ?>
</div> 