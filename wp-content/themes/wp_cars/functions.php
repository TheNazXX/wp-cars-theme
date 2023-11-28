<?php
/**
 * Geniuscourses functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Geniuscourses
 */

 // geniuscourses_options

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/redux-options.php';
require_once get_template_directory() . '/inc/custom-walker.php';
require_once get_template_directory() . '/inc/custom-post-types.php';

require_once get_template_directory() . '/inc/metaboxes-core.php';
require_once get_template_directory() . '/inc/custom-metaboxes.php';



add_action( 'tgmpa_register', 'geniuscourses_register_required_plugins' );

function geniuscourses_register_required_plugins() {

	$plugins = array(

		array(
			'name'               => 'Geniuscourses Core', // The plugin name.
			'slug'               => 'geniuscourses-core', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/plugins/geniuscourses-core.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

		array(
			'name'      => 'Advanced Custom Fields',
			'slug'      => 'advanced-custom-fields',
			'required'  => true,
		),

		array(
			'name'      => 'Gutenberg Template Library & Redux Framework',
			'slug'      => 'redux-framework',
			'required'  => true,
		),
	);

	$config = array(
		'id'           => 'geniuscourses',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		
	);

	tgmpa( $plugins, $config );
}


function geniuscourses_paginate($query){
	$big = 999999999; // need an unlikely integer

	$paged = '';
	if(is_singular()) {
		$paged = get_query_var('page');
	} else {
		$paged = get_query_var('paged'); 
	}
 
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, $paged),
		'total' => $query->max_num_pages,
		'prev_next' => false,
		
	) );
}

function geniuscourses_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'geniuscourses' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'geniuscourses' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Car Pages Sidebar', 'geniuscourses' ),
			'id'            => 'carsidebar',
			'description'   => esc_html__( 'Appear as a Sidebar on Car Pages', 'geniuscourses' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'geniuscourses_widgets_init' );


function geniuscourses_enqueue_scripts(){
	wp_enqueue_style('geniuscourses-font-awesome','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css', array(), '1.0', 'all');
	wp_enqueue_style('owl.carousel', get_template_directory_uri().'/assets/js/lib/owlcarousel/assets/owl.carousel.min.css', array(), '1.0', 'all');
	wp_enqueue_style('tempusdominus-bootstrap-4', get_template_directory_uri().'/assets/js/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css', array(), '1.0', 'all');
	wp_enqueue_style('geniuscourses-bootstrap', get_template_directory_uri().'/assets/css/bootstrap.min.css', array(), '1.0', 'all');
	wp_enqueue_style('geniuscourses-style', get_template_directory_uri().'/assets/css/style.css', array(), '1.0', 'all');
	wp_enqueue_style('geniuscourses-general', get_template_directory_uri().'/assets/css/general.css', array(), '1.0', 'all');
	wp_enqueue_style('animate-css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', array(), '4.1.1', 'all');

	wp_enqueue_script('bootstrap.bundle', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('easing', get_template_directory_uri().'/assets/js/lib/easing/easing.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('waypoints', get_template_directory_uri().'/assets/js/lib/waypoints/waypoints.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('owl.carousel', get_template_directory_uri().'/assets/js/lib/owlcarousel/owl.carousel.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('moment', get_template_directory_uri().'/assets/js/lib/moment.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('moment-timezone', get_template_directory_uri().'/assets/js/lib/tempusdominus/js/moment-timezone.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('tempusdominus-bootstrap-4', get_template_directory_uri().'/assets/js/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js', array('jquery'), '1.0', true);

	wp_enqueue_script('geniuscourses-main', get_template_directory_uri().'/assets/js/main.js', array('jquery'), '1.0', true);
	wp_localize_script('geniuscourses-main', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
	
	wp_enqueue_style('geniuscourses-fonts', gc_fonts_url(), array(), '1.0');
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action('wp_enqueue_scripts', 'geniuscourses_enqueue_scripts');


function gc_fonts_url(){
	$fonts_url = '';
	$families = array();
	$families[] = 'Oswald:wght@400;500;600;700';
	$families[] = 'Rubik';

	$query_args = array(
		'family' => urlencode(implode('|', $families)),
	);
	$fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
	return esc_url_raw($fonts_url);
}


function geniuscourses_ajax_example(){

	if(!wp_verify_nonce($_REQUEST['nonce'],'ajax-nonce')){
		die;
	}

	if(isset($_REQUEST['string_one'])){
		echo $_REQUEST['string_one'];
	}

	echo "<br>";

	if(isset($_REQUEST['string_two'])){
		echo $_REQUEST['string_two'];
	}

	$cars = new WP_Query(array('post_type'=>'car','posts_per_page'=>-1));

	if($cars->have_posts()) : while($cars->have_posts()) : $cars->the_post(); 

	get_template_part('partials/content', 'car'); 

	endwhile; endif; 
	wp_reset_postdata();

	die;
}
add_action('wp_ajax_geniuscourses_ajax_example','geniuscourses_ajax_example');
add_action('wp_ajax_nopriv_geniuscourses_ajax_example','geniuscourses_ajax_example');

function geniuscourses_theme_init(){

	//Регистрация локций меню
	register_nav_menus(array(
		'header_nav' => 'Header Navigation',
		'footer_useful' => 'Footer Useful Links'
	));


	//Поддержка html5 тэгов
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	

	//Поддержка многоязычности
	load_theme_textdomain('geniuscourses', get_template_directory().'/lang');

	//Поддержка тумб
	add_theme_support( 'post-thumbnails' );
	add_image_size('car-cover', 240, 188, true);

	add_theme_support('post-formats',
		array(
			'video',
			'quote',
			'image',
			'gallery'
		)
	);

	add_theme_support('custom-logo',
		array(
			'width' => '130',
			'height' => '50'
		)
	);

	add_post_type_support('car','post-formats');

}
add_action('after_setup_theme','geniuscourses_theme_init',0);







function geniuscourses_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'geniuscourses_content_width', 640 );
}
add_action( 'after_setup_theme', 'geniuscourses_content_width', 0 );


function geniuscourses_custom_comments($comment, $args, $depth){

	if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
<<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>
  id="comment-<?php comment_ID() ?>"><?php 
    if ( 'div' != $args['style'] ) { ?>
  <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
    } ?>
    <div class="comment-author vcard">
      <?php 
            if ( $args['avatar_size'] != 0 ) {
                echo get_avatar( $comment, $args['avatar_size'] ); 
            } 
            printf( __( '<cite class="fn">Author: %s</cite>' ), get_comment_author_link() ); ?>

      <div class="reply"><?php 
					comment_reply_link( 
						array_merge( 
							$args, 
							array( 
								'add_below' => $add_below, 
								'depth'     => $depth, 
								'max_depth' => $args['max_depth'] 
							) 
						) 
					); ?>
      </div>

    </div><?php 
        if ( $comment->comment_approved == '0' ) { ?>
    <em
      class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.','geniuscourses' ); ?></em><br /><?php 
        } ?>
    <div class="comment-meta commentmetadata">
      <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
                /* translators: 1: date, 2: time */
                printf( 
                    __('%1$s at %2$s'), 
                    get_comment_date(),  
                    get_comment_time() 
                ); ?>
      </a><?php 
            edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>
    </div>

    <?php comment_text(); ?>

    <?php 
    if ( 'div' != $args['style'] ) : ?>
  </div><?php 
    endif;
}



function wp_cars_class_on_li($classes, $item, $args){
	if(isset($args->add_li_class)){
		$classes[] = $args->add_li_class;
	};
	return $classes;
}
add_filter('nav_menu_css_class', 'wp_cars_class_on_li', 1, 3);


function gc_posts_per_page($query){
	if(!is_admin()){
		if(is_post_type_archive('car')){
			$query->set('posts_per_page', 3);
		}
	}
}
add_action('pre_get_posts','gc_posts_per_page');


function load_content() {
	$link = esc_url($_POST['link']); // Получаем адрес ссылки

	// Получаем куки текущего пользователя
	$user_cookies = $_COOKIE;

	// Загружаем содержимое страницы с куками
	$response = wp_remote_get($link, array(
		'cookies' => $user_cookies,
	));

	// Возвращаем содержимое
	echo wp_remote_retrieve_body($response);

	wp_die();
}

add_action('wp_ajax_nopriv_load_content', 'load_content');
add_action('wp_ajax_load_content', 'load_content');