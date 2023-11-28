<?php 


$custom_post_types = get_posts(['post_type' => ['property', 'agent'], 'numberposts' => -1]);

foreach($custom_post_types as $post){
  wp_delete_post($post->ID, true);  
};


?>