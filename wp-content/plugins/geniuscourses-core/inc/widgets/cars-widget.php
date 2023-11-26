<?php

class Elementor_Cars_Widget extends Elementor\Widget_Base {

	
	public function get_name() {
		return 'cars_cars_posts';
	}

	public function get_title() {
		return esc_html__( 'Cars Posts', 'geniuscourses-core' );
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
			'wp_title',
			[
				'label' => esc_html__( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Find your car',
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
			]
		);

		$this->add_control(
			'wp_subtitle',
			[
				'label' => esc_html__( 'subtitle', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '01',
				'placeholder' => __( 'Type your subtitle here', 'plugin-domain' ),
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
    <h1 class="display-4 text-uppercase text-center mb-5"><?php esc_html_e($settings['wp_title']); ?></h1>
    <div class="row">
      <?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$cars = new WP_Query(array('post_type'=>'cars','posts_per_page'=>6,'paged' => $paged));
				
				if($cars->have_posts()) : while($cars->have_posts()) : $cars->the_post(); ?>


      <?php get_template_part('partials/content', 'car'); ?>

      <?php endwhile; ?>

      <?php else : ?>

      <?php get_template_part('partials/content', 'none'); ?>

      <?php endif;
			  wp_reset_postdata();
			?>


    </div>
  </div>
</div>

<?php

	}

}