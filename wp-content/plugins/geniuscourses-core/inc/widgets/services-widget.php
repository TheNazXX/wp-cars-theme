<?php

class Elementor_Services_Widget extends Elementor\Widget_Base {

	
	public function get_name() {
		return 'cars_services';
	}

	public function get_title() {
		return esc_html__( 'Services', 'wp_cars' );
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

    $this->add_control(
			'wp_subtitle',
			[
				'label' => esc_html__( 'SubTitle', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '01',
				'placeholder' => __( 'Type your subtitle here', 'plugin-domain' ),
			]
		);

		$this->add_control(
			'wp_title',
			[
				'label' => esc_html__( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'OUR SERVICES',
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
			]
		);
	
    $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'wp_services_count',
			[
				'label' => esc_html__( 'Count', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Type your item count', 'plugin-domain' ),
			]
		);

	
    $repeater->add_control(
			'wp_services_title',
			[
				'label' => esc_html__( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Type your title for services item', 'plugin-domain' ),
			]
		);

		$repeater->add_control(
			'wp_services_desc',
			[
				'label' => esc_html__( 'Description', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Type your Description', 'plugin-domain' ),
			]
		);

		$repeater->add_control(
			'wp_services_icon',
			[
				'label' => esc_html__( 'Icon', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Type your shorcode icons', 'plugin-domain' ),
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Repeater List', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => 'Item',
			]
		);


		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

?>
<div class="container-fluid py-5">
  <div class="container pt-5 pb-3">

    <h1 class="display-1 text-primary text-center"><?php esc_html_e($settings['wp_subtitle']); ?></h1>
    <h1 class="display-4 text-uppercase text-center mb-5"><?php esc_html_e($settings['wp_title']) ?></h1>

    <div class="row">

      <?php $i = 0; foreach($settings['items'] as $item){; ?>
      <div class="col-lg-4 col-md-6 mb-2">
        <div
          class="service-item <?php echo ($i == 1) ? 'active': '';?> d-flex flex-column justify-content-center px-4 mb-4">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="d-flex align-items-center justify-content-center bg-primary ml-n4"
              style="width: 80px; height: 80px;">
              <i class="fa fa-2x <?php esc_html_e($item['wp_services_icon']); ?> text-secondary"></i>
            </div>
            <h1 class="display-2 text-white mt-n2 m-0"><?php esc_html_e($item['wp_services_count']); ?></h1>
          </div>
          <h4 class="text-uppercase mb-3"><?php esc_html_e($item['wp_services_title']); ?></h4>
          <p class="m-0" style="overflow-y: hidden; max-height: 100px"><?php esc_html_e($item['wp_services_desc']); ?>
          </p>
        </div>
      </div>

      <?php $i++; }; ?>

    </div>


  </div>


</div>
</div>

<?php

	}

}