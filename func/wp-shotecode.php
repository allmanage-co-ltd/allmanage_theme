<?php

// add_shortcode('', '');

/**
 * トップのurl
 */
function shortcode_home()
{
  return home_url('/');
}
add_shortcode('home', 'shortcode_home');