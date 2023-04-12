<?php

get_header();

$folder = 'view/single/';

$slug = get_post_type();

$file=$folder.$slug;

if( locate_template( $file.'.php' )=='' ){

	$file = $folder.'default';

}

get_template_part( $file );

get_footer();

