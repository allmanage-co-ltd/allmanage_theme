<?php

/**-----------------------------------
 *
 *----------------------------------*/



/**
 *
 */
function is_local()
{
  $host = $_SERVER['HTTP_HOST'];

  if (empty($host)) {
    return false;
  }

  $localhosts = [
    'localhost',
    '127.0.0.1',
    'web-checker',
  ];

  foreach ($localhosts as $localhost) {
    if (strpos($host, $localhost) !== false) {
      return true;
    }
  }

  return false;
}