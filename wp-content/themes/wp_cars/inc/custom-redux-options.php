<?php 

Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'Header Settings', 'wp_cars' ),
		'id'               => 'wp_header_settings',
		'customizer_width' => '500px',
		'icon'             => 'el el-edit',
    'desc'             => __('Settings for header', 'wp_cars'),
    'fiels'            => [
      [
        'id' => 'wp_phone',
        'type' => 'text',
        'title'            => esc_html__( 'Phone Number', 'wp_cars' ),
        'subtitle'            => esc_html__( 'Type the phone', 'wp_cars' ),
        'desc'             => esc_html__( 'The field that will be displayed in the header section.', 'wp_cars' ),
        'customizer_width' => '400px',
      ],
    ],
	)
);

?>