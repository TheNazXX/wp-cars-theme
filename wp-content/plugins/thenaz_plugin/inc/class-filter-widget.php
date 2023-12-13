<?php 

class thenaz_filter_widget extends WP_Widget
{

  function __construct(){
    parent::__construct('thenaz_filter_widget', esc_html__('Filter', 'thenaz'), ['description' => 'Filter Form']);
  }

  public function widget($args, $instance){
    extract($args);

    $title = apply_filters('widget_title', $instance["title"]);

    echo $before_widget;

    if($title){
      echo $before_title . '<h3 class="text-center">' .  $title . '</h3>' . $after_title;
    }

    $fields = '';

    if($instance['location']){
      $fields .= ' location="1" ';
    }
    if($instance['agent']){
      $fields .= ' agent="1" ';
    }

    echo do_shortcode('[thenaz_filter ' . $fields .']'); 

    echo $after_widget;
  }
  

  public function form($instance){
    if(isset($instance['title'])){
      $title = $instance['title'];
    }else{
      $title = '';
    };

    if(isset($instance['location'])){
      $location = $instance['location'];
    }else{
      $location = '';
    }

    if(isset($instance['agent'])){
      $agent = $instance['agent'];
    }else{
      $agent = '';
    }

  ?>

<p>
  <label for="<?php echo $this->get_field_id('title')?>"></label>
  <input class="widefat" type="text" name="<?php echo $this->get_field_name('title');?>"
    id="<?php echo $this->get_field_id('title')?>" value="<?php echo esc_attr($title) ?>">
</p>

<p>
  <label for="<?php echo $this->get_field_id('location')?>">Show Location Field?</label>
  <input type="checkbox" name="<?php echo $this->get_field_name('location');?>"
    id="<?php echo $this->get_field_id('location')?>" <?php checked($location, 'on')?>>
</p>

<p>
  <label for="<?php echo $this->get_field_id('agent')?>">Show Agent Field?</label>
  <input type="checkbox" name="<?php echo $this->get_field_name('agent');?>"
    id="<?php echo $this->get_field_id('agent')?>" <?php checked($agent, 'on')?>>
</p>

<?php

  }

  public function update($new_instance, $old_instance){
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['location'] = strip_tags($new_instance['location']);
    $instance['agent'] = strip_tags($new_instance['agent']);
    return $instance;
  }
}

?>