<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <?php wp_head()?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <?php global $cars_options; ?>

  <div class="container-fluid bg-dark py-3 px-lg-5 d-none d-lg-block">
    <div class="row">
      <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0">
        <div class="d-inline-flex align-items-center">
          <?php if($cars_options['wp_phone']): ?>
          <a class="text-body pr-3" href="tel:<?php esc_html_e($cars_options['wp_phone']); ?>"><i
              class="fa fa-phone-alt mr-2"></i><?php esc_html_e($cars_options['wp_phone']); ?></a>
          <?php endif;?>
          <span class="text-body">|</span>

          <?php if($cars_options['wp_email']): ?>
          <a class="text-body px-3" href="mailto:<?php esc_html_e($cars_options['wp_email']); ?>"><i
              class="fa fa-envelope mr-2"></i><?php esc_html_e($cars_options['wp_email']); ?></a>

          <?php endif; ?>
        </div>
      </div>
      <div class="col-md-6 text-center text-lg-right">
        <div class="d-inline-flex align-items-center">

          <?php if($cars_options['fb']): ?>
          <a class="text-body px-3" href="<?php echo esc_url($cars_options['fb']);?>">
            <i class="fab fa-facebook-f"></i>
          </a>
          <?php endif; ?>

          <?php if($cars_options['twi']): ?>
          <a class="text-body px-3" href="<?php echo esc_url($cars_options['twi']);?>">
            <i class="fab fa-twitter"></i>
          </a>
          <?php endif; ?>


          <?php if($cars_options['in']): ?>
          <a class="text-body px-3" href="<?php echo esc_url($cars_options['inf']);?>">
            <i class="fab fa-linkedin-in"></i>
          </a>
          <?php endif; ?>

          <?php if($cars_options['ins']): ?>
          <a class="text-body px-3" href="<?php echo esc_url($cars_options['ins']);?>">
            <i class="fab fa-instagram"></i>
          </a>
          <?php endif; ?>

          <?php if($cars_options['yout']): ?>
          <a class="text-body px-3" href="<?php echo esc_url($cars_options['yout']);?>">
            <i class="fab fa-youtube"></i>
          </a>
          <?php endif; ?>



        </div>
      </div>
    </div>
  </div>
  <!-- Topbar End -->


  <!-- Navbar Start -->
  <div class="container-fluid position-relative nav-bar p-0">
    <div class="position-relative px-lg-5" style="z-index: 9;">
      <nav class="navbar navbar-expand-lg bg-secondary navbar-dark py-3 py-lg-0 pl-3 pl-lg-5">
        <a href="<?php echo esc_url(home_url('/'));?>" class="navbar-brand">
          <h1 class="text-uppercase text-primary mb-1"><?php bloginfo('name'); ?></h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">

          <?php echo wp_nav_menu([
                'theme_location' => 'header_nav',
                'container' => false,
                'echo' => false,
                'menu_class' => 'navbar-nav ml-auto py-0',
                'add_li_class' => 'nav-item nav-link'
            ]); ?>
        </div>
      </nav>
    </div>
  </div>


  <?php if (!is_front_page()): ?>
  <?php 
        $bg_img = (get_the_post_thumbnail_url(get_the_id(), 'full')) ? get_the_post_thumbnail_url(get_the_id(), 'full') : $cars_options['main_banner']['url']; 
    ?>

  <div class="container-fluid page-header page-banner"
    style="background-image: linear-gradient(rgba(28, 30, 50, .9), rgba(28, 30, 50, .9)) , url('<?php echo $bg_img; ?>');">
    <h1 class="display-3 text-uppercase text-white mb-3"><?php wp_title(""); ?></h1>
  </div>
  <?php endif;?>