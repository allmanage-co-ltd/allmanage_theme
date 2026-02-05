<?php

namespace App\Hook;

/**-----------------------------------
 *
 *----------------------------------*/

class MwFormHook
{
  public function __construct()
  {
    $this->add_yubinbango_script();
    $this->add_yubinbango_class();
    $this->mwform_send_mail_content();
  }

  /**
   *
   */
  private function add_yubinbango_script()
  {
    //
  }

  /**
   * Formタグにクラスを付与
   *
   * ※Form先頭に手動で記載する
   *   <p class="p-country-name" style="display:none">Japan</p>
   *
   * ※各フィールドにもクラスを手動でで付与する
   *   郵便番号：p-postal-code
   *   都道府県：p-region
   *   市区町村：p-locality
   *   町域：p-street-address
   *   詳細住所：p-extended-address
   */
  private function add_yubinbango_class()
  {
    add_action('wp_enqueue_scripts', function () {
      wp_enqueue_script('yubinbango', 'https://yubinbango.github.io/yubinbango/yubinbango.js', array(), false, true);
    }, 99);
  }

  /**
   *
   */
  private function mwform_send_mail_content()
  {
    add_filter('mwform_custom_mail_tag', function ($value, $key, $insert_contact_data_id) {

      if ($key === '利用環境') {
        return $_SERVER["HTTP_USER_AGENT"];
      }
      if ($key === 'IPアドレス') {
        $ip = $_SERVER["REMOTE_ADDR"];
        return $ip;
      }
      if ($key === 'ホスト名') {
        $host = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
        return $host;
      }
      if ($key === '送信日時') {
        $org_timezone = date_default_timezone_get();
        date_default_timezone_set('Asia/Tokyo');
        $Datetime = date("Y年n月j日 H:i:s");
        date_default_timezone_set($org_timezone);
        return $Datetime;
      }
      return $value;
    }, 10, 3);
  }
}