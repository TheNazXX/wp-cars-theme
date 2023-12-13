<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Elementor_Properties_Widget extends \Elementor\Widget_Base {
	
	protected $thenazTempalteLoader;


	public function get_name() {
		return 'thenaz_properties';
	}


	public function get_title() {
		return esc_html__( 'Property List', 'thenaz' );
	}

	
	public function get_icon() {
		return 'eicon-code';
	}

	
	public function get_categories() {
		return [ 'general' ];
	}



	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'thenaz' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'count',
			[
				'label' => esc_html__( 'Posts Count', 'thenaz' ),
				'type' => \Elementor\Controls_Manager::TEXT,
        'default' => 3
			]
		);

		$this->end_controls_section();

	}

	
	protected function render() {

		$settings = $this->get_settings_for_display();
		$this->thenazTempalteLoader = new thenaz_Template_Loader();

		$properties = new WP_Query([
			'post_type' => 'property'
		]);

		?>

<div class="container"></div>
<div class="d-flex">

  <?php if ( $properties->have_posts() ) : while ( $properties->have_posts() ) : $properties->the_post(); ?>
  <div class="item">
    <?php $this->thenazTempalteLoader->get_template_part('parts/content')?>
  </div>

  <?php endwhile; else : ?>
  <?php echo 'Sorry, no posts were found.'; ?>
  <?php endif; ?>
  <?php
    
	}
}?>

</div>
</div>