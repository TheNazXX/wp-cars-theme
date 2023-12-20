<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Elementor_Properties_Widget extends \Elementor\Widget_Base {
	
	protected $thenazTempalteLoader;
	protected $taxonomies = [];


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
		return [ 'thenaz' ];
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

		$this->add_control(
			'offer',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => esc_html__( 'Choose offer', 'thenaz' ),
				'options' => [
					'default' => esc_html__( 'Default', 'thenaz' ),
					'sale' => esc_html__( 'For Sale', 'thenaz' ),
					'rent' => esc_html__( 'For Rent', 'thenaz' ),
					'sold' => esc_html__( 'For Sold', 'thenaz' ),
				]
			]
		);

		$this->end_controls_section();

	}

	
	protected function render() {

		$settings = $this->get_settings_for_display();
		$this->thenazTempalteLoader = new thenaz_Template_Loader();


		foreach(get_terms('location') as $location){

		};

		$args = [
			'post_type' => 'property',
			'posts_per_page' => $settings['count'],
			'meta_query' => ['relation'=>'AND'],
			'tax_query' => ['relation'=>'AND']
		];

		if(isset($settings['offer']) && $settings['offer'] != 'default'){
			array_push($args['meta_query'], [
				'key' => 'property_type',
				'value' => $settings['offer']
			]);
		};

		$properties = new WP_Query($args);

		?>

<div class="container"></div>
<div class="d-flex justify-content-center">

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