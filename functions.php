<?php
/**
 * 主题核心功能
 */

// 定义常量
define('VP_VERSION', '1.0.0');
define('VP_DIR', get_template_directory());
define('VP_URI', get_template_directory_uri());

// 加载核心文件
require_once VP_DIR . '/inc/core/init.php';
require_once VP_DIR . '/inc/core/setup.php';
require_once VP_DIR . '/inc/core/widgets.php';

// 加载功能模块
require_once VP_DIR . '/inc/modules/dark-mode/dark-mode.php';
require_once VP_DIR . '/inc/modules/member/member.php';
require_once VP_DIR . '/inc/modules/pay/pay.php';
require_once VP_DIR . '/inc/modules/seo/seo.php';
require_once VP_DIR . '/inc/modules/social/social-login.php';
require_once VP_DIR . '/inc/modules/user/user-center.php';
require_once VP_DIR . '/inc/modules/posts/post-enhance.php';
require_once VP_DIR . '/inc/modules/optimization/optimization.php';

// 主题设置
function vp_theme_setup() {
    // 加载翻译文件
    load_theme_textdomain('vp-theme', VP_DIR . '/languages');
    
    // 添加主题支持
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));
    
    // 注册导航菜单
    register_nav_menus(array(
        'primary' => __('主导航', 'vp-theme'),
        'footer' => __('页脚导航', 'vp-theme')
    ));
    
    // 添加自定义图片尺寸
    add_image_size('post-thumbnail', 800, 450, true);
    add_image_size('post-medium', 400, 225, true);
}
add_action('after_setup_theme', 'vp_theme_setup');

// 加载资源文件
function vp_enqueue_scripts() {
    // 样式
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
    wp_enqueue_style('vp-main', VP_URI . '/assets/css/main.css', array(), VP_VERSION);
    wp_enqueue_style('vp-mobile', VP_URI . '/assets/css/mobile.css', array(), VP_VERSION);
    
    if (is_singular()) {
        wp_enqueue_style('vp-single', VP_URI . '/assets/css/single.css', array(), VP_VERSION);
    }
    
    // 脚本
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array('jquery'), '', true);
    wp_enqueue_script('vp-main', VP_URI . '/assets/js/main.js', array('jquery'), VP_VERSION, true);
    
    // 评论回复
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    
    // 本地化脚本
    wp_localize_script('vp-main', 'vpTheme', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('vp_theme_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'vp_enqueue_scripts');

// 注册小工具区域
function vp_widgets_init() {
    register_sidebar(array(
        'name' => __('侧边栏', 'vp-theme'),
        'id' => 'sidebar-1',
        'description' => __('添加小工具到侧边栏。', 'vp-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ));
    
    register_sidebar(array(
        'name' => __('页脚小工具', 'vp-theme'),
        'id' => 'footer-widgets',
        'description' => __('添加小工具到页脚。', 'vp-theme'),
        'before_widget' => '<div class="col-md-4"><section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section></div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ));
}
add_action('widgets_init', 'vp_widgets_init');

// 自定义摘要长度
function vp_excerpt_length($length) {
    return 120;
}
add_filter('excerpt_length', 'vp_excerpt_length');

// 自定义摘要末尾
function vp_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'vp_excerpt_more');

// 添加主题选项
require_once VP_DIR . '/inc/options/theme-options.php'; 