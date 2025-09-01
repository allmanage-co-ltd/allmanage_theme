<?php

/**
 *
 */
function get_url($key)
{
  $home = home_url();

  $urls = [
    'top'     => "{$home}",
    'company' => "{$home}/company",
    'recruit' => "{$home}/recruit",
    'contact' => "{$home}/contact",
    'privacy-policy' => "{$home}/privacy",
  ];

  return esc_url($urls[$key]) ?? '#';
}