<?php 


function aletheme_metaboxes($meta_boxes) {

	$meta_boxes = array();

	wp_reset_postdata();
	
	$meta_boxes[] = array(
		'id'         => 'cars_metabox',
		'title'      => 'Cars Options',
		'pages'      => array( 'cars', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('cars_year', 'cars'),
				'desc' => __('Type the car year','cars'),
				'id'   => 'wp_cars_year',
				'std'  => '',
				'type' => 'text',
			),
			array(
				'name' => __('cars_engine title','cars'),
				'desc' => __('Type the car engine','cars'),
				'id'   => 'wp_cars_engine',
				'std'  => '',
				'type' => 'text',

			),
			array(
				'name' => __('cars_unit','cars'),
				'desc' => __('Type car  drive unit','cars'),
				'id'   => 'wp_cars_unit',
				'std'  => '',
				'type' => 'text',
			),
			array(
				'name' => __('cars_price','cars'),
				'desc' => __('Type price','cars'),
				'id'   => 'wp_cars_price',
				'std'  => '',
				'type' => 'text',
			),
			array(
				'name' => __('cars_period','cars'),
				'desc' => __('Type period','cars'),
				'id'   => 'wp_cars_period',
				'std'  => '',
				'type' => 'text',
			)
		)
	);


	$meta_boxes[] = array(
		'id'         => 'services_page_metabox',
		'title'      => 'Services Page Options',
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on'    => array( 'key' => 'page-template', 'value' => array('template-services.php'), ), // Specific post templates to display this metabox
		'fields' => array(
			array(
				'name' => __('Discount title', 'wp_cars'),
				'desc' => __('Type the title for teachers section','wp_cars'),
				'id'   => 'services_discount_bg',
				'type' => 'text',
			)
		)
	);


	return $meta_boxes;
}
?>