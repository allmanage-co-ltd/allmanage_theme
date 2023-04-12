<?php

/*-------------------------------------------*/
/*    管理画面で使用したいcss・jsを読み込む
/*-------------------------------------------*/
function add_dashboard()
{
	add_action('admin_enqueue_scripts', 'my_admin_style');
	add_action('admin_enqueue_scripts', 'my_admin_script');
}
// 管理画面　css
function my_admin_style()
{
	wp_enqueue_style('admin', get_template_directory_uri() . '/src/css/admin.css', false, '1.0.1');
	wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.1.0/css/all.css');
}
// 管理画面　js
function my_admin_script()
{
	wp_enqueue_media();
	wp_enqueue_script('admin', get_template_directory_uri() . '/src/js/admin.js', array('jquery'), '1.0.2', true);
	$js_array = array(
		'theme'   => theme_dir(),
		'home'   => home(),
		'img'   => img_dir()
	);
	wp_localize_script('admin', 'admin', $js_array);
}
add_action('admin_menu', 'add_dashboard');


/*-------------------------------------------*/
/*    フロント画面で使用したいcss・jsを読み込む
/*-------------------------------------------*/
function add_front_theme()
{
	add_action('wp_enqueue_scripts', 'my_front_style');
	add_action('wp_enqueue_scripts', 'my_front_script');
}
// フロント画面　css
function my_front_style()
{

	$dir = get_template_directory_uri() . '/src/css/';

	// wp_enqueue_style('swiper',  'https://unpkg.com/swiper/swiper-bundle.min.css', false, '0.0.1');
	wp_enqueue_style('fonts',  'https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap', false, '0.0.1');
	wp_enqueue_style('core', $dir . 'style.css', false, '0.1.0');
}
// フロント画面　js
function my_front_script()
{

	$dir = get_template_directory_uri() . '/src/js/';

	wp_deregister_script('jquery');
	wp_enqueue_script('swiper', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), false, true);
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), false, true);
	wp_enqueue_script('inview', $dir . 'jquery.inview.min.js', array('jquery'), '0.0.2', true);
	wp_enqueue_script('app', $dir . 'func.js', array('jquery'), '0.0.5', true);

	wp_localize_script(
		'app',
		'DATA',
		array(
			'template' => get_template_directory_uri() . '/',
			'ajax' => admin_url('admin-ajax.php')
		)
	);

	//wp_add_inline_script( $handle, $inline_script );

}
add_action('after_setup_theme', 'add_front_theme');