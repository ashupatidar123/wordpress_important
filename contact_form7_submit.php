Add this file functions.php
===================================

add_action('wpcf7_before_send_mail', 'save_contact_form7');
function save_contact_form7($wpcf7)
{
      //global $wpdb;
      $submission = WPCF7_Submission::get_instance();
      $formData = $submission->get_posted_data();
      
      $title = $wpcf7->title;
      if($title=='Contact form 1')
      {

        $first_name = $formData['first_name'];
        $last_name  = $formData['last_name'];
        $email      = $formData['email'];
        $phone      = $formData['phone'];
        $comments   = $formData['comments'];

        $postInsert = array(
            'post_type'=>'contactForm7',
            'post_title'=>$title,
            'post_status' => 'publish',
            'comment_status'=>'closed',
            'ping_status' => 'closed',
            'post_name'=>'contact'
        );

        $post_id = wp_insert_post($postInsert);
        if($post_id>0){
            add_post_meta($post_id,'first_name',$first_name);
            add_post_meta($post_id,'last_name',$last_name);
            add_post_meta($post_id,'email',$email);
            add_post_meta($post_id,'phone',$phone);
            add_post_meta($post_id,'comments',$comments);
        }
      } 
}
