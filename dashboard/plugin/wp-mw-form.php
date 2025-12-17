<?php

declare(strict_types=1);

/**
 * 確認・完了ページで消したい要素
 */
function my_footer_script()
{

  if (is_page('contact')): ?>
<script>
$(function() {
  //規約チェックボックスの文言変更
  $('.c-form__agreement .mwform-checkbox-field-text').html(
    '「<a href="<?php echo esc_url(home_url('privacy/')); ?>" target="_blank" class="u-txt_ul">プライバシーポリシー</a>」に同意する'
  );
});
</script>
<?php endif;

  if (is_page(['contact', 'confirm', 'thanks'])) : ?>
<script type="text/javascript">
jQuery(function($) {
  if ($('.mw_wp_form_confirm, .mw_wp_form_complete').length) {
    $('.c-form__notes').hide();
    $('.c-form__privacy').hide();
    $('.c-form__agreement').hide();
  }
});
</script>
<?php endif;
}
add_action('wp_footer', 'my_footer_script');


/**
 * yubinbango.jsを読み込む
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


/******************************************************
 *
 * オリジナルメールタグ定義
 *
 * @param string $value 送信された値
 * @param string $key メールタグ
 * @param int $insert_contact_data_id データベースに保存した場合、そのときの Post ID
 *
 *******************************************************/
function mwform_send_mail_content($value, $key, $insert_contact_data_id)
{

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
}
add_filter('mwform_custom_mail_tag', 'mwform_send_mail_content', 10, 3);




/******************************************************
 *
 * 新規作成時にフォームを自動生成
 *
 *******************************************************/
function my_mwform_default_content($content)
{
  ob_start();
  echo <<<HTML
    <div class="c-form__head">

    </div>
    <div class="c-form__body">
      <table class="c-form__sheet">
        <tr>
          <th>
            <div class="c-form__ttl -required"><span>お名前</span></div>
          </th>
          <td>
            <div class="c-form__row">
              <div class="c-form__field">[mwform_text name="your_name" class="c-form__input -text -middle" show_error="false"]</div>
            </div>
            <div class="c-form__error">[mwform_error keys="your_name"]</div>
          </td>
        </tr>
        <tr>
          <th>
            <div class="c-form__ttl -required"><span>フリガナ</span></div>
          </th>
          <td>
            <div class="c-form__row">
              <div class="c-form__field">[mwform_text name="your_name_kana" class="c-form__input -text -middle" show_error="false"]</div>
            </div>
            <div class="c-form__error">[mwform_error keys="your_name_kana"]</div>
          </td>
        </tr>
        <tr>
          <th>
            <div class="c-form__ttl -required"><span>お名前</span></div>
          </th>
          <td>
            <div class="c-form__row">
              <div class="c-form__field">[mwform_text name="your_name01" class="c-form__input -text -half" show_error="false" placeholder="姓"][mwform_text name="your_name02" class="c-form__input -text -half" show_error="false" placeholder="名"]</div>
            </div>
            <div class="c-form__error">[mwform_error keys="your_name01,your_name02"]</div>
          </td>
        </tr>
        <tr>
          <th>
            <div class="c-form__ttl -required"><span>フリガナ</span></div>
          </th>
          <td>
            <div class="c-form__row">
              <div class="c-form__field">[mwform_text name="your_name_kana01" class="c-form__input -text -half" show_error="false" placeholder="セイ"][mwform_text name="your_name_kana02" class="c-form__input -text -half" show_error="false" placeholder="メイ"]</div>
            </div>
            <div class="c-form__error">[mwform_error keys="your_name_kana01,your_name_kana02"]</div>
          </td>
        </tr>
        <tr>
          <th>
            <div class="c-form__ttl -required"><span>性別</span></div>
          </th>
          <td>
            <div class="c-form__row">
              <div class="c-form__field">[mwform_radio name="your_gender" class="c-form__radio" children="男性,女性" value="男性" show_error="false"]</div>
            </div>
            <div class="c-form__error">[mwform_error keys="your_gender"]</div>
          </td>
        </tr>
        <tr>
          <th>
            <div class="c-form__ttl -required"><span>電話番号</span></div>
          </th>
          <td>
            <div class="c-form__row">
              <div class="c-form__field">[mwform_text name="your_tel" class="c-form__input -text -short" show_error="false"]</div>
            </div>
            <div class="c-form__notes">ハイフンなしで入力してください</div>
            <div class="c-form__error">[mwform_error keys="your_tel"]</div>
          </td>
        </tr>
        <tr>
          <th>
            <div class="c-form__ttl -required"><span>ご住所</span></div>
          </th>
          <td>
            <div class="c-form__row">
              <table class="c-form__rowgroup h-adr">
                <tr>
                  <th><div class="c-form__ttl">郵便番号</div></th>
                  <td><div class="c-form__field">〒[mwform_text name="your_postal" class="p-postal-code c-form__input -text" show_error="false" size="8"]</div></td>
                </tr>
                <tr>
                  <th><div class="c-form__ttl">都道府県</div></th>
                  <td>
                    <div class="c-form__field">
                      <span class="p-country-name" style="display:none;">Japan</span>
                      [mwform_select name="your_pref" children=":--,北海道,青森県,岩手県,宮城県,秋田県,山形県,福島県,茨城県,栃木県,群馬県,埼玉県,千葉県,東京都,神奈川県,新潟県,富山県,石川県,福井県,山梨県,長野県,岐阜県,静岡県,愛知県,三重県,滋賀県,京都府,大阪府,兵庫県,奈良県,和歌山県,鳥取県,島根県,岡山県,広島県,山口県,徳島県,香川県,愛媛県,高知県,福岡県,佐賀県,長崎県,熊本県,大分県,宮崎県,鹿児島県,沖縄県" class="p-region c-form__select" show_error="false"]
                    </div>
                  </td>
                </tr>
                <tr>
                  <th><div class="c-form__ttl">市区町村・番地</div></th>
                  <td><div class="c-form__field">[mwform_text name="your_locality" class="p-locality p-street-address c-form__input -text -long" show_error="false"]</div></td>
                </tr>
                <tr>
                  <th><div class="c-form__ttl">ビル・マンション名</div></th>
                  <td><div class="c-form__field">[mwform_text name="your_exaddress" class="p-extended-address c-form__input -text -long" show_error="false"]</div></td>
                </tr>
              </table>
            </div>
            <div class="c-form__error">[mwform_error keys="your_postal,your_pref,your_locality"]</div>
          </td>
        </tr>
        <tr>
          <th>
            <div class="c-form__ttl -required"><span>メールアドレス</span></div>
          </th>
          <td>
            <div class="c-form__row">
              <div class="c-form__field">[mwform_email name="your_mail" class="c-form__input -text -middle" show_error="false"]</div>
            </div>
            <div class="c-form__error">[mwform_error keys="your_mail"]</div>
          </td>
        </tr>
        <tr>
          <th>
            <div class="c-form__ttl -required"><span>HPをご覧になったきっかけ</span></div>
          </th>
          <td>
            <div class="c-form__row">
              <div class="c-form__field">[mwform_checkbox name="your_trigger" class="c-form__check" children="ホームズ,SUUMO,友達の紹介,チラシ・パンフレット" separator="," show_error="false"]</div>
            </div>
            <div class="c-form__error">[mwform_error keys="your_trigger"]</div>
          </td>
        </tr>
        <tr>
          <th>
            <div class="c-form__ttl -required"><span>お問い合わせ内容</span></div>
          </th>
          <td>
            <div class="c-form__row">
              <div class="c-form__field">[mwform_textarea name="your_inquiry" class="c-form__input -textarea -long" show_error="false"]</div>
            </div>
            <div class="c-form__error">[mwform_error keys="your_inquiry"]</div>
          </td>
        </tr>
      </table>
    </div>
    <div class="c-form__foot">
      <div class="c-form__privacy">
        [myphp file=inc/module/block/privacy]
        <div class="c-form__agreement"><div class="c-form__check">[mwform_checkbox name="your_agreement" children="同意する" separator="," show_error="false" class="c-form__check"]</div></div>
      </div>
      <div class="u-ta_center">[mwform_error keys="your_agreement"]</div>
      <div class="u-ta_center">[mwform_hidden name="recaptcha-v3" value="false"][mwform_error keys="recaptcha-v3"]</div>
      <div class="c-form__button">
      [mwform_bsubmit name="btn_submit" class="c-form__btn" value="submit"]送信する[/mwform_bsubmit]
      [mwform_bconfirm class="c-form__btn" value="confirm"]確認画面へ[/mwform_bconfirm]
      [mwform_bback class="c-form__btn -back" value="back"]戻る[/mwform_bback]
      </div>
    </div>

  HTML;
  return ob_get_clean();
}
add_filter('mwform_default_content', 'my_mwform_default_content');


/******************************************************
 *
 * 新規作成時に各項目を自動設定
 *
 *******************************************************/
function my_mwform_default_settings($value, $key)
{

  // **************************************************
  //
  // 変数設定
  // @ $profile   : 会社情報
  // @ $input     : 送信内容
  //
  // **************************************************
  $profile = array(
    'name' => get_bloginfo('name'),
    'email' => get_bloginfo('admin_email'),
  );


  $input = <<<EOT

─送信内容の確認─────────────────

[ お名前 ]　{your_name}

[ フリガナ ]　{your_name_kana}

[ 性別 ]　{your_gender}

[ ご住所 ]　〒{your_postal}　{your_address}

[ 電話番号 ]　{your_tel}

[ メールアドレス ]　{your_mail}

[ HPをご覧になったきっかけ ]　{your_trigger}

[ お問い合わせ内容 ]
{your_inquiry}

──────────────────────────

EOT;


  // **************************************************
  //
  // 自動返信メール各種設定
  // @mail_subject          : 件名
  // @mail_sender           : 送信者
  // @mail_reply_to         : Reply-to
  // @mail_from             : 送信元
  // @automatic_reply_email : 自動返信メール
  // @mail_content          : 本文
  //
  // **************************************************
  if ($key == 'mail_subject') {
    return 'お問い合わせありがとうございます';
  }

  if ($key == 'mail_sender') {
    return $profile['name'];
  }

  if ($key == 'mail_reply_to') {
    return $profile['email'];
  }

  if ($key == 'mail_from') {
    return $profile['email'];
  }

  if ($key == 'automatic_reply_email') {
    return 'your_mail';
  }

  if ($key == 'mail_content') {
    $content = <<<EOT
{your_name}様

この度は、お問い合わせいただき、ありがとうございます。
こちらのメールは、お問い合わせいただいた時点で配信される自動返信メールとなっております。
送信していただいた内容を確認し、担当者より改めてご連絡致します。

{$input}

このメールに心当たりの無い場合は、下記の連絡先までお問い合わせください。

=================================

{$profile['name']}

=================================
EOT;
    return $content;
  }


  // **************************************************
  //
  // 管理者宛メール各種設定
  // @mail_to               : 送信先
  // @admin_mail_subject    : 件名
  // @admin_mail_sender     : 送信者
  // @admin_mail_reply_to   : Reply-to
  // @admin_mail_content    : 本文
  // @mail_return_path      : Return-Path
  // @admin_mail_from       : 送信元
  //
  // **************************************************

  if ($key == 'mail_to') {
    return $profile['email'];
  }

  if ($key == 'admin_mail_subject') {
    return 'お問い合わせがありました';
  }

  if ($key == 'admin_mail_sender') {
    return '{your_name}';
  }

  if ($key == 'admin_mail_reply_to') {
    return '{your_mail}';
  }

  if ($key == 'admin_mail_content') {
    $content = <<<EOT
{your_name}様よりお問い合わせがありました。

{$input}

******************************************

利用環境 : {利用環境}
送信元IPアドレス : {IPアドレス}
ホスト名 : {ホスト名}
送信日時 : {送信日時}
EOT;
    return $content;
  }

  if ($key == 'mail_return_path') {
    return $profile['email'];
  }

  if ($key == 'admin_mail_from') {
    return '{your_mail}';
  }

  // **************************************************
  //
  // バリデーション
  // @target        : 対象
  // @noempty       : 必須項目
  // @required      : 必須項目(チェックボックス)
  // @numeric       : 半角数字
  // @alpha         : 半角英字
  // @alphanumeric  : 半角英数字
  // @katakana      : カタカナ
  // @hiragana      : ひらがな
  // @kana          : ひらがな または カタカナ
  // @zip           : 郵便番号
  // @tel           : 電話番号
  // @mail          : メールアドレス
  // @date          : 日付
  // @month         : 日付（年月）
  // @url           : URL
  //
  // **************************************************
  if ($key == 'validation') {
    return array(
      array(
        'target'  => 'your_name',
        'noempty' => true,
      ),
      array(
        'target'  => 'your_name_kana',
        'noempty' => true,
        'katakana' => true,
      ),
      array(
        'target'  => 'your_mail',
        'noempty' => true,
        'mail' => true,
      ),
      array(
        'target'  => 'your_tel',
        'noempty' => true,
        'tel' => true,
      ),
      array(
        'target'  => 'your_postal',
        'noempty' => true,
        'zip' => true,
      ),
      array(
        'target'  => 'your_inquiry',
        'noempty' => true,
      ),
      array(
        'target'  => 'recaptcha-v3',
      ),
    );
  }


  // **************************************************
  //
  // その他
  // @input_url         : 入力画面URL
  // @confirmation_url  : 確認画面URL
  // @complete_url      : 完了画面URL
  // @complete_message  : 完了ページメッセージ
  // @usedb             : 問合せ内容をDBに保存
  //
  // **************************************************

  if ($key == 'complete_message') {
    $message = <<< EOF
<p>この度は、お問い合わせいただき、ありがとうございます。<br>ご入力いただきましたメールアドレス宛に自動返信メールをお送りしております。<br>ご送信いただいた内容を確認後、折り返しご連絡させていただきます。</p>
<div class="c-form__button"><a href="../../" class="c-form__btn">トップページ</a></div>
EOF;
    return $message;
  }

  if ($key == 'usedb') {
    return true;
  }

  if ($key == 'input_url') {
    return '/contact/';
  }

  if ($key == 'confirmation_url') {
    return '/contact/confirm/';
  }

  if ($key == 'complete_url') {
    return '/contact/thanks/';
  }
}
add_filter('mwform_default_settings', 'my_mwform_default_settings', 10, 2);