<?php

add_shortcode('', '');
add_shortcode('home', 'shortcode_home');


function shortcode_home()
{
  return home_url('/');
}