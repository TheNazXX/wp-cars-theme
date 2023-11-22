<?php

class Elementor_Slider_Widget extends Elementor\Widget_Base {

	
	public function get_name() {
		return 'cars_slider';
	}

	public function get_title() {
		return esc_html__( 'Main Slider', 'geniuscourses-core' );
	}

	public function get_icon() {
		return 'eicon-container';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

    $repeater = new \Elementor\Repeater();

    
    $repeater->add_control(
			'wp_subtitle',
			[
				'label' => esc_html__( 'Sub Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
			]
		);

		$repeater->add_control(
			'wp_title',
			[
				'label' => esc_html__( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
				'default' => ''
			]
		);

		$repeater->add_control(
			'wp_image',
			[
				'label' => __( 'Choose Image', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);



		$this->add_control(
			'slides',
			[
				'label' => esc_html__( 'Repeater List', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ wp_title }}}',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

?>
<div class="container-fluid p-0" style="margin-bottom: 90px;">
  <div id="header-carousel" class="carousel slide" data-ride="carousel">

    <?php 
                if ( $settings['slides'] ) {
                    echo '<div class="carousel-inner">';
                    $i = 0;
                    foreach (  $settings['slides'] as $slide ) {?>
    <div class="carousel-item <?php if($i == 0) echo 'active'?>">
      <img class="w-100" src="<?php echo esc_html($slide['wp_image']['url']); ?>" alt="Image">
      <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
        <div class="p-3" style="max-width: 900px;">
          <h4 class="text-white text-uppercase mb-md-3"><?php echo esc_html($slide['wp_subtitle']); ?></h4>
          <h1 class="display-1 text-white mb-md-4"><?php echo esc_html($slide['wp_title']); ?></h1>
          <a href="" class="btn btn-primary py-md-3 px-md-5 mt-2">Reserve Now</a>
        </div>
      </div>
    </div>
    <?php $i++;}
                    echo '</div>';
                }
                
                ?>



    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
      <div class="btn btn-dark" style="width: 45px; height: 45px;">
        <span class="carousel-control-prev-icon mb-n2"></span>
      </div>
    </a>
    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
      <div class="btn btn-dark" style="width: 45px; height: 45px;">
        <span class="carousel-control-next-icon mb-n2"></span>
      </div>
    </a>
  </div>
</div>

<?php

	}

}