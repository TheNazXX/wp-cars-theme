<?php 

class thenaz_bookingForm
{
  public function __construct(){
    add_action('wp_enqueue_scripts', [$this, 'enqueue']);
    add_action('init', [$this, 'thenaz_booking_shortcode']);

    add_action('wp_ajax_booking_form', [$this, 'booking_form']);
    add_action('wp_ajax_nopriv_booking_form', [$this, 'booking_form']);
  }

  public function enqueue(){
    wp_enqueue_script('thenaz_bookingform', plugins_url('thenaz_plugin/assets/js/front/bookingform.js'), ['jquery'], '1.0', true);
    
    wp_localize_script('thenaz_bookingform', 'thenaz_bookingform_vars', [
      'ajaxurl' => admin_url('admin-ajax.php'),
      'nonce' => wp_create_nonce('_wpnonce'),
      'title' => 'Booking Form'
    ]);
  }

  public function thenaz_booking_shortcode(){
    add_shortcode('thenaz_booking', [$this, 'booking_form_html']);
  }

  public function booking_form_html($atts, $content){


    extract(shortcode_atts([
      'price' => '0',
    ], $atts));


    echo '
      <div id="thenaz_result"></div>
      <form method="post">
        <p>
          <input type="type" name="name" id="thenaz_name"/>
        </p>
        <p>
          <input type="email" name="email" id="thenaz_email"/>
        </p>
        <p>
          <input type="number" name="phone" id="thenaz_phone"/>
        </p> ';

        if($price != ''){
          echo '
            <p>
              <input type="hidden" name="price" id="thenaz_price" value="'.$price.'" />
            </p>
          ';
        }

        echo '<p>
          <input type="submit" name="submit" id="thenaz_booking_submit"/>
        </p>
      </form>
    ';
  }

  public function booking_form(){
    check_ajax_referer('_wpnonce', 'nonce');

    if(!empty($_POST)){
      if(isset($_POST['name'])){
        $name = $_POST['name'];
      }
      
      if(isset($_POST['email'])){
        $email = $_POST['email'];
      }
      
      if(isset($_POST['phone'])){
        $phone = $_POST['phone'];
      }

      if(isset($_POST['price'])){
        $price = $_POST['price'];
      }

      $data_message = '';
      $result = wp_mail(get_option('admin_mail'), 'New reservation', $data_message);

      $message = 'That for your reservation';
      wp_mail($email, 'New reservation', $data_message);

      echo '
        '. $_POST['price'] .' 
      ';
    }


    wp_die();
  }
}


$bookingForm = new thenaz_bookingForm();
?>