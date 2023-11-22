<?php

class Elementor_About_Widget extends Elementor\Widget_Base {

	
	public function get_name() {
		return 'geniuscourses_about';
	}

	public function get_title() {
		return esc_html__( 'Geniuscourses About', 'geniuscourses-core' );
	}

	public function get_icon() {
		return 'fa fa-code';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'geniuscourses_title_one',
			[
				'label' => esc_html__( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Welcome To',
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
			]
		);

		$this->add_control(
			'geniuscourses_title_two',
			[
				'label' => esc_html__( 'Title Two', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
				'default' => 'Royal Cars'
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);


        $this->add_control(
			'geniuscourses_description',
			[
				'label' => esc_html__( 'Title Two', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
				'default' => 'Justo et eos et ut takimata sed sadipscing dolore lorem, et elitr labore labore voluptua no rebum sed, stet voluptua amet sed elitr ea dolor dolores no clita. Dolores diam magna clita ea eos amet, amet rebum voluptua vero vero sed clita accusam takimata. Nonumy labore ipsum sea voluptua sea eos sit justo, no ipsum sanctus sanctus no et no ipsum amet, tempor labore est labore no. Eos diam eirmod lorem ut eirmod, ipsum diam sadipscing stet dolores elitr elitr eirmod dolore. Magna elitr accusam takimata labore, et at erat eirmod consetetur tempor eirmod invidunt est, ipsum nonumy at et.',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

?>

<h1 class="display-4 text-uppercase text-center mb-5">Welcome To <span class="text-primary">Royal Cars</span></h1>
<div class="row justify-content-center">
  <div class="col-lg-10 text-center">
    <img class="w-75 mb-4" src="img/about.png" alt="">
    <p>Justo et eos et ut takimata sed sadipscing dolore lorem, et elitr labore labore voluptua no rebum sed, stet
      voluptua amet sed elitr ea dolor dolores no clita. Dolores diam magna clita ea eos amet, amet rebum voluptua
      vero vero sed clita accusam takimata. Nonumy labore ipsum sea voluptua sea eos sit justo, no ipsum sanctus
      sanctus no et no ipsum amet, tempor labore est labore no. Eos diam eirmod lorem ut eirmod, ipsum diam
      sadipscing stet dolores elitr elitr eirmod dolore. Magna elitr accusam takimata labore, et at erat eirmod
      consetetur tempor eirmod invidunt est, ipsum nonumy at et.</p>
  </div>
</div>
<div class="row mt-3">
  <div class="col-lg-4 mb-2">
    <div class="d-flex align-items-center bg-light p-4 mb-4" style="height: 150px;">
      <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4"
        style="width: 100px; height: 100px;">
        <i class="fa fa-2x fa-headset text-secondary"></i>
      </div>
      <h4 class="text-uppercase m-0">24/7 Car Rental Support</h4>
    </div>
  </div>
  <div class="col-lg-4 mb-2">
    <div class="d-flex align-items-center bg-secondary p-4 mb-4" style="height: 150px;">
      <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4"
        style="width: 100px; height: 100px;">
        <i class="fa fa-2x fa-car text-secondary"></i>
      </div>
      <h4 class="text-light text-uppercase m-0">Car Reservation Anytime</h4>
    </div>
  </div>
  <div class="col-lg-4 mb-2">
    <div class="d-flex align-items-center bg-light p-4 mb-4" style="height: 150px;">
      <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4"
        style="width: 100px; height: 100px;">
        <i class="fa fa-2x fa-map-marker-alt text-secondary"></i>
      </div>
      <h4 class="text-uppercase m-0">Lots Of Pickup Locations</h4>
    </div>
  </div>
</div>


<?php



	}

}