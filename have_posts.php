<?php
    if(have_posts())
    {
        while (have_posts())
        {
            the_post(); 
            $homeTitle = get_the_title();
            $homeId = get_the_ID();
            $homeContent = get_the_content();
    ?>
    
    
    Get all particular page post meta data
    
    $history_content = get_post_meta($homeId,'our_history_content',true);
    $history_title   = get_post_meta($homeId,'our_history_title',true);
