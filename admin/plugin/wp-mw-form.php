<?php

/**
 *
 */
function add_yubinbango_script()
{
  wp_enqueue_script('yubinbango', 'https://yubinbango.github.io/yubinbango/yubinbango.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'add_yubinbango_script', 99);

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
function add_yubinbango_class()
{
  echo <<<HTML
    <script>
        jQuery('.mw_wp_form form').addClass('h-adr');
    </script>
    HTML;
}
add_action('wp_print_footer_scripts', 'add_yubinbango_class');


// 1:北海道
// 2:青森県
// 3:岩手県
// 4:宮城県
// 5:秋田県
// 6:山形県
// 7:福島県
// 8:茨城県
// 9:栃木県
// 10:群馬県
// 11:埼玉県
// 12:千葉県
// 13:東京都
// 14:神奈川県
// 15:新潟県
// 16:富山県
// 17:石川県
// 18:福井県
// 19:山梨県
// 20:長野県
// 21:岐阜県
// 22:静岡県
// 23:愛知県
// 24:三重県
// 25:滋賀県
// 26:京都府
// 27:大阪府
// 28:兵庫県
// 29:奈良県
// 30:和歌山県
// 31:鳥取県
// 32:島根県
// 33:岡山県
// 34:広島県
// 35:山口県
// 36:徳島県
// 37:香川県
// 38:愛媛県
// 39:高知県
// 40:福岡県
// 41:佐賀県
// 42:長崎県
// 43:熊本県
// 44:大分県
// 45:宮崎県
// 46:鹿児島県
// 47:沖縄県