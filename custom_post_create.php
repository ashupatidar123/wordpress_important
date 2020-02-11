this code use in functions.php file

This is a custom post generate like (post section etc)

add_action('init', 'my_custom_post_slider');
function my_custom_post_slider() {
  $labels = array(
    'name'               => _x( 'Slider', 'post type general name' ),
    'singular_name'      => _x( 'Slider', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'book' ),
    'add_new_item'       => __( 'Add New Slider' ),
    'edit_item'          => __( 'Edit Slider' ),
    'new_item'           => __( 'New Slider' ),
    'all_items'          => __( 'All Slider' ),
    'view_item'          => __( 'View Slider' ),
    'search_items'       => __( 'Search Slider' ),
    'not_found'          => __( 'No sliders found' ),
    'not_found_in_trash' => __( 'No slider found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Slider'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our sliders and slider specific data',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail'),
    'has_archive'   => true,
  );
  register_post_type('slider',$args); 
}
