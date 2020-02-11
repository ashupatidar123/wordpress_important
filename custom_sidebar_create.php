add functions.php file




add_action('widgets_init','create_custom_sidebar');
function create_custom_sidebar() {
    register_sidebar( array(
        'name'          => __('Footer-01','theme_name'),
        'id'            => 'footer-01',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<div class="widget-title"><h3>',
        'after_title'   => '</h3></div>',
    ));
    register_sidebar( array(
        'name'          => __('Footer-02','theme_name'),
        'id'            => 'footer-02',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<div class="widget-title"><h3>',
        'after_title'   => '</h3></div>',
    ));
    // register_sidebar( array(
    //     'name'          => __('Footer-02','theme_name'),
    //     'id'            => 'footer-02',
    //     'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    //     'after_widget'  => '</aside>',
    //     'before_title'  => '<h3 class="widget-title">',
    //     'after_title'   => '</h3>',
    // ));
    register_sidebar( array(
        'name'          => __('Footer-03','theme_name'),
        'id'            => 'footer-03',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
 
    register_sidebar( array(
        'name'          => __('Footer Bottom Sidebar','theme_name'),
        'id'            => 'footer-bottom',
        'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li></ul>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
