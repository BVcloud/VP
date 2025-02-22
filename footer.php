    <footer class="site-footer">
        <div class="container">
            <div class="footer-widgets">
                <div class="row">
                    <?php dynamic_sidebar('footer-widgets'); ?>
                </div>
            </div>
            
            <div class="footer-info">
                <div class="copyright">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>
                    <?php if ($icp = get_option('vp_icp_number')): ?>
                        <a href="https://beian.miit.gov.cn/" target="_blank"><?php echo $icp; ?></a>
                    <?php endif; ?>
                </div>
                <div class="footer-links">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_class' => 'footer-menu',
                        'container' => false,
                        'depth' => 1
                    ));
                    ?>
                </div>
            </div>
        </div>
    </footer>
    
    <?php if (get_option('vp_back_to_top', true)): ?>
        <button id="back-to-top" class="back-to-top">
            <i class="fas fa-arrow-up"></i>
        </button>
    <?php endif; ?>
    
    <?php wp_footer(); ?>
</body>
</html> 