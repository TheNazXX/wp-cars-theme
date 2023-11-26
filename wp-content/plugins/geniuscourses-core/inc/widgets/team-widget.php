<?php

class Elementor_Team_Widget extends Elementor\Widget_Base {

  public function get_script_depends(){
		if(\Elementor\Plugin::$instance->preview->is_preview_mode()){
			wp_register_script('gc-team', plugins_url('/js/gc-team.js', __FILE__), ['elementor-frontend'], ' 1.0', true);
			return ['gc-team'];
		}
		return [];
	}

	
	public function get_name() {
		return 'cars_team';
	}

	public function get_title() {
		return esc_html__( 'Cars Team Slider', 'geniuscourses-core' );
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
			'wp_section_subtitle',
			[
				'label' => esc_html__( 'Section SubTitle', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '01',
				'placeholder' => __( 'Type your subtitle here', 'plugin-domain' ),
			]
		);

		$this->add_control(
			'wp_section_title',
			[
				'label' => esc_html__( 'Section Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Meet our team',
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
			]
		);

    $repeater = new \Elementor\Repeater();

    
    $repeater->add_control(
			'wp_subtitle',
			[
				'label' => esc_html__( 'Dev position', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
			]
		);

		$repeater->add_control(
			'wp_title',
			[
				'label' => esc_html__( 'Name', 'plugin-domain' ),
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


<div class="container-fluid py-5">
  <div class="container py-5">
    <h1 class="display-1 text-primary text-center"><?php esc_html_e($settings['wp_section_subtitle']); ?></h1>
    <h1 class="display-4 text-uppercase text-center mb-5"><?php esc_html_e($settings['wp_section_title']); ?></h1>

    <div class="owl-carousel team-carousel position-relative" style="padding: 0 30px;">
      <?php foreach($settings['slides'] as $slide){ ?>
      <div class="team-item">
        <img class="img-fluid w-100" src="<?php echo esc_url($slide['wp_image']['url'])?>" alt="Photo of employee">
        <div class="position-relative py-4">
          <h4 class="text-uppercase"><?php esc_html_e($slide['wp_title']); ?></h4>
          <p class="m-0"><?php esc_html_e($slide['wp_subtitle']); ?></p>
          <div class="team-social position-absolute w-100 h-100 d-flex align-items-center justify-content-center">
            <a class="btn btn-lg btn-primary btn-lg-square mx-1" href="#"><i class="fab fa-twitter"></i></a>
            <a class="btn btn-lg btn-primary btn-lg-square mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
            <a class="btn btn-lg btn-primary btn-lg-square mx-1" href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
      </div>

      <?php }; ?>


    </div>
  </div>
</div>

<?php

	}

}