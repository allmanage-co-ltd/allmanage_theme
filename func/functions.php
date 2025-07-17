<?php

declare(strict_types=1);

function pr($data): void
{
  echo '<pre>';
  var_dump($data);
  echo '</pre>';
}


function is_iphone()
{
  $is_iphone = (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone');
  if ($is_iphone) {
    return true;
  }

  return false;
}


function is_android()
{
  $is_android = (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'Android');
  if ($is_android) {
    return true;
  }

  return false;
}


function is_ipad()
{
  $is_ipad = (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'iPad');
  if ($is_ipad) {
    return true;
  }

  return false;
}


function is_kindle()
{
  $is_kindle = (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle');
  if ($is_kindle) {
    return true;
  }

  return false;
}


function is_mobile()
{
  $useragents = [
    'iPhone',          // iPhone
    'iPod',            // iPod touch
    'Android',         // 1.5+ Android
    'dream',           // Pre 1.5 Android
    'CUPCAKE',         // 1.5+ Android
    'blackberry9500',  // Storm
    'blackberry9530',  // Storm
    'blackberry9520',  // Storm v2
    'blackberry9550',  // Storm v2
    'blackberry9800',  // Torch
    'webOS',           // Palm Pre Experimental
    'incognito',       // Other iPhone browser
    'webmate',          // Other iPhone browser
  ];
  $pattern = '/' . implode('|', $useragents) . '/i';

  return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}


function isBot()
{
  $bot_list = [
    'Googlebot',
    'Yahoo! Slurp',
    'Mediapartners-Google',
    'msnbot',
    'bingbot',
    'MJ12bot',
    'Ezooms',
    'pirst; MSIE 8.0;',
    'Google Web Preview',
    'ia_archiver',
    'Sogou web spider',
    'Googlebot-Mobile',
    'AhrefsBot',
    'YandexBot',
    'Purebot',
    'Baiduspider',
    'UnwindFetchor',
    'TweetmemeBot',
    'MetaURI',
    'PaperLiBot',
    'Showyoubot',
    'JS-Kit',
    'PostRank',
    'Crowsnest',
    'PycURL',
    'bitlybot',
    'Hatena',
    'facebookexternalhit',
    'NINJA bot',
    'YahooCacheSystem',
  ];
  $is_bot = false;
  foreach ($bot_list as $bot) {
    if (false !== stripos($_SERVER['HTTP_USER_AGENT'], $bot)) {
      $is_bot = true;

      break;
    }
  }

  return $is_bot;
}