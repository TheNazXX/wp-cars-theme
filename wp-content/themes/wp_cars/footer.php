<?php global $cars_options; ?>

<div class="container-fluid bg-secondary py-5 px-sm-3 px-md-5" style="margin-top: 90px;">
  <div class="row pt-5">
    <div class="col-lg-3 col-md-6 mb-5">
      <h4 class="text-uppercase text-light mb-4">
        <?php esc_html_e(($cars_options['title_one']) ? $cars_options['title_one'] : 'Get In Touch') ?></h4>

      <?php if($cars_options['wp_address']): ?>
      <p class="mb-2"><i
          class="fa fa-map-marker-alt text-white mr-3"></i><?php esc_html_e($cars_options['wp_address']); ?></p>
      <?php endif; ?>


      <?php if ($cars_options['wp_phone']): ?>
      <p class="mb-2"><i class="fa fa-phone-alt text-white mr-3"></i><?php esc_html_e($cars_options['wp_phone']); ?>
      </p>
      <?php endif; ?>

      <?php if ($cars_options['wp_email']): ?>
      <p><i class="fa fa-envelope text-white mr-3"></i><?php esc_html_e($cars_options['wp_email']); ?></p>
      <?php endif; ?>

      <h6 class="text-uppercase text-white py-2">Follow Us</h6>
      <div class="d-flex justify-content-start">
        <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
        <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
        <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
        <a class="btn btn-lg btn-dark btn-lg-square" href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-5">
      <h4 class="text-uppercase text-light mb-4">
        <?php esc_html_e(($cars_options['title_two']) ? $cars_options['title_two'] : 'Useful links') ?></h4>
      <div class="d-flex flex-column justify-content-start">

        <?php echo wp_nav_menu(
            [
                'theme_location' => 'footer_useful',
                'container' => false,
                'echo' => false,
                'depth' => 0,
                'items_wrap' => '<div id="%1$s" class="%2$s">%3$s</div>',
                'walker' => new Useful_Links_Walker_Nav_Menu()
            ]
            ) ?>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-5">
      <h4 class="text-uppercase text-light mb-4">
        <?php esc_html_e(($cars_options['title_three']) ? $cars_options['title_three'] : 'Car gallery') ?></h4>
      <!-- <div class="row mx-n1">
        <div class="col-4 px-1 mb-2">
          <a href=""><img class="w-100" src="img/gallery-1.jpg" alt=""></a>
        </div>
        <div class="col-4 px-1 mb-2">
          <a href=""><img class="w-100" src="img/gallery-2.jpg" alt=""></a>
        </div>
        <div class="col-4 px-1 mb-2">
          <a href=""><img class="w-100" src="img/gallery-3.jpg" alt=""></a>
        </div>
        <div class="col-4 px-1 mb-2">
          <a href=""><img class="w-100" src="img/gallery-4.jpg" alt=""></a>
        </div>
        <div class="col-4 px-1 mb-2">
          <a href=""><img class="w-100" src="img/gallery-5.jpg" alt=""></a>
        </div>
        <div class="col-4 px-1 mb-2">
          <a href=""><img class="w-100" src="img/gallery-6.jpg" alt=""></a>
        </div>
      </div> -->
    </div>
    <div class="col-lg-3 col-md-6 mb-5">
      <h4 class="text-uppercase text-light mb-4">
        <?php esc_html_e(($cars_options['title_four']) ? $cars_options['title_four'] : 'About') ?></h4>
      <?php if ($cars_options['about_footer']): ?>
      <?php esc_html_e($cars_options['about_footer'])?>
      <?php endif; ?>
    </div>

  </div>
</div>
<div class="container-fluid bg-dark py-4 px-sm-3 px-md-5">
  <p class="mb-2 text-center text-body">&copy; Your Site Name. All Rights Reserved.</p>
  <p class="m-0 text-center text-body">Designed by Team Name</p>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


<!-- JavaScript Libraries -->
<?php wp_footer(); ?>
</body>

</html>